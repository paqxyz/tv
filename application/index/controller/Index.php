<?php
namespace app\index\controller;

Class Index
{
	public function index($name = '')
	{
		if ('thinkphp' == $name) {
			# code...
			return redirect('http://baidu.com');
		} else {
			return 'hello';
		}
 	}

 	
}
