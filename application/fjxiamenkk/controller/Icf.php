<?php
namespace fjxiamenkk\Controller;

use Think\Controller;

//调用用户类
Vendor('User.User');
//ICF 防火墙
Vendor('ICF.ICF');

class Icf extends Controller {

    public function index(){

            $ICF = $this->execute();    
            $data = $ICF->select(); 
            //print_r($data);
            $this->assign("data",$data);
            return $this->fetch();
    }

    //后台监控连接状态
    public function line_show(){

        $ICF = $this->execute();    
        $data1 = $ICF->all_np();
        $num1=0;
        foreach($data1 as $value){

            $login = $value->S_login();
            $data2[$num1]['ICF'] = $login->select();
            $data2[$num1]['value'] =  $value->user['name'];
            $data2[$num1]['id'] =  $value->user['id'];
            $num1++;
        }
        //print_r($data2);
        $this->assign("data",$data2);

        return $this->fetch();
        
    }
    //删除
    public function line_delete(){

        $id = I("param.id");
        $ICF = $this->execute();    
        $data['id'] = $id;
        $ICF = new \ICF\K_ICF(); 
        $np = $ICF->np($data);
        $login = $np ->S_login();
        $data1 = $login->delete();
        echo 1;
        
    }
    //连接
    public function line(){
        $id = I("param.id");
        //echo $id;
        $ICF = $this->execute();    
        $data['id'] = $id;
        $ICF = new \ICF\K_ICF(); 

        $np = $ICF->np($data);
        //print_r($np);
        $login = $np ->S_login();
        $data1 = $login->update();
        echo 1;

    }


    //显示用户添加
    public function Add_show(){
            $ICF = $this->execute();    
            return $this->fetch();
    }
    
    //管理系统用户添加
    public function Add(){
        $ICF = $this->execute();    
        $data = I("param.");
        $data1 = $ICF->add($data);

        header("Location:".__APP__."/fjxiamenkk/ICF");
        
        //$data1 = $user->Add($data);
    }


    //删除用户
    public function delete(){
        $ICF = $this->execute();    
        $id = I("param.id");

        if($ICF->delete($id)){
            echo "1";           
        }

    }

    //修改 
    public function update(){
        $ICF = $this->execute();    
        $data =I("param.");
        //print_r($data);
        if($ICF->update($data['id'],$data)){
           echo 1; 
        }
    }

    //显示 
    public function show(){

        $ICF = $this->execute();    
        $id = I("param.id");
        //show的接口不一致
        $data  = $ICF->on_select($id);
        $data  = json_encode($data);
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
        return $ICF = new \ICF\K_ICF();

    }

}
