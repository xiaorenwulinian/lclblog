<?php
namespace app\admin\controller;

use think\console\Input;
use think\Db;

class Article extends AdminBase {

    public function lst() {
        $artData = Db::table('article')
                        ->alias('a')
                        ->leftJoin('type b','a.type_id=b.id')
                        ->field(['a.id','a.art_title','a.add_time','a.art_content','art_desc','b.title'=>'type_name'])
                        ->select();
        $this->assign('artData',$artData);
        return $this->fetch();
    }

    public function add() {
        if(!empty($_POST)){
            $type_id = request()->param('type_id');
            $art_title = request()->param('art_title');
            $art_desc = request()->param('art_desc');
            $art_content = request()->param('art_content');
            $data = array(
                'type_id'=>$type_id,
                'art_title'=>$art_title,
                'art_desc'=>$art_desc,
                'art_content'=>$art_content,
                'add_time'=>time(),
            );
            $articleId = Db::name('article')->insertGetId($data);
            if($articleId) {
                $this->success('文章新增成功', 'article/lst');
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
            $type_id = request()->param('type_id');
            $art_title = request()->param('art_title');
            $art_desc = request()->param('art_desc');
            $art_content = request()->param('art_content');
            $updateData = array(
                'type_id'=>$type_id,
                'art_title'=>$art_title,
                'art_desc'=>$art_desc,
                'art_content'=>$art_content,
                'edit_time'=>time(),
            );
//            var_dump($updateData);
//            die;
            $ret = Db::name('article')->where('id', $id)->update($updateData);
            if($ret != false) {
                $this->success('文章修改成功', 'article/lst');
            }else{
                $this->error('修改失败');
            }
        }
        $id = request()->param('id');
        $curArtData = Db::table('article')->where('id',$id)->find();
        $typeData = Db::table('type')->select();
        $this->assign('curArtData',$curArtData);
        $this->assign('typeData',$typeData);
        return $this->fetch();
    }
}
