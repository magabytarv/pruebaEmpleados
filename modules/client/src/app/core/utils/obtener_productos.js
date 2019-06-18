'use strict';

angular.module('Utils').factory('productos', function(_) {

	function obtener_productos(producto) {
		var url = globalApp.base_url + "productos/productos/productos_por_nombre_matriz?ID=" + globalApp.id + "&IDB=" + globalApp.idb;
		var data_response = [];
		if (url !== '') {
			$.ajax({
				url: url,
				async: false,
				dataType: "json",
				data: {
					producto: producto
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

	function obtener_productos_plan(producto) {
		var url = globalApp.base_url + "productos/productos/productos_para_planes?ID=" + globalApp.id + "&IDB=" + globalApp.idb;
		var data_response = [];
		if (url !== '') {
			$.ajax({
				url: url,
				async: false,
				dataType: "json",
				data: {
					producto: producto
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

	function obtener_productos_planpet(producto) {
		var url = globalApp.base_url + "productos/productos/obtener_productos_planpet?ID=" + globalApp.id + "&IDB=" + globalApp.idb;
		var data_response = [];
		if (url !== '') {
			$.ajax({
				url: url,
				async: false,
				dataType: "json",
				data: {
					producto: producto
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
		obtener_productos: function(value) {
			return obtener_productos(value);
		},
		obtener_productos_plan: function(value) {
			return obtener_productos_plan(value);
		},
		obtener_productos_planpet: function(value) {
			return obtener_productos_planpet(value);
		}
	};
});
