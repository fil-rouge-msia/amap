'use strict';

var producteur = angular.module('producteur', []);

producteur.controller('ListProducteurController', ['$scope', 'Restangular', function ($scope, Restangular) {
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

produit.controller('EditProducteurController', ['$scope', 'Restangular', '$state', '$stateParams', function ($scope, Restangular, $state, $stateParams) {

    Restangular.one('producteurs', $stateParams.id).get().then(function (producteur) {

        $scope.producteur = producteur;
        $scope.envoiProducteur = function () {
            $scope.producteur.amap = $scope.producteur.amap.id;
            $scope.producteur.put();
            $state.go('producteurs.list');
        };
    });

    var baseAmaps = Restangular.all('amaps');
    baseAmaps.getList().then(function (amaps) {
        $scope.amaps = amaps;
    });
}]);

produit.controller('AddProducteurController', ['$scope', 'Restangular', '$state', function ($scope, Restangular, $state) {
    var baseProducteurs = Restangular.all('producteurs'),
        baseAmaps = Restangular.all('amaps');

    $scope.producteur = {};

    baseAmaps.getList().then(function (amaps) {
        $scope.amaps = amaps;
    });

    $scope.envoiProducteur = function () {
        $scope.producteur.amap = $scope.producteur.amap.id;
        baseProducteurs.post($scope.producteur).then(function () {
            $state.go('producteurs.list');
        });
    };

}]);
;