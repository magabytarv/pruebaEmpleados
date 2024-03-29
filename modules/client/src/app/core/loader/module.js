angular.module('Loader', []).config(function($httpProvider) {
	$httpProvider.interceptors.push('loadingStatusInterceptor');
})
.directive('loadingStatusMessage', function() {
	return {
		link: function($scope, $element, attrs) {
			function show(){

				$element.css('display', 'block');
			}
			function hide() {
				if ($element.attr('once')){
					$element.removeAttr('once');
				}

				$element.css('display', 'none');
			}
			$scope.$on('loadingStatusActive', show);
			$scope.$on('loadingStatusInactive', hide);
			hide();
		}
	};
})
.factory('loadingStatusInterceptor', function($q, $rootScope) {
	var activeRequests = 0;
	var started = function() {
		if(activeRequests === 0) {
			$rootScope.$broadcast('loadingStatusActive');
		}
		activeRequests++;
	};
	var ended = function() {
		activeRequests--;
		if(activeRequests === 0) {
			$rootScope.$broadcast('loadingStatusInactive');
		}
	};
	return {
		request: function(config) {
			started();
			return config || $q.when(config);
		},
		response: function(response) {
			ended();
			return response || $q.when(response);
		},
		responseError: function(rejection) {
			ended();
			return $q.reject(rejection);
		}
	};
});
