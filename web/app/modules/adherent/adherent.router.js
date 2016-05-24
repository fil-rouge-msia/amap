'use strict';

adherent.config(['$stateProvider', function ($stateProvider) {
    $stateProvider.state('adherents',
        {
            url: '/adherents',
            templateUrl: 'app/modules/adherent/partials/adherents.html'
        })
        .state('adherents.list',
            {
                url: '/',
                templateUrl: 'app/modules/adherent/partials/list-adherents.html',
                controller: 'ListAdherentController'
            })

        .state('adherents.add_adherent',
            {
                url: '/add',
                templateUrl: 'app/modules/adherent/partials/add-adherent.html',
                controller: 'AddAdherentController'
            })

        .state('adherents.edit',
            {
                url: '/edit/:id',
                templateUrl: 'app/modules/adherent/partials/edit-adherent.html',
                controller: 'EditAdherentController'
            })
}]);