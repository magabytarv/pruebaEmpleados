(function () {
  'use strict';

  angular.module('Notifier').factory('success_formater', function($sanitize, _) {
  
    var service =  {
      format: function(success) {
        
        if(success.custom_message) {
          return success.custom_message;
        }
        
        var action = success.action;
        var element = success.element;
        
        return $sanitize(_(element) + ' ' + success.identifier + ' ' + action + '.');
      }
    };
    
    return service;
  });
})();