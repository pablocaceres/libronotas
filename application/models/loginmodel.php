<?php
    class Loginmodel extends CI_Model {

      
        function __construct(){
            // Call the Model constructor
            parent::__construct();
            
            //Inicio la base de dato que va a usar este archivo!
            //$sgf = $this->load->database('db_sga', TRUE);
        }

        function autenticacion_login(){
            if(!isset($this->session->userdata['id']) and 
               !isset($this->session->userdata['name']) and
               !isset($this->session->userdata['email']) and
               !isset($this->session->userdata['active']) and
               !isset($this->session->userdata['password'])){
                redirect(base_url(''), 'refresh');
            }
        }

        public function log($user,$pass){
           //comprobamos que el nombre de usuario y contraseña coinciden
            $data = array(
                'username' => $user,
                'password' => $pass                
            );           
            $query = $this->db->get_where('usr',$data);
            return $query->result_array();
        }
       
        public function cerrarSesion(){
            //cerrar sesión
            return $this->session->sess_destroy();
        }

        public function modificar_fecha_log($data){
            $this->db->insert('usrhit',$data);
        }

        public function cambio_clave($pass,$id){
            $data = array('password' => $pass);
            $this->db->where('id', $id);
            return $this->db->update('usr', $data);
        }
               
    }
?>