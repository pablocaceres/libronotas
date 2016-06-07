


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
                                    <th>Concepto</th>
                                    <th>Observ</th>
                                    <th>Convenio</th>
                                    <th>N° Expete.</th>
                                    <th>N° Resol.</th>
                                    <th>PDF</th>
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

                                  <td><?php echo $v->observaciones;?></td>

                                  <td>
                                      <?php if ($v->convenio == 1) {
                                          echo "Si";
                                      }else{
                                          echo "No";
                                          }
                                      ?>
                                  </td>
                                  <td><?php echo $v->nroexpete;?></td>
                                  <td><?php echo $v->nroresol;?></td>
                                  <?php if ($v->pdf == ''){?>
                                   <td></td>
                                  <?php
                                  }else{?>
                               <td><center><a href='../../public/pdf/<?php echo $v->pdf;?>.pdf' target="_blank"><i class="fa fa-file-pdf-o"></a></center></td>
                                   <?php
                                   }
                                   ?>
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
