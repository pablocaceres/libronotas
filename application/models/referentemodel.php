<?php
    class Referentemodel extends CI_Model {
      var $id="", $desc="";
    	//TRAIGO TODOS LOS USUARIOS DE LA BASE DE DATOS!

        function __construct(){
            // Call the Model constructor
            parent::__construct();
            
            //Inicio la base de dato que va a usar este archivo!
            //$sgf = $this->load->database('db_sga', TRUE);
        }

      	public function referente($id){
          $this->db->select('referente.id, referente.Apellido, referente.Nombre, referente.email, referente.tel_inst, referente.tel_per, grado.desc as grado, institucion.desc as institucion');
          //$this->db->select('*');
          $this->db->from('referente');
          $this->db->join('grado', 'grado.id = referente.grado_id');
          $this->db->join('institucion', 'institucion.id=referente.institucion_id');
          if($id != 0){              
              $this->db->where('id = '.$id);
          }
          $this->db->order_by("id", "asc");
      		$query = $this->db->get();  

        	return $query->result();      
          //return $this->db->last_query(); //MUESTAS LA CONSULTA
      	}
      
        //retorna el ultimo ID de referente + 1  
        public function id_referente(){          
          $this->db->select_max('id');
          $query = $this->db->get('referente');

          foreach ($query->result_array() as $row)
            {
               $variable = $row['id'];               
            }
          
          return $variable+1;
        }

        //alta
        public function new_referente($data){
          //$data = array('desc'=> $desc);
          return $this->db->insert('referente',$data);
        }
        
        //baja
        public function delete_referente($data){
          //$data = array('id'=>$id);
          return $this->db->delete('referente',$data);
        }

        //modificacin
        public function edit_referente($data){  
          //el $data['id'] lee el id del array y lo compara con el where
          $this->db->where('id',$data['id']);
          return $this->db->update('referente',$data);

        }   

        
    }
?>