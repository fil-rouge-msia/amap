'use strict';

var produit = angular.module('produit', []);

produit.controller('ListProduitController', ['$scope', 'Restangular', function($scope, Restangular) {
    var baseProduits = Restangular.all('produits');

    baseProduits.getList().then(function(produits) {
        $scope.produits = produits;
    });

    $scope.delete = function(produit) {
        produit.remove().then(function(){
            var idProduit = $scope.produits.indexOf(produit);
            $scope.produits.splice(idProduit,1);
        });
    };
}]);

produit.controller('EditProduitController', ['$scope', 'Restangular', '$state', '$stateParams', function($scope, Restangular, $state, $stateParams) {
    Restangular.one('produits', $stateParams.id).get().then(function(produit){
        $scope.produit = produit;
    });

    $scope.envoiProduit= function(){
        $scope.produit.put();
        $state.go('produits.list');
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