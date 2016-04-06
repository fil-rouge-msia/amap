'use strict';

var login = angular.module('login', []);

login.config(['$stateProvider', function ($stateProvider) {
    $stateProvider.state('login',
        {
            url: '/login',
            templateUrl: 'app/modules/login/partials/login.html'
        })
    .state('login.list',
        {
            url: '/login',
            templateUrl: 'app/modules/login/partials/login.html',
            controller: 'LoginController'
        });
}]);

login.controller('LoginController', ['$scope', 'Restangular', function ($scope, Restangular) {
}]);