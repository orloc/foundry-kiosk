'use strict';

angular.module('kioskApp', [
  'ngCookies',
  'ngResource',
  'ngSanitize',
  'wu.masonry',
  'ngRoute'
])
  .config(function ($routeProvider, $httpProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/checkin.html',
      })
      .when('/events', { 
	  	templateUrl: 'views/main.html',
	  })
	  .when('/events/checkin/:group/:id', {
	  	  templateUrl: 'views/checkin_detail.html'
	  })
      .otherwise({
        redirectTo: '/'
      });
  });
