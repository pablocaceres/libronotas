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
		$data['data']['titulo'] = 'Libro de Notas';
		$data['origen'] = $this->libroModel->origen_array(0);
		$data['data']['libro'] = $libro;
		$data['error_archivo']=$this->upload->display_errors();
		$data['contenido'] = 'libro/index';
		$this->load->view('layouts/plantilla',$data);
		//$this->output->enable_profiler(TRUE);
	}

	// muestra tabla (vista libro/resol)
	public function resol(){
		$libro = $this->libroModel->libro_resol(0);
		$data['data']['titulo'] = 'Resoluciones PDF';
		$data['origen'] = $this->libroModel->origen_array(0);
		$data['data']['libro'] = $libro;
		$data['error_archivo']=$this->upload->display_errors();
		$data['contenido'] = 'libro/resol';
		$this->load->view('layouts/plantilla',$data);
		//$this->output->enable_profiler(TRUE);
	}

	// muestra tabla por año (vista index libro)
	public function libroyear($year){
		$libro = $this->libroModel->libroyear($year);
		$data['data']['titulo'] = 'Libro de Notas';
		$data['origen'] = $this->libroModel->origen_array(0);
		$data['data']['libro'] = $libro;
		$data['data']['year'] = $year;
		$data['error_archivo']=$this->upload->display_errors();
		$data['contenido'] = 'libro/index';
		$this->load->view('layouts/plantilla',$data);
		//$this->output->enable_profiler(TRUE);
	}

	public function ajax_edit($id)
    {
        $data = $this->libroModel->un_libro($id);
        echo json_encode($data);
    }


		// este editar es con el ajax que encontre en un tutorial
		public function un_libro($id){
			$libro = $this->libroModel->libro($id);
			echo json_encode($libro[0]);
		}


	// public function un_libro(){
	// 	$libro = $this->libroModel->libro($_POST['id']);
	// 	echo json_encode($libro[0]);
	// }



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

			//si no se carga el pdf no importa, se pone el nombre en blanco y se graba igual.
      if (!$this->upload->do_upload()){
				$file_name = "";
			}else{
					//graba el archivo si esta todo ok
					$this->upload->data();
				}
					//consulta del año que traigo del formulario
					$año= date("Y",strtotime($this->input->post('fecha')));
					//genero nro de nota dentro de un año seleccionado
					$nronota= $this->libroModel->maximo_nro_nota($año);

					//genera array para grabar en base de datos
          $data = array(
						'nro_nota'=>$nronota,
						'fecha'=>$this->input->post('fecha'),
						'origen_id'=>$this->input->post('origen'),
						'destino'=>$this->input->post('destino'),
						'concepto'=>$this->input->post('concepto'),
						//'nroexpete'=>$this->input->post('nroexpete'),
						//'nroresol'=>$this->input->post('nroresol'),
						'observaciones'=>$this->input->post('observaciones'),
						'pdf'=>$file_name,//guardo la ruta donde esta el pdf (../public/pdf/nombre.pdf)
						'convenio'=>$this->input->post('convenio'),
					);

					//graba el array
					$this->libroModel->new_libro($data);
					//variables para el mje de guardado flashdata

					//traigo el maximo nro_nota de un año y le resto 1 xq la funtion ya me suma +1
					$nronota= $this->libroModel->maximo_nro_nota($año)-1;
					//variables para el flashdata
					$msj = 'Se guardo correctamente';
					$tipo = 'success';
					$this->session->set_flashdata('nronota', $nronota);
					$this->session->set_flashdata('inst_edit', $msj);
					$this->session->set_flashdata('inst_edit_tipo', $tipo);
					redirect(base_url().'index.php/libro/libroyear/'.$año);
	// $this->output->enable_profiler(TRUE);
	}



public function eliminar_libro($id,$nro_nota,$año){
			$msj = 'No Se Anulo';
			$tipo = 'danger';
			$data = array('id'=>$id, 'activo'=>0);
			if ($this->libroModel->eliminar_libro($data)){
				$msj = 'La nota se anulo correctamente';
				$tipo = 'warning';
			}
				$this->session->set_flashdata('nronota', $nro_nota);
				$this->session->set_flashdata('inst_edit', $msj);
				$this->session->set_flashdata('inst_edit_tipo', $tipo);
				redirect(base_url().'index.php/libro/libroyear/'.$año);
}

		public function editar_libro(){
			$msj = 'No se Edito';
			$tipo = 'danger';
				//configuracion para subir el archivo
				$config['upload_path'] = './public/pdf/';
	      $config['allowed_types'] = 'pdf';
	      $file_name = date('YmdHis');
	      $config['file_name']= $file_name;// reasigno un nombre al archivo (fecha-nro de nota)
				$this->load->library('upload', $config);
	      $this->upload->initialize($config);

				//si no se carga el pdf no importa, se pone el nombre en blanco y se graba igual.
	      if (!$this->upload->do_upload()){
					$file_name = "";
				}else{
						//graba el archivo si esta todo ok
						$this->upload->data();
					}
						//consulta del año que traigo del formulario
						$año= date("Y",strtotime($this->input->post('fecha')));

						//genera array para grabar en base de datos
	          $data = array(
							//'id'=>$this->input->post('Lid'),
							'fecha'=>$this->input->post('fecha'),
							'origen_id'=>$this->input->post('origen_id'),
							'destino'=>$this->input->post('destino'),
							'concepto'=>$this->input->post('concepto'),
							'nroexpete'=>$this->input->post('nroexpete'),
							'nroresol'=>$this->input->post('nroresol'),
							'observaciones'=>$this->input->post('observaciones'),
							'pdf'=>$file_name,//guardo la ruta donde esta el pdf (../public/pdf/nombre.pdf)
							'convenio'=>$this->input->post('convenio'),
						);
						//traigo el maximo nro_nota de un año y le resto 1 xq la funtion ya me suma +1 para mostrar grid
						//$nronota= $this->libroModel->maximo_nro_nota($año)-1;
						$id_nota = $this->input->post('id_nota');

						//graba el array
						if ($this->libroModel->editar_libro($id_nota, $data)) {
							//variables para el flashdata
							$msj = 'Se Edito correctamente';
							$tipo = 'info';
							$nronota = $this->input->post('nro_nota');
						}
						//variables para el mje de guardado flashdata
						$this->session->set_flashdata('nronota', $nronota);
						$this->session->set_flashdata('inst_edit', $msj);
						$this->session->set_flashdata('inst_edit_tipo', $tipo);
						redirect(base_url().'index.php/libro/libroyear/'.$año);
						echo json_encode(array("status" => TRUE));
	 				//$this->output->enable_profiler(TRUE);
		}

			// if ($this->form_validation->run() === FALSE)
			// {
			// 	$this->load->view('layouts/header', $data);
			// 	$this->load->view('facultad/editar_facultad',$data);
			// 	$this->load->view('layouts/footer',$data);
			// }
			// else
			// {
			// 	$msj = 'No Se Edito';
			// 	$tipo = 'warning';
			// 	if($this->input->post('desc') != $this->input->post('desc_viejo')){
			// 		$data = array('id'=> $this->input->post('id'), 'desc'=>$this->input->post('desc'));
			// 		//if($this->facultadModel->editar_facultad($this->input->post('id'), $data)){
			// 		if($this->facultadModel->editar_facultad($data)){
			// 			$msj = 'Se Edito Correctamente [id = '.$this->input->post('id').']';
			// 			$tipo = 'success';
			// 		}else{
			// 			$msj = 'Error, NO Se Edito Correctamente';
			// 			$tipo = 'danger';
			// 		}
			// 	}
			//
			// 	$this->session->set_flashdata('inst_edit', $msj);
			// 	$this->session->set_flashdata('inst_edit_tipo', $tipo);
			// 	redirect('/facultad');
			// }
			//
			// }
}
