<?php
	require_once('../DAL/UsuarioDao.php');
	class UsuarioController{
		protected $usuarioDao;
		function __construct(){
			$this->usuarioDao = new UsuarioDao();
		}

		function dadosPaciente(){
			return $this->usuarioDao->dadosPaciente();
		}

		function cadastrar(Usuario $user){
			if(!empty($user->getPontuacao())){
				return $this->usuarioDao->cadastrar($user);
			}
		}
	}

?>