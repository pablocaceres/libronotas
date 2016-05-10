<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {

	function __construct(){
		parent::__construct();
		//$this->load->model('usuarioModel');
		$this->load->library('lbusr');//Libreria de usuarios!

		//Verifica si esta logueado!
		$this->lbusr->autenticacionLogin();
	}

	// Este metodo, Descodifica el array que esta en JSON... para trabajar con php
	public function request(){
		$request = file_get_contents('php://input');
		return json_decode($request,true);
	}

	public function index(){
		$data['data']['titulo'] = 'Usuarios';
		$data['contenido'] = 'usuario/index';
		$this->load->view('layouts/plantilla',$data);
	}

	public function listausuario(){
		$data['titulo'] = 'Usuarios';
		//$this->load->view('layouts/plantilla',$data);	
		$this->load->view('usuario/listausuario',$data);
		$this->output->enable_profiler(TRUE);		

	}
	//Lista de usuarios, en el index, SI RECIVE UN ID, TRAE EL REGISTRO ASOCIADO AL ID
	public function usuarios($id = 0){
		$usuarios = $this->lbusr->usuariosLista($id);
		print_r(json_encode($usuarios));
	}

	public function formulario(){		
		$data['titulo'] = 'Usuarios';
		//$this->load->view('layouts/plantilla',$data);	
		$this->load->view('usuario/formulario',$data);


	}

	public function tipuser(){
		$tipuser = $this->lbusr->tipuser();
		print_r(json_encode($tipuser));
	}

	public function crearusr(){

		$post = $this->request();
		$tipuser = $this->lbusr->crearusr($post['nya'],$post['user'],$post['email'],$post['tpuser'],$post['id_usr']);
		echo 1;
	}

	public function actDesact(){
		$post = $this->request();
		echo $this->lbusr->actDesact($post['id']);
		
	}

	public function importador(){
		$data['titulo'] = 'Importar Lista De Usuarios';		
		$this->load->view('usuario/importador',$data);
	}

	//En Esta Funcion Importo La Lista Excel, De Usuarios!!!!
	public function import(){		
		$arc = $_FILES['file'];//Archivo que recivo!
		if($arc['type'] === 'text/x-sql'){
			print_r($arc);
		}else{
			echo 'Solo Se Permiten Archivos .SQL';
		}
	}

	//DESCARGA EL EXCEL PARA USUARIOS
	public function descargarExcel(){
		$this->load->helper('download');
		$name = 'excelUsuarios.rar';
		$data = file_get_contents(base_url('public/archivos/excelUsuarios.rar'));
		force_download($name, $data); 
	}

	public function restclav(){
		$post = $this->request();
		echo $this->lbusr->restclav($post['id']);
	}

	
}