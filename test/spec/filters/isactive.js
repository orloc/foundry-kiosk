'use strict';

describe('Filter: isActive', function () {

  // load the filter's module
  beforeEach(module('kioskApp'));

  // initialize a new instance of the filter before each test
  var isActive;
  beforeEach(inject(function ($filter) {
    isActive = $filter('isActive');
  }));

  it('should return the input prefixed with "isActive filter:"', function () {
    var text = 'angularjs';
    expect(isActive(text)).toBe('isActive filter: ' + text);
  });

});
