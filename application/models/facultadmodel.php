<?php
    class Facultadmodel extends CI_Model {
      var $id="", $desc="";
    	//TRAIGO TODOS LOS USUARIOS DE LA BASE DE DATOS!

        function __construct(){
            // Call the Model constructor
            parent::__construct();
            
            //Inicio la base de dato que va a usar este archivo!
            //$sgf = $this->load->database('db_sga', TRUE);
        }

      	public function facultad($id){
          $this->db->select('*');
          if($id != 0){              
              $this->db->where('id = '.$id);
          }
      		$query = $this->db->get('facultad');      		
        	return $query->result();      
          //return $this->db->last_query(); //MUESTAS LA CONSULTA
      	}

        //alta
        public function nueva_facultad($data){
          //$data = array('desc'=> $desc);
          return $this->db->insert('facultad',$data);
        }
        
        //baja
        public function eliminar_facultad($data){
          //$data = array('id'=>$id);
          return $this->db->delete('facultad',$data);
        }

        //modificacin
        public function editar_facultad($data){  
          //el $data['id'] lee el id del array y lo compara con el where
          $this->db->where('id',$data['id']);
          return $this->db->update('facultad',$data);

        }

         

        
    }
?>