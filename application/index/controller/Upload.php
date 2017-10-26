<?php
namespace app\index\controller;

use think\Controller;
use think\Session;

class Upload extends Controller {

    protected function _initialize() {
      //此处要要进行是否进行登陆，如果没有登录跳转到登录部分，如果登录才能执行下面的上传操作
    }
    /**
     * 上传缩略图
     * @return \think\response\Json
     */
    public function uploadThumb() {
        $file = $this->request->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

        if ($info) {
            $result = [
                'code'     => 0,
                'msg'      => '上传成功',
                'filename' => '/uploads/' . str_replace('\\', '/', $info->getSaveName())
            ];
        } else {
            $result = [
                'code' => -1,
                'msg'  => $file->getError()
            ];
        }

        return json($result);
    }
}