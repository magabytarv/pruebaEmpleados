#!/bin/bash

function create_module_client()
{
    api_path="../client/src/app/"$modulo    
echo '(function() {
    "use_strict";
    angular.module("'${modulo^}'", [
        "clientApp"
    ]);
})();
'>$api_path/'module.js'
}
