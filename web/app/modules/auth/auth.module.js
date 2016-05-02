'use strict';

var auth = angular.module('auth', []);

auth.controller('LoginController', ['$scope', '$auth', function($scope, $auth) {
	$scope.handleLogin = function() {
		$auth.submitLogin($scope.auth)
		.then(function(resp) {
		})
		.catch(function(resp) {
			console.log(resp);
		});
	}
}]);