<?php
namespace index\Controller;
use Think\Controller;

Vendor('User.User');
//屏蔽列表
Vendor('HWlist.HWlist');

class HWlist extends Controller {

    public function index(){

        $user = $this->execute();

        return $this->fetch();
    }

    //搜索
    public function select(){

        $user = $this->execute();
        $data = I("param.");

        $HWlist = new \HWlist\K_HWlist(); 
        $data1 = $HWlist->select($data);
        //print_r($data1);
        $data1 = json_encode($data1);

        echo($data1); 
    }

    //更新
    public function update(){

        $user = $this->execute();
        $data = I("param.");

        $HWlist = new \HWlist\K_HWlist(); 
        $data1 = $HWlist->update($data);

        echo($data1); 
    }
    //更新
    public function delete(){

        $user = $this->execute();
        $data = I("param.");

        $HWlist = new \HWlist\K_HWlist(); 
        $data1  = $HWlist->delete($data);

        echo($data1); 
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
