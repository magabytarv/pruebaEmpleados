(function() {
  'use strict';

  angular
    .module('clientApp')
    .config(routeConfig);

  /** @ngInject */
  function routeConfig($stateProvider, $urlRouterProvider) {
    $stateProvider
      .state('error', {
        url: '/error',
        templateUrl: 'app/main/main.html',
        controller: 'MainController',
      });
  }

})();
