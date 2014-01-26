'use strict';

angular.module('kioskApp')
  .filter('isActive', function () {
    return function (input) {
    	var start = new Date(input.meta.start);
    	var end = new Date(input.meta.end);
    	var now = new Date();

		if (start.getFullYear() < now.getFullYear()) {  
			return false;
		}

		if (end.getTime() == 'NaN' || end.getTime() < now.getTime()){ 
			return false;
		}

    	if (start.getTime() <= now.getTime() && end.getTime() >= now.getTime()){
			return true;
		}

    	return false;
    };
  });
