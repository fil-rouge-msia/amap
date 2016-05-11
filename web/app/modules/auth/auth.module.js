'use strict';

var auth = angular.module('auth', []);

auth.controller('LoginController', ['$scope', 'jwtHelper', '$http', '$state', 'authService', 
function($scope, jwtHelper, $http, $state, authService) {
	
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