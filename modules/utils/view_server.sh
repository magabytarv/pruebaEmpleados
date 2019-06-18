#!/bin/bash

function create_view_server()
{
    api_path="../server/application/modules/"$modulo"/views"    
echo '<script src="<?= base_url()?>../client/src/app/'$modulo'/module.js"></script>
<script src="<?= base_url()?>../client/src/app/'$modulo'/'$modulo'_model.js"></script>
<script src="<?= base_url()?>../client/src/app/'$modulo'/controllers/'$modulo'.controller.js"></script>

<div ng-view ng-cloak class="container" style="width:100%">
    <div ng-controller="Notifier"><div>
</div>
<script type="text/javascript">
    function base_recargar() {
        window.location.reload();
    }

    function base_salir() {
        window.parent.close();
    }
    function base_imprimir() {
       window.print();
    
    }
</script>

'>$api_path/$modulo'.php'
}
