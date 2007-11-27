<?
class AppError extends ErrorHandler
{
	function __construct($method, $messages)
	{
		static $__previousError = null;
		$this->__dispatch =& new Dispatcher();
		
		if ($__previousError != array($method, $messages))
		{
			$__previousError = array($method, $messages);

			if (!class_exists('AppController'))
			{
				loadController(null);
			}

			$this->controller =& new AppController();
			$this->__dispatch->start($this->controller);

			if (method_exists($this->controller, 'apperror'))
			{
				return $this->controller->appError($method, $messages);
			}
		}
		else
		{
			$this->controller =& new Controller();
		}

		call_user_func_array(array(&$this, $method), $messages);
	}

	function missingController($params)
	{
		$this->layout = 'ajax';
		echo "<h2>{$params['className']} not found</h2>";
	}
	function missingView($params)
	{
		$this->layout = 'ajax';
		echo "<h2>{$params['action']}.thtml not found</h2>";
	}
	function missingAction($params)
	{
		$this->layout = 'ajax';
		echo "<h2>{$params['action']} not found (in {$params['className']})</h2>";
//		die();
	}
	//Array ( [className] => ClientsController [base] => /hostool [action] => admin_prospects [webroot] => /hostool/ )
}
?>