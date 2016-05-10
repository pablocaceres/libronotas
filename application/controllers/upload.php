    <?php
    defined('BASEPATH') OR exit('No direct script access allowed');
     
    class Upload extends CI_Model {
            function __construct(){
                // Call the Model constructor
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                //Inicio la base de dato que va a usar este archivo!
                //$sgf = $this->load->database('db_sga', TRUE);
            }
     
            public function do_upload()
            {
                    $config['upload_path'] = './public/pdf/';
                    $config['allowed_types'] = 'pdf';
                   
                    $this->load->library('upload', $config);
                   
                    if ( ! $this->upload->do_upload()){
                            $error = $this->upload->display_errors();
                            echo $this->html();
                            if($message == ''){ //cierre de php ?>
                                    <script type="text/javascript" charset="utf-8">
                                            alert("Error al subir la imagen");
                                    </script> <?php
                            }else{            ?>
                                    <script type="text/javascript" charset="utf-8">
                                            alert("<?= $message ?>");
                                    </script> <?php
                            }
                            return null;
                    }
                    else{
                            
                            $file_data = $this->upload->data();
                            return $file_data['file_name'];
                    }
            }
     
            public function html($value='')
            {
                    return "
                    <html>
                    <head>
                            <title> Upload Error </title>
                    </head>
                    <body>
                   
                    </body>
                    </html>";
            }
     
    }
