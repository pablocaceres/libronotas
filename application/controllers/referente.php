<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Referente extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('referenteModel');
		$this->load->model('gradoModel');
		$this->load->model('institucionModel');
		$this->load->library('lbusr');//Libreria de usuarios!	
		$this->load->library('form_validation');
		$this->load->helper('form');	
		$this->load->library('session');	
		$this->load->database();
		

		//Verifica si esta logueado!
		$this->lbusr->autenticacionLogin();
	}

	// Este metodo, Descodifica el array que esta en JSON... para trabajar con php
	public function request(){
		$request = file_get_contents('php://input');
		return json_decode($request,true);
	}

	public function index(){
		$referente = $this->referenteModel->referente(0);
		$data['data']['titulo'] = 'Lista de Referentes';
		$data['data']['referente'] = $referente;
		$data['contenido'] = 'referente/index';
		$this->load->view('layouts/plantilla',$data);
		$this->output->enable_profiler(TRUE);
	}





	public function new_referente($id=0){
		//esto es para el flash data
		$msj = 'No guardo';
		$tipo = 'danger';

		$data['data']['titulo'] = 'Nuevo Referente';
		//form validation
		$this->form_validation->set_rules('Apellido', 'apellido', 'required');
		$this->form_validation->set_rules('Nombre', 'nombre', 'required');
		if($this->form_validation->run()===FALSE){			
			$data['grado'] = $this->gradoModel->grado_array(0);
			$data['institucion'] = $this->institucionModel->institucion_array(0);
			$data['consulta_id'] = $this->referenteModel->id_referente();
			$data['contenido'] = 'referente/new_referente';
			$this->load->view('layouts/plantilla',$data);
		}else{
			
			$consulta_id = $this->referenteModel->id_referente();
			$data = array(	'id'=>$consulta_id,
							'apellido'=>$this->input->post('Apellido'), 
							'nombre'=>$this->input->post('Nombre'), 
							'email'=>$this->input->post('email'), 
							'tel_inst'=>$this->input->post('tel_inst'), 
							'tel_per'=>$this->input->post('tel_per'), 
							'grado_id'=>$this->input->post('grado'), 
							'institucion_id'=>$this->input->post('institucion'), 
				);
			$this->referenteModel->new_referente($data);
			//variables para el mje de guardado
			$msj = 'Se guardo correctamente';
			$tipo = 'success';
			$this->session->set_flashdata('inst_edit', $msj);
			$this->session->set_flashdata('inst_edit_tipo', $tipo);
			redirect(base_url().'index.php/referente');
		}
	$this->output->enable_profiler(TRUE);
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
