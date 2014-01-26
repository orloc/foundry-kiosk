'use strict';

angular.module('kioskApp')
  .filter('filterActive', function () {
    return function (input) {
      return (new Date(input) <= new Date()); 
    };
  });
