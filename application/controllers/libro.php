<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Libro extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('libroModel');
		$this->load->model('fileModel');
		$this->load->library('lbusr');//Libreria de usuarios!
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->database();
		//Verifica si esta logueado!
		$this->lbusr->autenticacionLogin();
	}

	// Este metodo, Descodifica el array que esta en JSON... para trabajar con php
	public function request(){
		$request = file_get_contents('php://input');
		return json_decode($request,true);
	}

	// muestra tabla (vista index libro)
	public function index(){
		$libro = $this->libroModel->libro(0);
		$data['data']['titulo'] = 'Lista del Libro';
		$data['origen'] = $this->libroModel->origen_array(0);
		$data['data']['libro'] = $libro;
		$data['error_archivo']=$this->upload->display_errors();
		$data['contenido'] = 'libro/index';
		$this->load->view('layouts/plantilla',$data);
		//$this->output->enable_profiler(TRUE);
	}



public function new_libro($id=0){
		//esto es para el flash data
		$msj = 'No guardo';
		$tipo = 'danger';
			//configuracion para subir el archivo
			$config['upload_path'] = './public/pdf/';
      $config['allowed_types'] = 'pdf';
      $file_name = date('YmdHis');
      $config['file_name']= $file_name;// reasigno un nombre al archivo (fecha-nro de nota)
			$this->load->library('upload', $config);
      $this->upload->initialize($config);

      if (!$this->upload->do_upload()){
				$file_name = "";
				// $msj = 'No guardo';
				// $tipo = 'danger';
				// $this->session->set_flashdata('nronota', $nronota);
				// $this->session->set_flashdata('inst_edit', $msj);
				// $this->session->set_flashdata('inst_edit_tipo', $tipo);
				// redirect(base_url().'index.php/libro');
	      // $data['libro'] = $this->libroModel->libro(0);
				// $data['origen'] = $this->libroModel->origen_array(0);
	      //$data['error_archivo']=$this->upload->display_errors();
	      // $data['contenido'] = 'libro/index';
	      // $this->load->view('layouts/plantilla',$data);

			}else{
					//graba el archivo
					$this->upload->data();
				}
          //genera array para grabar en base de datos
          $data = array(
						'fecha'=>$this->input->post('fecha'),
						'origen_id'=>$this->input->post('origen'),
						'destino'=>$this->input->post('destino'),
						'concepto'=>$this->input->post('concepto'),
						'nroexpete'=>$this->input->post('nroexpete'),
						'nroresol'=>$this->input->post('nroresol'),
						'observaciones'=>$this->input->post('observaciones'),
						'pdf'=>$file_name,//guardo la ruta donde esta el pdf (../public/pdf/nombre.pdf)
						'convenio'=>$this->input->post('convenio'),
					);

					//graba el array
					$this->libroModel->new_libro($data);
					//variables para el mje de guardado
					$nronota= $this->libroModel->id_libro();
					$msj = 'Se guardo correctamente';
					$tipo = 'success';
					$this->session->set_flashdata('nronota', $nronota);
					$this->session->set_flashdata('inst_edit', $msj);
					$this->session->set_flashdata('inst_edit_tipo', $tipo);
					redirect(base_url().'index.php/libro');
				

	// $this->output->enable_profiler(TRUE);
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
