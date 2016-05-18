'use strict';

auth.config(['$stateProvider', function($stateProvider) {
	$stateProvider.state('login',
	{
		url: '/login',
    	templateUrl: 'app/modules/auth/partials/login.html',
    	controller: 'LoginController',
    	data: {
    		anonymous: true
    	}
	})
	.state('logout', 
	{
		url: '/logout',
		controller: 'LogoutController'
	})
}]);