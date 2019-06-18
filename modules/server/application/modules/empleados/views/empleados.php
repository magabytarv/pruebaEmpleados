<script src="<?= base_url()?>../client/src/app/empleados/module.js"></script>
<script src="<?= base_url()?>../client/src/app/empleados/empleados_model.js"></script>
<script src="<?= base_url()?>../client/src/app/empleados/controllers/empleados.controller.js"></script>

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


