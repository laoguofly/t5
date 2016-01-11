<?php
namespace index\controller;

use Think\Controller;

//引入了 用户类 
Vendor('User.User');

//引入配置类
Vendor('Sconfig.Sconfig');


class Sconfig extends Controller 
{
    public function index()
    {

        $user = $this->execute();

        return ;
    }

    //查找远程配置类
    public function select(){

        $user = $this->execute();
        $ip = I("param.ip");       
        $data['ip'] = $ip;
        $Sconfig = new \Sconfig\S_config();
        $data1 = $Sconfig->select($data);
        return json_encode($data1);

    }

    //更新
    public function update(){
        $user = $this->execute();
        $data = I("param.");    

        //远程配置类
        $Sconfig = new \Sconfig\S_config();
        //ip
        $data1['param_setting_addr'] =$data['param_setting_addr']; 
        //拒绝国外访问
        $data1['param_reject_foreign_access'] = $data["param_reject_foreign_access"]; 
        //屏蔽所有流量
        $data1['param_forbid'] = $data["param_forbid"]; 
        //忽略所有流量
        $data1['param_ignore'] = $data["param_ignore"]; 
        //防护参数
        $data1['param_param_set'] = $data["param_param_set"]; 
        //过滤规则集
        $data1['param_filter_set'] = $data["param_filter_set"]; 
        //tcp端口集
        $data1['param_portpro_set_tcp'] = $data["param_portpro_set_tcp"]; 
        //udp端口集
        $data1['param_portpro_set_udp'] = $data["param_portpro_set_udp"]; 

        $data2 = $Sconfig->update($data1); 
        //返回上一页
        if($data2){
            $url = " <script language = 'javascript'  type = 'text/javascript' >  history.go(-1);</script>";  
            return $url;
        }
    }

    //策略更新
    public function set_execute(){
        $user = $this->execute();
        $data = I("param.");

        $U_config = new \Sconfig\U_config(); 

        //记录执行
        $data1 = $U_config->execute_select($data);

        $data1['param_setting_addr'] =$data['ip']; 
        //执行更新
        $S_config = new \Sconfig\S_config(); 
        $data2 = $S_config->update($data1); 
        print_r($data2);
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
