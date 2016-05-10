<div class="container-fluid">
	<div class="row-fluid">
    
    <!--/span-->
    <div class="span12" id="content">
                    
        <div class="row-fluid">
            <!-- block -->
            <div class="block">
                <div class="navbar navbar-inner block-header">
                    <div class="muted pull-left"><b><?php echo $titulo; ?></b></div>
                    <div class="muted pull-right">
                        
                    </div>
                </div>
                                      
                <div class="block-content collapse in">
                    
                    <!-- TABLA -->
                    <div class="span12">
                        
                     <?php
                        print_r($consulta_id);
                        echo form_open('referente/new_referente');
                        echo form_open();
				        echo form_label('Apellido', 'apellido');
				        echo form_input('Apellido');
                        echo form_label('Nombre', 'nombre');
                        echo form_input('Nombre');
                        echo form_label('email', 'email');
                        echo form_input('email');
                        echo form_label('tel_inst', 'tel_inst');
                        echo form_input('tel_inst');
                        echo form_label('tel_per', 'tel_per');
                        echo form_input('tel_per');
                        echo '<br>';
                        echo form_label('Grado', 'grado');
                        echo form_dropdown('grado', $grado);

                        echo form_label('Institucion', 'institucion');
                        echo form_dropdown('institucion', $institucion);     
				        echo '<br>';
				        echo form_submit(array('class'=>'btn btn-success'),'Guardar', 'Enviar');
				        echo form_close();                        
				    ?>	
                    </div>
                    <!-- FIN TABLA -->                     
                </div>
            </div>
        </div>
    </div>
</div>
 