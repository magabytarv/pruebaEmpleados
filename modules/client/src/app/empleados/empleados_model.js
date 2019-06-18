(function() {
  "use strict";

  angular.module("Empleados").factory("empleados_model", function(model) {
    return model("empleados");
  });
})();

