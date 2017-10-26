<?php
/**
 * Created by HK.
 * Date: 2017.10.20
 * 会员登陆
 */

namespace app\index\controller;
use think\Controller;
use think\View;
use app\index\model\User;

class Login extends Controller{

  public function index(){
    return view();
  }


  public function login(){
    $captcha = input('code');
    dump($captcha);
    if(!captcha_check($captcha)){
        //验证码错误
        dump(1);
    }else{
         //验证码正确
         dump(2);
    }
    exit;
  }

}