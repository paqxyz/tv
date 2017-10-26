<?php
/**
 * Created by HK.
 * Date: 2017.10.18
 * 网站基础资料
 */
namespace app\admin\controller;

use think\Controller;

use think\Db;

class Config extends Controller {

    public function index(){
        $config = db('config')->where('userid',1)->find();
        $this->assign('config',$config);
        return view();
    }

    public function save(){
        
        $data = array(
            'sitename'  => $_POST['sitename'],
            'des'       => $_POST['des'],
            'keywords'  => $_POST['keywords'],
            'agreement' => $_POST['agreement']

        );
        $res = db('config')->where('userid',1)->update($data);
        if ($res) {
            
            $result = array(
                'code'=>0,
                'msg'  => '保存成功'
            );
        } else {
            $result = array(
                'code'=>1,
                'msg'  => '没有任何改动'
            );
        }
        return json($result);
    }
}
