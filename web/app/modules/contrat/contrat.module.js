'use strict';

var contrat = angular.module('contrat', []);

contrat.controller('ListContratController', ['$scope', 'Restangular', function ($scope, Restangular) {
    var baseContrats = Restangular.all('contrats');

    baseContrats.getList().then(function (contrats) {
        $scope.contrats = contrats;
    });

    $scope.delete = function (contrat) {
        contrat.remove().then(function () {
            var idContrat = $scope.contrats.indexOf(contrat);
            $scope.contrats.splice(idContrat, 1);
        });
    };
}]);

contrat.controller('EditContratController', ['$scope', 'Restangular', '$state', '$stateParams', function ($scope, Restangular, $state, $stateParams) {

    Restangular.one('contrats', $stateParams.id).get().then(function (contrat) {

        $scope.contrat = contrat;
        $scope.envoiContrat = function () {
            $scope.contrat.amap = $scope.contrat.amap.id;
            $scope.contrat.put();
            $state.go('contrats.list');
        };
    });

    var baseAmaps = Restangular.all('amaps');
    baseAmaps.getList().then(function (amaps) {
        $scope.amaps = amaps;
    });
}]);

contrat.controller('AddContratController', ['$scope', 'Restangular', '$state', function ($scope, Restangular, $state) {
    var baseContrats = Restangular.all('contrats'),
        baseAmaps = Restangular.all('amaps');

    $scope.contrat = {};

    baseAmaps.getList().then(function (amaps) {
        $scope.amaps = amaps;
    });

    $scope.envoiContrat = function () {
        $scope.contrat.amap = $scope.contrat.amap.id;
        baseContrats.post($scope.contrat).then(function () {
            $state.go('contrats.list');
        });
    };

}]);
;