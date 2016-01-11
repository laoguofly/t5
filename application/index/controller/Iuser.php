<?php
namespace index\controller;

use Think\Controller;


//调用用户类
Vendor('User.User');
//载入方法类
Vendor('Common.Common');


class Iuser extends Controller {

    public function index(){

        $user = new \User\User();

        $status  = $user->status(); 

        if($user->is_login()){
            header("Location:".__APP__."/index/"); 
        }else{
           return $this->fetch();
        }

    }

    //登录
    public function login(){

        $user = new \User\User();
        $data = I("param.");

        $data1 = $user->login($data);

        if($user->is_login()){
            header("Location:".__APP__."/index/"); 
        }else{

            header("Location:".__APP__."/index/Iuser"); 
        }
        
    }

  
    //登出
    public function out(){
        $user = new \User\User();
        $user->out();
        header("Location:".__APP__."/index/Iuser"); 
    }
   
}
