'use strict';

var producteur = angular.module('producteur', []);

producteur.controller('ListProducteurController', ['$scope', 'Restangular', function($scope, Restangular) {
    var baseProducteurs = Restangular.all('producteurs');

    baseProducteurs.getList().then(function(producteurs) {
        $scope.producteurs = producteurs;
    });

    $scope.delete = function(producteur) {
        producteur.remove().then(function(){
            var idProducteur = $scope.producteurs.indexOf(producteur);
            $scope.producteurs.splice(idProducteur,1);
        });
    };
}]);

produit.controller('EditProducteurController', ['$scope', 'Restangular', '$state', '$stateParams', function($scope, Restangular, $state, $stateParams) {
    Restangular.one('producteurs', $stateParams.id).get().then(function(producteur){
        $scope.producteur = producteur;
    });

    $scope.envoiProducteur= function(){
        $scope.producteur.put();
        $state.go('producteurs.list');
    };
}]);

produit.controller('AddProducteurController', ['$scope', 'Restangular', '$state', function($scope, Restangular, $state) {
    var baseProducteurs = Restangular.all('producteurs');

    $scope.producteur = {};

    $scope.envoiProducteur= function(){
        baseProducteurs.post($scope.producteur).then(function() {
            $state.go('producteurs.list');
        });
    };
}]);