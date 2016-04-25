'use strict';

amap.config(['$stateProvider', function($stateProvider) {
	$stateProvider.state('amaps',
	{
		url: '/amaps',
    	templateUrl: 'app/modules/amap/partials/amaps.html'
	})
	.state('amaps.list',
	{
		url: '/',
    	templateUrl: 'app/modules/amap/partials/list-amaps.html',
    	controller: 'ListController'
	})
        .state('amaps.edit',
        {
            url: '/edit/:id',
            templateUrl: 'app/modules/amap/partials/formulaire.html',
            controller: 'EditAmapController'
        })
                .statte('amaps.add',
        {
            url: '/add',
            templateUrl: 'app/modules/amap/partials/addAmapForm.html',
            controller: 'AddAmapController'
        })
}]);