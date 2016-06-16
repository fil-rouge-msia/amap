'use strict';

benevole.config(['$stateProvider', function ($stateProvider) {
    $stateProvider.state('benevoles',
        {
            url: '/benevoles',
            templateUrl: 'app/modules/benevole/partials/benevoles.html'
        })
        .state('benevoles.list',
            {
                url: '/',
                templateUrl: 'app/modules/benevole/partials/list-benevoles.html',
                controller: 'ListBenevoleController'
            })

        .state('benevoles.add_benevole',
            {
                url: '/add',
                templateUrl: 'app/modules/benevole/partials/add-benevole.html',
                controller: 'AddBenevoleController'
            })

        .state('benevoles.edit',
            {
                url: '/edit/:id',
                templateUrl: 'app/modules/benevole/partials/edit-benevole.html',
                controller: 'EditBenevoleController'
            })
}]);