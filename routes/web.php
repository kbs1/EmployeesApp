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

Route::get('/', 'DashboardController@index')->name('dashboard');

Route::get('/employees', 'EmployeesController@listing')->name('employees.listing');
Route::get('/employees/add', 'EmployeesController@add')->name('employees.add');
Route::post('/employees/add', 'EmployeesController@create')->name('employees.create');
Route::get('/employees/{id}/edit', 'EmployeesController@edit')->name('employees.edit');
Route::put('/employees/{id}/edit', 'EmployeesController@update')->name('employees.update');
Route::get('/employees/{id}/delete', 'EmployeesController@delete')->name('employees.delete');

Route::get('/projects', 'ProjectsController@listing')->name('projects.listing');
Route::get('/projects/add', 'ProjectsController@add')->name('projects.add');
Route::post('/projects/add', 'ProjectsController@create')->name('projects.create');
Route::get('/projects/{id}/edit', 'ProjectsController@edit')->name('projects.edit');
Route::put('/projects/{id}/edit', 'ProjectsController@update')->name('projects.update');
Route::get('/projects/{id}/delete', 'ProjectsController@delete')->name('projects.delete');