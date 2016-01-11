<?php
namespace Admin\Controller;

use Think\Controller;

//调用用户类
Vendor('User.User');
//ICF 防火墙
Vendor('ICF.ICF');

class IcfController extends Controller {

    public function index(){

            $ICF = $this->execute();    
            $data = $ICF->select(); 

            $this->assign("data",$data);
            $this->display();
    }

    //后台监控连接状态
    public function line_show(){

        $ICF = $this->execute();    
        $data = $ICF->select();
        $num=0;

        foreach($data as $value){

            //echo $value['id'];
            $data1[$num]['ICF'] = new \ICF\K_ICF($value); 
            $data1[$num]['value'] = $value; 
            $num++;
        }
        
        //print_r($All_ICF);
        $num1=0;
        foreach($data1 as $value){
            $np = $value['ICF']->np();
            $login = $np ->S_login();

            $data2[$num1]['ICF'] = $login->select();
            $data2[$num1]['value'] =  $value['value'];
            $num1++;
        }
        //print_r($data2);
        $this->assign("data",$data2);

        $this->display();
        
    }
    //删除
    public function line_delete(){

        $id = I("param.id");
        $ICF = $this->execute();    
        $data['id'] = $id;
        $ICF = new \ICF\K_ICF($data); 
        $np = $ICF->np();
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
        $ICF = new \ICF\K_ICF($data); 

        $np = $ICF->np();
        //print_r($np);
        $login = $np ->S_login();
        $data1 = $login->update();
        echo 1;

    }

    //cs
    public function cs(){
        $id = I("param.id");
        $ICF = $this->execute();    
        $scope = $ICF->ip_scope();
        $data['id'] = $id;
        $ICF = new \ICF\K_ICF($data);
        $scope->ip_scope_auto($ICF);

    }






    //显示用户添加
    public function Add_show(){
            $ICF = $this->execute();    
            $this->display();
    }
    
    //管理系统用户添加
    public function Add(){
        $ICF = $this->execute();    
        $data = I("param.");
        $data1 = $ICF->add($data);
        if($data1){
            $this->success("添加成功");
        }else{
            $this->error("添加失败");
        }
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

       $user = new \MUser();  
        if(!$user->is_login()){
            $this->error("请先登录",__MODULE__."/Imaster");
            return false;
        }

        $name = $user->name();

        $this->assign("name",$name);
        
        
       return new \ICF\K_ICF();

    }

}
