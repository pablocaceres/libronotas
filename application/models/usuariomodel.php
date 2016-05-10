<?php
    class Usuariomodel extends CI_Model {
      var $name="", $username="", $email="", $idtipousr="", $password="", $created_on="", $active="";
    	//TRAIGO TODOS LOS USUARIOS DE LA BASE DE DATOS!

        function __construct(){
            // Call the Model constructor
            parent::__construct();
            
            //Inicio la base de dato que va a usar este archivo!
            //$sgf = $this->load->database('db_sga', TRUE);
        }

      	public function usuarios($id){
          if($id != 0){
              $this->db->select('usr.name AS n, usr.idtipousr AS tpusr, usr.username AS un, usr.id AS i, usr.email AS e, usr.active AS a, usr.created_on AS co');
              $this->db->where('id = '.$id);
          }else{      		
          		$this->db->select('usrhit.last_access AS ult_acc, usr.name AS n, usr.username AS un, usr.id AS i, usr.email AS e, usr.active AS a, usr.created_on AS co, tipousr.id AS i_tpu, tipousr.descr AS tpu');      		
          		$this->db->select_max('usrhit.last_access');
          		$this->db->join('usrhit', 'usrhit.iduser = usr.id','left');
              $this->db->join('tipousr', 'tipousr.id = usr.idtipousr','left');
          		$this->db->group_by("usr.id");
          		//$this->db->order_by("usrhit.last_access","asc");
          }
      		$query = $this->db->get('usr');      		
        	return $query->result();      
          //return $this->db->last_query(); //MUESTAS LA CONSULTA
      	}

        public function tipousr(){
          $this->db->select('id AS ident, descr AS descripcion');    
          $this->db->where('descr != "SuperAdmin"');
          $query = $this->db->get('tipousr');         
          return $query->result();
        }

        public function crearusr($nya,$user,$email,$tpuser,$clave,$created_on,$id_usr){          
            if($id_usr == 0){
                $data = array(
                   'name' => $nya,
                   'username' => $user,
                   'email' => $email,
                   'idtipousr' => $tpuser,
                   'password' => $clave,
                   'created_on' => $created_on,
                   'active' => 1
                );
                $this->db->insert('usr', $data);
            }else{
                $data = array(
                   'name' => $nya,
                   'username' => $user,
                   'email' => $email,
                   'idtipousr' => $tpuser
                );
                $this->db->where('id', $id_usr);
                $this->db->update('usr', $data);
                //$this->output->enable_profiler(TRUE); 
            }
        }

        public function actDesact($id){
            $usr = $this->usuarios($id);
            if($usr[0]->a){
              $data = array('active'=>0);            
            }else{
              $data = array('active'=>1);
            }
            $this->db->where('id', $id);
            return $this->db->update('usr', $data);          
        }

        public function restclav($id,$pass){
            $data = array('password' => $pass);
            $this->db->where('id', $id);
            return $this->db->update('usr', $data);
        }
    }
?>