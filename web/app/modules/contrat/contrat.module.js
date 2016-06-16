'use strict';

var contrat = angular.module('contrat', []);

contrat.controller('ListContratController', ['$scope', 'Restangular', function($scope, Restangular) {
    var baseContrats = Restangular.all('contrats');

    baseContrats.getList().then(function(contrats) {
        $scope.contrats = contrats;
    });

    $scope.delete = function(contrat) {
        contrat.remove().then(function(){
            var idContrat = $scope.contrats.indexOf(contrat);
            $scope.contrats.splice(idContrat,1);
        });
    };
}]);

contrat.controller('EditContratController', ['$scope', 'Restangular', '$state', '$stateParams', function($scope, Restangular, $state, $stateParams) {
    Restangular.one('contrats', $stateParams.id).get().then(function(contrat){
        $scope.contrat = contrat;
    });

    $scope.contrat.put().then(function(){
            $state.go('contrats.list');
    });
}]);

contrat.controller('AddContratController', ['$scope', 'Restangular', '$state', function($scope, Restangular, $state) {
    var baseContrats = Restangular.all('contrats');

    $scope.contrat = {};

    $scope.envoiContrat= function(){
        baseContrats.post($scope.contrat).then(function() {
            $state.go('contrats.list');
        });
    };
}]);