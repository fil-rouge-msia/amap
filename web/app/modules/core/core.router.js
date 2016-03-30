'use strict';

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