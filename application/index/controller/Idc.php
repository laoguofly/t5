<?php
namespace index\controller;

use Think\Controller;

//引入了 用户类 
Vendor('User.User');

//引入idc 类 
Vendor('IDC.IDC');


class Idc extends Controller 
{
    public function index()
    {

        $user = $this->execute();

        $IDC  = new \IDC\free_idc();

        $data = $IDC->all_select();
        //print_r($data);
        $this->assign("data",$data);
        return $this->fetch();
    }

  
    public function execute()
    {
        $user = new \User\User();
        $status = $user->status();

        if(!$user->is_login()){
            header("Location:".__APP__."/index/Iuser");
        }

        $area =$user->call_area();
        $data = $area->all_select();
        $this->assign("name",$status['name']);
        $this->assign("nav",$data);
        return $user;
    }

}
