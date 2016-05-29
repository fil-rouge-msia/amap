'use strict';

produit.config(['$stateProvider', function ($stateProvider) {
    $stateProvider.state('producteurs',
        {
            url: '/producteurs',
            templateUrl: 'app/modules/producteur/partials/producteurs.html'
        })
        .state('producteurs.list',
            {
                url: '/',
                templateUrl: 'app/modules/producteur/partials/list-producteurs.html',
                controller: 'ListProducteurController'
            })

        .state('producteurs.add_producteur',
            {
                url: '/add',
                templateUrl: 'app/modules/producteur/partials/add-producteur.html',
                controller: 'AddProducteurController'
            })

        .state('producteurs.edit',
            {
                url: '/edit/:id',
                templateUrl: 'app/modules/producteur/partials/edit-producteur.html',
                controller: 'EditProducteurController'
            })

        .state('producteurs.view',
            {
                url: '/:id',
                templateUrl: 'app/modules/producteur/partials/view-producteur.html',
                controller: 'ViewProducteurController'
            })
}]);