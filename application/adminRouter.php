<?php
use think\Route;

Route::get('admin/:id',function($id){
    echo $id;
},[],['id'=>'\d+']);

//Route::group('admin',function(){
//  Route::group('study',function(){
//    Route::any('test',function(){
//      echo 'test';
//    });
//  });
//});
