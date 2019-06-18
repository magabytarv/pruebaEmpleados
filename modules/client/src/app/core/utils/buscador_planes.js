'use strict';

angular.module('Utils').factory('Buscador_Planes', function(_){

function obtener_planes (plan) {
    var url = globalApp.base_url + "planes_exequiales/api/planes_por_descripcion?ID="+globalApp.id+"&IDB="+globalApp.idb;
    var data_response = [];
    if (url !== '') {
        $.ajax({
            url: url,
            async: false,
            dataType: "json",
            data: {
                plan: plan
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
    obtener_planes: function(value) {
      return obtener_planes(value);
    }
};
});