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

    Restangular.all('produits').getList().then(function(produits) {
        $scope.produits = produits;
    });

    $scope.envoiProducteur = function () {
        $scope.producteur.amap = $scope.producteur.amap.id;

        if ($scope.producteur.produits) {
            $scope.producteur.produits = $scope.producteur.produits.map(function(el) {
                return el.id;
            });
        }

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
    $scope.allProduits = undefined;
    $scope.filteredProduits = undefined;

    $scope.data = {
        selectedProduit : null
    };

    Restangular.one('producteurs', $stateParams.id).get().then(function(producteur) {
        $scope.producteur = producteur;
    });

    /**
     * Affiche le formulaire d'ajout d'une offre produit
     */
    $scope.startAddOffer = function() {
        $scope.isAdding = true;

        if (!$scope.allProduits) {
            Restangular.all('produits').getList().then(function(produits) {
                $scope.allProduits = produits;
                filterProduits();
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
        var produit = $scope.data.selectedProduit;

        Restangular
            .one('producteurs', $scope.producteur.id)
            .one('produits', produit.id)
            .post(null, produit)
            .then(function(producteur) {
                $scope.producteur.produits.push(produit);
                filterProduits();
                $scope.isAdding = false;
            });
    };

    /**
     * Supprime une offre produit
     * @param {Object} produit Produit à supprimer de la liste
     */
    $scope.deleteProduit = function(produit) {
        Restangular
            .one('producteurs', $scope.producteur.id)
            .one('produits', produit.id)
            .remove()
            .then(function(producteur) {
                $scope.producteur.produits = $scope.producteur.produits.filter(function(el) {
                    return el.id !== produit.id;
                });
                filterProduits();
            });
    };

    var filterProduits = function() {
        if ($scope.allProduits) {
            var ids = $scope.producteur.produits.map(function(el) {
                return el.id;
            });

            $scope.filteredProduits = $scope.allProduits.filter(function(el) {
                return ids.indexOf(el.id) === -1;
            });
        }
    }

}]);