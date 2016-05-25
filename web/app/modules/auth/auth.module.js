'use strict';

var auth = angular.module('auth', []);

auth.controller('LoginController', ['$scope', '$state', 'authService', 
function($scope, $state, authService) {
	
	/**
	 * Si vrai, affiche un message d'erreur indiquant
	 * que les identifiants sont incorrects
	 * @type {Boolean}
	 */
	$scope.badCred = false;

	/**
	 * Est-ce qu'une requête est en cours d'exécution ?
	 * @type {Boolean}
	 */
	$scope.isSaving = false;

	$scope.handleLogin = function() {
		$scope.isSaving = true;

		authService.login($scope.auth.username, $scope.auth.password)
			.then(
				function(data) {
					$scope.isSaving = false;
					$state.go('home');
				}, 
				function(error) {
					if (error.code === 401) {
						$scope.badCred = true;
					}
					$scope.isSaving = false;
				}
			);
	}

	$scope.dismissAlert = function() {
		$scope.badCred = false;
	}

}]);

auth.controller('LogoutController', ['$state', 'authService', 
function($state, authService) {
	authService.logout();
	$state.go('home');
}]);

auth.controller('LostPassController', ['$scope', '$state', 'Restangular', 'authService', '$http', 
function($scope, $state, Restangular, authService, $http) {

	/**
	 * Objet contenant les valeurs du 
	 * formulaire
	 * @type {Object}
	 */
	$scope.lostPass = {};

	/**
	 * Vrai si requête en cours
	 * @type {Boolean}
	 */
	$scope.isSaving = false;

	/**
	 * Envoie un mail permettant de réinitialiser
	 * le mot de passe
	 */
	$scope.sendResetPass = function() {
		$scope.isSaving = true;

		return $http({
			url: '/api/lost-pass',
			method: 'PUT',
			data: {
				email: $scope.lostPass.email
			}
	    }).then(function(response) {
	    	$scope.isSaving = false;
	    }, function(response) {
	    	console.log('error !');
	    	$scope.isSaving = false;
	    });
	}

}]);