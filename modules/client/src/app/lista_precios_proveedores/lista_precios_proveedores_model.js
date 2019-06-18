(function() {
	"use strict";

	angular.module("Lista_precios_proveedores")
		.factory("lista_precios_proveedores_model", function(model) {
			return model("lista_precios_proveedores");
		});
})();