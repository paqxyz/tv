<?php
/**
 * Created by HK.
 * Date: 2017.10.23
 * 直播列表相关
 */
namespace app\admin\controller;

use think\Controller;

use think\Db;

class Live extends Controller {

    public function index(){
        $allcate = array(
            1  => '教育',
            2  => '娱乐',
            3  => '会议',
            4  => '展会',
            5  => '其他',
        );
        $list = db('Live')->select();
        $this->assign('list',$list);
        $this->assign('allcate',$allcate);
        return view();
    }

    public function getData() {
        $list = db('Live')->order('addtime desc')->select();
        $allcate = array(
            1  => '教育',
            2  => '娱乐',
            3  => '会议',
            4  => '展会',
            5  => '其他',
        );
        foreach($list as $k=>$v) {
            $list[$k]['thumb'] = '<img src="'.$v['thumb'].'">';
            $list[$k]['addtime'] = date('Y-m-d H:i:s',$v['addtime']);
            $list[$k]['catename'] = $allcate[$v['catid']];
        }
        $count = db('Live')->count();
        $data['code'] = 0;
        $data['count'] = $count;
        $data['data'] = $list;
        //dump($data);
        return json($data);
    }

    public function add() {
        return view();
    }

    public function del() {     
        $id = intval(input('id'));
        if ($id>0) {
            $res = db('live')->where('id=' . $id)->delete();
            if ($res) {            
                $result = array(
                    'code'=>0,
                    'msg'  => '删除成功'
                );
            } else {
                $result = array(
                    'code'=>1,
                    'msg'  => '删除失败'
                );
            }          
            return json($result);
        }
    }

    public function edit() {
        $id = input('id')?input('id'):0;
        if ($id>0) {
            $info = db('live')->where('id='.$id)->find();
        }
        $this->assign('info',$info);
        return $this->fetch('live/add');
    }

    public function save() {
        $id = intval(input('id'));
        $data = array(
            'catid'  => input('catid'),
            'title'  => input('title'),
            'dsp'       => input('dsp'),
            'author'  => input('author'),
            'thumb' => input('thumb'),
            'stime' => strtotime(input('stime')),
            'content' => input('content'),
            'addtime' => time()
        );      
        if ($id>0) {
            $res = db('live')->where('id='.$id)->update($data);
        } else {
            $res = db('live')->insert($data);
        }
        if ($res) {            
            $result = array(
                'code'=>0,
                'msg'  => '发布成功'
            );
        } else {
            $result = array(
                'code'=>1,
                'msg'  => '发布失败'
            );
        }
        return json($result);
    }
}
