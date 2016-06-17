'use strict';

var benevole = angular.module('benevole', []);

benevole.controller('ListBenevoleController', ['$scope', 'Restangular', function ($scope, Restangular) {
    var baseBenevoles = Restangular.all('benevoles');

    baseBenevoles.getList().then(function (benevoles) {
        $scope.benevoles = benevoles;
    });

    $scope.delete = function (benevole) {
        benevole.remove().then(function () {
            var idBenevole = $scope.benevoles.indexOf(benevole);
            $scope.benevoles.splice(idBenevole, 1);
        });
    };
}]);

benevole.controller('EditBenevoleController', ['$scope', 'Restangular', '$state', '$stateParams', function ($scope, Restangular, $state, $stateParams) {

    Restangular.one('benevoles', $stateParams.id).get().then(function (benevole) {

        $scope.benevole = benevole;
        $scope.envoiBenevole = function () {
            $scope.benevole.amap = $scope.benevole.amap.id;
            $scope.benevole.adherent = $scope.benevole.adherent.id;
            $scope.benevole.put();
            $state.go('benevoles.list');
        };
    });

    var baseAmaps = Restangular.all('amaps');
    baseAmaps.getList().then(function (amaps) {
        $scope.amaps = amaps;
    });


}]);

benevole.controller('AddBenevoleController', ['$scope', 'Restangular', '$state', function ($scope, Restangular, $state) {
    var baseBenevoles = Restangular.all('benevoles'),
        baseAmaps = Restangular.all('amaps'),
        baseAdherents = Restangular.all('adherents');

    $scope.benevole = {};

    baseAmaps.getList().then(function (amaps) {
        $scope.amaps = amaps;
    });

    baseAdherents.getList().then(function (adherents) {
        $scope.adherents = adherents;
    });

    $scope.envoiBenevole = function () {
        $scope.benevole.amap = $scope.benevole.amap.id;
        $scope.benevole.adherent = $scope.benevole.adherent.id;
        baseBenevoles.post($scope.benevole).then(function () {
            $state.go('benevoles.list');
        });
    };

}]);
;