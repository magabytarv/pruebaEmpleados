(function() {

    "use strict";

    angular.module("Lista_precios_proveedores")
        .controller("historial_precios_proveedores.controller", function($scope, $http, _, $route, $location, lista_precios_proveedores_model, proveedores) {
            $scope.fecha_servidor = moment(globalApp.fecha_servidor).format('YYYY-MM-DD');
            var fecha_servidor = $scope.fecha_servidor.split('-');

            $scope.proveedores = proveedores;

            $scope.fecha_desde = {
                opened: false,
            };

            $scope.fecha_hasta = {
                opened: false,
            };

            $scope.lista_precios_proveedores = [];

            $scope.data_buscar_lista = {
                codigo_proveedor: '',
                fecha_desde: new Date(fecha_servidor[0], fecha_servidor[1] - 1, '01'),
                fecha_hasta: new Date(fecha_servidor[0], fecha_servidor[1] - 1, fecha_servidor[2]),
            }

            $scope.buscar_lista = function() {

                var data_params = {
                    data: {
                        'codigo_proveedor': $scope.data_buscar_lista.codigo_proveedor,
                        'fecha_desde': moment($scope.data_buscar_lista.fecha_desde).format('YYYY-MM-DD'),
                        'fecha_hasta': moment($scope.data_buscar_lista.fecha_hasta).format('YYYY-MM-DD'),
                    }
                }

                lista_precios_proveedores_model.create('historial_precios_proveedores', data_params)
                    .then(function(listas_precios) {
                        $scope.lista_precios_proveedores = [];

                        listas_precios.forEach(function(lista_precios) {
                            lista_precios.link_archivo = `${globalApp.base_url_client}../../../${lista_precios.link_archivo}`;
                            $scope.lista_precios_proveedores.push(lista_precios);
                        });
                    });
            }
        })
        .config(function($routeProvider) {
            $routeProvider
                .when("/", {
                    templateUrl: globalApp.base_url + "../client/src/app/lista_precios_proveedores/views/historial_precios_proveedores.html",
                    controller: "historial_precios_proveedores.controller",
                    resolve: {
                        proveedores: function(lista_precios_proveedores_model) {
                            return lista_precios_proveedores_model.get('obtener_proveedores');
                        }
                    }
                });
        });
})();