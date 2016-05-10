<div class="container-fluid">
	<div class="row-fluid">

    <!--/span-->

    <div class="span12" id="content">

        <div class="row-fluid">
            <!-- block -->
            <div class="block">
                <div class="navbar navbar-inner block-header">
                    <div class="muted pull-left"><b><?php echo $titulo; ?></b>
                    </div>
                    <div class="muted pull-right">

                    </div>
                </div>

            <div class="block-content collapse in">

            <!-- TABLA -->
            <div class="span12">



            <!-- <?php echo form_open_multipart('libro/new_libro'); ?> -->
            <form class="form-horizontal"  action="http://localhost/codeigniter/libro/index.php/libro/new_libro" method="post" accept-charset="utf-8" enctype="multipart/form-data" >


            <!-- <?php echo form_label('Fecha', 'fecha');?> -->


            <label class="control-label">Feha</label>
            <input type="date" name="fecha" value="<?php echo date("Y-m-d")?>" >
            <br>
            <label class="control-label">Origen</label>
            <?php echo form_dropdown('origen', $origen);?>
            <br>
            Destino
            <?php echo form_input('destino');?><font color="red">*</font>
            <br>
            N° Expete
            <?php echo form_input('nroexpete');?>
            <br>
            N° Resol
            <?php echo form_input('nroresol');?>
            <br>
            Concepto
            <?php echo form_textarea('concepto');?><font color="red">*</font>
            <br>
            Observaciones
            <?php echo form_input('observaciones');?>
            <br>
            Convenio
            <?php echo form_checkbox('convenio','1');?>
            <br>
            <br>
            PDF
            <?php echo form_upload('userfile');?><font color="red">*</font>

            <br>
            <br>
            <br>

            <button type="submit" class="btn btn-success">Guardar</button>
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#cancelar">Cancelar</button>

            <?php echo form_close();?>
            <br>
            <br>
            <br>
            <font color="red"><?php echo validation_errors();?></font>
            <font color="red"><?php echo $error_archivo;?></font>
            </div>
                    <!-- FIN TABLA -->
                </div>
            </div>
        </div>
    </div>
</div>





 <!-- Modal cancelar-->
<div id="cancelar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Esta seguro que desea cancelar esta operación?</h4>
      </div>

      <div class="modal-footer">
        <?php echo anchor(base_url('index.php/libro'), 'Si', array('class'=>'btn btn-danger'));?>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>

  </div>
</div>
