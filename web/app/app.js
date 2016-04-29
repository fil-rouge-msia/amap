(function() {'use strict';

	var app = angular.module('AmapApp', ['ui.router', 'restangular', 'ng-token-auth',
		'core', 'amap', 'login', 'produit']); //Ajouter ici tous les modules

	//Mode HTML5
	app.config(['$locationProvider',
		function($locationProvider) {
			$locationProvider.html5Mode(true).hashPrefix('!');
		}
	]);

	app.config(['RestangularProvider', function(RestangularProvider) {
		RestangularProvider.setBaseUrl('/api');

		RestangularProvider.setRequestInterceptor(function(elem, operation, what) {
			var retElem = elem;
			if (operation === 'post' || operation === 'put') {
				if (operation === 'put') {
					delete retElem.id; //retire l'identifiant de l'objet, déjà présent sur l'url
				}
		    	var wrapper = {};
		    	wrapper[what.substring(0, what.length -1)] = elem; 
		    	retElem = wrapper;
			}
			return retElem;
		});
	}]);
})();