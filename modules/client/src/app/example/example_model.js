(function() {
  "use strict";

  angular.module("Example").factory("example_model", function(model) {
    return model("example");
  });
})();

