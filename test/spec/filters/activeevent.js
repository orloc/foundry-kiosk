'use strict';

describe('Filter: activeEvents', function () {

  // load the filter's module
  beforeEach(module('kioskApp'));

  // initialize a new instance of the filter before each test
  var activeEvent;
  beforeEach(inject(function ($filter) {
    activeEvent = $filter('activeEvent');

  }));

  it('should return true', function () {
	var date = new Date('948797879');
    expect(activeEvent(date).toBe(true));
  });

});
