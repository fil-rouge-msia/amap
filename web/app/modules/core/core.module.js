'use strict';

var core = angular.module('core', []);

core.controller('CoreController', ['$scope', 'authService', 
function($scope, authService) {
	var updateAuth = function(){
    	$scope.isLoggedIn = authService.isLoggedIn();
    	$scope.currentUser = authService.currentUser();
  	};

  	//Appelle updateAuth() à chaque modification de l'état de 
  	//connexion
  	authService.registerObserverCallback(updateAuth);
  	updateAuth();
}]);

core.run(['$rootScope', '$state', function($rootScope, $state) {
	$rootScope.$on('$stateChangeError', function(event) {
		$state.go('404');
	});
}]);

core.directive('multiselectDropdown', [function() {
    return function(scope, element, attributes) {
        var element = $(element[0]);
        
        element.multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            onChange: function (optionElement, checked) {
                optionElement[0].removeAttribute('selected');
                if (checked) {
                    optionElement[0].setAttribute('selected', 'selected');
                }
                element.change();
                angular.element(element).triggerHandler('change');
            }
        });
        
        // Watch for any changes to the length of our select element
        scope.$watch(function () {
            return element[0].length;
        }, function () {
            element.multiselect('rebuild');
        });
        
        // Watch for any changes from outside the directive and refresh
        scope.$watch(attributes.ngModel, function () {
            element.multiselect('refresh');
        });

    }
}]);