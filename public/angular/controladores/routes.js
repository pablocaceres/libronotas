var r = angular.module('usuarios', ['ngRoute','angularFileUpload'])
	.config(function($routeProvider) {
		$routeProvider
			//RUTAS DE USUARIOS
			.when('/',{
				templateUrl: 'usuario/listausuario/',
				controller : "usuarioController"
			})
			.when('/formulario',{
				templateUrl: 'usuario/formulario/',
				controller : "usuarioAMController"
			})
			.when('/modulos/:id',{
				templateUrl: 'usuario/modulos/',
				controller: 'modulosController'
			})
			.when('/importador',{
				templateUrl: 'usuario/importador/',
				controller: 'importadorController'
			})
			.when('/formulario/:id',{
				templateUrl: 'usuario/formulario/',
				controller : "usuarioAMController",
			})
			//RUTAS DE SISTEMAS
			.when('/sistemas/:id_usr/:tp_usr',{
				templateUrl: 'sistemas/listasistemas',
				controller : "sistemasController",
			})
			.otherwise({
		        redirectTo: '/'
		    });
		
	});