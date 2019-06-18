#!/bin/bash

function create_model_client()
{
    api_path="../client/src/app/"$modulo    
echo '(function() {
  "use strict";

  angular.module("'${modulo^}'").factory("'$modulo'_model", function(model) {
    return model("'$modulo'");
  });
})();
'>$api_path/$modulo'_model.js'
}
