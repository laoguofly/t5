<?php
namespace fjxiamenkk\Controller;

use Think\Controller;

Vendor('User.User');

class Index extends Controller {
    
    public function index(){

        $user = $this->execute();

        return $this->fetch();

    }
    

    public function execute($data){

       $user = new \User\Admin();  
        if(!$user->is_login()){
            header("Location:".__APP__."/fjxiamenkk/Iadmin");
            return false;
        }
        
        $data = $user->status();
        $this->assign("name",$data['name']);
        return $user;

    }

}
