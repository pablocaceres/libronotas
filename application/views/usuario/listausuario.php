<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
    <div class="span3" id="sidebar">        
        <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
            <li  ng-repeat="ml in menu_lateral">
                <a href="{{ml.menu_accion}}">
                    <i class="icon-chevron-right"></i> 
                    {{ml.menu_titulo}}
                </a>
            </li>

            <li ng-if="check_if_ml_desactivar_todos" style="cursor:pointer">
                <a><span data-toggle="modal" href="#desactivar_todos">
                    <i class="icon-chevron-right"></i> 
                    Activar / Desactivar Todos
                </span></a>
            </li>

            
                <li ng-if="check_if_ml" style="cursor:pointer"  ng-click="accion_menu(1)">
                    <a>
                        <i class="icon-chevron-right"></i> 
                         {{activar_desactivar}}
                    </a>
                </li>       
                <li ng-if="check_if_ml" style="cursor:pointer" >
                    <a><span data-toggle="modal" href="#restablecer_clave">
                        <i class="icon-chevron-right"></i> 
                         Restablecer la Clave                     
                    </span></a>
                </li>
            
                   
        </ul>
    </div>
            <!-- Modal de restablecer clave-->
            <div class="modal hide" id="restablecer_clave" style="display: none;" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Restablecer la clave del usuario</h3>
                </div>
                <div class="modal-body">
                    <p>
                        Se esta por reiniciar la clave del usuario. 
                        Volvera a  la original.
                        <small>(clave = usuario)</small>
                    </p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" data-dismiss="modal"  ng-click="accion_menu(2)">Restablecer</a>
                    <a href="#" class="btn" data-dismiss="modal">Cancelar</a>
                </div>
            </div>
            <!-- FIN RESTABLECER CLAVE-->

            <!-- Modal de desactivar todos-->
            <div class="modal hide" id="desactivar_todos" style="display: none;" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Desactivar a Todos los Usuarios!</h3>
                </div>
                <div class="modal-body">
                    <p>
                       Esta seguro de queres Activar o Desactivar a todos los usuarios?...
                    </p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" data-dismiss="modal"  ng-click="accion_menu(3)">Activar / Desactivar Usuarios</a>
                    <a href="#" class="btn" data-dismiss="modal">Cancelar</a>
                </div>
            </div>
            <!-- FIN desactivar todos-->
            
    <!--/span-->
    <div class="span9" id="content">
                    
        <div class="row-fluid">
            <!-- block -->
            <div class="block">
                <div class="navbar navbar-inner block-header">
                    <div class="muted pull-left"><b><?php echo $titulo; ?></b></div>
                    <div class="muted pull-right">
                        <input type="text" ng-model="buscador" placeholder="Buscador">
                    </div>
                </div>
                                      
                <div class="block-content collapse in">
                    
                    <!-- TABLA -->
                    <div class="span12">
                        
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" ng-model="todos_activar" ng-click="todos(checked=!checked)"></th>
                                    <th>ID</th>
                                    <th>Nombre y Apellido</th>                                    
                                    <th>E-Mail</th>
                                    <th>Usuario</th>
                                    <th>Tipo Usuario</th>
                                    <th>Activo</th>
                                    <th>Creado</th>
                                    <th>Ultima Conexion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="u in usuarios | orderBy:'a':true | filter:buscador" 
                                    ng-class="(u.a == 1) ? 'activado' : 'desactivado'">
                                    <td><input type="checkbox"  ng-click="usuario(u.i)" ng-checked="todos_activar"></td>
                                    <td>{{u.i}}</td>
                                    <td>{{u.n}}</td>                                    
                                    <td>{{u.e}}</td>
                                    <td>{{u.un}}</td>
                                    <td>{{u.tpu}}</td>
                                    <td>{{(u.a == 1)?'Activado':'Desactivado'}}</td>
                                    <td>{{u.co}}</td>
                                    <td>{{u.ult_acc}}</td>
                                </tr>                                        
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
</div>
</div>
