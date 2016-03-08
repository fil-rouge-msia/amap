'use strict';

var core = angular.module('core', []);

core.config(['$routeProvider', function($routeProvider) {
	$routeProvider.when('/',
	{
    	templateUrl: 'app/modules/core/partials/home.html',
    	controller: 'HomeController'
	})
	.when('/404',
	{
    	templateUrl: 'app/modules/core/partials/404.html'
	})
	.otherwise('/404');
}]);

core.controller('HomeController', ['$scope', function($scope) {

}]);