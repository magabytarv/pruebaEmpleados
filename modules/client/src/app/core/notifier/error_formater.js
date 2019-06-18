(function() {
  'use strict';

  angular.module('Notifier').factory('error_formater', function($sanitize, _) {
  
    var service =  {
      format: function(error) {
        if(error.custom_message) {
          return error.custom_message;
        }
        
        var message = 'Error al';
        var action = error.action;
        var element = error.element;
        var problems = error.problems;
        
        return $sanitize(_(message) + ' ' + action + ' ' + element + ': '+ problems + '.');
      }
    };
    
    return service;
  });
})();