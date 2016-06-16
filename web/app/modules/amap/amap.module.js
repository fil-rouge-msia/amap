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

amap.controller('EditAmapController', ['$scope', 'Restangular', '$stateParams', '$state', function($scope, Restangular, $stateParams, $state) {
        Restangular.one('amaps', $stateParams.id).get().then(function(amap){
            $scope.amap = amap;
            $scope.amap.producteurs = undefined;
        });

        $scope.envoiAmap= function(){
            $scope.amap.put().then(function(){
                $state.go('amaps.list');
            });
        };
}]);

amap.controller('AddAmapController', ['$scope', 'Restangular', '$state', function($scope, Restangular, $state) {
        var baseAmap = Restangular.all('amaps');
        $scope.envoiAmap = {};

        $scope.envoiAmap= function(){
            baseAmap.post($scope.amap).then(function() {
                $state.go('amaps.list');
            });

        };
}]);