'use strict';

var produit = angular.module('produit', []);

produit.controller('ListProduitController', ['$scope', 'Restangular', function($scope, Restangular) {
	var baseProduits = Restangular.all('produits');

	baseProduits.getList().then(function(produits) {
		$scope.produits = produits;
	});
}]);