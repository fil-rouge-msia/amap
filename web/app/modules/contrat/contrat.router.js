'use strict';

produit.config(['$stateProvider', function ($stateProvider) {
    $stateProvider.state('contrats',
        {
            url: '/contrats',
            templateUrl: 'app/modules/contrat/partials/contrats.html'
        })
        .state('contrats.list',
            {
                url: '/',
                templateUrl: 'app/modules/contrat/partials/list-contrats.html',
                controller: 'ListContratController'
            })

        .state('contrats.add_contrat',
            {
                url: '/add',
                templateUrl: 'app/modules/contrat/partials/add-contrat.html',
                controller: 'AddContratController'
            })

        .state('contrats.edit',
            {
                url: '/edit/:id',
                templateUrl: 'app/modules/contrat/partials/edit-contrat.html',
                controller: 'EditContratController'
            })
}]);