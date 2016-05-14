'use strict';

var core = angular.module('core', []);

core.controller('CoreController', ['$scope', 'authService', 
function($scope, authService) {
	var updateAuth = function(){
    	$scope.isLoggedIn = authService.isLoggedIn();
    	$scope.currentUser = authService.currentUser();
  	};

  	//Appelle updateAuth() à chaque modification de l'état de 
  	//connexion
  	authService.registerObserverCallback(updateAuth);
  	updateAuth();
}]);

core.run(['$rootScope', '$state', function($rootScope, $state) {
	$rootScope.$on('$stateChangeError', function(event) {
		$state.go('404');
	});
}]);