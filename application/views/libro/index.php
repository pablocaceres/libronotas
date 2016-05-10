
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

<!-- fileinput -->
<script type="text/javascript">
$(document).ready(function() {
  $('#subirarchivo').fileinput({
        language: 'es',
        allowedFileExtensions : ['pdf'],
        showUpload: false,
          });
 });

//   $('#subirarchivo').fileinput('disable');
//   $(".btn-warning").on('click', function() {
//       if ($('#subirarchivo').attr('disabled')) {
//           $('#subirarchivo').fileinput('enable');
//           var banderafile="1";
//           console.log(banderafile);
//         } else {
//           $('#subirarchivo').fileinput('disable');
//           var banderafile="0";
//           console.log(banderafile);
//       }
//   });
//
// });

</script>

<!-- formulariomodal -->
<script type="text/javascript">
  function desplegar(){
    $("#formulariomodal").modal("show");//ABRO EL POPUP MyModal
  }

</script>


<!-- function datatable para mi tabla-->
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabla').DataTable({
        "order": [[0, "desc" ]],
         responsive: true
    });

    } );
</script>

<style>
  .desactivado{
    color: #777;
    background-color: #ffe6e6;
  }

  .activado{

  }
</style>
<!-- flashdata-->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row-fluid">
            <!--/span-->
            <div class="span12" id="content">

                <div class="row-fluid">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $titulo; ?></h1>
                    </div>
                    <div class="col-lg-12">


                        <!-- panel-default -->
                        <div class="panel panel-default">
                            <!-- panel-default -->
                            <div class="panel-heading">
                                <!-- <a href="javascript:desplegar();"><button class="btn btn-success">Nuevo Registro</button></a> -->
                                <button type="button" class="btn btn-success" onclick="desplegar()">Nuevo Registro</button>

                            </div>
                            <!-- panel-body -->
                            <div class="panel-body">
                              <?php if ($this->session->flashdata('inst_edit')) { ?>

                                  <div class="alert alert-<?php echo $this->session->flashdata('inst_edit_tipo');?> alert-dismissable">
                                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                                  <?php echo $this->session->flashdata('inst_edit');?>
                                  <strong> Nro de Nota <?php echo $this->session->flashdata('nronota');?> </strong>
                                  </div>
                              <?php } ?>

                                <!-- TABLA -->

                                <table id='tabla' class="table table-bordered table-hover table-condensed">
                                <thead>
                                 <tr>
                                    <th>Nro </th>
                                    <th>Fecha</th>
                                    <th>Origen</th>
                                    <th>Destino</th>
                                    <th >Concepto</th>
                                    <th>Nro de Expete.</th>
                                    <th>Nro Resol</th>
                                    <th>Observ</th>
                                    <th>PDF</th>
                                    <th>Convenio</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($libro as $k => $v)
                                    {?>
                                <tr class="<?php echo ($v->activo == 1)?'activado':'desactivado';?>">
                                  <td><?php echo $v->id;?></td>
                                  <td><?php echo date("d/m/Y",strtotime($v->fecha));?></td>
                                  <td><?php echo $v->origen;?></td>
                                  <td><?php echo $v->destino;?></td>
                                  <td><?php echo $v->concepto;?></td>
                                  <td><?php echo $v->nroexpete;?></td>
                                  <td><?php echo $v->nroresol;?></td>
                                  <td><?php echo $v->observaciones;?></td>
                                     <?php if ($v->pdf == ''){?>
                                      <td></td>
                                     <?php
                                     }else{?>
                                  <td><center><a href='../public/pdf/<?php echo $v->pdf;?>.pdf' target="_blank"><i class="fa fa-file-pdf-o"></a></center></td>
                                      <?php
                                      }
                                      ?>
                                  <td>
                                      <?php if ($v->convenio == 1) {
                                          echo "Si";
                                      }else{
                                          echo "No";
                                          }
                                      ?>
                                  </td>
                                  <td>
                                    <?php if($v->activo == 1){?>
                                      <a href=<?php echo site_url();?>/grado/editar_grado/<?php echo $v->id;?>>
                                      <button type="button" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="right" title="Editar"><i class="fa fa-list"></i>
                                      </button></a>


                                      <button type="button" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Eliminar!!" onclick="eliminar('<?php echo $v->id;?>','<?php echo $v->id;?>')"><i class="fa fa-times"></i>
                                      </button>
                                      <?php }else{echo 'Anulado';}?>
                                  </td>
                                </tr>
                                <?php
                                    }
                                ?>
                                </tbody>
                                </table>
                                <!-- FIN TABLA -->
                            </div>
                        </div>
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
        <h4 class="modal-title">ELIMINAR GRADO</h4>
      </div>
      <div class="modal-body">
        <p>Desea eliminar Este grado?</p>
        <h3 id="descripcion"></h3>

        <input type="hidden" id="elim" value="0">

      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" onclick="eliminar_reg('<?php echo site_url();?>/grado/eliminar_grado/')">Eliminar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>


</div>





<!-- Modal formulariomodal-->
  <div class="modal fade" id="formulariomodal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <!-- FORMULARIO -->
          <form class="form-horizontal"  action="http://localhost/codeigniter/prueba/index.php/libro/new_libro" method="post" accept-charset="utf-8" enctype="multipart/form-data" >
            <!-- Fecha -->
            <div class="form-group">
              <label class="control-label col-sm-2">Fecha:</label>
              <div class="col-sm-10">
                <input class="form-control" type="date" name="fecha" value="<?php echo date("Y-m-d")?>">
              </div>
            </div>
            <!-- Origen -->
            <div class="form-group">
              <label class="control-label col-sm-2">Origen</label>
              <div class="col-sm-10">
                <?php echo form_dropdown('origen', $origen);?>
              </div>
            </div>
            <!-- Destino -->
            <div class="form-group">
              <label class="control-label col-sm-2">Destino</label>
              <div class="col-sm-10">
                <input class="form-control" name="destino">
              </div>
            </div>

            <!-- nroexpete -->
            <div class="form-group">
              <label class="control-label col-sm-2">Nro Expte</label>
              <div class="col-sm-10">
                <input class="form-control" name="nroexpete">
              </div>
            </div>
            <!-- nroresol -->
            <div class="form-group">
              <label class="control-label col-sm-2">Nro Resol</label>
              <div class="col-sm-10">
                <input class="form-control" name="nroresol">
              </div>
            </div>
            <!-- Concepto -->
            <div class="form-group">
              <label class="control-label col-sm-2">Concepto</label>
              <div class="col-sm-10">
                <textarea class="form-control"  rows="3" name="concepto" title="Campo obrigtorio" required></textarea>
              </div>
            </div>
            <!-- observaciones -->
            <div class="form-group">
              <label class="control-label col-sm-2">Observ</label>
              <div class="col-sm-10">
                <input class="form-control" name="observaciones">
              </div>
            </div>
            <!-- convenio -->
            <div class="form-group">
              <label class="control-label col-sm-2">Convenio</label>
              <div class="col-sm-10">
                <input type="checkbox" class="checkbox-inline" value="1" name="convenio">

              </div>
            </div>
            <!-- pdf -->

          <div class="form-group">
              <label class="control-label col-sm-2">PDF</label>
              <div class="col-sm-10">
                <input id="subirarchivo" class="file" type="file" name="userfile">
              </div>
              <!-- <div class="col-sm-2">
                <button class="btn btn-warning" type="button">a/d</button>
              </div> -->
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Guardar</button>
          <?php echo form_close();?>
        </div>
      </div>

    </div>
  </div>

</div>
