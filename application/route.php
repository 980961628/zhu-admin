<?php
use think\Route;

//index/index/new
//模块/控制器/方法

Route::rule('new/:id','index/Index/news');
Route::rule('user','index/User/index');
Route::rule('test','index/Index/test');
Route::get('a/:id/[:name]',function($id,$name='zhu'){
    return $id.$name;
});

Route::group("aa",[
    "id"=>['index/Index/test'],
    "name"=>['index/Index/test'],
]);
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    '__alias__' =>  [
        'user'  =>  'index/User',
    ],
    '__miss__'  => 'public/miss',
];
