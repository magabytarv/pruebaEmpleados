#!/bin/bash

function create_controller_client()
{
    api_path="../client/src/app/"$modulo"/controllers"    
echo '(function() {

    "use strict";

    angular.module("'${modulo^}'").controller("'$modulo'.controller", function($scope, $http, _, $route, $location, '$modulo'_model) {

        })
        .config(function($routeProvider) {
            $routeProvider
                .when("/", {
                    templateUrl: globalApp.base_url + "../client/src/app/'$modulo'/views/'$modulo'.html",
                    controller: "'$modulo'.controller"
                });
        });
})();
'>$api_path/$modulo'.controller.js'
}
