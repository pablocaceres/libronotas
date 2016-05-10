<?php
    class Gradomodel extends CI_Model {
      var $id="", $desc="";
    	//TRAIGO TODOS LOS USUARIOS DE LA BASE DE DATOS!

        function __construct(){
            // Call the Model constructor
            parent::__construct();
            
            //Inicio la base de dato que va a usar este archivo!
            //$sgf = $this->load->database('db_sga', TRUE);
        }

      	public function grado($id){
          $this->db->select('*');
           if($id != 0){              
               $this->db->where('id = '.$id);
           }
      		$query = $this->db->get('grado');      		
        	return $query->result();      
          //return $this->db->last_query(); //MUESTAS LA CONSULTA
      	}

        //retorna un array simple
        public function grado_array($id){
          $this->db->select('*');
           if($id != 0){              
               $this->db->where('id = '.$id);
           }
          $query = $this->db->get('grado');
          
          foreach ($query->result() as $row)
          {
            $array[$row->id] = $row->desc;
          }         
          return $array;      
          //return $this->db->last_query(); //MUESTAS LA CONSULTA
        }

        public function nuevo_grado($data){
          return $this->db->insert('grado',$data);
        }

        public function eliminar_grado($data){
          return $this->db->delete('grado',$data);
        }

        public function editar_grado($data){
          $this->db->where('id',$data['id']);          
          return $this->db->update('grado',$data);
        }
       
    }
?>