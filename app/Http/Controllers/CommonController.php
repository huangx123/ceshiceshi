<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 2019/7/22
 * Time: 16:41
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class CommonController extends Controller
{

    public function __construct()
    {
        $this->checkLogin();

    }

    public function checkLogin(){
        if(!Session::get("uid")){
            return redirect("/login");
        }
    }

}