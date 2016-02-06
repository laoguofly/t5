<?php
namespace index\controller;

use Think\Controller;

//引入了 用户类 
Vendor('User.User');

//引入了 自动同步类 
Vendor('sync.sync');



class sync extends Controller 
{
    public function index()
    {

        $user = $this->execute();
      
        return ;
    }

    public function auto(){
        $user = $this->execute();
        $sync = new \Sync\user_database_sync();
        $data = $sync->auto();
        return 1;
        
        
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
