'use strict';

angular.module('Utils').factory('Buscar_Convenios', function(_) {

	function obtener_convenios(cliente) {
		var url = globalApp.base_url + "convenio/api/convenios_by_cliente?ID=" + globalApp.id + "&IDB=" + globalApp.idb;
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
					response.response.map(function(item) {
						data_response.push(item);
					});
				}
			});
			return data_response;
		}
	}

	function convenio_by_codigo(convenio) {
		var url = globalApp.base_url + "convenio/api/convenio_by_codigo?ID=" + globalApp.id + "&IDB=" + globalApp.idb;
		var data_response = [];
		if (url !== '') {
			$.ajax({
				url: url,
				async: false,
				dataType: "json",
				data: {
					codigo: convenio
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

	function buscar_convenio_por_parametro(parametro) {
		var url = globalApp.base_url + "convenio/api/buscar_convenio_por_parametro?ID=" + globalApp.id + "&IDB=" + globalApp.idb;
		var data_response = [];
		if (url !== '') {
			$.ajax({
				url: url,
				async: false,
				dataType: "json",
				data: {
					parametro: parametro
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

	function buscar_escuela_por_parametro(parametro) {
		var url = globalApp.base_url + "maetab/maetab/buscar_escuela_por_parametro?ID=" + globalApp.id + "&IDB=" + globalApp.idb;
		var data_response = [];
		if (url !== '') {
			$.ajax({
				url: url,
				async: false,
				dataType: "json",
				data: {
					parametro: parametro
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
		obtener_convenios: function(value) {
			return obtener_convenios(value);
		},
		convenio_by_codigo: function(value) {
			return convenio_by_codigo(value);
		},
		buscar_convenio_por_parametro: function(value) {
			return buscar_convenio_por_parametro(value);
		},
		buscar_escuela_por_parametro: function(value) {
			return buscar_escuela_por_parametro(value);
		}
	};
});
