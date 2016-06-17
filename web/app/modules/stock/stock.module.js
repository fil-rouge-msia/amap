'use strict';

var stock = angular.module('stock', []);

stock.controller('ListStockController', ['$scope', 'Restangular', function ($scope, Restangular) {
    var baseStocks = Restangular.all('stocks');

    baseStocks.getList().then(function (stocks) {
        $scope.stocks = stocks;
    });

    $scope.delete = function (stock) {
        stock.remove().then(function () {
            var idStock = $scope.stocks.indexOf(stock);
            $scope.stocks.splice(idStock, 1);
        });
    };
}]);

stock.controller('EditStockController', ['$scope', 'Restangular', '$state', '$stateParams', function ($scope, Restangular, $state, $stateParams) {

    Restangular.one('stocks', $stateParams.id).get().then(function (stock) {

        $scope.stock = stock;
        $scope.envoiStock = function () {

            if ($scope.stock.amap == null) {
                $scope.stock.amap = undefined;
            }
            else {
                $scope.stock.amap = $scope.stock.amap.id;
            }

            if ($scope.stock.producteur == null) {
                $scope.stock.producteur = undefined;
            }
            else {
                $scope.stock.producteur = $scope.stock.producteur.id;
            }

            $scope.stock.produit = $scope.stock.produit.id;
            $scope.stock.put();
            $state.go('stocks.list');
        };

        $scope.envoiStockProducteur = function () {
            $scope.stock.amap = $scope.stock.amap.id;
            $scope.stock.produit = $scope.stock.produit.id;
            $scope.stock.producteur = undefined;
            $scope.stock.put();
            $state.go('stocks.list');
        };
    });

    var baseProduits = Restangular.all('produits');
    baseProduits.getList().then(function (produits) {
        $scope.produits = produits;
    });

    var baseProducteurs = Restangular.all('producteurs');
    baseProducteurs.getList().then(function (producteurs) {
        $scope.producteurs = producteurs;
    });

    var baseAmaps = Restangular.all('amaps');
    baseAmaps.getList().then(function (amaps) {
        $scope.amaps = amaps;
    });

}]);

stock.controller('AddStockController', ['$scope', 'Restangular', '$state', function ($scope, Restangular, $state) {
    var baseStocks = Restangular.all('stocks'),
        baseAmaps = Restangular.all('amaps'),
        baseProducteurs = Restangular.all('producteurs'),
        baseProduits = Restangular.all('produits');

    $scope.stock = {};

    baseAmaps.getList().then(function (amaps) {
        $scope.amaps = amaps;
    });

    baseProduits.getList().then(function (produits) {
        $scope.produits = produits;
    });

    baseProducteurs.getList().then(function (producteurs) {
        $scope.producteurs = producteurs;
    });

    $scope.envoiStockAmap = function () {
        $scope.stock.amap = $scope.stock.amap.id;
        $scope.stock.produit = $scope.stock.produit.id;
        $scope.stock.producteur = undefined;
        baseStocks.post($scope.stock).then(function () {
            $state.go('stocks.list');
        });
    };

    $scope.envoiStockProducteur = function () {
        $scope.stock.amap = undefined;
        $scope.stock.produit = $scope.stock.produit.id;
        $scope.stock.producteur = $scope.stock.producteur.id;
        baseStocks.post($scope.stock).then(function () {
            $state.go('stocks.list');
        });
    };

}]);
;