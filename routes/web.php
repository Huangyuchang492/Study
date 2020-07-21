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



//默认页面
Route::get('/',function (){
    return redirect('/');
});

// 用户模块

/**
 * 注册页面
 */
Route::get('/register','\App\Http\Controllers\RegisterController@index');
/**
 * 注册逻辑
 */
Route::post('/register','\App\Http\Controllers\RegisterController@register');
/**
 * 登录页面
 */
Route::get('/login','\App\Http\Controllers\LoginController@index')->name('login');
/**
 * 登录逻辑
 */
Route::post('/login','\App\Http\Controllers\LoginController@login');



Route::group(['middleware'=>'auth:web'],function (){
    /**
     * 个人设置页面
     */
    Route::get('user/me/setting','\App\Http\Controllers\UserController@setting');
    /**
     * 个人设置操作
     */
    Route::post('user/me/setting','\App\Http\Controllers\UserController@settingStore');

    /**
     * 文章列表页
     */
    Route::get('/posts','PostController@index');
    /**
     *文章详情页
     */
    Route::get('/posts/show/{post}','PostController@show');
    /**
     * 创建文章
     */
    Route::get('/posts/create','\App\Http\Controllers\PostController@create');
    Route::post('/posts','PostController@store');
    /**
     *编辑文章
     */
    Route::get('/posts/{post}/edit','PostController@edit');
    Route::put('/posts/update/{post}','PostController@update');
    /**
     * 删除文章
     */
    Route::get('/posts/delete','PostController@delete');
    /**
     * 图片上传
     */
    Route::post('/posts/image/upload','PostController@imageupload');

    /**
     * 登出行为
     */
    Route::get('logout','\App\Http\Controllers\LoginController@loginout');

    /**
     * 评论提交
     */
    Route::post('/posts/{post}/comment','PostController@comment');

    /**
     * 点赞
     */
    Route::get('/posts/{post}/zan','PostController@zan');
    /**
     * 取消赞
     */
    Route::get('/posts/{post}/unzan','PostController@unzan');

    /**
     * 个人中心
     */
    Route::get('/user/{user}/show','UserController@show');
    Route::post('/user/{user}/fan','UserController@fan');
    Route::post('/user/{user}/unfan','UserController@unfan');

    /**
     * 专题模块
     *专题详情
     */
    Route::get('/topic/{topic}','TopicController@show');
    /**
     * 投稿
     */
    Route::post('/topic/{topic}/submit','TopicController@submit');

    /**
     *通知
     */
    Route::get('/notices','\App\Http\Controllers\NoticeController@index');

});

include_once('admin.php');







