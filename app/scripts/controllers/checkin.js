'use strict';

angular.module('kioskApp')
  .controller('checkinCtrl', function ($scope) {
  	  $scope.test = 'meow';


  	  $scope.testcase = function(i) { 
  	   	  if (i == 'grant_test') { 
			return true; 
		  }

		  return false;
  	   };
});
