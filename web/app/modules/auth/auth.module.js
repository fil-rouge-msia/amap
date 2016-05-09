'use strict';

var auth = angular.module('auth', []);

auth.controller('LoginController', ['$scope', 'jwtHelper', '$http', 'store', '$state', 
function($scope, jwtHelper, $http, store, $state) {
	
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

		$http({
			url: '/api/login',
			method: 'POST',
			data: $scope.auth
	    }).then(function(response) {
			store.set('jwt', response.data.token);
			$scope.isSaving = false;
			//$state.go('home');
	    }, function(error) {
			if (error.data.code === 401) {
				$scope.badCred = true;
			}
			$scope.isSaving = false;
	    });
	}

	$scope.dismissAlert = function() {
		$scope.badCred = false;
	}

}]);