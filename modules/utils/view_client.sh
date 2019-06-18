#!/bin/bash

function create_view_client()
{
    api_path="../client/src/app/"$modulo"/views"    
echo '<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">'${modulo^}'</div>
                <div class="panel-body">
                    <h1>MODULO '${modulo^}'</h1>
                    <h2>Generador de modulos</h2>
                    <h3>run command line</h3>
                    <pre>
                        dir_proyecto/modulos/utils$ ./new_module.sh
                    </pre>
                </div>
            </div>
        </div>
    </div>
</div>
'>$api_path/$modulo'.html'
}
