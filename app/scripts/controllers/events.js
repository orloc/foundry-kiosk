'use strict';

var app = angular.module('kioskApp');
  
app.controller('eventDataCtrl', function ($scope, $http) {
	$scope.events = null;

	$http.get('feeds/feeds.php').then(function(response){
		$scope.events = response.data;
	});
});
