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

  

    public function select(){
        $this->execute();
        $user = new \User\User();  
        $id =I("param.id");
        $data = $user->select($id);
        return json_encode($data);

    }

    public function update(){
        $this->execute();
        $user = new \User\User();
        $data = I("param.");
        $data = $user->update($data);
        echo 1;
    }

    //显示
    public function add_show(){
        $this->execute();
        $user = new \User\User();
        return $this->fetch();   
    }

    public function add(){
        $this->execute();
        $user = new \User\User();
        $data = I("param.");
        $user->add($data);
        return header("Location:".__APP__."/fjxiamenkk/Iuser");
    }

    public function delete(){
        $this->execute();
        $user = new \User\User();
        $id = I("param.id");
        $data = $user->delete($id);
        echo $data;
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
