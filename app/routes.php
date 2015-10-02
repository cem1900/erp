<?php
// 首页
//
Route::get('/', array('uses' => 'HomeController@getIndex'));

// 员工
//
Route::controller('users', 'UsersController');

// 货品
//
Route::controller('goods', 'GoodsController');

// 网点
//
Route::controller('branch', 'BranchController');

// 配送
//
Route::controller('picking', 'PickingController');

// 通知
//
Route::controller('notice', 'NoticeController');
