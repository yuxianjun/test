<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Http\Model\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

require_once 'public/org/code/Code.class.php';

class UserController extends BaseController
{
    /**
     * 显示登录页
     */
    public function login(){
     /*   $pass='123456';
        $pass= Crypt::encrypt($pass);
   echo date('Y年m月d日 H时i分s秒');*/
       return  view('admin/login');
    }

    /**
     * 用户登录
     */
    public function userLogin(){

        if($input=Input::all()){
            $code = new \Captcha(90,50,4);
            $_code=$code->getCode();
            $user=User::first();
           if($user->uname!= $input['username'] ||  Crypt::decrypt($user->passwd) != $input['password']){
                return back()->with('msg','用户名或者密码错误！');
            }

            if($input['verCode']!=$_code){
                return back()->with('msg','验证码错误！');
            }
            session(['user'=>$user]);

            return redirect('admin/index');

        }else{
            return back()->with('msg','请填写登录信息！');
        }
       //dd( DB::connection()->getPdo());die();
     //   echo "hello";die();

    }

    /**
     * 生成验证码
     */
    public function veriCode(){
        $captcha = new \Captcha(80,30,4);
        $captcha->showImg();die();

    }

    /**
     * 获取当前验证码
     */
    public function getCode(){
        $captcha = new \Captcha(80,30,4);
       echo  $captcha->getCode();die();

    }
}
