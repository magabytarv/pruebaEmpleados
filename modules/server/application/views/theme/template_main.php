<?php
$client_path = base_url() . "../client/";
?>
<!DOCTYPE HTML>
<html lang="es-EC">
    <head>
        <title><?= $title_for_layout ?></title>

        <script type="text/javascript">
            window.globalApp = window.globalApp || {};
            window.globalApp.base_url = '<?= base_url() ?>';
            window.globalApp.base_url_client = '<?= $client_path ?>';
            window.globalApp.fecha_servidor = '<?= date("Y-m-d H:i:s") ?>';
        </script>

        <meta charset="UTF-8">

        <link rel="stylesheet" href="<?= $client_path ?>bower_components/angular-toastr/dist/angular-toastr.min.css" />
        <link rel="stylesheet" href="<?= $client_path ?>src/app/index.css">
        <link rel="stylesheet" href="<?= $client_path ?>src/app/core/loader/loadingStatusHTTP.css">
        <link rel="stylesheet" href="<?= $client_path ?>src/app/estilos_pac.css">
        <link rel="stylesheet" href="<?= $client_path ?>src/app/components/iCheck/all.css">
        <link rel="stylesheet" href="<?= $client_path ?>src/app/components/chosen/chosen.min.css">
        <link rel="stylesheet" href="<?= $client_path ?>src/app/components/chosen/chosen_modify.css">
        <link rel="stylesheet" href="<?= $client_path ?>src/assets/css/font-awesome.css">
        <link rel="stylesheet" href="<?= $client_path ?>src/app/components/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= $client_path ?>bower_components/jquery-ui/jquery-ui.css">
        <link rel="stylesheet" href="<?= $client_path ?>bower_components/jquery-ui/jquery-ui.theme.css">
    </head>

    <script src="<?= $client_path ?>bower_components/jquery/dist/jquery.js"></script>
    <script src="<?= $client_path ?>bower_components/angular/angular.js"></script>
    <script src="<?= $client_path ?>bower_components/angular-animate/angular-animate.js"></script>
    <script src="<?= $client_path ?>bower_components/angular-cookies/angular-cookies.js"></script>
    <script src="<?= $client_path ?>bower_components/angular-touch/angular-touch.js"></script>
    <script src="<?= $client_path ?>bower_components/angular-sanitize/angular-sanitize.js"></script>
    <script src="<?= $client_path ?>bower_components/angular-route/angular-route.js"></script>
    <script src="<?= $client_path ?>bower_components/angular-resource/angular-resource.js"></script>
    <script src="<?= $client_path ?>bower_components/angular-ui-router/release/angular-ui-router.js"></script>
    <script src="<?= $client_path ?>bower_components/angular-bootstrap/i18n/angular-locale_es-es.js"></script>
    <script src="<?= $client_path ?>bower_components/angular-bootstrap/ui-bootstrap-tpls-2.1.3.js"></script>
    <script src="<?= $client_path ?>bower_components/bootstrap/js/bootstrap-collapse.js"></script>
    <script src="<?= $client_path ?>bower_components/malarkey/dist/malarkey.min.js"></script>
    <script src="<?= $client_path ?>bower_components/toastr/toastr.js"></script>
    <script src="<?= $client_path ?>src/assets/js/moment.js"></script>
    <script src="<?= $client_path ?>src/assets/js/moment-precise-range.js"></script>
    <script src="<?= $client_path ?>bower_components/underscore/underscore.js"></script>
    <script src="<?= $client_path ?>bower_components/angular-toastr/dist/angular-toastr.min.js"></script>
    <script src="<?= $client_path ?>bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/modal.js"></script>
    <script src="<?= $client_path ?>bower_components/big.js/big.min.js"></script>
    <script src="<?= $client_path ?>bower_components/bootstrap/js/bootstrap-tooltip.js "></script>
    <script src="<?= $client_path ?>bower_components/bootstrap/js/bootstrap-dropdown.js "></script>
    <script src="<?= $client_path ?>bower_components/bootstrap/js/bootstrap-tab.js "></script>
    <script src="<?= $client_path ?>bower_components/bootstrap/js/bootstrap-collapse.js"></script>

    <script src="<?= $client_path ?>bower_components/jquery-ui/jquery-ui.js"></script>
    <script src="<?= $client_path ?>bower_components/jquery-ui/jquery-ui-i18n.min.js"></script>

    <script src="<?= $client_path ?>src/assets/js/sweetalert2.js"></script>
    <script src="<?= $client_path ?>src/assets/js/angular-file-upload.js"></script>
    <script src="<?= $client_path ?>src/assets/js/chart.min.js"></script>

    <script src="<?= $client_path ?>src/app/index.module.js"></script>
    <script src="<?= $client_path ?>src/app/components/webDevTec/webDevTec.service.js"></script>
    <script src="<?= $client_path ?>src/app/components/navbar/navbar.directive.js"></script>
    <script src="<?= $client_path ?>src/app/components/malarkey/malarkey.directive.js"></script>
    <script src="<?= $client_path ?>src/app/components/githubContributor/githubContributor.service.js"></script>
    <script src="<?= $client_path ?>src/app/components/iCheck/icheck.js"></script>
    <script src="<?= $client_path ?>src/app/components/chosen/chosen.jquery.min.js"></script>
    <script src="<?= $client_path ?>src/app/components/file-saver/FileSaver.min.js"></script>
    <script src="<?= $client_path ?>src/app/main/main.controller.js"></script>
    <script src="<?= $client_path ?>src/app/index.run.js"></script>
    <script src="<?= $client_path ?>src/app/index.route.js"></script>
    <script src="<?= $client_path ?>src/app/index.constants.js"></script>
    <script src="<?= $client_path ?>src/app/index.config.js"></script>

    <!--CORE-->
    <script src="<?= $client_path ?>src/app/core/module.js"></script>
    <script src="<?= $client_path ?>src/app/core/underscore/module.js"></script>
    <script src="<?= $client_path ?>src/app/core/loader/module.js"></script>
    <script src="<?= $client_path ?>src/app/core/model/module.js"></script>
    <script src="<?= $client_path ?>src/app/core/model/model.js"></script>

    <!--NOTIFIER-->
    <script src="<?= $client_path ?>src/app/core/notifier/module.js"></script>
    <script src="<?= $client_path ?>src/app/core/notifier/error_formater.js"></script>
    <script src="<?= $client_path ?>src/app/core/notifier/notifier_controller.js"></script>
    <script src="<?= $client_path ?>src/app/core/notifier/success_formater.js"></script>
    <script src="<?= $client_path ?>src/app/core/notifier/warning_formater.js"></script>

    <!--UTILS-->
    <script src="<?= $client_path ?>src/app/core/utils/module.js"></script>
    <script src="<?= $client_path ?>src/app/core/utils/math_utils.js"></script>
    <script src="<?= $client_path ?>src/app/core/utils/validator_utils.js"></script>
    <script src="<?= $client_path ?>src/app/core/utils/obtener_productos.js"></script>
    <script src="<?= $client_path ?>src/app/core/utils/buscador_planes.js"></script>
    <script src="<?= $client_path ?>src/app/core/utils/buscar_convenios.js"></script>
    <script src="<?= $client_path ?>src/app/core/utils/buscar_contratos.js"></script>
    <script src="<?= $client_path ?>src/app/core/utils/buscar_clientes.js"></script>

    <!--DICTIONARY-->
    <script src="<?= $client_path ?>src/app/core/dictionary/module.js"></script>
    <script src="<?= $client_path ?>src/app/core/dictionary/dictionary.js"></script>

    <!--DIRECTIVES-->
    <script src="<?= $client_path ?>src/app/directives/module.js"></script>
    <script src="<?= $client_path ?>src/app/directives/iCheck.js"></script>
    <script src="<?= $client_path ?>src/app/directives/xlsx-model.js"></script>
    <script src="<?= $client_path ?>src/app/directives/form_validation/validation.js"></script>
    <script src="<?= $client_path ?>src/app/directives/form_validation/validate_form.js"></script>
    <script src="<?= $client_path ?>src/app/directives/form_validation/is_required.js"></script>
    <script src="<?= $client_path ?>src/app/directives/minnumber.js"></script>
    <script src="<?= $client_path ?>src/app/directives/decimal.js"></script>
    <script src="<?= $client_path ?>src/app/directives/decimal_lenght.js"></script>
    <script src="<?= $client_path ?>src/app/directives/modal.js"></script>
    <script src="<?= $client_path ?>src/app/directives/chosen_select.js"></script>
    <script src="<?= $client_path ?>src/app/directives/chosen_multiple.js"></script>
    <script src="<?= $client_path ?>src/app/directives/chosen_disabled_options.js"></script>
    <script src="<?= $client_path ?>src/app/directives/upload/file_model.js"></script>
    <script src="<?= $client_path ?>src/app/directives/valid_id_card.js"></script>
    <script src="<?= $client_path ?>src/app/directives/checklist-model.js"></script>

    <!--FILTERS-->
    <script src="<?= $client_path ?>src/app/filters/module.js"></script>
    <script src="<?= $client_path ?>src/app/filters/number/module.js"></script>
    <script src="<?= $client_path ?>src/app/filters/number/format_number.js"></script>

     <script src="<?= $client_path ?>src/app/librerias/FileSaver.js"></script>
     <script src="<?= $client_path ?>src/app/librerias/bootbox.min.js"></script>
     <script src="<?= $client_path ?>src/app/librerias/xlsx.full.min.js"></script>

    <body ng-app="<?= $angular_app ?>">
        <?php $this->load->view('theme/loader') ?>
        <?= $content_for_layout ?>
    </body>
</html>
