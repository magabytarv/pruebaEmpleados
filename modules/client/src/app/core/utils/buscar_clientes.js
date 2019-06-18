'use strict';

angular.module('Utils').factory('Buscar_Clientes', function(_){

function obtener_clientes (cliente) {
    var url = globalApp.base_url + "cliente/cliente/buscar_clientes?ID="+globalApp.id+"&IDB="+globalApp.idb;
    var data_response = [];
    if (url !== '') {
        $.ajax({
            url: url,
            async: false,
            dataType: "json",
            data: {
                cliente: cliente
            },
            success: function(response) {
                if (response.response.length > 0){
                    
                response.response.map(function(item) {
                    data_response.push(item);
                });
                }
            }
        });
        return data_response;
    }
}

function obtener_clientes_sin_contratos (cliente) {
    var url = globalApp.base_url + "cliente/cliente/buscar_clientes_sin_contrato?ID="+globalApp.id+"&IDB="+globalApp.idb;
    var data_response = [];
    if (url !== '') {
        $.ajax({
            url: url,
            async: false,
            dataType: "json",
            data: {
                cliente: cliente
            },
            success: function(response) {
                if (response.response.length > 0){
                    
                response.response.map(function(item) {
                    data_response.push(item);
                });
                }
            }
        });
        return data_response;
    }
}

return {
    obtener_clientes: function(value) {
      return obtener_clientes(value);
    },
    obtener_clientes_sin_contratos: function(value) {
      return obtener_clientes_sin_contratos(value);
    }
};
});