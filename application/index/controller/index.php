<?php
namespace index\controller;

use Think\Controller;

//引入了 用户类 
Vendor('User.User');

//图片类
Vendor('Rimg.Rimg');


class Index extends Controller 
{
    public function index()
    {

        $user = $this->execute();
        $host = $user->call_host();
        $area = $user->call_area();
        $data['area'] = I("param.area");
        $data['ip']   = I("param.hostaddr");
        //print_r($data);
        //设置默认地区
        $area->set_area($data['area']);
        $data1 = $host->area_select($data);
       // print_r($data1);
        $this->assign("data1",$data1);

        return $this->fetch();
    }

    public function Rimg(){
        $user = $this->execute();
        $ip   = I("param.ip");
        $data['ip'] = $ip;
        $Rimg = new \Rimg\R_img();

        $data1 = $Rimg->select($data);
        echo ($data1);

        
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
