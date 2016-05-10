<?php
    class Libromodel extends CI_Model {
      var $id="", $desc="";
    	//TRAIGO TODOS LOS USUARIOS DE LA BASE DE DATOS!

        function __construct(){
            // Call the Model constructor
            parent::__construct();

            //Inicio la base de dato que va a usar este archivo!
            //$sgf = $this->load->database('db_sga', TRUE);
        }

      	public function libro($id){
          $this->db->select('libro.id, libro.fecha, origen.desc as origen, libro.destino, libro.concepto, libro.nroexpete, libro.nroresol, libro.observaciones, libro.pdf, libro.convenio, libro.activo');
          //$this->db->select('*');
          $this->db->from('libro');
          $this->db->join('origen', 'origen.id = libro.origen_id');
          $this->db->order_by ('libro.id',"desc");

          if($id != 0){
              $this->db->where('id = '.$id);
          }
      		$query = $this->db->get();
        	return $query->result();
          //return $this->db->last_query(); //MUESTAS LA CONSULTA
      	}

        //alta
        public function new_libro ($data){
          //$data = array('desc'=> $desc);
          return $this->db->insert('libro',$data);
        }

        //baja
        public function eliminar_libro($data){
          //$data = array('id'=>$id);
          return $this->db->delete('libro',$data);
        }

        //modificacin
        public function editar_libro($data){
          //el $data['id'] lee el id del array y lo compara con el where
          $this->db->where('id',$data['id']);
          return $this->db->update('libro',$data);

        }

        public function origen_array($id){
          $this->db->select('*');
           if($id != 0){
               $this->db->where('id = '.$id);
           }
          $query = $this->db->get('origen');

          foreach ($query->result() as $row)
          {
            $array[$row->id] = $row->desc;
          }
          return $array;
          //return $this->db->last_query(); //MUESTAS LA CONSULTA
        }

        //retorna el ultimo ID del libro +1
        public function id_libro(){
          $this->db->select_max('id');
          //$this->db->mysql_insert_id('id');
          $query = $this->db->get('libro');
          foreach ($query->result_array() as $row)
            {
               $variable = $row['id'];
            }
          return $variable;
        }


    }
?>
