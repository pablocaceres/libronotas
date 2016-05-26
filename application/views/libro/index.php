<!-- Anular nota -->
<script type="text/javascript">
    function eliminar(id_nota,nro_nota,yearvar){
        $("#id_nota").val(id_nota); //HIDDEN PARA GUARDAR EL ID DEL REGISTRO
        $("#yearvar").val(yearvar);//guardo la fecha
        $("#nro_nota").html(nro_nota);
        $("#anular_nota").modal("show");//ABRO EL POPUP MyModal
    }
    function eliminar_reg(url){
        window.location.href = url+$("#id_nota").val()+"/"+$("#nro_nota").html()+"/"+$("#yearvar").val();
        //console.log(url+$("#id_nota").val()+"/"+$("#nro_nota").html()+"/"+$("#yearvar").val());
    }
</script>


<!-- habilitar subida de pdf para resoluciones -->
<script type="text/javascript">
$(document).ready(function() {
  document.getElementById('habilitarpdf').style.display='none';
});
function mostrarfile(id){
  var divelement = document.getElementById(id);
  if (divelement.style.display=='none'){
      divelement.style.display='block';
      document.getElementById('botonpdf').value="Ocultar";
    }else{
        divelement.style.display = 'none';
        document.getElementById('botonpdf').value="Habilitar";
      }

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
</script>

<!-- formulariomodal NUEVO LIBRO -->
<script type="text/javascript">
  function desplegar(){
    
    $("#formulariomodal").modal("show");//ABRO EL POPUP MyModal
  }

</script>


<!-- function datatable para mi tabla-->
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabla').DataTable({
        "lengthMenu": [[100, 25, 50, -1], [100, 25, 50, "All"]],
        "order": [[0, "desc" ]],
         responsive: true
    });

    } );
</script>

<style>
  .desactivado{
    color: #777;
    background-color: #F2F2F2;
  }

  .activado{

  }
</style>

<title><?php echo $titulo; ?></title>
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
                                <div>

                                  <button type="button" class="btn btn-success" onclick="desplegar()">Nuevo Registro </button>

                                  <div class="col-sm-10">

                                    <div class="dropdown">
                                       Filtro por año: <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $year ?> <span class="caret"></span></button>
                                       <ul class="dropdown-menu">
                                         <li><a href="<?php echo base_url('index.php/libro/libroyear/2016');?>">2016</a></li>
                                         <li><a href="<?php echo base_url('index.php/libro/libroyear/2015');?>">2015</a></li>
                                         <li><a href="<?php echo base_url('index.php/libro/libroyear/2014');?>">2014</a></li>
                                         <li><a href="<?php echo base_url('index.php/libro/libroyear/2013');?>">2013</a></li>
                                         <li><a href="<?php echo base_url('index.php/libro/libroyear/2012');?>">2012</a></li>
                                        </ul>
                                    </div>

                                  </div>
                                </div>

                            </div>

                            <!-- panel-body -->
                            <div class="panel-body">
                              <?php if ($this->session->flashdata('inst_edit')) { ?>

                                  <div class="alert alert-<?php echo $this->session->flashdata('inst_edit_tipo');?> alert-dismissable">
                                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                                  <?php echo $this->session->flashdata('inst_edit');?>
                                  <h3> <strong>Nro. de Nota <?php echo $this->session->flashdata('nronota').'/'.$year;?> </strong></h3>
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
                                    <!-- <th>PDF</th> -->
                                    <th>Convenio</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($libro as $k => $v)
                                    {?>
                                <tr class="<?php echo ($v->activo == 1)?'activado':'desactivado';?>">
                                  <td><?php echo $v->nro_nota;?></td>
                                  <td><?php echo date("d/m/Y",strtotime($v->fecha));?></td>
                                  <td><?php echo $v->origen;?></td>
                                  <td><?php echo $v->destino;?></td>
                                  <td><?php echo $v->concepto;?></td>
                                  <td><?php echo $v->nroexpete;?></td>
                                  <td><?php echo $v->nroresol;?></td>
                                  <td><?php echo $v->observaciones;?></td>
                                     <!-- <?php if ($v->pdf == ''){?> -->
                                      <!-- <td></td> -->
                                     <!-- <?php
                                     }else{?>
                                  <td><center><a href='../public/pdf/<?php echo $v->pdf;?>.pdf' target="_blank"><i class="fa fa-file-pdf-o"></a></center></td>
                                      <?php
                                      }
                                      ?>-->
                                  <td>
                                      <?php if ($v->convenio == 1) {
                                          echo "Si";
                                      }else{
                                          echo "No";
                                          }
                                      ?>
                                  </td>
                                  <td>
                                    <!-- si activo == 0 entonces muestra anulado y se borran los botones -->
                                    <?php if($v->activo == 1){?>
                                        <!-- <a href=<?php echo site_url();?>/grado/editar_grado/<?php echo $v->id;?>> -->
                                        <!-- Boton EDITAR -->
                                        <button type="button" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="right" title="Editar" onclick="edit_nota('<?php echo $v->id;?>')"><i class="fa fa-list"></i></button></a>

                                        <!-- Boton ANULAR -->
                                        <button type="button" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Anular nota" onclick="eliminar('<?php echo $v->id;?>','<?php echo $v->nro_nota;?>','<?php echo date("Y",strtotime($v->fecha));?>')"><i class="fa fa-times"></i></button>
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





<!-- Modal ANULAR LIBRO -->
<div id="anular_nota" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Anular Nota</h4>
      </div>
      <div class="modal-body">
        <p>Desea anular esta nota?:</p>
        <h3 id="nro_nota"></h3>
        <input type="hidden" id="id_nota" value="0">
        <input type="hidden" id="yearvar" value="0">
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" onclick="eliminar_reg('<?php echo site_url();?>/libro/eliminar_libro/')">Anular</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>


</div>





<!-- Modal formulariomodal NUEVO LIBRO-->
  <div class="modal fade" id="formulariomodal" role="dialog">

    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nuevo registro</h4>
        </div>
        <div class="modal-body">
          <!-- FORMULARIO -->
          <form class="form-horizontal"  action="<?php echo base_url('index.php/libro/new_libro')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" >
          <!-- <form class="form-horizontal"  action="http://localhost/codeigniter/prueba/index.php/libro/new_libro" method="post" accept-charset="utf-8"> -->
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
            <!-- <div class="form-group">
              <label class="control-label col-sm-2">Nro Expte</label>
              <div class="col-sm-10">
                <input class="form-control" name="nroexpete">
              </div>
            </div> -->
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
                <select name="convenio">
                    <option value="0">No</option>
                    <option value="1" >Si</option>
                </select>

              </div>
            </div>

            <!-- boton para habilitar suba de pdf solo a resolusiones -->
             <!-- <div id="resol" class="form-group">
              <label class="control-label col-sm-2">Resol</label>
              <div class="col-sm-10">
                <input type="button" class="btn btn-default" id="botonpdf" value="Habilitar" onClick="mostrarfile('habilitarpdf')">
              </div>
            </div> -->

            <!-- div habilitar pdf solo para resoluciones -->
            <!-- <div id="habilitarpdf" >
                <div class="form-group">
                  <label class="control-label col-sm-2">Nro Resol</label>
                  <div class="col-sm-10">
                    <input class="form-control" name="nroresol" >
                  </div>
                </div>
              <div class="form-group">
                  <label class="control-label col-sm-2">PDF Resol</label>
                  <div class="col-sm-10">
                    <input id="subirarchivo" class="file" type="file" name="userfile">
                  </div>
              </div>
          </div> -->

        <!-- cierro div del body -->
        </div>

        <!-- </div> -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Guardar</button>
          <?php echo form_close();?>
        </div>
      </div>

    </div>
  </div>

</div>



<!-- Modal editarlibro EDITAR LIBRO-->
  <div class="modal fade" id="editar_nota_modal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Editar registro</h4>
            </div>

            <div class="modal-body">
              <!-- FORMULARIO -->
              <form class="form-horizontal"  id="form" action="<?php echo base_url('index.php/libro/editar_libro')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" >
              <!-- <form class="form-horizontal"  action="http://localhost/codeigniter/prueba/index.php/libro/new_libro" method="post" accept-charset="utf-8"> -->
              <input type="HIDDEN" id="Liv">
              <!-- Muestro numero de nota -->
              <div class="form-group">
                <label class="control-label col-sm-2">Nro Nota:</label>
                <div class="col-sm-10">
                    <input name="nro_nota" class="form-control" disabled >
                </div>
              </div>
                <!-- Fecha -->
                <div class="form-group">
                  <label class="control-label col-sm-2">Fecha:</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="date" name="fecha">
                  </div>
                </div>
                <!-- Origen -->
                <div class="form-group">
                  <label class="control-label col-sm-2">Origen</label>
                  <div class="col-sm-10">
                    <select name="origen_id">
                        <option value="1">SGRI</option>
                        <option value="2" >SVTT</option>
                        <option value="3">DCI</option>
                    </select>
                  </div>

                </div>
                <!-- Destino -->
                <div class="form-group">
                  <label class="control-label col-sm-2">Destino</label>
                  <div class="col-sm-10">
                    <input class="form-control" id="destino" name="destino">
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
                  <label class="control-label col-sm-2">Observ.</label>
                  <div class="col-sm-10">
                      <input class="form-control" name="observaciones">
                  </div>
                </div>
                <!-- convenio -->
                <div class="form-group">
                  <label class="control-label col-sm-2">Convenio</label>
                  <div class="col-sm-10">
                    <select name="convenio">
                        <option value="0">No</option>
                        <option value="1" >Si</option>
                    </select>

                  </div>
                </div>

                <!-- salto de linea -->
                <HR>
                  <!-- nroexpete -->
                  <div class="form-group">
                    <label class="control-label col-sm-2">Nro Expte</label>
                    <div class="col-sm-10">
                      <input class="form-control" name="nroexpete">
                    </div>
                  </div>

                <!-- checkbox para habilitar suba de pdf solo a resolusiones -->
                 <div id="resol" class="form-group">
                  <label class="control-label col-sm-2">Resol</label>
                  <div class="col-sm-10">
                    <input type="button" class="btn btn-default" id="botonpdf" value="Habilitar" onClick="mostrarfile('habilitarpdf')">
                    <!-- <input type="checkbox" class="checkbox-inline" value="1" name="resol"> -->

                  </div>
                </div>

                <!-- div habilitar pdf solo para resoluciones -->
                <div id="habilitarpdf" >
                    <!-- nroresol -->
                    <div class="form-group">
                      <label class="control-label col-sm-2">Nro Resol</label>
                      <div class="col-sm-10">
                        <input class="form-control" name="nroresol" >
                      </div>
                    </div>
                  <!-- pdf -->
                  <div class="form-group">
                      <label class="control-label col-sm-2">PDF Resol</label>
                      <div class="col-sm-10">
                        <input id="subirarchivo" class="file" type="file" name="userfile">
                      </div>
                  </div>
              </div>
            <!-- cierro div del body -->
            </div>

            <!-- </div> -->
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-success">Guardar</button>
              <?php echo form_close();?>
            </div>
          </div>

        </div>
      </div>

    </div>

    <!-- Editar NOTA -->
    <script type="text/javascript">

    function edit_nota(id){
    //save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo base_url("index.php/libro/ajax_edit");?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            //data = JSON.parse(data)
            //console.log(data);
            $('[name="id"]').val(data.Liv);
            $('[name="nro_nota"]').val(data.nro_nota);
            $('[name="fecha"]').val(data.fecha);
            $('[name="origen_id"]').val(data.origen_id);
            $('[name="destino"]').val(data.destino);
            $('[name="concepto"]').val(data.concepto);
            $('[name="nroexpete"]').val(data.nroexpete);
            $('[name="nroresol"]').val(data.nroresol);
            $('[name="observaciones"]').val(data.observaciones);
            $('[name="convenio"]').val(data.convenio);
            // pdf ???  $('[name="nroexpete"]').val(data,data.nroexpete);
            $('#editar_nota_modal').modal('show'); // show bootstrap modal when complete loaded

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
</script>

<!-- <script type="text/javascript">

        function editar_js(id_nota){
              $.post('<?php echo base_url("index.php/libro/un_libro");?>',{"id":id_nota}).success(function(data){
              $("#id_nota_modal").val(id_nota); //HIDDEN PARA GUARDAR EL ID DEL REGISTRO
              $("#editar_nota_modal").modal("show");//ABRO EL POPUP MyModal de editar
              data = JSON.parse(data)
              console.log(data);
                $("#id_nota").val(data.Liv);
                $("#nro_nota_editar").val(data.nro_nota);
                $("#fecha").val(data.fecha);
                $("#destino").val(data.destino);
                $("#concepto").val(data.concepto);
                $("#convenio").val(data.convenio);
                $("#observaciones").val(data.observaciones);


            })

        }
        function editar_reg(url){
            //window.location.href = url+$("#id_nota").val()+"/"+$("#nro_nota").html()+"/"+$("#yearvar").val();
            //console.log(url+$("#id_nota").val()+"/"+$("#nro_nota").html()+"/"+$("#yearvar").val());
        }
    </script> -->
