<?
class AppController extends Controller
{
	var $helpers = array('Html','Javascript');
//	var $components = array('Pagination', 'Slots');
	
	/*function checkSession()
	{
		if(!$this->Session->check('User'))
		{
			$this->Session->write("url", $this->params['url']['url']);
			$this->redirect("login");
		}
	}*/
	function beforeFilter()
	{
		header("Content-Type: text/html; charset=UTF-8;");
		if(!empty($this->params['url']['layout']) && $this->params['url']['layout'] == "ajax")		$this->layout = 'ajax';
			else												$this->layout = 'default';
			
//		print_r($this->params);
//		if($this->Session->check('User'))
//		{
//			if(!empty($this->params['url']['layout']) && $this->params['url']['layout'] == "ajax")		$this->layout = 'ajax';
//			else												$this->layout = 'sys';
//		}
//		else
//		{
//			if($this->params["controller"]!="users" && $this->params["action"]!="login"){
//			$this->redirect("/login");
//			} 
//		}
	}
	function teste()
	{
		echo "teste";
	}
	function sys($type = false)
	{
		$this->layout = 'sys';
	}
	/*function __admin($type = false)
	{
		$this->layout = 'sys';
		if ($type == 'ajax')
			$this->layout = 'ajax';
		
		$is_admin = $this->Session->read('User');
		if (!$this->Session->read('User'))
		{
			$this->Session->setFlash('Somente usuarios registrados tem acesso a essa op&ccedil;&atilde;o. Se voc&ecirc; &eacute; um, fa&ccedil;a o login abaixo:', 'error');
			$this->redirect('/login');
			exit;
		}
	}*/


}