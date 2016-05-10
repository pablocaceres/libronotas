<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facultad extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('facultadModel');
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
		$facu = $this->facultadModel->facultad(0);
		$data['data']['titulo'] = 'Lista de facultades';
		$data['data']['facu'] = $facu;
		$data['contenido'] = 'facultad/index';
		$this->load->view('layouts/plantilla',$data);
	}

	public function nueva_facultad($id=0){
		//esto es para el flash data
		$msj = 'No guardo';
		$tipo = 'danger';

		$data['data']['titulo'] = 'Nueva Facultad';
		//form validation
		$this->form_validation->set_rules('desc', 'Descripcion', 'required');
		if($this->form_validation->run()===FALSE){			
			//aca muestra el formulario
			$data['contenido'] = 'facultad/nueva_facultad';
			$this->load->view('layouts/plantilla',$data);
		}else{
			//guarda el post en el array
			$data = array('desc'=>$this->input->post('desc'));
			//pasa los datos a facultadModel
			$this->facultadModel->nueva_facultad($data);
			//variables para el mje de guardado
			$msj = 'Se guardo correctamente';
			$tipo = 'success';
			$this->session->set_flashdata('inst_edit', $msj);
			$this->session->set_flashdata('inst_edit_tipo', $tipo);
			redirect(base_url().'index.php/facultad');


		}
	}

		public function eliminar_facultad($id){
			$msj = 'No Se Elimino';
			$tipo = 'danger';
			$data = array('id'=>$id);
			if ($this->facultadModel->eliminar_facultad($data)){
				$msj = 'Se Elimino Correctamente';
				$tipo = 'success';	
			}
				$this->session->set_flashdata('inst_edit', $msj);
				$this->session->set_flashdata('inst_edit_tipo', $tipo);
				redirect(base_url().'index.php/facultad');
			
		}

		public function editar_facultad($id){
			$data['facultad'] = $this->facultadModel->facultad($id);
			$data['titulo'] = 'Editar Facultad';
			$this->form_validation->set_rules('desc', 'Descripcion', 'required');

			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('layouts/header', $data);	
				$this->load->view('facultad/editar_facultad',$data);
				$this->load->view('layouts/footer',$data);
			}
			else
			{
				$msj = 'No Se Edito';
				$tipo = 'warning';
				if($this->input->post('desc') != $this->input->post('desc_viejo')){
					$data = array('id'=> $this->input->post('id'), 'desc'=>$this->input->post('desc'));
					//if($this->facultadModel->editar_facultad($this->input->post('id'), $data)){
					if($this->facultadModel->editar_facultad($data)){	
						$msj = 'Se Edito Correctamente [id = '.$this->input->post('id').']';
						$tipo = 'success';	
					}else{
						$msj = 'Error, NO Se Edito Correctamente';
						$tipo = 'danger';
					}
				}
				
				$this->session->set_flashdata('inst_edit', $msj);
				$this->session->set_flashdata('inst_edit_tipo', $tipo);
				redirect('/facultad');
			}

			}
			


		}

	

	

	
