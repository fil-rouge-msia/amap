'use strict';

var produit = angular.module('produit', []);

produit.controller('ListProduitController', ['$scope', 'Restangular', function($scope, Restangular) {
    var baseProduits = Restangular.all('produits');

    baseProduits.getList().then(function(produits) {
        $scope.produits = produits;
    });
}]);

produit.controller('EditProduitController', ['$scope', 'Restangular', '$stateParams', function($scope, Restangular, $stateParams) {
    Restangular.one('produits', $stateParams.id).get().then(function(produit){
        $scope.produit = produit;
    });

    $scope.envoiProduit= function(){
        $scope.produit.put();
    };
}]);

produit.controller('AddProduitController', ['$scope', 'Restangular', '$state', function($scope, Restangular, $state) {
    var baseProduits = Restangular.all('produits');

    $scope.produit = {};

    $scope.envoiProduit= function(){
        baseProduits.post($scope.produit).then(function() {
            $state.go('produits.list');
        });
    };
}]);