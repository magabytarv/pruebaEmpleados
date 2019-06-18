(function() {
    'use strict';

  angular.module('Underscore', []);
  angular.module('Underscore').value('_', window._.noConflict());

  angular.module('Underscore').run(function(_){
    _.mixin({
      capitalize : function(string) {
        return string.charAt(0).toUpperCase() + string.substring(1).toLowerCase();
      }
    });
  });
})();