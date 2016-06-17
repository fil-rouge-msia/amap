(function() {'use strict';

	var app = angular.module('AmapApp', ['ui.router', 'restangular', 'angular-jwt', 'angular-storage',
		'core', 'amap', 'produit', 'auth', 'adherent', 'producteur', 'benevole', 'stock']); //Ajouter ici tous les modules

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

	app.config(['jwtInterceptorProvider', '$httpProvider', function(jwtInterceptorProvider, $httpProvider) {
		jwtInterceptorProvider.tokenGetter = function(store) {
			return store.get('jwt');
		}
		$httpProvider.interceptors.push('jwtInterceptor');
	}]);

	app.run(['$rootScope', '$state', 'authService', function($rootScope, $state, authService) {
		//Lors du changement d'état, si ce dernier nécessite d'être connecté
		//on vérifie si l'utilisateur est connecté et si son token est toujours
		//valide
		$rootScope.$on('$stateChangeStart', function(e, to) {
	    	if (!to.data || !to.data.anonymous) {
	      		if (!authService.isLoggedIn()) {
	        		e.preventDefault();
	        		$state.go('login');
	      		}
	    	}
	  	});

	  	//Lors du lancement de l'application
	  	if (!authService.isLoggedIn()) {
    		$state.go('login');
  		}
	}]);
})();