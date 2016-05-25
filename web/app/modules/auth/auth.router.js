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
	.state('lostPass',
	{
		url: '/lost-pass',
		templateUrl: 'app/modules/auth/partials/lost-pass.html',
		controller: 'LostPassController',
		data: {
    		anonymous: true
    	}
	})
	.state('lostPassSent',
	{
		url: '/lost-pass-sent/:email',
		templateUrl: 'app/modules/auth/partials/lost-pass-sent.html',
		controller: 'LostPassSentController',
		data: {
    		anonymous: true
    	}
	});
}]);