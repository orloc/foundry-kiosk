'use strict';

angular.module('kioskApp', [
  'ngCookies',
  'ngResource',
  'ngSanitize',
  'ngRoute',
  'ui.router'
])
  .config(function ($routeProvider, $httpProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/checkin.html',
      })
      .when('/events', { 
	  	templateUrl: 'views/main.html',
	  })
      .otherwise({
        redirectTo: '/'
      });
  });
