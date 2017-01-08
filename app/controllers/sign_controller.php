<?php
class SignController extends AppController {
	var $name = 'Sign';
	var $uses = array('Client', 'Plans', 'Periods', 'Domains');
	var $LANG_SIGNFORM = array(
	/* Client data */
	'CLIENT_NAME'			=> array('label' => "Nome", 'tip' => "Insira seu nome"),
	'CLIENT_SURNAME'		=> array('label' => "Sobrenome", 'tip' => "Insira seu sobrenome"),
	'CLIENT_PREFERREDNAME'	=> array('label' => "Nome de prefer�ncia", 'tip' => "Insira um nome como gostaria de ser referido"),
	'CLIENT_BIRTHDATE'		=> array('label' => "Data de nascimento", 'tip' => "Informe-nos sua data de nascimento"),
	'CLIENT_GENDER'			=> array('label' => "Sexo", 'tip' => "Informe-nos seu sexo"),
	'CLIENT_MARITALSTATUS'	=> array('label' => "Estado civil", 'tip' => "Informe-nos seu estado civil"),
	'CLIENT_RG'				=> array('label' => "RG", 'tip' => "RG"),
	'CLIENT_CPF'			=> array('label' => "CPF", 'tip' => "CPF"),
	'CLIENT_CNPJ'			=> array('label' => "CNPJ", 'tip' => "CNPJ"),
	'CLIENT_COMPANYNAME'	=> array('label' => "Raz�o social", 'tip' => "Raz�o social"),

	/* Domains data */
	'DOMAIN_URL'		=> array('label' => "Endere�o", 'tip' => "Digite o endere�o que pretenda utilizar para seu dominio no formato <b>dominio.com</b> (sem www.)"),
	'DOMAIN_REGISTER'	=> array('label' => "Desejo registrar", 'tip' => "Marque esta op��o se voc� deseja registrar este dom�nio conosco"),
	'DOMAIN_LOGIN'		=> array('label' => "Login", 'tip' => "Login que ser� utilizado para gerenciar este dom�nio, sendo via FTP ou painel de controle"),
	'DOMAIN_PASSWORD'	=> array('label' => "Senha", 'tip' => "Senha para acesso restrito ao gerenciamento deste dom�nio"),
	'DOMAIN_PASSWORD_REPEAT'	=> array('label' => "Repita a senha", 'tip' => "Voc� deve repetir a senha para sua maior seguran�a."),
	'DOMAIN_PLAN_ID'	=> array('label' => "Plano de hospedagem", 'tip' => "Escolha o plano que mais se adequar"),
	'DOMAIN_PERIOD_ID'	=> array('label' => "Periodicidade", 'tip' => "Escolha uma op��o de periodicidade"),
	);

	function index($oi=null)
	{
		$this->layout = 'sign';
		if(!empty($this->data))
		{
			$this->set('posted', $this->data);
			sleep(1);
			print_r($this->data); exit;
		}

	}
	function beforeFilter()
	{
		header("Content-Type: text/html;  charset=UTF-8",true);

		$this->set('lang', $this->LANG_SIGNFORM);
	}
	
	/**
	 * Atrav�s da ordem definida pelo usu�rio, chama as p�ginas.
	 * Sao elas:
	 * - domains_data: formul�rio que enviar� os dados de dom�nio.
	 * - client_data: formul�rio de registro de dados pessoais (como nome, telefone e etc)
	 * - user_data: formul�rio simples onde a pessoa coloca um login e uma senha
	 *
	 * @todo Fazer uma verifica��o de �rdem de paginas a seguir.
	 */
	function next()
	{
		$this->layout = 'ajax';
		if(!empty($this->data) && isset($this->data['Next'])){
			$function = $this->data['Next'];
//			$this->$function($this->data);
			$this->render($function);
			exit;
		}
		$signup_data = ($this->Session->check("signup")) ? $this->Session->read("signup"):array('Domain' => array());
		$this->set('signup_data', $signup_data);
		$plans = $this->Plans->generateMultiList(null, 'created ASC', null, '{n}.Plans.id', '{n}.Plans.name#{n}.Plans.cost#{n}.Plans.id');
		$periods = $this->Periods->generateMultiList(null, 'created ASC',  null, '{n}.Periods.id', '{n}.Periods.name#{n}.Periods.discount#{n}.Periods.id');
		$this->set('plans', $plans);
		$this->set('periods',$periods);
		$this->render("domains_data");
	}
	
	/**
	 * Realiza o "whois" caso o cliente deseje o registro de dominio.
	 * Retorna um jSon, e caso haja sucesso retornar� tamb�m o pre�o
	 *
	 * @param string $domain
	 */
	function domain_whois($domain = null)
	{
		if($domain === null) exit;
		vendor("whois/indot.whois");
		$whois = new Whois($domain);
		list($domain, $extension) = explode(".", $domain, 2);
		$tld_price = 0;
		$is_avaible = (bool) $whois->is_available();
		if($is_avaible)
		{
			//get tld prices
		}
		$is_avaible = ($is_avaible) ? 'true':'false';
		die("{avaible:{$is_avaible}, tld_price:{$tld_price}}");
		exit;
	}
	function client_data()
	{
		$this->layout = 'ajax';
	}
	function domains_data($data)
	{
		if(!empty($data))
		{
			echo "<pre>";print_r($this->data);echo "</pre>"; exit;
		}
	}
	/**
	 * Verifica se existe um login no banco de dados de dom�nios.
	 *
	 */
	function checklogin()
	{
		if(empty($this->data)) $this->redirect("/sign");
		//		print_r($this->data); die();
		$logins = $this->Domains->findAllByLogin($this->data['login']);
		$exists = (!empty($logins)) ? 'true':'false';
		echo "{exists:{$exists}}";
		die();
	}

	/**
	 * Adiciona um dom�nio na sess�o
	 * @since 25/11/07 - 06:03
	 */
	function add_domain()
	{
		if(empty($this->data['Domain'])) $this->redirect("/sign");
		$signup_data = ($this->Session->check("signup")) ? $this->Session->read("signup"):array('Domain' => array());
		foreach ($signup_data['Domain'] as $k => $domain)
		{
			if($domain['url'] == $this->data['Domain']['url'])
			{
				echo $domain['url'] . "|" . $this->data['Domain']['url'] . "<br>";
				die("dominio ja cadastrado");
			}
		}
		array_push($signup_data['Domain'], $this->data['Domain']);
		$this->Session->write("signup", $signup_data);
		$this->added_domains();
		exit;
	}
	/**
	 * Coleta dominios adicionados na sess�o
	 * @since 25/11/07 - 08:12
	 */
	function added_domains()
	{
		$this->layout = 'ajax';
		$signup_data = ($this->Session->check("signup")) ? $this->Session->read("signup"):array('Domain' => array());
		$this->set('signup_data', $signup_data);
		$plans = $this->Plans->generateMultiList(null, 'created ASC', null, '{n}.Plans.id', '{n}.Plans.name#{n}.Plans.cost#{n}.Plans.id');
		$periods = $this->Periods->generateMultiList(null, 'created ASC',  null, '{n}.Periods.id', '{n}.Periods.name#{n}.Periods.discount#{n}.Periods.id');
		$this->set('plans', $plans);
		$this->set('periods',$periods);
		$this->render("added_domains");
	}
}
?>