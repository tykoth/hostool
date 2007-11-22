CREATE TABLE clients (
	id int(11) NOT NULL auto_increment COMMENT 'ID',
	created datetime NOT NULL COMMENT 'data de criação',
	modified datetime NOT NULL COMMENT 'data de modificação',
	name varchar(32) NOT NULL COMMENT 'nome do cliente',
	surname varchar(64) NOT NULL COMMENT 'sobrenome do cliente',
	preferredname varchar(16) NOT NULL COMMENT 'nome de preferencia',
	gender tinyint(2) NOT NULL default '1' COMMENT 'sexo',
	maritalstatus tinyint(4) NOT NULL default '0' COMMENT 'estado civil',
	rg int(11) NOT NULL COMMENT 'rg',
	cpf int(11) NOT NULL COMMENT 'cpf',
	cnpj int(11) NOT NULL COMMENT 'cnpj',
	status int(11) default '0' COMMENT 'Status do cliente: 0 = lixeira; 1 = recem cadastrado; 2 = aprovado;3 = bloqueado;',
	permalink varchar(255) NOT NULL COMMENT 'permalink',
  PRIMARY KEY  (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela com dados primários dos clientes.' AUTO_INCREMENT=1 ;

CREATE TABLE addresses (
	id int(11) NOT NULL auto_increment COMMENT 'Id',
	created datetime NOT NULL COMMENT 'data de criação',
	modified datetime NOT NULL COMMENT 'data de modificação',
	client_id int(11) NOT NULL COMMENT 'Id do cliente',
	address varchar(255) NOT NULL COMMENT 'Endereço',
	address_c varchar(255) NOT NULL COMMENT 'Complemento',
	neighborhood varchar(32) NOT NULL COMMENT 'Bairro',
	zipcode varchar(8) NOT NULL COMMENT 'CEP',
	city varchar(32) NOT NULL COMMENT 'Cidade',
	state varchar(32) NOT NULL COMMENT 'Estado',
	country varchar(32) NOT NULL COMMENT 'País',
  PRIMARY KEY  (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela com dados de endereçamento.' AUTO_INCREMENT=1 ;

CREATE TABLE phones (
	id int(11) NOT NULL auto_increment COMMENT 'Id',
	created datetime NOT NULL COMMENT 'data de criação',
	modified datetime NOT NULL COMMENT 'data de modificação',
	client_id int(11) NOT NULL COMMENT 'Id do cliente',
	country_code int(2) NOT NULL COMMENT 'código do país',
	region_code int(3) NOT NULL COMMENT 'código de área',
	phone int(8) NOT NULL COMMENT 'numero do telefone',
	phone_type int(1) NOT NULL COMMENT 'tipo de telefone: 0 = pessoal; 1 = celular; 2 = trabalho; 3 = fax',
	phone_priority int(1) NOT NULL COMMENT 'prioridade dos telefones, sendo 0 o principal',
  PRIMARY KEY  (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela com dados telefones.' AUTO_INCREMENT=1 ;

CREATE TABLE emails (
	id int(11) NOT NULL auto_increment COMMENT 'Id',
	created datetime NOT NULL COMMENT 'data de criação',
	modified datetime NOT NULL COMMENT 'data de modificação',
	client_id int(11) NOT NULL COMMENT 'Id do cliente',
	email varchar(32) NOT NULL COMMENT 'email',
	email_priority int(1) NOT NULL COMMENT 'prioridade dos emails, sendo 0 o principal',
  PRIMARY KEY  (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela com dados de email.' AUTO_INCREMENT=1 ;

CREATE TABLE users (
	id int(11) NOT NULL auto_increment COMMENT 'Id',
	created datetime NOT NULL COMMENT 'data de criação',
	modified datetime NOT NULL COMMENT 'data de modificação',
	login varchar(255) NOT NULL COMMENT 'login',
	password varchar(32) NOT NULL COMMENT 'senha',
	group_id int(3) NOT NULL COMMENT 'grupo do qual faz parte',
	client_id int(11) default NULL COMMENT 'caso não seja nulo, pode acessar todos os paineis de clientes, caso contrário, é cliente',
	status int(11) default '0' COMMENT 'Status do usuario: 0 = lixeira; 1 = recem cadastrado; 2 = aprovado;3 = bloqueado;',
  PRIMARY KEY  (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela com dados de acesso.' AUTO_INCREMENT=1 ;

CREATE TABLE groups (
	id int(11) NOT NULL auto_increment COMMENT 'Id',
	created datetime NOT NULL COMMENT 'data de criação',
	modified datetime NOT NULL COMMENT 'data de modificação',
	name varchar(32) NOT NULL COMMENT 'nome do grupo',
	flags text default NULL COMMENT 'bandeiras, que indicam o que o grupo pode fazer, null = fazer tudo',
  PRIMARY KEY  (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela com dados dos grupos.' AUTO_INCREMENT=1 ;

CREATE TABLE servers (
	id int(11) NOT NULL auto_increment COMMENT 'Id',
	created datetime NOT NULL COMMENT 'data de criação',
	modified datetime NOT NULL COMMENT 'data de modificação',
	name varchar(32) NOT NULL COMMENT 'nome do servidor',
	ip varchar(16) NOT NULL COMMENT 'ip do servidor',
	disk_space float default '0' COMMENT 'espaço em disco do sevidor',
	bandwidth float default '0' COMMENT 'banda do servidor',
	cost float default '0' COMMENT 'custo do servidor',
	osystem_id int(11) NOT NULL COMMENT 'sistema operacional do servidor',
	software_id int(11) NOT NULL COMMENT 'software de gestão',
  PRIMARY KEY  (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela com dados dos servidores.' AUTO_INCREMENT=1 ;

CREATE TABLE osystems (
	id int(11) NOT NULL auto_increment COMMENT 'Id',
	created datetime NOT NULL COMMENT 'data de criação',
	modified datetime NOT NULL COMMENT 'data de modificação',
	name varchar(32) NOT NULL COMMENT 'nome do sistema operacional',
	distro varchar(32) NOT NULL COMMENT 'nome da distribuição',
	version varchar(32) NOT NULL COMMENT 'versao',
	company varchar(32) NOT NULL COMMENT 'empresa responsavel',
  PRIMARY KEY  (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de sistemas operacionais' AUTO_INCREMENT=1 ;

CREATE TABLE domains (
	id int(11) NOT NULL auto_increment COMMENT 'Id',
	created datetime NOT NULL COMMENT 'data de criação',
	modified datetime NOT NULL COMMENT 'data de modificação',
	url varchar(255) NOT NULL COMMENT 'url do dominio',
	client_id int(11) NOT NULL COMMENT 'Id do cliente',
	plan_id int(11) NOT NULL COMMENT 'Id do plano de hospedagem',
	login varchar(8) NOT NULL COMMENT 'login de acesso do domínio',
	password varchar(255) NOT NULL COMMENT 'senha do domínio',
  PRIMARY KEY  (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela com dados dos dominios.' AUTO_INCREMENT=1 ;



CREATE TABLE plans (
	id int(11) NOT NULL auto_increment COMMENT 'Id',
	created datetime NOT NULL COMMENT 'data de criação',
	modified datetime NOT NULL COMMENT 'data de modificação',
	name varchar(32) NOT NULL COMMENT 'nome do plano de hospedagem',
	disk_space float default '0' COMMENT 'espaço em disco do plano',
	bandwidth float default '0' COMMENT 'banda do plano',
	cost float default '0' COMMENT 'custo do plano',
	plan_order float default '0' COMMENT 'ordem de exibição',
	plan_type int(11) default '0' COMMENT 'tipo de plano',
	period_id int(11) default '0' COMMENT 'periodo minimo',
	plan_status int(11) NOT NULL COMMENT 'status do plano, 0 = lixeira',
	tax float default '0' COMMENT 'taxa de setup',
  PRIMARY KEY  (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela com dados dos planos' AUTO_INCREMENT=1 ;

CREATE TABLE periods (
	id int(11) NOT NULL auto_increment COMMENT 'Id',
	created datetime NOT NULL COMMENT 'data de criação',
	modified datetime NOT NULL COMMENT 'data de modificação',
	name varchar(32) NOT NULL COMMENT 'nome do periodo',
	period int(11) NOT NULL COMMENT 'periodicidade, em dias',
	discount float default '0' COMMENT 'porcentagem de desconto',
	period_type int(11) default '0' COMMENT 'tipo de periodo: 0 - hospedagem; 1 - registro de dominio; 3 - outros; 4 - global',
	period_status int(11) default '0' COMMENT 'status do periodo: 0 - lixeira; 1 - visivel apenas no admin; 2 - visivel para todos',
  PRIMARY KEY  (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela com as periodicidades.' AUTO_INCREMENT=1 ;


CREATE TABLE services (
	id int(11) NOT NULL auto_increment COMMENT 'Id',
	created datetime NOT NULL COMMENT 'data de criação',
	modified datetime NOT NULL COMMENT 'data de modificação',
	name varchar(64) NOT NULL COMMENT 'nome do serviço',
	period_id int(11) default '0' COMMENT 'caso não haja periodo, é um serviço unico',
	min_period_id int(11) default '0' COMMENT '',
	service_type int(11) default '0' COMMENT 'tipo de serviço: 0 = hosting package; ', 
  PRIMARY KEY  (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela com dados de endereçamento.' AUTO_INCREMENT=1 ;

CREATE TABLE domain_extensions (
	id int(11) NOT NULL auto_increment COMMENT 'Id',
	created datetime NOT NULL COMMENT 'data de criação',
	modified datetime NOT NULL COMMENT 'data de modificação',
  PRIMARY KEY  (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela com dados de endereçamento.' AUTO_INCREMENT=1 ;
/*
  	codigo_plano  	int(11)  	 	  	Não  	 	auto_increment  	  Navegador distingue valores   	  Alterar   	  Eliminar   	  Primária   	  Único   	  Índice   	 Texto completo
	codigo_servidor 	smallint(6) 			Sim 	NULL 		Navegador distingue valores 	Alterar 	Eliminar 	Primária 	Único 	Índice 	Texto completo
	texto_boas_vindas 	int(11) 			Não 	0 		Navegador distingue valores 	Alterar 	Eliminar 	Primária 	Único 	Índice 	Texto completo
	nome_plano 	varchar(100) 	latin1_swedish_ci 		Sim 	NULL 		Navegador distingue valores 	Alterar 	Eliminar 	Primária 	Único 	Índice 	Texto completo
	espaco 	float 			Sim 	NULL 		Navegador distingue valores 	Alterar 	Eliminar 	Primária 	Único 	Índice 	Texto completo
	transferencia 	float 			Sim 	NULL 		Navegador distingue valores 	Alterar 	Eliminar 	Primária 	Único 	Índice 	Texto completo
	valor 	float 			Sim 	NULL 		Navegador distingue valores 	Alterar 	Eliminar 	Primária 	Único 	Índice 	Texto completo
	ordem 	float 			Sim 	0 		Navegador distingue valores 	Alterar 	Eliminar 	Primária 	Único 	Índice 	Texto completo
	integrado_whm 	char(1) 	latin1_swedish_ci 		Sim 	NULL 		Navegador distingue valores 	Alterar 	Eliminar 	Primária 	Único 	Índice 	Texto completo
	pacote 	varchar(100) 	latin1_swedish_ci 		Sim 	NULL 		Navegador distingue valores 	Alterar 	Eliminar 	Primária 	Único 	Índice 	Texto completo
	visivel 	char(1) 	latin1_swedish_ci 		Sim 	NULL 		Navegador distingue valores 	Alterar 	Eliminar 	Primária 	Único 	Índice 	Texto completo
	periodo_minimo 	varchar(10) 	latin1_swedish_ci 		Sim 	NULL 		Navegador distingue valores 	Alterar 	Eliminar 	Primária 	Único 	Índice 	Texto completo
	tipo_plano 	char(1) 	latin1_swedish_ci 		Não 	h 		Navegador distingue valores 	Alterar 	Eliminar 	Primária 	Único 	Índice 	Texto completo
	taxa_setup


*/





CREATE TABLE tabela (
	id int(11) NOT NULL auto_increment COMMENT 'Id',
	created datetime NOT NULL COMMENT 'data de criação',
	modified datetime NOT NULL COMMENT 'data de modificação',
  PRIMARY KEY  (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela com dados de endereçamento.' AUTO_INCREMENT=1 ;