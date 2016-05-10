<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grado extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('gradoModel');
		$this->load->library('lbusr');//Libreria de usuarios!
		$this->load->library('form_validation');
		$this->load->helper('form');	
		$this->load->library('session');	

		//Verifica si esta logueado!
		$this->lbusr->autenticacionLogin();
	}

	// Este metodo, Descodifica el array que esta en JSON... para trabajar con php
	public function request(){
		$request = file_get_contents('php://input');
		return json_decode($request,true);
	}

	public function index(){
		$grado = $this->gradoModel->grado(0);
		$data['data']['titulo'] = 'Lista de Grados';
		$data['data']['grado'] = $grado;
		$data['contenido'] = 'grado/index';
		$this->load->view('layouts/plantilla',$data);
	}

	public function nuevo_grado($id=0){
		//esto es para el flash data
		$msj = 'No guardo';
		$tipo = 'danger';

		$data['data']['titulo'] = 'Nuevo Grado';
		//form validation
		$this->form_validation->set_rules('desc', 'Descripcion', 'required');
		if($this->form_validation->run()===FALSE){
			//aca muestra el formulario
			$data['contenido'] = 'grado/nuevo_grado';
			$this->load->view('layouts/plantilla',$data);
		}else{
			//guarda el post en el array
			$data = array('desc'=>$this->input->post('desc'));
			//pasa los datos a gradoModel
			$this->gradoModel->nuevo_grado($data);
			//variables para el mje de guardado
			$msj = 'Se guardo correctamente';
			$tipo = 'success';
			$this->session->set_flashdata('inst_edit', $msj);
			$this->session->set_flashdata('inst_edit_tipo', $tipo);
			redirect(base_url().'index.php/grado');
		}
	}

	public function eliminar_grado($id){
		$msj = 'No Se Elimino';
		$tipo = 'danger';
		$data= array('id'=>$id);
		if ($this->gradoModel->eliminar_grado($data)) {
			$msj = 'Se eliminó correctamente';
			$tipo = 'warning';
		}
		$this->session->set_flashdata('inst_edit', $msj);
		$this->session->set_flashdata('inst_edit_tipo', $tipo);
		redirect(base_url().'index.php/grado');
	}

	public function editar_grado($id){
		
		$data['grado'] = $this->gradoModel->grado($id);
		$data['data']['titulo'] = 'Editar Grado';
		//form validation
		$this->form_validation->set_rules('desc', 'Descripcion', 'required');
		if($this->form_validation->run()===FALSE){
			//aca muestra el formulario
			$data['contenido'] = 'grado/editar_grado';
			$this->load->view('layouts/plantilla',$data);
		}else{
			$msj = 'No edito';
			$tipo = 'danger';
			if($this->input->post('desc') != $this->input->post('desc_viejo')){
				$data = array('id'=> $this->input->post('id'), 'desc'=>$this->input->post('desc'));
				//if($this->facultadModel->editar_facultad($this->input->post('id'), $data)){
				if($this->gradoModel->editar_grado($data)){	
					$msj = 'Se Edito Correctamente [id = '.$this->input->post('id').']';
					$tipo = 'success';	
				}else{
					$msj = 'Error, NO Se Edito Correctamente';
					$tipo = 'danger';
				}
			}
			$this->session->set_flashdata('inst_edit', $msj);
			$this->session->set_flashdata('inst_edit_tipo', $tipo);
			redirect('/grado');
		}
	}

}

	
