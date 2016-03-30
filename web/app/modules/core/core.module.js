'use strict';

var core = angular.module('core', []);



core.run(['$rootScope', '$state', function($rootScope, $state) {
	$rootScope.$on('$stateChangeError', function(event) {
		$state.go('404');
	});
}]);