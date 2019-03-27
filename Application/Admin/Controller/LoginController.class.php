<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller
{
	public function chkcode()
	{
		$Verify = new \Think\Verify(array(
		  'fontSize'  =>  12,              // 验证码字体大小(px)
        'useCurve'  =>  true,            // 是否画混淆曲线
        'useNoise'  =>  ture,            // 是否添加杂点
        'length'    =>  4,               // 验证码位数
        'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
         'imageH' => 25,
        'imageW'  => 100
		));
		$Verify->entry();
	}
   public function login()
   {
   		if(IS_POST)
   		{
   			$model = D('Admin');
   			// 接收表单并且验证表单
   			if($model->validate($model->_login_validate)->create())
   			{
   				if($model->login())
   				{
   					$this->success('登录成功!', U('Index/index'));
   					exit;
   				}
   			}
   			$this->error($model->getError());
   		}
   		$this->display();
   }
   public function logout()
   {
   		$model = D('Admin');
   		$model->logout();
   		redirect('login');
   }
}