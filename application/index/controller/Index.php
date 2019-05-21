<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Index extends Controller {

    public function index(){
        $artData = Db::table('article')->order('id', 'desc')->paginate(20);
        $page = $artData->render();
        $this->assign('artData',$artData);
        $this->assign('page', $page);

        $typeData = Db::table('type')->select();
        $this->assign('typeData',$typeData);
        return $this->fetch();
    }
    public function type_art_lst(){
        $id = request()->param('type_id');
        $artData = Db::table('article')
                ->where('type_id',$id)
                ->order('id', 'desc')->paginate(10);
        $page = $artData->render();
        $this->assign('artData',$artData);
        $this->assign('page', $page);

        $typeData = Db::table('type')->select();
        $this->assign('typeData',$typeData);
        return $this->fetch();
    }
    public function artDetail(){
        $id = request()->param('art_id');
        $artData = Db::table('article')->where('id',$id)->find();
        $this->assign('artData',$artData);
        $typeData = Db::table('type')->select();
        $this->assign('typeData',$typeData);

        $next = Db::table('article')
                    ->where(array(
                        array('id','<',$id),
//                        array('type_id','=',$artData['type_id'])
                    ))
                    ->find();
        $before = Db::table('article')
                    ->where(array(
                        array('id','>',$id),
//                        array('type_id','=',$artData['type_id'])
                    ))
                    ->find();
        $this->assign('before',$before);
        $this->assign('next',$next);
        return $this->fetch();
    }
    public function index1()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>';
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
