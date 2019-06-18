(function () {
  'use strict';

  angular.module('Directives').directive('validateForm', ['$parse', function($parse) {
  
    return {
      require: 'form',
      link: function(scope, element, attrs, form) {
        
        form.$submitted = false;
        var fn = $parse(attrs.validateForm);
        
        element.on('submit', function(event) {
          
          scope.$apply(function() {
            
            form.$submitted = true;
            
            if (form.$valid) {
              fn(scope, { $event : event });
              form.$submitted = false;
              return;
            }
            
            var first_invalid_element = angular.element(element[0].querySelector('.ng-invalid'))[0];
            if (first_invalid_element) {
            
              var input = $('input[name="' + first_invalid_element.name + '"]');
              if (input){
                var tab_id = input.parents('.tab-pane').attr('id');
              }
              
              var select = $('select[name="' + first_invalid_element.name + '"]');
              if (select && tab_id == undefined){
                var tab_id = select.parents('.tab-pane').attr('id');
              }

              if (tab_id) {
                $('a[data-target="#'+tab_id+'"], a[href="#'+tab_id+'"]').tab('show');
              }
              
              first_invalid_element.focus();
              
              if (first_invalid_element.hasAttribute('datepicker')) {
                $(first_invalid_element).next().focus();
              }
              
              if (first_invalid_element.hasAttribute('chosen')) {
                $(first_invalid_element).trigger('chosen:open');
              }
            }
          });
        });
      }
    };
  }]);
})();