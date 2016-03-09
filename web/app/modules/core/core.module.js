'use strict';

var core = angular.module('core', []);

core.config(['$stateProvider', function($stateProvider) {
	$stateProvider.state('home',
	{
		url: '/',
    	templateUrl: 'app/modules/core/partials/home.html'
	})
	.state('404',
	{
		url: '/404',
    	templateUrl: 'app/modules/core/partials/404.html'
	});
}]);

core.run(['$rootScope', '$state', function($rootScope, $state) {
	$rootScope.$on('$stateChangeError', function(event) {
		$state.go('404');
	});
}]);