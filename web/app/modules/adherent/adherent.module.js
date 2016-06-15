'use strict';

var adherent = angular.module('adherent', []);

adherent.controller('ListAdherentController', ['$scope', 'Restangular', function($scope, Restangular) {
    var baseAdherents = Restangular.all('adherents');

    baseAdherents.getList().then(function(adherents) {
        $scope.adherents = adherents;
    });

    $scope.delete = function(adherent) {
        adherent.remove().then(function(){
            var idAdherent = $scope.adherents.indexOf(adherent);
            $scope.adherents.splice(idAdherent,1);
        });
    };
}]);

adherent.controller('EditAdherentController', ['$scope', 'Restangular', '$state', '$stateParams', function($scope, Restangular, $state, $stateParams) {
    Restangular.one('adherents', $stateParams.id).get().then(function(adherent){
        $scope.adherent = adherent;
        $scope.adherent.contrats = undefined;
    });

    $scope.envoiAdherent= function(){
        $scope.adherent.put().then(function(){
            $state.go('adherents.list');
        });
    };
}]);

adherent.controller('AddAdherentController', ['$scope', 'Restangular', '$state', function($scope, Restangular, $state) {
    var baseAdherents = Restangular.all('adherents');

    $scope.adherent = {};

    $scope.envoiAdherent= function(){
        baseAdherents.post($scope.adherent).then(function() {
            $state.go('adherents.list');
        });
    };
}]);