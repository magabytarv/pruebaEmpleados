(function() {

    "use strict";

    angular.module("Empleados").controller("empleados.controller", function($scope, $http, _, $route, $location, empleados_model, promesas) {
            $scope.empleados = [{
                    nombre: "diego",
                    codigo: "123",
                    estado: "Activo"
                },
                {
                    nombre: "gaby",
                    codigo: "122",
                    estado: "Activo"
                },
            ];

            var [empleados, provincias] = promesas;

            $scope.empleados = empleados;
            $scope.provincias = provincias;

            $scope.buscar = function() {
                var params = {
                    url_params: {
                        nombre_busqueda: $scope.nombre_buscar,
                        codigo_busqueda: $scope.codigo_buscar
                    }
                }
                empleados_model.get('obtener_empleados_filtro', params).then(function(datos) {
                    $scope.empleados = datos;
                });
            }

            $scope.guardar = function() {
                empleados_model.post('guardar_empleado').then(function() {
                    alert('ok');
                });
            }

            $scope.crear = function() {
                $location.path('/crear_empleados');
            }

            $scope.reporte = function() {
                $location.path('/reporte_empleados');
            }

            $scope.tabDatos = function(tab) {
                if (tab == 1) {
                    $scope.tabDatosPersonales = 'active';
                    $scope.tabDatosLaborales = '';
                } else {
                    $scope.tabDatosPersonales = '';
                    $scope.tabDatosLaborales = 'active';
                }
                return false;
            }

            $scope.continuar = function() {
                $scope.tabDatos(2);
            }
        })
        .config(function($routeProvider) {
            $routeProvider
                .when("/", {
                    templateUrl: globalApp.base_url + "../client/src/app/empleados/views/empleados.html",
                    controller: "empleados.controller",
                    resolve: {
                        promesas: function(empleados_model) {
                            var promesas = [
                                empleados_model.get('obtener_empleados'),
                                empleados_model.get('obtener_provincias')
                            ];
                            return Promise.all(promesas);
                        },
                    }
                })
                .when("/crear_empleados", {
                    templateUrl: globalApp.base_url + "../client/src/app/empleados/views/crear_empleados.html",
                    controller: "empleados.controller",
                    resolve: {
                        promesas: function(empleados_model) {
                            var promesas = [
                                empleados_model.get('obtener_empleados'),
                                empleados_model.get('obtener_provincias')
                            ];
                            return Promise.all(promesas);
                        },
                    }
                })
                .when("/reporte_empleados", {
                    templateUrl: globalApp.base_url + "../client/src/app/empleados/views/reporte_empleados.html",
                    controller: "empleados.controller",
                    resolve: {
                        promesas: function(empleados_model) {
                            var promesas = [
                                empleados_model.get('obtener_empleados'),
                                empleados_model.get('obtener_provincias')
                            ];
                            return Promise.all(promesas);
                        },
                    }
                });
        });
})();