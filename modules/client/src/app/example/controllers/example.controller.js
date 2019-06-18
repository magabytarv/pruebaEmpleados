(function() {

    "use strict";

    angular.module("Example").controller("example.controller", function($scope, $http, _, $route, $location, example_model) {

        })
        .config(function($routeProvider) {
            $routeProvider
                .when("/", {
                    templateUrl: globalApp.base_url + "../client/src/app/example/views/example.html",
                    controller: "example.controller"
                });
        });
})();

