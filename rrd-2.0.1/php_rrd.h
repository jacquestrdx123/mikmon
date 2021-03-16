/**
 * PHP bindings to the rrdtool
 *
 * This source file is subject to the BSD license that is bundled
 * with this package in the file LICENSE.
 * ---------------------------------------------------------------
 *  Author: Miroslav Kubelik <koubel@php.net>
 * ---------------------------------------------------------------
 */

#ifndef PHP_RRD_H
#define PHP_RRD_H

extern zend_module_entry rrd_module_entry;
#define phpext_rrd_ptr &rrd_module_entry

#define PHP_RRD_VERSION "2.0.1"

#ifdef ZTS
#include "TSRM.h"
#endif

#ifndef zend_parse_parameters_none
# define zend_parse_parameters_none() zend_parse_parameters(ZEND_NUM_ARGS(), "")
#endif 

typedef struct _rrd_args {
	int count;
	char **args;
} rrd_args;

extern rrd_args *rrd_args_init_by_phparray(const char *command_name, const char *filename,
	const zval *options);
extern void rrd_args_free(rrd_args *args);

#endif  /* PHP_RRD_H */
