'use strict';

var amap = angular.module('amap', []);

amap.controller('ListController', ['$scope', 'Restangular', function($scope, Restangular) {
	var baseAmaps = Restangular.all('amaps');

	baseAmaps.getList().then(function(amaps) {
		$scope.amaps = amaps;
	});

	$scope.delete = function(amap) {
		amap.remove().then(function(){
			var idAmap = $scope.amaps.indexOf(amap);
			$scope.amaps.splice(idAmap,1);
		});
	};



}]);