r.controller('usuarioController', function($scope, $http, $location) {
	$scope.usuarios = [];
	
	//carga el menu_lateral_activar.
	menu_lateral_activar();


	function lista_usuarios(){
		$http.post('usuario/usuarios').success(function(data){
			$scope.usuarios = data;
		});
	}
	lista_usuarios();		

	
	$scope.usuarios_check = [];

	$scope.usuario = function (id) {
		var idx = $scope.usuarios_check.indexOf(id);
		if (idx > -1) {
			$scope.usuarios_check.splice(idx, 1);			
		}else{
			$scope.usuarios_check.push(id);			
		}
		//COLOCO EL MENU
		menu_lateral_activar($scope.usuarios_check.length);
	};

	$scope.todos = function(chek){		
		//CHEK me devuelve TRUE O FALSE
		if(chek){
			menu_lateral_activar(-1);			
			for(var i = 0; i < $scope.usuarios.length; i++){
				//ES LA FUNCION DE ARRIBA
				this.usuario($scope.usuarios[i].i);
			}
		}else{
			$scope.usuarios_check = [];		
			menu_lateral_activar(-1);
		}
		console.log($scope.usuarios_check);		
	}

	//retorna, si el usuario esta o no bloqueado
	function actDesact(id){
		return $scope.usuarios[$scope.usuarios.map(function(e) { return e.i; }).indexOf(id)];		
	}

	//Activa los menues laterales!
	function menu_lateral_activar(usuarios_checked){
		$scope.check_if_ml = false;
		$scope.check_if_ml_desactivar_todos = false;
		$scope.menu_lateral = [{menu_titulo:'Crear', menu_accion:'#/formulario'},
							   {menu_titulo:'Importar', menu_accion:'#/importador'}];
		
		switch(true) {
		    case (usuarios_checked == 1):
		    	id = $scope.usuarios_check[0];//ID del que esta check!;
		    	$scope.usr = actDesact(id);//Funcion trae todo el registro

		    	$scope.menu_lateral.push({menu_titulo:'Editar', menu_accion:'#/formulario/'+id});
		    	//if($scope.usr.i_tpu == 2){//Si es admin puede ver los modulos
					$scope.menu_lateral.push({menu_titulo:'Ver Sistemas', menu_accion:'modulos#/'+id+'/'+$scope.usr.i_tpu});
				//}
				
				$scope.check_if_ml = true;
				$scope.activar_desactivar = ($scope.usr.a == 0)?'Activar':'Desactivar';
		    	break;

		    case (usuarios_checked > 1):
		    	$scope.check_if_ml_desactivar_todos = true;
		        break;
		}		
	} 



	//MENU LATERAL FUNCIONES!!!
	$scope.accion_menu = function(accion){
		var id = $scope.usuarios_check[0];
		switch(accion){			
			case 1:
				active(id);
				break;
			case 2:
				restclav(id);
				break;
			case 3:
				eliminarTodos();
				break;
		}
	}

	//ABM
	//VER MODULOS DEL USUARIO
	function active(id){
	    $http({
	            method: 'POST', 
	            url: 'usuario/actDesact',
	            //codificamos el contenido
	            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	            data: { "id":id },
	        }).
	        success(function(data) {
	        	console.log(data)
	        	$scope.usr = actDesact(id);//Funcion
				$scope.acdac = ($scope.usr.a == 0)?'Activo':'Desactivo';
				$scope.activar_desactivar = ($scope.usr.a != 0)?'Activar':'Desactivar';//Para cambiar en el menu				
				$scope.usr.a = ($scope.usr.a == 1)? false:true;				
	            $.jGrowl('Se '+$scope.acdac+' Correctamente', { header: 'ACTIVACION / DESACTIVACION' });
	        })
	}	
	//ELIMINA el registro
	function restclav(id){		
		$http.post('usuario/restclav',{id:id}).success(function(data){
			$.jGrowl('Se Reinicio La Clave Correctamente', { header: 'Reinicio de Clave!' });
		});
	}
	//ELIMINA TODOS LOS REGISTROS
	function eliminarTodos(){		
		for (var i = 0; i < $scope.usuarios_check.length; i++) {
			active($scope.usuarios_check[i]);			
		};
	}
})


.controller('usuarioAMController', function($scope, $http, $routeParams, $location) {
	$scope.n = "";//nombre y apellido NYA
	$scope.un = ""; // usuario  USERNAME
	$scope.i = ""; // id ID
	$scope.e = ""; //email EMAIL
	$scope.a = ""; //activado ACTIVE (1/0)
	$scope.tpu = ""; //tipo de usuario IDTIPOUSR
	$scope.btn = 'Guardar';
	$scope.hideid = 0;

	
	$scope.menu_lateral = [{menu_titulo:'Volver a la Lista', menu_accion:'#/'}];
	$scope.tipuser=[];
	$http.post('usuario/tipuser').success(function(data){
		$scope.tipuser = data;
	});

	$scope.crearusr = function (){
		tpu = $scope.tpuser;
		tpu = tpu['ident'];
		id_usr = ($scope.hideid != 0)?$scope.hideid : 0;

		$http({
		    method: 'POST', 
		    url: 'usuario/crearusr',
		    //codificamos el contenido
		    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		    data: {nya:$scope.nya,email:$scope.email,user:$scope.user,tpuser:tpu,id_usr:id_usr},
		}).
		success(function(data) {			
		    $.jGrowl('Se Guardo Correctamente El Usuario!!!', { header: '' });
		    if(id_usr != 0){
		    	 $location.url("/");
		    }

		}).
		error(function() {
		    $.jGrowl('No se pudo guardar correctamente...', { header: 'Error!!!' });
		});
	}

	//////////EDITAR

	$scope.params = $routeParams;
	//Para Editar!!!!! TRAIGO EL FORMULARIO CARGADO! 
	if($scope.params.id){		
		$scope.usrs = [];
		$http.post('usuario/usuarios/'+$scope.params.id).success(function(data){
			$scope.nya = data[0].n;	//nombre y apellido NAME		
			$scope.user = data[0].un; // usuario  USERNAME			
			$scope.email = data[0].e; //email EMAIL	
			//Obtiene el INDEXOF del array
			$scope.tpuserIndexOf = $scope.tipuser.map(function(e) { return e.ident; }).indexOf(data[0].tpusr);
			$scope.tpuser = $scope.tipuser[$scope.tpuserIndexOf]; //tipo de usuario IDTIPOUSR
			$scope.hideid = data[0].i;
			$scope.btn = 'Modificar';			
		});		
	}
});

r.controller('importadorController',function($scope, $http, $upload, $routeParams, $location){
	$scope.onFileSelect = function($files) {
	    //$files: an array of files selected, each file has name, size, and type.
	    for (var i = 0; i < $files.length; i++) {
	    	var file = $files[i];	    
	    	$scope.upload = $upload.upload({
		    	url: 'usuario/import', 
		        data: {arc: $scope.myModelObj},
		        file: file,
		    }).success(function(data, status, headers, config) {
		        console.log(data);
		    });
		}		    
	}

});