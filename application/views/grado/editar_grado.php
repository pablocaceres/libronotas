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

				        echo form_open('grado/editar_grado');
				        echo form_label('Descripcion', 'desc');
				        echo form_input('desc',$grado[0]->desc);
                        echo form_hidden('id', $grado[0]->id); //oculto
                        echo form_hidden('desc_viejo', $grado[0]->desc); //oculto
				        echo '<br>';
                        ?>
                    <tr>
				        <td>
                            <?php echo form_submit(array('class'=>'btn btn-success'),'Guardar', 'Enviar');?>				            
                        </td>
                        <td>                            
                            <?php echo anchor(base_url('index.php/grado'), 'Volver a lista', array('class'=>'btn btn-defaul'));?>
                        </td>
                    </tr>
                        <?php echo form_close();
				    ?>	
                    </div>
                    <!-- FIN TABLA -->                     
                </div>
            </div>
        </div>
    </div>
</div>
 
 
</div>