'use strict';

var producteur = angular.module('producteur', []);

producteur.controller('ListProducteurController', ['$scope', 'Restangular',
function ($scope, Restangular) {
    var baseProducteurs = Restangular.all('producteurs');

    baseProducteurs.getList().then(function (producteurs) {
        $scope.producteurs = producteurs;
    });

    $scope.delete = function (producteur) {
        producteur.remove().then(function () {
            var idProducteur = $scope.producteurs.indexOf(producteur);
            $scope.producteurs.splice(idProducteur, 1);
        });
    };
}]);

producteur.controller('EditProducteurController', ['$scope', 'Restangular', '$state', '$stateParams', function ($scope, Restangular, $state, $stateParams) {

    Restangular.one('producteurs', $stateParams.id).get().then(function (producteur) {

        $scope.producteur = producteur;
        $scope.envoiProducteur = function () {
            $scope.producteur.contrats = undefined;
            $scope.producteur.amap = $scope.producteur.amap.id;
            $scope.producteur.put().then(function() {
                $state.go('producteurs.view', {
                    id: $scope.producteur.id
                });
            });
            
        };
    });

    var baseAmaps = Restangular.all('amaps');
    baseAmaps.getList().then(function (amaps) {
        $scope.amaps = amaps;
    });
}]);

producteur.controller('AddProducteurController', ['$scope', 'Restangular', '$state', function ($scope, Restangular, $state) {
    var baseProducteurs = Restangular.all('producteurs'),
        baseAmaps = Restangular.all('amaps');

    $scope.producteur = {};

    baseAmaps.getList().then(function (amaps) {
        $scope.amaps = amaps;
    });

    $scope.envoiProducteur = function () {
        $scope.producteur.amap = $scope.producteur.amap.id;
        baseProducteurs.post($scope.producteur).then(function (producteur) {
            $state.go('producteurs.view', {
                id: producteur.id
            });
        });
    };

}]);

producteur.controller('ViewProducteurController', ['$scope', 'Restangular', '$stateParams',
function($scope, Restangular, $stateParams) {
    $scope.isAdding = false;
    $scope.produits = undefined;

    Restangular.one('producteurs', $stateParams.id).get().then(function(producteur) {
        $scope.producteur = producteur;
    });

    /**
     * Affiche le formulaire d'ajout d'une offre produit
     */
    $scope.startAddOffer = function() {
        $scope.isAdding = true;

        if (!$scope.produits) {
            Restangular.all('produits').getList().then(function(produits) {
                $scope.produits = produits;
            });
        }
    };

    /**
     * Annule l'ajout d'une offre produit
     */
    $scope.cancelAddOffer = function() {
        $scope.isAdding = false;
    };

    /**
     * Ajoute la nouvelle offre sélectionnée
     */
    $scope.sendAddOffer = function() {
        var produit = $scope.selectedProduit;
    }

}]);