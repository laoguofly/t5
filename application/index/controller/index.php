<?php
namespace index\controller;

use Think\Controller;

//引入了 用户类 
Vendor('User.User');

//图片类
Vendor('Rimg.Rimg');

//调用防火墙类 
Vendor('ICF.ICF');


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

        $this->assign("ip","off");

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

    //ip详情分析 
    public function S_details(){

        $ip   = I("param.ip");
        $user = $this->execute();
        $host = $user->call_host(); 

        //详情分析
        $data = $host->logs_report($ip);

        echo json_encode($data);

    } 

    public function ip_select(){

        $user = $this->execute();
        $data['ip']   = I("param.ip");
        $ICF          = new \ICF\K_User_ICF();
        $data['ip']   = trim($data['ip']);
        //获取ip所在地区
        $area_data    =$ICF->is_area($data['ip']);
        //print_r($area_data);
        $host = $user->call_host();
        $area = $user->call_area();

        //设置默认地区
        $area->set_area($area_data['icf_id']);
        $data1 = $host->area_select($data);
        //print_r($data1);
        
        $this->assign("data1",$data1);
        //echo $data['ip'];
        $this->assign("ip",$data['ip']);

        return $this->fetch('index');

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
