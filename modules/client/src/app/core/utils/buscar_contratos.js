'use strict';

angular.module('Utils').factory('Buscar_Contratos', function(_){

function obtener_contratos (contrato) {
    var url = globalApp.base_url + "contratos/api/contratos_por_cliente?ID="+globalApp.id+"&IDB="+globalApp.idb;
    var data_response = [];
    if (url !== '') {
        $.ajax({
            url: url,
            async: false,
            dataType: "json",
            data: {
                contrato: contrato
            },
            success: function(response) {
                response.response.map(function(item) {
                    data_response.push(item);
                });
            }
        });
        return data_response;
    }
}

function obtener_contratos_by_numero (numero) {
    var url = globalApp.base_url + "contratos/api/contrato_por_numero?ID="+globalApp.id+"&IDB="+globalApp.idb;
    var data_response = [];
    if (url !== '') {
        $.ajax({
            url: url,
            async: false,
            dataType: "json",
            data: {
                numero: numero
            },
            success: function(response) {
                response.response.map(function(item) {
                    data_response.push(item);
                });
            }
        });
        return data_response;
    }
}
return {
    obtener_contratos: function(value) {
      return obtener_contratos(value);
    },
    obtener_contratos_by_numero: function(value) {
      return obtener_contratos_by_numero(value);
    }
};
});