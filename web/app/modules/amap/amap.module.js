'use strict';

var amap = angular.module('amap', []);

amap.controller('ListController', ['$scope', 'Restangular', function($scope, Restangular) {
	var baseAmaps = Restangular.all('amaps');

	baseAmaps.getList().then(function(amaps) {
		$scope.amaps = amaps;
	});
}]);