(function() {'use strict';

	var app = angular.module('AmapApp', ['ui.router', 'restangular',
		'core', 'amap', 'login']); //Ajouter ici tous les modules

	//Mode HTML5
	app.config(['$locationProvider',
		function($locationProvider) {
			$locationProvider.html5Mode(true).hashPrefix('!');
		}
	]);

	app.config(['RestangularProvider', function(RestangularProvider) {
		RestangularProvider.setBaseUrl('/api');
	}]);
})();