(function() {
	'use strict';

	angular
		.module('clientApp', [
			'ngAnimate',
			'ngCookies',
			'ngTouch',
			'ngSanitize',
			'ngResource',
			'ui.router',
			'ui.bootstrap',
			'angularFileUpload',
			'ngRoute',
			'Core',
			'Directives',
			'Filters',
			'Utils'
		])
		.config(['uibDatepickerPopupConfig', function(uibDatepickerPopupConfig) {
			uibDatepickerPopupConfig.currentText = "Hoy";
			uibDatepickerPopupConfig.clearText = "Limpiar";
			uibDatepickerPopupConfig.closeText = "Cerrar";
		}]);
})();
