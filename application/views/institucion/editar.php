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

				        echo form_open('institucion/editar');
				        echo form_label('Descripcion', 'desc');
				        echo form_input('desc',$institucion[0]->desc);
                        echo form_hidden('id', $institucion[0]->id); //oculto
                        echo form_hidden('desc_viejo', $institucion[0]->desc); //oculto

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
 
 
</div>