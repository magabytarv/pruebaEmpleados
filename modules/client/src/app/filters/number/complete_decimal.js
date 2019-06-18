(function() {
  'use strict';

  angular.module('Number_filters').filter('complete_decimal', function() {
    
    function complete_decimal(num) {
      var new_number = num;
      
      if (has_dot(num)) {
        var number_of_decimal = get_number_of_decimal(num);
        
        if (number_of_decimal == 0) {
          new_number = new_number + '00';
        }
        else if (number_of_decimal == 1) {
          new_number = new_number + '0';
        }
      }
      else {
        new_number = new_number + '.00';
      }
      
      return new_number;
    }
    
    function has_dot(num) {
      return num.indexOf('.') !== -1;
    };
    
    function get_number_of_decimal(num) {
      var decimal = num.substring((dot_position(num) + 1), length_num(num));
      
      return num.length;
    }
    
    function length_num(num) {
      return num.length;
    }
        
    function dot_position(num) {
      return num.indexOf('.');
    };
    
    return function (num) {
      if (num !== null) {
        num = String(num);
        return complete_decimal(num);
      }
      return '0.00';
    };
  
  });
})();