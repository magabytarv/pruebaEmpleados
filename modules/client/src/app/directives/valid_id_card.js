'use strict';

angular.module('Directives').directive('idCard', function(validator_utils) {

  return {
    restrict: 'A',
    require: 'ngModel',
    priority: 0,
    link: function(scope, element, attrs, input_model) {

      scope.$watch(attrs.ngModel, function(new_value, old_value) {
        if (new_value !== old_value) {
          refresh_validation();
          if($(element).val().length <= 10 ){              
              validate_id_card() 
          }else{          
               validate_ruc();
          } 
        }
      });

      function refresh_validation() {
          var is_valid = true;
          var error_key = 'invalid_legal_ruc';
          input_model.$setValidity(error_key, is_valid);
      }
      
      function validate_id_card() {
        var error_key = 'invalid_id_card';
        var is_valid = true;
        input_model.$setValidity(error_key, is_valid);
        if (attrs.isPassport == 'false') {
          var value = element.val();
          if (/\S/.test(value)) {
            is_valid = validator_utils.is_id_card(value);
            input_model.$setValidity(error_key, is_valid);
          }
        }
        if (!scope.$$phase) {
          scope.$digest();
        }
      }


      function validate_ruc() {
        var error_key = 'invalid_legal_ruc';
        //var error_key_cedula = 'invalid_id_card';
        var is_valid = true;

        input_model.$setValidity(error_key, is_valid);
        
       if(attrs.isPassport == 'false') {
          var value = element.val();

          if (/\S/.test(value)) {
            is_valid = validator_utils.is_legal_ruc(value);
            
            input_model.$setValidity(error_key, is_valid);
            //input_model.$setValidity(error_key_cedula, is_valid);            
          }
        }

        if(!scope.$$phase) {
          scope.$digest();
        }
      }
    }
  };
});
