'use strict';

angular.module('Notifier').factory('warning_formater', function(_) {

  var service =  {
    format: function(warning) {
      
      if(warning.custom_message) {
        return warning.custom_message;
      }
      
      var action = warning.action;
      var element = warning.element;
      var message = warning.message;
      
      return action + ' ' + element + '\n' + message + '.';
    },

    format_gritter: function(warning) {
      return {
        title: 'Alerta!',
        text: this.format(warning),
        class_name: 'gritter-warning gritter-light',
        image: globalApp.base_url + 'web/app/images/warning.png',
        sticky: true
      };
    }
  };
  
  return service;
});