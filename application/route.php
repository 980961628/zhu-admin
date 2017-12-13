<?php
use think\Route;
use think\Db;
use app\api\model\Admin;

Route::rule("/",function(){
    $admin = new Admin();
    $admin->data([
        'name'=>'朱哥哥'
    ]);
    $res = $admin->save();
});



