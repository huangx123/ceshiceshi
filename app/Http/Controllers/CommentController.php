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
class CommentController extends CommonController
{
    //创建表
    public function createMsql(){

         if(!Schema::hasTable('messages')){
            Schema::create('messages', function ($table) {
                $table->increments('id');
                $table->string('title');
                $table->string('content');
                $table->dateTime('created_at');
                $table->dateTime('updated_at');
            });
        }

        if(!Schema::hasTable('users')){
            Schema::create('users', function ($table) {
                $table->increments('id');
                $table->string('username');
                $table->string('password');
                $table->dateTime('created_at');
                $table->dateTime('updated_at');
            });
        }

    }
//
//        public function show() {
//        return view('show');
//        }


    //列表
    public function list(Request $request) {
        //查询
        $where = [];
        $start = $request->get('start');
        $end = $request->get('end');
        $title = $request->get('title');
        if (isset($start) && isset($end)){
            $where[] = ['created_at' ,'>' ,$start];
            $where[] = ['created_at' ,'<=' ,$end];
        }elseif (isset($title)) {
            $where[] = ['title','like','%'.$title.'%'];
        }
        $messages = DB::table('messages')->where($where)->paginate(10);
//        var_dump($res);
        return view('/list')->with('messages', $messages);

    }

    public function add() {
        return view('/add');
    }
    //增加信息
    public function create() {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $created_at = date("Y-m-d H:i:s",time());
        $updated_at = date("Y-m-d H:i:s",time());
        $res = DB::table('messages')->insert(['title'=>$title , 'content'=>$content ,'created_at'=>$created_at,'updated_at'=>$updated_at]);
//       return redirect('/list');
        return response()->json([
            'status' => 200,
            'msg' => '新增成功',
        ],200);
    }


//获取编辑页面
    public function edit(Request $request) {
        $id = $request->get('id');
        $messages = DB::table('messages')->where('id' , $id)->first();
        return view('/edit')->with('messages',$messages);
    }

    //编辑
    public function save(Request $request) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $res = DB::table('messages')->where('id' , $id)->update([
            'title' =>$title,
            'content' =>$content,
            'updated_at' =>date("Y-m-d H:i:s",time()),
        ]);
        if ($res) {
            return response()->json([
                'status' => 200,
                'msg' => '编辑成功',
            ],200);
        } else {
            return response()->json([
                'status' => 404,
                'msg' => '编辑失败',
            ],404);
        }
    }

    //删除
    public function delete() {
        $id = $_POST['id'];
        DB::table('messages')->delete($id);
        return back();
    }




    public function logout(Request $request){
        Session::put("uid",null);
        $this->user = [];
        return redirect("/login");
    }


}