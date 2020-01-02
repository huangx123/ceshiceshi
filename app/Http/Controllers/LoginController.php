<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 2019/7/22
 * Time: 16:41
 */

namespace App\Http\Controllers;


use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LoginController extends CommonController
{

    //登录页面
    public function login() {
        return view('/login');
    }


    //登录页面
    public function in_login() {
        $email = $_POST['email'];
        if (!$email) {
            return '请输入邮箱';
        }

        $users = DB::table('users')->where('email' , $email)->first();
        if (!$users) {
            return response()->json([
                'status' => 404,
                'msg' => '邮箱输入错误',
            ],404);
        }
        $password = md5($_POST['password']);
        if (!$password) {
            return response()->json([
                'status' => 404,
                'msg' => '请输入密码',
            ],404);
        }
        if ($users->password !== $password) {
            return response()->json([
                'status' => 404,
                'msg' => '密码错误',
            ],404);
        }

        $res = $users = DB::table('users')->where('email' , $email)->where('password' , $password)->first();
//        Session::put('uid' , $res['id']);
        if ($res) {
            return response()->json([
                'status' => 200,
                'msg' => '登录成功',
            ],200);
        } else {
            return response()->json([
                'status' => 404,
                'msg' => '登录失败',
            ],404);
        }

    }
}