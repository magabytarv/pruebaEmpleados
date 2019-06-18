'use strict';

angular.module('Directives')
.directive('modal', function(_, $parse) {

  return function(scope, element, attrs) {
    element.attr('id', attrs.modal);
    element.addClass('modal fade');
    
    var submit_button = $(element).find('form');
    
    if (!_(attrs).has('hideOnSubmit')) {
      submit_button.on('submit', function() {
        $(element).modal('hide');
      });
    }
    else {
      submit_button.on('submit', function() {
        if(attrs.hideOnSubmit === 'true') {
          $(element).modal('hide');
        }
      });
      
      scope.$on('form_successfully_saved', function() {
        $(element).modal('hide');
      });
    }
    
    if (attrs.onClose) {
      $(element).on('hidden.bs.modal', function () {
        scope.$apply(function() { $parse(attrs.onClose)(scope); });
      });
    }
  };
});
