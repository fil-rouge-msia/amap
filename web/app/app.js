(function() {'use strict';

	var app = angular.module('AmapApp', ['ngRoute', 'restangular',
		'core']);

	//Mode HTML5
	app.config(['$locationProvider',
		function($locationProvider) {
			$locationProvider.html5Mode(true).hashPrefix('!');
		}
	]);
})();