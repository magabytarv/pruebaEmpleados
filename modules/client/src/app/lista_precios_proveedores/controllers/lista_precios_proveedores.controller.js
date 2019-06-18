(function() {

    "use strict";

    angular.module("Lista_precios_proveedores")
        .controller("lista_precios_proveedores.controller", function($rootScope, $scope, $http, _, $route, $location, fileUpload, lista_precios_proveedores_model, proveedores, tipos_monedas) {
            $scope.url_modal_productos_tmp = `${globalApp.base_url_client}src/app/lista_precios_proveedores/views/partials/productos_tmp.html`;
            $scope.url_formato = `${globalApp.base_url_client}src/app/lista_precios_proveedores/views/partials/formato.xlsx`;

            $scope.proveedores = proveedores;
            $scope.tipos_monedas = tipos_monedas;

            $scope.file_model_data = {
                value: ''
            }

            $scope.file_model = {
                value: ''
            }

            $scope.productos = [];
            $scope.productos_tmp = [];

            $scope.listado_precios = {
                codigo_proveedor: '',
                tipo_moneda: '',
                productos: [],
                productos_tmp: [],
                tipo_carga: 1
            }

            $scope.data_buscar_lista = {
                codigo_proveedor: ''
            }

            $scope.buscar_lista = function() {

                var params = {
                    url_params: {
                        'codigo_proveedor': $scope.data_buscar_lista.codigo_proveedor,
                    }
                }

                lista_precios_proveedores_model.get('lista_precios_proveedores', params)
                    .then(function(productos) {
                        $scope.productos = [];

                        productos.forEach(function(producto) {
                            $scope.productos.push(producto);
                        });
                    });

            }

            $scope.procesar_archivo = function() {
                var productos = key_object($scope.file_model_data.value);
                var file = $scope.file_model.value;

                if (extension_archivo_valido(file)) {
                    var confirmacion_titulo = 'Se actualizará la lista de precios parcialmente!';

                    if ($scope.listado_precios.tipo_carga == 1) {
                        confirmacion_titulo = 'Se actualizará la lista de precios completamente!';
                    }

                    Swal.fire({
                        title: confirmacion_titulo,
                        text: '',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar',
                        cancelButtonText: 'Cancelar',
                        allowEnterKey: false,
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.value) {
                            var data_create = {
                                data: {
                                    'productos': productos,
                                    'proveedor': $scope.listado_precios.codigo_proveedor,
                                    'tipo_moneda': $scope.listado_precios.tipo_moneda,
                                    'tipo_carga': $scope.listado_precios.tipo_carga,
                                    'nombre_archivo': file.name,
                                }
                            }
                            lista_precios_proveedores_model.create('validar_lista_precios_proveedores', data_create)
                                .then(function(res) {
                                    $scope.productos_tmp = [];
                                    if (res.estado == true) {
                                        var upload_url = `${globalApp.base_url}lista_precios_proveedores/api/guardar_archivo${document.location.search}`;
                                        fileUpload.upload_file_To_url(file, upload_url);

                                        Swal.fire({
                                            title: 'La lista de precios fue actualizada correctamente',
                                            text: '',
                                            type: 'success',
                                            showCancelButton: false,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Aceptar',
                                            cancelButtonText: 'Cancelar',
                                            allowEnterKey: false,
                                            allowEscapeKey: false,
                                            allowOutsideClick: false,
                                        }).then((result) => {
                                            window.location.reload();
                                            $rootScope.$apply();
                                        })
                                    } else {
                                        res.productos.forEach(function(producto) {
                                            $scope.productos_tmp.push(producto);
                                        })
                                    }
                                });
                        }
                    }).catch((err) => {
                        console.log(err)
                    });
                } else {
                    swal.fire('Favor cargar un archivo válido', '', 'warning')
                }
            }

            $scope.cancelar_modal = function() {
                window.location.reload();
            }

            $scope.limpiar_productos = function() {
                $scope.productos = [];

            }

            $scope.generar_excel = function() {
                var data_proveedor = $scope.proveedores.find(proveedor => proveedor.codigo_proveedor === $scope.data_buscar_lista.codigo_proveedor);

                $http({
                    method: 'POST',
                    url: full_path('lista_precios_proveedores', 'generar_excel', undefined),
                    data: {
                        productos: $scope.productos,
                        proveedor: data_proveedor
                    },
                    responseType: 'arraybuffer'
                }).then(function(response) {
                    var fileName = 'Reporte Precios proveedor' + moment().format('YYYY-MM-DD') + '.xlsx';
                    saveAs(new Blob([response.data], {
                        type: 'application/excel'
                    }), fileName);
                });
            }

            $scope.generar_pdf = function() {
                var data_proveedor = $scope.proveedores.find(proveedor => proveedor.codigo_proveedor === $scope.data_buscar_lista.codigo_proveedor);

                $http({
                    method: 'POST',
                    url: full_path('lista_precios_proveedores', 'generar_pdf', undefined),
                    data: {
                        productos: $scope.productos,
                        proveedor: data_proveedor
                    },
                    responseType: 'arraybuffer'
                }).then(function(response) {
                    var fileName = 'Reporte Precios proveedor' + moment().format('YYYY-MM-DD') + '.pdf';
                    saveAs(new Blob([response.data], {
                        type: 'application/pdf'
                    }), fileName);
                });
            }

            $scope.cargar_archivo_proveedor = function() {
                $scope.listado_precios.codigo_proveedor = $scope.data_buscar_lista.codigo_proveedor;
            }

            function key_object(obj) {
                var key = Object.keys(obj)
                return obj[key[0]];
            }

            function extension_archivo_valido(file) {
                if (file) {
                    var archivo = file.name;
                    var extension = (archivo.substring(archivo.lastIndexOf('.'))).toLowerCase();

                    if (extension == '.xls' || extension == '.xlsx') {
                        return true;
                    }
                }

                return false;
            }

            function full_path(resource, action, params) {
                var path = globalApp.base_url + resource + '/api/' + action;
                if (params !== undefined && params.url_params) {
                    _(_.values(params.url_params)).each(function(param) {
                        path += '/' + param;
                    })
                }

                path += document.location.search;

                if (params !== undefined && params.fideicomiso) {
                    path += '&fideicomiso=' + params.fideicomiso;
                }

                return path;
            }
        })
        .config(function($routeProvider) {
            $routeProvider
                .when("/", {
                    templateUrl: globalApp.base_url + "../client/src/app/lista_precios_proveedores/views/lista_precios_proveedores.html",
                    controller: "lista_precios_proveedores.controller",
                    resolve: {
                        proveedores: function(lista_precios_proveedores_model) {
                            return lista_precios_proveedores_model.get('obtener_proveedores');
                        },
                        tipos_monedas: function(lista_precios_proveedores_model) {
                            return lista_precios_proveedores_model.get('obtener_tipos_monedas');
                        }
                    }
                });
        })
        .service('fileUpload', function($http) {

            this.upload_file_To_url = function(file, upload_url) {
                var fd = new FormData();

                fd.append('file', file);

                $http.post(upload_url, fd, {
                        transformRequest: angular.identity,
                        headers: {
                            'Content-Type': undefined
                        }
                    })
                    .then(function(response) {
                        return response.data.response;
                    });
            }
        });
})();