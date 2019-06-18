'use strict';angular.module('Directives').directive('isRequired', function() {
  return {    
  	restrict: 'A',    
  	require: 'ngModel',    
  	link: function(scope, element, attrs, input_model) {      
  		scope.$watch('$parent.' + attrs.isRequired, function() {        
  			is_required();      
  		});

  		scope.$watch(attrs.ngModel, function(new_value, old_value) {        
  			if(new_value !== old_value){          
  				is_required();        
  			}      
  		});      

  		function is_required() {        
  			var error_key = 'required';        
  			var is_valid = true;        
  			input_model.$setValidity(error_key, is_valid);                
  			if(scope.$eval('$parent.' + attrs.isRequired)) {          
  				var value = element.val();          
  				is_valid = Boolean(value);          
  				input_model.$setValidity(error_key, is_valid);        
  			}        

  			if(!scope.$$phase) {          
  				scope.$digest();        
  			}      
  		}    
  	}  
  };
});