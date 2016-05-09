'use strict';

amap.config(['$stateProvider', function($stateProvider) {
	$stateProvider.state('amaps',
	{
		url: '/amaps',
    	templateUrl: 'app/modules/amap/partials/amaps.html',
    	data: {
	    	requiresLogin: true
	    }
	})
	.state('amaps.list',
	{
		url: '/',
    	templateUrl: 'app/modules/amap/partials/list-amaps.html',
    	controller: 'ListController'
	})
}]);