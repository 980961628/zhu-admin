<?php
// 指定允许其他域名访问
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:*');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
use think\Route;

Route::group('api/admin',function(){
  Route::group('study',function(){
    //分类管理
    Route::group('category',function(){
      Route::any('test','api/Study/test');
      Route::post('add','api/Study/category_add');
    });

    //笔记管理
    Route::group('node',function(){
      Route::post('add','api/Study/node_add');
      Route::get('list','api/Study/node_list');
    });
  });
});
