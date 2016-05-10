<script type="text/javascript">
    function eliminar(id,desc){
        $("#elim").val(id); //HIDDEN PARA GUARDAR EL ID DEL REGISTRO
        $("#descripcion").html(desc);
        $("#myModal").modal("show");//ABRO EL POPUP MyModal      
    }
    function eliminar_reg(url){        
        window.location.href = url+$("#elim").val();
        //console.log(url+$("#elim").val());
    }
</script>

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
                            
                        <a href=<?php echo site_url();?>/institucion/formulario><button class="btn btn-success">Nuevo</button> </a>
                       
                                               
                    </div>
                </div>
                                      
                <div class="block-content collapse in">
                    
                    <!-- TABLA -->
                    <div class="span12">

                    <!-- esto es para el flashdata-->
                    <?php if ($this->session->flashdata('inst_edit')) { ?>

                        <div class="alert alert-<?php echo $this->session->flashdata('inst_edit_tipo');?> alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <?php echo $this->session->flashdata('inst_edit'); ?>
                        </div>
                    <?php } ?>
                        
                        <table class="table table-bordered">
                            <thead>
                                <tr>                                   
                                    <th width="15">ID</th>
                                    <th width="auto">Descripcion</th>
                                    <th width="150">Acciones</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                            	<?php 
                            		foreach ($institucion as $k => $v) {
                            	?>
                                <tr>
                                    <td><?php echo $v->id;?></td>
                                    <td><?php echo $v->desc;?></td>
                                    <td>
                                    	<a href=<?php echo site_url();?>/institucion/editar/<?php echo $v->id;?>><button class="btn">Editar</button></a>
                                    	<!-- <button class="btn btn-danger">Eliminar</button> -->
                                        <button type="button" class="btn btn-danger" onclick="eliminar('<?php echo $v->id;?>','<?php echo $v->desc;?>')">Eliminar</button>
                                    </td>                                    
                                </tr>
                                <?php
                            		}
                            	?>                                      
                            </tbody>
                        </table>
                    </div>
                    <!-- FIN TABLA -->                     
                </div>
            </div>
        </div>
    </div>
</div>
 
 
</div>  


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ELIMINAR INSTITUCION</h4>
      </div>
      <div class="modal-body">
        <p>Desea eliminar esta institución?</p>
        <h3 id="descripcion"></h3>
        
        <input type="hidden" id="elim" value="0">
        
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" onclick="eliminar_reg('<?php echo site_url();?>/institucion/eliminar/')">Eliminar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>