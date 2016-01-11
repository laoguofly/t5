<?php
namespace fjxiamenkk\Controller;

use Think\Controller;


//调用用户类
Vendor('User.User');

class Iadmin extends Controller {

    public function index(){

        $user = new \User\Admin();    
        if($user->is_login()){
            return header("Location:".__APP__."/fjxiamenkk/");
        }else{
            return $this->fetch();
        }
    }

     //登录
    public function login(){

        $user = new \User\Admin();    
        $data = I("param.");

        $data1 = $user->login($data);

        if($user->is_login()){
            return header("Location:".__APP__."/fjxiamenkk/"); 
        }else{
            return header("Location:".__APP__."/fjxiamenkk/Iadmin"); 
        }
        
    }

    //登出
    public function out(){
        $user = new \User\Admin();    
        $user->out();
        return header("Location:".__APP__."/fjxiamenkk/Iuser"); 
    }



    //显示用户添加
    public function Add_show(){
            $user = $this->execute();    

            return $this->fetch();
    }
    
    //master 会员添加
    public function add(){
        $user = $this->execute();    
        $data = I("param.");
        //echo 111;
        $data1 = $user->Add($data);

        return header("Location:".__APP__."/fjxiamenkk/Iadmin/I_list"); 
    }

    //显示用户
    public function I_list(){
        $user = $this->execute();    
        $data = $user->all_select();
        $this->assign("data",$data);
        //print_r($data);
        return $this->fetch();

    }
    //删除用户
    public function delete(){
        $user = $this->execute();    
        $id = I("param.id");
        if($user->delete($id)){
            echo "1";           
        }

    }
    //修改 
    public function update(){
        $user = $this->execute();    
        $data =I("param.");
        if($user->update($data)){
           echo 1; 
        }
    }

    //显示单个 
    public function select(){
        $user = $this->execute();    
        $id = I("param.id");
        $sql ="id = $id";
        $data  = $user->select($sql);
        $data  = json_encode($data);
        echo $data;
    }


  

    public function execute($data){

        $user = new \User\Admin();    

        if(!$user->is_login()){
           return header("Location:".__APP__."/fjxiamenkk/Iuser"); 
           return false;
        }

        $status = $user->status();
        $this->assign("name",$status['name']);
        return $user;

    }

}
