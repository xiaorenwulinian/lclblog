<?php
namespace app\admin\controller;

class Index extends AdminBase {

    public function index() {
        $data = "my chinese heart";
        $this->assign('td',$data);
        return $this->fetch();
    }

    public function hello($name = 'ThinkPHP5') {
        return 'hello,' . $name;
    }

    public function myMain(){
        return $this->fetch();
    }
}
