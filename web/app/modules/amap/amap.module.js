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