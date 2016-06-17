'use strict';

stock.config(['$stateProvider', function ($stateProvider) {
    $stateProvider.state('stocks',
        {
            url: '/stocks',
            templateUrl: 'app/modules/stock/partials/stocks.html'
        })
        .state('stocks.list',
            {
                url: '/',
                templateUrl: 'app/modules/stock/partials/list-stocks.html',
                controller: 'ListStockController'
            })

        .state('stocks.add_stockProducteur',
            {
                url: '/add',
                templateUrl: 'app/modules/stock/partials/add-stockProducteur.html',
                controller: 'AddStockController'
            })

        .state('stocks.add_stockAmap',
            {
                url: '/add',
                templateUrl: 'app/modules/stock/partials/add-stockAmap.html',
                controller: 'AddStockController'
            })
        .state('stocks.edit',
            {
                url: '/edit/:id',
                templateUrl: 'app/modules/stock/partials/edit-stock.html',
                controller: 'EditStockController'
            })
}]);