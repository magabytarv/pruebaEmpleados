(function() {
  'use strict';

  angular.module('Notifier').controller('Notifier', function($scope, $rootScope, error_formater, success_formater, warning_formater, toastr) {
    $scope.handle_error = function(event, error) {
      $scope.error_message = error_formater.format(error);
      toastr.options.closeButton = true;
      toastr.options.timeOut = 0;
      toastr.error($scope.error_message, 'Alerta!');
    };

    $scope.handle_error2 = function(event, error) {
      $scope.error_message = error_formater.format(error);
      toastr.options.closeButton = true;
      toastr.options.timeOut = error.time;
      toastr.error($scope.error_message, 'Alerta!');
    };

    $scope.handle_success = function(event, success) {
      $scope.success_message = success_formater.format(success);
      toastr.options.timeOut = success.time;
      toastr.options.closeButton = false;
      toastr.success($scope.success_message, 'Éxito!');
    };

    $scope.handle_warning = function(event, warning) {
      $scope.warning_message = warning_formater.format(warning);
      toastr.options.timeOut = warning.time;
      toastr.options.closeButton = warning.closeButton;
      toastr.warning($scope.warning_message, 'Alerta!');
    };

    $rootScope.$on('error', $scope.handle_error);
    $rootScope.$on('error2', $scope.handle_error2);
    $rootScope.$on('success', $scope.handle_success);
    $rootScope.$on('warning', $scope.handle_warning);
  });
})();