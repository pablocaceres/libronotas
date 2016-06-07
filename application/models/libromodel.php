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

        //me trae toda la base libro_db
      	public function libro($id){
          $this->db->select('libro.id as Lid, libro.nro_nota, libro.fecha, origen.desc as origen, libro.destino, libro.concepto, libro.nroexpete, libro.nroresol, libro.observaciones, libro.pdf, libro.convenio, libro.activo');
          //$this->db->select('*');
          $this->db->from('libro');
          $this->db->join('origen', 'origen.id = libro.origen_id');
          $this->db->order_by ('libro.id',"desc");

          //solo trae un registro con id
          if($id != 0){
              $this->db->where('libro.id = '.$id);
          }
      		$query = $this->db->get();
        	return $query->result();
          //return $this->db->last_query(); //MUESTAS LA CONSULTA
      	}

        public function libro_resol($id){
          $this->db->select('libro.id as Lid, libro.nro_nota, libro.fecha, origen.desc as origen, libro.destino, libro.concepto, libro.nroexpete, libro.nroresol, libro.observaciones, libro.pdf, libro.convenio, libro.activo');
          //$this->db->select('*');
          $this->db->from('libro');
          $this->db->join('origen', 'origen.id = libro.origen_id');
          $this->db->order_by ('libro.id',"desc");
          $this->db->where('libro.pdf != ""');

          //solo trae un registro con id
          if($id != 0){
              $this->db->where('libro.id = '.$id);
          }
      		$query = $this->db->get();
        	return $query->result();
          //return $this->db->last_query(); //MUESTAS LA CONSULTA
      	}

        public function un_libro($id){
          $this->db->select('libro.id as Lid, libro.nro_nota, libro.fecha, libro.origen_id, libro.destino, libro.concepto, libro.nroexpete, libro.nroresol, libro.observaciones, libro.pdf, libro.convenio, libro.activo');
          //$this->db->select('*');
          $this->db->from('libro');
          $this->db->order_by ('libro.id',"desc");
          //solo trae un registro con id
          if($id != 0){
              $this->db->where('libro.id = '.$id);
          }
      		$query = $this->db->get();
        	return $query->row();
          //return $this->db->last_query(); //MUESTAS LA CONSULTA
      	}
        //trar tabla solo de un año especifico
        public function libroyear($year){
          $this->db->select('libro.id, libro.nro_nota, libro.fecha, origen.desc as origen, libro.destino, libro.concepto, libro.nroexpete, libro.nroresol, libro.observaciones, libro.pdf, libro.convenio, libro.activo');
          $this->db->from('libro');
          $this->db->where('fecha >=', $year.'-01-01');
          $this->db->where('fecha <=', $year.'-12-31');
          $this->db->join('origen', 'origen.id = libro.origen_id');
          $this->db->order_by ('libro.nro_nota',"desc");
      		$query = $this->db->get();
        	return $query->result();
      	}

        //alta
        public function new_libro($data){
          //$data = array('desc'=> $desc);
          return $this->db->insert('libro',$data);
        }

        //baja
        public function eliminar_libro($data){
          //$data = array('id'=>$id);
          $this->db->where('id',$data['id']);
          return $this->db->update('libro',$data);
        }

        //modificacin
        public function editar_libro($where, $data){
          //el $data['id'] lee el id del array y lo compara con el where
          $this->db->where('id', $where);
          return $this->db->update('libro', $data);

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

        //retorna el MAX nro_nota entre 2016-01-01 y 2016-12-31
        public function maximo_nro_nota($año){
          $this->db->select_max('nro_nota');
          //$this->db->where('fecha BETWEEN 2016-01-01 AND 2016-12-31');
          $this->db->where('fecha >=', $año.'-01-01');
          $this->db->where('fecha <=', $año.'-12-31');
          //$this->db->mysql_insert_id('id');
          $query = $this->db->get('libro');
          foreach ($query->result_array() as $row)
            {
               $variable = $row['nro_nota'];
            }
          return $variable+1;
        }


    }
?>
