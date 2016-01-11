<?php
namespace fjxiamenkk\Controller;

use Think\Controller;


//调用用户类
Vendor('User.User');


class Iuser extends Controller {

    public function index(){
        $this->execute();
        $user = new \User\User();  
        $data = $user->all_select();
        $this->assign("data",$data);
        return $this->fetch();
    }

    public function update(){
        $user = $this->execute();
        $post =I("param.");

        $data = $user->update($post);
        echo $data;

    }

  

  

   public function execute($data){

       $user = new \User\Admin();  
        if(!$user->is_login()){
            header("Location:".__APP__."/Iadmin/");
            return false;
        }
        
        $data = $user->status();
        $this->assign("name",$data['name']);
        return $user;

    }

}
