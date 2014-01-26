'use strict';

angular.module('kioskApp')
  .controller('checkinCtrl', function ($scope, $routeParams) {
  	  $scope.params = {
  	  	  group:$routeParams.group, 
  	  	  id:$routeParams.id
  	  };
});
