<?php
namespace app\admin\controller;

use think\console\Input;
use think\Db;

class Type extends AdminBase {

    public function lst() {
        $typeData = Db::table('type')->select();
        $this->assign('typeData',$typeData);
        return $this->fetch();
    }

    public function add() {

        if(!empty($_POST)){
            $pId = request()->param('parent_id');
            $title = request()->param('title');
            $data = array(
                'parent_id'=>$pId,
                'title'=>$title,
            );
            $typeId = Db::name('type')->insertGetId($data);
            if($typeId) {
                $this->success('文章分类新增成功', 'Type/lst');
            }else{
                $this->error('新增失败');
            }
        }

        $typeData = Db::table('type')->select();

        $this->assign('typeData',$typeData);
        return $this->fetch();
    }
    public function edit() {
        if(!empty($_POST)){
            $id = request()->param('id');
            $pId = request()->param('parent_id');
            $title = request()->param('title');
            $updateData = array(
                'parent_id'=>$pId,
                'title'=>$title,
            );
            $ret = Db::name('type')->where('id', $id)->update($updateData);
            if($ret != false) {
                $this->success('文章分类修改成功', 'type/lst');
            }else{
                $this->error('修改失败');
            }
        }
        $id = request()->param('id');

        $curTypeData = Db::table('type')->where('id',$id)->find();
        $typeData = Db::table('type')->select();
        $this->assign('curTypeData',$curTypeData);
        $this->assign('typeData',$typeData);
        return $this->fetch();
    }
}
