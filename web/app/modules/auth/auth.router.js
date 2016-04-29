'use strict';

auth.config(['$stateProvider', function($stateProvider) {
	$stateProvider.state('login',
	{
		url: '/login',
    	templateUrl: 'app/modules/auth/partials/login.html'
	})
}]);