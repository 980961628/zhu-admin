<?php
use think\Route;

Route::group('api/admin',function(){
  Route::group('study',function(){
    Route::any('test',function(){
      echo 'test';
    });
    Route::any('test2/:id','api/Index/test2');
  });
});
