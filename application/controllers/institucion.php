<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Institucion extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('institucionModel');
		$this->load->library('lbusr');//Libreria de usuarios!

		//Verifica si esta logueado!
		$this->lbusr->autenticacionLogin();
		$this->load->library('session');
	}

	// Este metodo, Descodifica el array que esta en JSON... para trabajar con php
	public function request(){
		$request = file_get_contents('php://input');
		return json_decode($request,true);
	}

	public function index(){
		$institucion = $this->institucionModel->institucion(0);
		$data['data']['titulo'] = 'Lista de Instituciones';
		$data['data']['institucion'] = $institucion;
		$data['contenido'] = 'institucion/index';
		$this->load->view('layouts/plantilla',$data);
	}


	public function formulario($id=0){	
		$this->load->helper('form');	
		$this->load->library('form_validation');

			$this->form_validation->set_rules('desc', 'Descripcion', 'required');
			$data['titulo'] = 'Crear nueva insitucion';

			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('layouts/header', $data);	
				$this->load->view('institucion/formulario',$data);
				$this->load->view('layouts/footer',$data);
							
			}
			else
			{
				$this->institucionModel->nueva_institucion();
				$this->load->view('layouts/header', $data);	
				$this->load->view('institucion/success',$data);
				$this->load->view('layouts/footer',$data);
			}	
		//if ($id>0) {
		//	$data['data']['titulo'] = 'Editar Institucion';
		//	$data['data']['inst'] = $this->institucionModel->institucion($id);
		//}else{
		//esta  parte es para nueva isntitucion lo de arriba es para editar
		//$data['contenido'] = 'institucion/formulario';
		//$this->load->view('layouts/plantilla',$data);
		//$this->institucionModel->nueva_institucion();
		//$this->load->view('institucion/success');
		//}
	}


	public function eliminar($id)
	{
		$msj = 'No Se Elimino';
		$tipo = 'danger';
		if ($this->institucionModel->eliminar_institucion($id)){
			$msj = 'Se Elimino Correctamente';
			$tipo = 'success';	
		}
			$this->session->set_flashdata('inst_edit', $msj);
			$this->session->set_flashdata('inst_edit_tipo', $tipo);
			redirect(base_url().'index.php/institucion');
			
	}

	public function editar ($id=0)
	{
		$data['institucion'] = $this->institucionModel->institucion($id);

		$this->load->helper('form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('desc', 'Descripcion', 'required');
		
		$data['titulo'] = 'Editar Insitucion';

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('layouts/header', $data);	
			$this->load->view('institucion/editar',$data);
			$this->load->view('layouts/footer',$data);
		}
		else
		{
			$msj = 'No Se Edito';
			$tipo = 'warning';
			if($this->input->post('desc') != $this->input->post('desc_viejo')){
				if($this->institucionModel->editar_institucion($this->input->post('id'), $this->input->post('desc'))){
					$msj = 'Se Edito Correctamente [id = '.$this->input->post('id').']';
					$tipo = 'success';	
				}else{
					$msj = 'Error, NO Se Edito Correctamente';
					$tipo = 'danger';
				}
			}
			
			$this->session->set_flashdata('inst_edit', $msj);
			$this->session->set_flashdata('inst_edit_tipo', $tipo);
			redirect('/institucion');
		}

	}

	


	
}