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
            $this->display();
    }
    
    //master 会员添加
    public function add(){
        $user = $this->execute();    
        $data = I("param.");
        //echo 111;
        $data1 = $user->Add($data);
        if($data1 == "用户名重复"){
            $this->error("用户名重复");
        }else if($data1){
            $this->success("添加成功"); 
        }else{
            $this->error("添加失败");
        }
    }

    //显示用户
    public function I_list(){
        $user = $this->execute();    
        $data = $user->show();
        $this->assign("data",$data);
        //print_r($data);
        $this->display();

    }
    //删除用户
    public function delete(){
        $user = $this->execute();    
        $id = I("param.id");
        $sql ="id=$id";

        if($user->delete($sql)){
            echo "1";           
        }

    }
    //修改 
    public function update(){
        $user = $this->execute();    
        $data =I("param.");
        if($user->update($data['id'],$data)){
           echo 1; 
        }
    }

    //显示单个 
    public function select(){

        $user = $this->execute();    
        $id = I("param.id");
        $sql ="id = $id";
        $data  = $user->show($sql);
        $data  = json_encode($data);
        echo $data;
    }


  

    public function execute($data){

        $user = new \User\Admin();    

        if(!$user->is_login()){
            $this->error("请先登录",__MODULE__."/Imaster");
            return false;
        }

        $name = $user->name();
        $this->assign("name",$name);
        return $user;

    }

}
