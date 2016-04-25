'use strict';

var amap = angular.module('amap', []);

amap.controller('ListController', ['$scope', 'Restangular', function($scope, Restangular) {
	var baseAmaps = Restangular.all('amaps');

	baseAmaps.getList().then(function(amaps) {
		$scope.amaps = amaps;
	});
}]);

amap.controller('EditAmapController', ['$scope', 'Restangular', '$stateParams', function($scope, Restangular, $stateParams) {
        Restangular.one('amaps', $stateParams.id).get().then(function(amap){
            $scope.amap = amap;
        });
        
        $scope.envoiAmap= function(){
            $scope.amap.put();
        };
}]);

amap.controller('AddAmapController', ['$scope', 'Restangular', '$stateParams', function($scope, Restangular, $stateParams) {
        Restangular.one('amaps', $stateParams.id).get().then(function(amap){
            $scope.amap = amap;
        });
        
        $scope.envoiAmap= function(){
            $scope.amap.post();
        };
}]);