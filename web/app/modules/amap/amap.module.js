'use strict';

var amap = angular.module('amap', []);

amap.config(['$stateProvider', function($stateProvider) {
	$stateProvider.state('amaps',
	{
		url: '/amaps',
    	templateUrl: 'app/modules/amap/partials/amaps.html'
	})
	.state('amaps.list',
	{
		url: '/amaps',
    	templateUrl: 'app/modules/amap/partials/list-amaps.html',
    	controller: 'ListController'
	});
}]);

amap.controller('ListController', ['$scope', 'Restangular', function($scope, Restangular) {
	var baseAmaps = Restangular.all('amaps');

	baseAmaps.getList().then(function(amaps) {
		$scope.amaps = amaps;
	});
}]);