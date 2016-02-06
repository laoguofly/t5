<?php
namespace index\Controller;
use Think\Controller;

//用户类
Vendor('User.User');

//屏蔽类
Vendor('Shield.Shield');

class Shield extends Controller {

    public function index(){

        //新建地区类
        $user = $this->execute();

        return $this->fetch();
    }

    public function update(){

        $user =  $this->execute(); 
        $data1['ip'] =I("param.ip");

        $Shield = new \Shield\K_Shield();

        $data3 = $Shield->i_reset($data1);
          
        echo $data3;
    }

    public function arr_update(){

        $user =  $this->execute(); 
        $data1 =I("param.arr_ip");
        if(!trim($data1)){echo 0; exit;}
        $data1 = preg_split("/[\s]+/", $data1); 

        $Shield = new \Shield\K_Shield();

        print_r($data1);

        //提取
        $num=0;
        foreach($data1 as $key=>$value){
             preg_match("/\d+\.\d+\.\d+\.\d+/",$value,$m); 
             if($m[0]){
                $data1_1[$num++] = $m[0];
             }
        }
        print_r($data1_1);

        //更新
        foreach($data1_1 as $key=>$value){
            $ip['ip'] = $value;
            $data3 = $Shield->i_reset($ip);
            echo $data3;
        }

    }
  
    public function select(){

        $user =  $this->execute(); 
        $data1['ip'] =I("param.ip");

        $Shield = new \Shield\K_Shield();

        $data3 = $Shield->select($data1);

        $data3 = json_encode($data3);
          
        echo $data3;
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
