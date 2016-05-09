'use strict';

produit.config(['$stateProvider', function ($stateProvider) {
    $stateProvider.state('produits',
        {
            url: '/produits',
            templateUrl: 'app/modules/produit/partials/produits.html',
            data: {
                requiresLogin: true
            }
        })
        .state('produits.list',
            {
                url: '/',
                templateUrl: 'app/modules/produit/partials/list-produits.html',
                controller: 'ListProduitController'
            })

        .state('produits.add_produit',
            {
                url: '/add',
                templateUrl: 'app/modules/produit/partials/add-produit.html',
                controller: 'AddProduitController'
            })

        .state('produits.edit',
            {
                url: '/edit/:id',
                templateUrl: 'app/modules/produit/partials/edit-produit.html',
                controller: 'EditProduitController'
            })
}]);