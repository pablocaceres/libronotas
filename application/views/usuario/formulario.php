<div class="row-fluid">
    <div class="span3" id="sidebar">
        <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
            <li  ng-repeat="ml in menu_lateral">
                <a href="{{ml.menu_accion}}" >
                    <i class="icon-chevron-right"></i> 
                    {{ml.menu_titulo}}
                </a>
            </li>                
        </ul>
    </div>

    <!--/span-->
    <div class="span9" id="content">
                            
        <div class="row-fluid">
            <!-- block -->
            <div class="block">
                <div class="navbar navbar-inner block-header">
                    <div class="muted pull-left"><b><?php echo $titulo; ?></b></div>
                </div>           
                                          
                <div class="block-content collapse in">                    
                        <!-- FORMULARIO -->
                    <div class="span12">

                        <div class="control-group ">
                            <label for="inputError" class="control-label">Nombre y Apellido </label>
                            <div class="controls">
                              <input type="text" ng-model="nya" id="input" value="" required>
                              <span class="help-inline">{{error_nya}}</span>
                            </div>
                        </div>

                        <div class="control-group ">
                            <label for="inputError" class="control-label">Usuario</label>
                            <div class="controls">
                              <input type="text" ng-model="user" id="input" required>
                              <span class="help-inline">{{error_user}}</span>
                            </div>
                        </div>

                        <div class="control-group ">
                            <label for="inputError" class="control-label">E - Mail</label>
                            <div class="controls">
                              <input type="email" ng-model="email" id="input" required>
                              <span class="help-inline">{{error_email}}</span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="inputError" class="control-label">Tipo de Usuario</label>
                            <div class="controls">
                                <select ng-model="tpuser"
                                        ng-options="v.descripcion for v in tipuser track by v.ident">
                                    <option></option>
                                </select>
                                                               
                                <span class="help-inline">{{error_descripcion}}</span>
                            </div>
                        </div>
                        <input type="hidden" ng-model="hideid">
                        <button  ng-click="crearusr()" id="nuevo" class="btn btn-primary">{{btn}}</button>
                            <!-- FIN FORMULARIO -->                     
                    </div>
                </div>
        </div>
    </div>
</div>