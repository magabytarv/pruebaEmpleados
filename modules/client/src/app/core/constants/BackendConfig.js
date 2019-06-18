/**
 * Frontend application backend constant definitions. This is something that you must define in your application.
 *
 * Note that 'BackendConfig.url' is configured in /frontend/config/config.json file and you _must_ change it to match
 * your backend API url.
 */
(function() {
  'use strict';

  angular.module('clientApp')
    .constant('BackendConfig', {
      url: 'http://localhost:3000/api/'
    })
  ;
}());
