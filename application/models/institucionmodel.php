<?php
    class Institucionmodel extends CI_Model {
      var $id="", $desc="";
    	//TRAIGO TODOS LOS USUARIOS DE LA BASE DE DATOS!

        function __construct(){
            // Call the Model constructor
            parent::__construct();
            $this->load->helper('url');
            //Inicio la base de dato que va a usar este archivo!
            //$sgf = $this->load->database('db_sga', TRUE);
        }

      	public function institucion($id){
          $this->db->select('*');
          if($id != 0){              
              $this->db->where('id = '.$id);
          }
      		$query = $this->db->get('institucion');      		
        	return $query->result();      
          //return $this->db->last_query(); //MUESTAS LA CONSULTA
      	}

        public function nueva_institucion()
        {

          $data = array('desc' => $this->input->post('desc'));
          
          return $this->db->insert('institucion', $data);
        }

        public function eliminar_institucion ($id)
        {
          return $this->db->delete('institucion', array('id'=>$id));
        }

        public function editar_institucion ($id,$desc){
          $data = array('desc' => $desc);
          $this->db->where('id', $id);
          return $this->db->update('institucion', $data); 
        }

        //retorna un array simple
        public function institucion_array($id){
          $this->db->select('*');
           if($id != 0){              
               $this->db->where('id = '.$id);
           }
          $query = $this->db->get('institucion');
          
          foreach ($query->result() as $row)
          {
            $array[$row->id] = $row->desc;
          }         
          return $array;      
          //return $this->db->last_query(); //MUESTAS LA CONSULTA
        }
       
    }
?>