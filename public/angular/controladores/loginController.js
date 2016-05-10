
function loginController($scope,$http){

	$scope.log = function(){
		$scope.msjerrorusr = '';
		$scope.msjerrorpass = '';

		var bandera = 1;

		if(angular.isUndefined($scope.usr) || $scope.usr === null){
			$scope.msjerrorusr = 'Coloque el Usuario!';
			bandera = 0;
		}
		if(angular.isUndefined($scope.pass) || $scope.pass === null){
			$scope.msjerrorpass = 'Coloque el Password!';
			bandera = 0;
		}

		//Si son distintos de vacio tanto el usuario como la password, entonces que compruebe si existe
		if(bandera == 1){
			$scope.url = 'index.php/login/log';
			$http.post($scope.url,{usr:$scope.usr, pass:$scope.pass}).
			success(function(data) {
				switch (data) {
				    case '0':
				       $.jGrowl('Verifique sus datos!', { header: 'Error!!!' });
				       break
				    case '1':
				       $(location).attr('href','index.php/libro');
				       break
				    case '2':
				    	$.jGrowl('Esta cuenta esta bloqueada, comuniquese con el administrador', { header: 'Error!!!' });
				       break
				    case '3':
				    	$(location).attr('href','index.php/login/cambio_clave');
				       break
				   }

			}).error(function(data, status){
				console.log('Error');
			});
		}
	}

	$scope.clave_cambiobtn = function(){
		bandera = 1;
		if(angular.isUndefined($scope.clave_cambio) || $scope.clave_cambio === null){
			$scope.msjerrorclavecambio = 'Coloque La Clave Nueva!';
			bandera = 0;
		}

		if(bandera == 1){
			$scope.url = 'nuevaclave';
			$http.post($scope.url,{clave:$scope.clave_cambio}).
			success(function(data) {
				switch (data) {
				    case '0':
				       $.jGrowl('Debe Colocar Una Clave Nueva!', { header: 'Error!!!' });
				       break
				    case '2':
				       $.jGrowl('No Se Pudo Crear La Nueva Clave!', { header: 'Error!!!' });
				       break
				    default:
				    	$(location).attr('href',data);//Redirecciono al login
				    	break;
				   }
			});
		}
	}
}
