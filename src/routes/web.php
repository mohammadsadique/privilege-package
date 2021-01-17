<?php

// use Illuminate\Support\Facades\Route;

use Sadique\Privilege\Http\Controllers\Privilege1Controller;
use Sadique\Privilege\Http\Controllers\Privilege2Controller;

Route::group(['namespace' => 'Sadique\Privilege\Http\Controllers'], function(){
    Route::get('/addpages', [ Privilege1Controller::class , 'addpages' ])->name('addpages');
    Route::post('/subaddmodule', [ Privilege1Controller::class , 'subaddmodule' ])->name('subaddmodule');
    Route::post('/subaddsubmodule', [ Privilege1Controller::class , 'subaddsubmodule' ])->name('subaddsubmodule');
    Route::post('/delmodule', [ Privilege1Controller::class , 'delmodule' ])->name('delmodule');
    Route::post('/delsubmodule', [ Privilege1Controller::class , 'delsubmodule' ])->name('delsubmodule');
    Route::post('/updmodule', [ Privilege1Controller::class , 'updmodule' ])->name('updmodule');
    Route::post('/updsubmodule', [ Privilege1Controller::class , 'updsubmodule' ])->name('updsubmodule');
    Route::post('/showmodule', [ Privilege1Controller::class , 'showmodule' ])->name('showmodule');
    Route::post('/hidemodule', [ Privilege1Controller::class , 'hidemodule' ])->name('hidemodule');
    Route::post('/showsubmodule', [ Privilege1Controller::class , 'showsubmodule' ])->name('showsubmodule');
    Route::post('/hidesubmodule', [ Privilege1Controller::class , 'hidesubmodule' ])->name('hidesubmodule');

    Route::get('/showprivilege', [ Privilege1Controller::class , 'showprivilege' ])->name('showprivilege');
    Route::get('/assignprivilege', [ Privilege2Controller::class , 'assignprivilege' ])->name('assignprivilege');
    Route::post('/subassignpri', [ Privilege2Controller::class , 'subassignpri' ])->name('subassignpri');
    Route::get('/staffprivilege/{id}', [ Privilege2Controller::class , 'staffprivilege' ])->name('staffprivilege');

    Route::post('/assignmodule',[ Privilege2Controller::class, 'assignmodule'])->name('assignmodule');
    Route::post('/notassignmodule',[ Privilege2Controller::class, 'notassignmodule'])->name('notassignmodule');
    Route::post('/Allassignmodule',[ Privilege2Controller::class, 'Allassignmodule'])->name('Allassignmodule');
    Route::post('/Allremovemodule',[ Privilege2Controller::class, 'Allremovemodule'])->name('Allremovemodule');
    Route::post('/assignsubmodule',[ Privilege2Controller::class, 'assignsubmodule'])->name('assignsubmodule');
    Route::post('/removesubmodule',[ Privilege2Controller::class, 'removesubmodule'])->name('removesubmodule');
});



// Route::get('privilege',function(){
//     return 'rrr';
// });