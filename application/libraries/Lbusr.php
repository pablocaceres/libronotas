<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lbusr {
	protected $ci;
   
   	function __construct(){
    	$this->ci =& get_instance();
    	$this->ci->load->model('usuariomodel');
   	}

	function autenticacionLogin(){
		$this->ci->load->model('loginmodel');
		return $this->ci->loginmodel->autenticacion_login();
	}

	function usuariosLista($id){
		return $this->ci->usuariomodel->usuarios($id);
	}

	function tipuser(){
		return  $this->ci->usuariomodel->tipousr();
	}

	function crearusr($nya,$user,$email,$tpuser,$id_usr){
		$clave = md5($user);
		$created_on = date("Y-m-d h:i:s");
		return  $this->ci->usuariomodel->crearusr($nya,$user,$email,$tpuser,$clave,$created_on,$id_usr);
	}

	function actDesact($id){
		return $this->ci->usuariomodel->actDesact($id);
	}

	function restclav($id){
		$usr = $this->ci->usuariomodel->usuarios($id);
		$pass = md5($usr[0]->un);
		return $this->ci->usuariomodel->restclav($id,$pass);
	}	
}