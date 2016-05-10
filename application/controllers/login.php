<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('loginModel');
	}

	// Este metodo, Descodifica el array que esta en JSON... para trabajar con php
	public function request(){
		$request = file_get_contents('php://input');
		return json_decode($request,true);
	}

	//Metodo Login, Trae la vista del LogIn
	public function index(){
		if($this->session->userdata('name') != ''){
			redirect(base_url('index.php/libro'),'refresh');
		}
		$this->load->view('login/login');
	}

	//Metodo Logout, Cierra la sessiones.
	public function log(){
		$post = $this->request();
		$user = htmlspecialchars(addslashes(trim($post["usr"])), ENT_QUOTES, config_item('utf8'));
		$pass = md5(htmlspecialchars(addslashes(trim($post["pass"])), ENT_QUOTES, config_item('utf8')));

		$usr = $this->loginModel->log($user,$pass);
		if(count($usr) > 0){
			if((md5($usr[0]["username"]) != $usr[0]["password"])){
				//Si esta activa genera las sessiones.
				if($usr[0]["active"] == 1){
					//Creo las sessiones!
	            	$this->crear_session($usr);
	            	//Modifico el ultimo logueo.
	            	$this->modificar_fecha_log();

	            	echo 1;//si envia un 1, Significa q se logueo correctamente
	            }else{
	            	//SI NO, Envia el msj nro: 2
	            	echo 2;//Error, LA CUENTA ESTA DESACTIVADA
	            }
	        }else{
	        	//creo la session con el id, para podes luego cambiar la clave
	        	$this->session->set_userdata(array('id'=>$usr[0]['id'], 'password'=>$usr[0]['password']));
	        	echo 3;//Comprueba si inicia por primera vez
	        }
		}else{
			// no se pudo loguear!!!! ERROR USER Y/O PASS
			echo 0;
		}
	}

	//Crea las sessiones!
	public function crear_session($usr){
		$this->session->set_userdata($usr[0]);
	}

	//Obtiene la IP del cliente
	public function get_real_ip(){
        if (isset($_SERVER["HTTP_CLIENT_IP"])){
            return $_SERVER["HTTP_CLIENT_IP"];
        }elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }elseif (isset($_SERVER["HTTP_X_FORWARDED"])){
            return $_SERVER["HTTP_X_FORWARDED"];
        }elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){
            return $_SERVER["HTTP_FORWARDED_FOR"];
        }elseif (isset($_SERVER["HTTP_FORWARDED"])){
            return $_SERVER["HTTP_FORWARDED"];
        }else{
            return $_SERVER["REMOTE_ADDR"];
        }
    }

	//modifica la ultima vez que se coneto.... TABLA: usrhit
	public function modificar_fecha_log(){
		$fecha_hs = date('Y-m-d h:i:s');
		$ip = $this->get_real_ip();
		$id_usr = $this->session->userdata('id');
		$data = array('last_access'=>$fecha_hs,
					  'ip_access'=>$ip,
				  	  'iduser'=>$id_usr);
		$this->loginModel->modificar_fecha_log($data);
	}

	//Metodo Logout, Cierra la sessiones.
	public function logout(){
		$this->loginModel->cerrarSesion();
		redirect(base_url(),'refresh');
	}

	public function cambio_clave(){
		$this->load->view('login/cambio_clave');
	}

	public function nuevaclave(){
		$post = $this->request();
		$pass = md5(htmlspecialchars(addslashes(trim($post["clave"])), ENT_QUOTES, config_item('utf8')));
		if($pass == $this->session->userdata('password')){
			echo 0;
		}else{
			if($this->loginModel->cambio_clave($pass,$this->session->userdata('id'))){
				echo base_url();
			}else{
				echo 2;
			}
		}
	}

}
