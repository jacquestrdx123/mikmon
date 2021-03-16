/**
 * PHP bindings to the rrdtool
 *
 * This source file is subject to the BSD license that is bundled
 * with this package in the file LICENSE.
 * ---------------------------------------------------------------
 *  Author: Miroslav Kubelik <koubel@php.net>
 * ---------------------------------------------------------------
 */

#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include "php.h"
#include "zend_exceptions.h"
#include "ext/standard/php_smart_string.h"

#include <rrd.h>

#include "php_rrd.h"
#include "rrd_update.h"

/* declare class entry */
static zend_class_entry *ce_rrd_update;
/* declare class handlers */
static zend_object_handlers rrd_update_handlers;

/**
 * overloading the standard zend object structure (std property) in the need
 * of having dedicated creating/cloning/destruction functions
 */
typedef struct _rrd_update_object {
	/** path to newly created rrd file */
	char *file_path;
	zend_object std;
} rrd_update_object;

/**
 * fetch our custom object from user space object
 */
static inline rrd_update_object *php_rrd_update_fetch_object(zend_object *obj) {
	return (rrd_update_object *)((char*)(obj) - XtOffsetOf(rrd_update_object, std));
} 

/* {{{ rrd_update_object_dtor
close all resources and the memory allocated for our internal object
*/
static void rrd_update_object_dtor(zend_object *object)
{
	rrd_update_object *intern_obj = php_rrd_update_fetch_object(object);
	if (!intern_obj) return;

	if (intern_obj->file_path)
		efree(intern_obj->file_path);

	zend_object_std_dtor(&intern_obj->std);
}
/* }}} */

/* {{{ rrd_update_object_new
creates new rrd update object
*/
static zend_object *rrd_update_object_new(zend_class_entry *ce)
{
	rrd_update_object *intern_obj = ecalloc(1, sizeof(rrd_update_object) +
		zend_object_properties_size(ce));
	intern_obj->file_path = NULL;

	zend_object_std_init(&intern_obj->std, ce);
	object_properties_init(&intern_obj->std, ce);
	
	intern_obj->std.handlers = &rrd_update_handlers;

	return &intern_obj->std;
}
/* }}} */

 /* {{{ proto void RRDUpdater::__construct(string path)
creates new object for rrd update function
 */
PHP_METHOD(RRDUpdater, __construct)
{
	rrd_update_object *intern_obj;
	char *path;
	size_t path_length;

	if (zend_parse_parameters(ZEND_NUM_ARGS(), "p", &path, &path_length) == FAILURE) {
		return;
	}

	intern_obj = php_rrd_update_fetch_object(Z_OBJ_P(getThis()));
	intern_obj->file_path = estrdup(path);
}
/* }}} */

/* {{{ proto array RRDUpdater::update(array $values, [string time=time()])
 Updates data sources in RRD database
 */
PHP_METHOD(RRDUpdater, update)
{
	rrd_update_object *intern_obj;
	zval *zv_values_array;

	/* help structures for preparing arguments for rrd_update call */
	zval zv_update_argv;
	rrd_args *update_argv;

	/* 'N' means default time string for rrd update, 
	 * see rrdtool update man page
	 */
	char *time = "N";
	size_t time_str_length = 1;

	int argc = ZEND_NUM_ARGS();
	zend_string *zs_ds_name;
	zval *zv_ds_val;

	/* string for all data source names formated for rrd_update call */
	smart_string ds_names = {0};
	/* string for all data source values for rrd_update call */
	smart_string ds_vals = {0};

	if (zend_parse_parameters(argc, "a|s", &zv_values_array, &time,
		&time_str_length) == FAILURE) {
		return;
	}

	if (zend_hash_num_elements(Z_ARRVAL_P(zv_values_array)) <= 0) {
		RETURN_TRUE;
	}

	intern_obj = php_rrd_update_fetch_object(Z_OBJ_P(getThis()));

	if (php_check_open_basedir(intern_obj->file_path)) {
		RETURN_FALSE;
	}

	if (argc > 1 && time_str_length == 0) {
		zend_throw_exception(NULL, "time cannot be empty string", 0);
		return;
	}

	ZEND_HASH_FOREACH_STR_KEY_VAL(Z_ARRVAL_P(zv_values_array), zs_ds_name, zv_ds_val) {
		if (ds_names.len) {
			smart_string_appendc(&ds_names, ':');
		} else {
			smart_string_appends(&ds_names, "--template=");
		}

		smart_string_appends(&ds_names, ZSTR_VAL(zs_ds_name));

		/* "timestamp:ds1Value:ds2Value" string */
		if (!ds_vals.len) {
			smart_string_appends(&ds_vals, time);
		}
		smart_string_appendc(&ds_vals, ':');
		if (Z_TYPE_P(zv_ds_val) != IS_STRING) {
			convert_to_string(zv_ds_val);
		}
		smart_string_appendl(&ds_vals, Z_STRVAL_P(zv_ds_val), Z_STRLEN_P(zv_ds_val));
	} ZEND_HASH_FOREACH_END();
	smart_string_0(&ds_names);
	smart_string_0(&ds_vals);

	/* add copy of names and values strings into arguments array and free
	 * original strings
	 */
	array_init(&zv_update_argv);
	add_next_index_string(&zv_update_argv, ds_names.c);
	add_next_index_string(&zv_update_argv, ds_vals.c);
	smart_string_free(&ds_names);
	smart_string_free(&ds_vals);

	update_argv = rrd_args_init_by_phparray("update", intern_obj->file_path, &zv_update_argv);
	if (!update_argv) {
		zend_error(E_WARNING, "cannot allocate arguments options");
		zval_dtor(&zv_update_argv);
		if (time_str_length == 0) efree(time);
		RETURN_FALSE;
	}

	if (rrd_test_error()) rrd_clear_error();

	/* call rrd_update and test if fails */
	if (rrd_update(update_argv->count - 1, &update_argv->args[1]) == -1) {
		zval_dtor(&zv_update_argv);
		rrd_args_free(update_argv);

		/* throw exception with rrd error string */
		zend_throw_exception(NULL, rrd_get_error(), 0);
		rrd_clear_error();
		return;
	}

	zval_dtor(&zv_update_argv);
	rrd_args_free(update_argv);

	RETURN_TRUE;
}
/* }}} */

/* {{{ proto int rrd_update(string file, array options)
	Updates the RRD file with a particular options and values.
*/
PHP_FUNCTION(rrd_update)
{
	char *filename;
	size_t filename_length;
	zval *zv_arr_options;
	rrd_args *argv;

	if (zend_parse_parameters(ZEND_NUM_ARGS(), "pa", &filename,
		&filename_length, &zv_arr_options) == FAILURE) {
		return;
	}

	if (php_check_open_basedir(filename)) RETURN_FALSE;

	argv = rrd_args_init_by_phparray("update", filename, zv_arr_options);
	if (!argv) {
		zend_error(E_WARNING, "cannot allocate arguments options");
		RETURN_FALSE;
	}

	if (rrd_test_error()) rrd_clear_error();

	if (rrd_update(argv->count - 1, &argv->args[1]) == -1 ) {
		RETVAL_FALSE;
	} else {
		RETVAL_TRUE;
	}

	rrd_args_free(argv);
}
/* }}} */

ZEND_BEGIN_ARG_INFO(arginfo_rrdupdater_construct, 0)
	ZEND_ARG_INFO(0, path)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_rrdupdater_update, 0, 0, 1)
	ZEND_ARG_INFO(0, values)
	ZEND_ARG_INFO(0, time)
ZEND_END_ARG_INFO()

/* class method table */
static zend_function_entry rrd_update_methods[] = {
	PHP_ME(RRDUpdater, __construct, arginfo_rrdupdater_construct, ZEND_ACC_PUBLIC)
	PHP_ME(RRDUpdater, update, arginfo_rrdupdater_update, ZEND_ACC_PUBLIC)
	PHP_FE_END
};

/* minit hook, called from main module minit */
void rrd_update_minit()
{
	zend_class_entry ce;
	INIT_CLASS_ENTRY(ce, "RRDUpdater", rrd_update_methods);
	ce.create_object = rrd_update_object_new;
	ce_rrd_update = zend_register_internal_class(&ce);

	memcpy(&rrd_update_handlers, zend_get_std_object_handlers(), sizeof(zend_object_handlers));
	rrd_update_handlers.clone_obj = NULL;
	rrd_update_handlers.offset = XtOffsetOf(rrd_update_object, std);
	rrd_update_handlers.free_obj = rrd_update_object_dtor;
}
