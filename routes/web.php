<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard','App\Http\Controllers\DeviceController@getDashBoard')
    ->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/','App\Http\Controllers\DeviceController@getDashBoard')
    ->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/device','App\Http\Controllers\DeviceController@index')
->name('device');
Route::middleware(['auth:sanctum', 'verified'])->get('/device/create','App\Http\Controllers\DeviceController@create')
    ->name('device.create');
Route::middleware(['auth:sanctum', 'verified'])->post('/device','App\Http\Controllers\DeviceController@store')
    ->name('device.store');
Route::middleware(['auth:sanctum', 'verified'])->get('/device/{id}','App\Http\Controllers\DeviceController@show')
    ->name('device.show');
Route::middleware(['auth:sanctum', 'verified'])->get('/device/latency/{id}','App\Http\Controllers\DeviceController@showLatency')
    ->name('device.latency');
Route::middleware(['auth:sanctum', 'verified'])->get('/device/events/{id}','App\Http\Controllers\DeviceController@showEvents')
    ->name('device.events');
Route::middleware(['auth:sanctum', 'verified'])->get('/device/dhcp/{id}','App\Http\Controllers\DeviceController@showDHCP')
    ->name('device.dhcp');
Route::middleware(['auth:sanctum', 'verified'])->get('/device/ip/{id}','App\Http\Controllers\DeviceController@showIP')
    ->name('device.ip');
Route::middleware(['auth:sanctum', 'verified'])->get('/ip','App\Http\Controllers\IpController@index')
    ->name('ip.index');
Route::middleware(['auth:sanctum', 'verified'])->get('/device/neighbors/{id}','App\Http\Controllers\DeviceController@showNeighbors')
    ->name('device.neighbors');
Route::middleware(['auth:sanctum', 'verified'])->get('/location','App\Http\Controllers\LocationController@index')
    ->name('location');
Route::middleware(['auth:sanctum', 'verified'])->get('/location/{id}','App\Http\Controllers\LocationController@show')
    ->name('location.show');

Route::get('/deviceinterface/{id}','App\Http\Controllers\DeviceinterfaceController@index');
Route::get('/deviceinterface/graph/{id}','App\Http\Controllers\DeviceinterfaceController@show');


Route::get('/dashboard/onlinedevices','App\Http\Controllers\DeviceController@dashboardOnlineDevices');
Route::get('/dashboard/offlinedevices','App\Http\Controllers\DeviceController@dashboardOfflineDevices');
Route::get('/dashboard/unstabledevices','App\Http\Controllers\DeviceController@dashboardUnstableDevices');
Route::get('/dashboard/events','App\Http\Controllers\DeviceController@dashboardEvents');
