<?php
namespace index\Controller;
use Think\Controller;


Vendor('User.User');
Vendor('Lmonitoring.Lmonitoring');

class Lmonitoring extends Controller {

    public function index(){

        $user = $this->execute();


        return $this->fetch();
    }

    //搜索
    public function select(){

        $user = $this->execute();
        $data = I("param.");
        $Lmonitoring = new \Lmonitoring\K_Lmonitoring(); 
        $data1 = $Lmonitoring->select($data);
        //print_r($data1);
        $data1 = json_encode($data1);

        echo($data1); 
    }

    //重置
    public function reset(){

        $user = $this->execute();
        $data['ip'] = I("param.ip");


        $Lmonitoring = new \Lmonitoring\K_Lmonitoring(); 

        $data1 = $Lmonitoring->i_reset($data);

        echo 1;
        
    }

 
   //启动执行
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
