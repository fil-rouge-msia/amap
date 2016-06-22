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
    var baseContrats = Restangular.all('contrats'),
        baseAmaps = Restangular.all('amaps'),
        baseAdherents = Restangular.all('adherents'),
        baseProducteurs = Restangular.all('producteurs');

        $scope.contrat = {};
    $scope.data = {
        option: "amap",
        models: {
            amap: null,
            producteur: null,
            adherent:null
        }
    };

    baseAmaps.getList().then(function (amaps) {
        $scope.data.models.amap = amaps;
    });

    baseAdherents.getList({benevole: false}).then(function (adherents) {
        $scope.data.models.adherent = adherents;
    });
    
    baseProducteurs.getList().then(function (producteurs) {
            $scope.data.models.producteur = producteurs;
    });



    $scope.envoiContrat= function(){
        $scope.contrat.amap = data.option;
        $scope.contrat.producteur = data.option;
        $scope.contrat.adherent = data.option;
               
        baseContrats.post($scope.contrat).then(function() {
            $state.go('contrats.list');
        });
    };
}]);