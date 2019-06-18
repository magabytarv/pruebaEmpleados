<?php
    $template_url = base_url() . "../client/";
    $tipo_cargo = '';
    $UID = '';
    if ($this->session->userdata('logged') != 1) {
        redirect('servicios/login'."?ID=".$_GET['ID']."&IDB=".$_GET['IDB']."#/", 'refresh');
    } else {
        $user_login = $this->session->userdata('loggedIn');
        $tipo_cargo = $user_login['tipo_cargo'];
        $UID = $user_login['UID'];
    }
?>
<!doctype html>
<html lang="es-EC">
  <head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="<?= $template_url ?>src/assets/intranet/iconos/favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title><?=$title_for_layout?></title>

    <script type="text/javascript">
        window.globalApp = window.globalApp || {};
        window.globalApp.base_url = '<?= base_url() ?>';
        window.globalApp.base_url_client = '<?= $template_url ?>';
        window.globalApp.id = '<?=$_GET['ID'] ?>';
        window.globalApp.idb = '<?=$_GET['IDB'] ?>';
        window.globalApp.uid = '<?=$UID ?>';
        window.globalApp.tipo_cargo = '<?=$tipo_cargo ?>';
        window.globalApp.fecha_servidor = '<?= date("Y-m-d H:i:s") ?>';
    </script>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    <link href="<?= $template_url ?>src/assets/intranet/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= $template_url ?>src/assets/intranet/css/animate.min.css" rel="stylesheet" />
    <link href="<?= $template_url ?>src/assets/intranet/css/paper-dashboard.css" rel="stylesheet"/>
    <link href="<?= $template_url ?>src/assets/intranet/css/demo.css" rel="stylesheet" />
    <link href="<?= $template_url ?>src/app/components/chosen/chosen.min.css" rel="stylesheet" />
    <link href="<?= $template_url ?>src/app/components/chosen/chosen_modify.css" rel="stylesheet" />
    <link href="<?= $template_url ?>src/assets/intranet/css/themify-icons.css" rel="stylesheet" />
    <link href="<?= $template_url ?>src/assets/css/font-awesome.css" rel="stylesheet" />
    <link href="<?= $template_url ?>src/assets/intranet/css/sweetalert.css" rel="stylesheet" />
    <link href="<?= $template_url ?>src/assets/css/sweetalert2.css" rel="stylesheet" />

    <link href="<?= $template_url ?>src/assets/intranet/js/jquery-ui/jquery-ui.css" rel="stylesheet" />
    <link href="<?= $template_url ?>src/assets/intranet/js/jquery-ui/jquery-ui.theme.css" rel="stylesheet" />

    <script src="<?= $template_url ?>src/assets/intranet/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="<?= $template_url ?>src/assets/intranet/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= $template_url ?>src/assets/intranet/js/bootstrap-notify.js"></script>
    <script src="<?= $template_url ?>src/assets/intranet/js/paper-dashboard.js"></script>
    <script src="<?= $template_url ?>src/assets/intranet/js/jquery-ui/jquery-ui.js"></script>
    <script src="<?= $template_url ?>src/assets/intranet/js/jquery-ui/jquery-ui-i18n.min.js"></script>
    <script src="<?= $template_url ?>src/assets/intranet/js/sweetalert.min.js"></script>
    <script src="<?= $template_url ?>src/assets/intranet/js/demo.js"></script>


    <script src="<?= $template_url ?>bower_components/jquery/dist/jquery.js"></script>
    <script src="<?= $template_url ?>bower_components/angular/angular.js"></script>
    <script src="<?= $template_url ?>bower_components/angular-animate/angular-animate.js"></script>
    <script src="<?= $template_url ?>bower_components/angular-cookies/angular-cookies.js"></script>
    <script src="<?= $template_url ?>bower_components/angular-touch/angular-touch.js"></script>
    <script src="<?= $template_url ?>bower_components/angular-sanitize/angular-sanitize.js"></script>
    <script src="<?= $template_url ?>bower_components/angular-route/angular-route.js"></script>
    <script src="<?= $template_url ?>bower_components/angular-resource/angular-resource.js"></script>
    <script src="<?= $template_url ?>bower_components/angular-ui-router/release/angular-ui-router.js"></script>
    <script src="<?= $template_url ?>bower_components/angular-bootstrap/i18n/angular-locale_es-es.js"></script>
    <script src="<?= $template_url ?>bower_components/angular-bootstrap/ui-bootstrap-tpls-0.14.3.js"></script>
    <script src="<?= $template_url ?>bower_components/bootstrap/js/bootstrap-collapse.js"></script>
    <script src="<?= $template_url ?>bower_components/malarkey/dist/malarkey.min.js"></script>
    <script src="<?= $template_url ?>bower_components/toastr/toastr.js"></script>
    <script src="<?= $template_url ?>src/assets/js/moment.js"></script>
    <script src="<?= $template_url ?>src/assets/js/moment-precise-range.js"></script>
    <script src="<?= $template_url ?>bower_components/underscore/underscore.js"></script>
    <script src="<?= $template_url ?>bower_components/angular-toastr/dist/angular-toastr.min.js"></script>
    <script src="<?= $template_url ?>bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/modal.js"></script>
    <script src="<?= $template_url ?>bower_components/big.js/big.min.js"></script>

    <script src="<?= $template_url ?>bower_components/jquery-ui/jquery-ui.js"></script>
    <script src="<?= $template_url ?>bower_components/jquery-ui/jquery-ui-i18n.min.js"></script>

    <script src="<?= $template_url ?>src/assets/js/sweetalert2.min.js"></script>
    <script src="<?= $template_url ?>src/assets/js/angular-file-upload.js"></script>

    <script src="<?= $template_url ?>src/app/index.module.js"></script>
    <script src="<?= $template_url ?>src/app/components/webDevTec/webDevTec.service.js"></script>
    <script src="<?= $template_url ?>src/app/components/navbar/navbar.directive.js"></script>
    <script src="<?= $template_url ?>src/app/components/malarkey/malarkey.directive.js"></script>
    <script src="<?= $template_url ?>src/app/components/githubContributor/githubContributor.service.js"></script>
    <script src="<?= $template_url ?>src/app/components/iCheck/icheck.js"></script>
    <script src="<?= $template_url ?>src/app/components/chosen/chosen.jquery.min.js"></script>
    <script src="<?= $template_url ?>src/app/components/file-saver/FileSaver.min.js"></script> 
    <script src="<?= $template_url ?>src/app/main/main.controller.js"></script>
    <script src="<?= $template_url ?>src/app/index.run.js"></script>
    <script src="<?= $template_url ?>src/app/index.route.js"></script>
    <script src="<?= $template_url ?>src/app/index.constants.js"></script>
    <script src="<?= $template_url ?>src/app/index.config.js"></script>        

    <!--CORE-->
    <script src="<?= $template_url ?>src/app/core/module.js"></script>
    <script src="<?= $template_url ?>src/app/core/underscore/module.js"></script>
    <script src="<?= $template_url ?>src/app/core/loader/module.js"></script>
    <script src="<?= $template_url ?>src/app/core/model/module.js"></script>
    <script src="<?= $template_url ?>src/app/core/model/model.js"></script>

    <!--NOTIFIER-->
    <script src="<?= $template_url ?>src/app/core/notifier/module.js"></script>
    <script src="<?= $template_url ?>src/app/core/notifier/error_formater.js"></script>
    <script src="<?= $template_url ?>src/app/core/notifier/notifier_controller.js"></script>
    <script src="<?= $template_url ?>src/app/core/notifier/success_formater.js"></script>
    <script src="<?= $template_url ?>src/app/core/notifier/warning_formater.js"></script>

    <!--UTILS-->
    <script src="<?= $template_url ?>src/app/core/utils/module.js"></script>
    <script src="<?= $template_url ?>src/app/core/utils/math_utils.js"></script>
    <script src="<?= $template_url ?>src/app/core/utils/validator_utils.js"></script>
    <script src="<?= $template_url ?>src/app/core/utils/obtener_productos.js"></script>
    <script src="<?= $template_url ?>src/app/core/utils/buscador_planes.js"></script>
    <script src="<?= $template_url ?>src/app/core/utils/buscar_convenios.js"></script>
    <script src="<?= $template_url ?>src/app/core/utils/buscar_contratos.js"></script>
    <script src="<?= $template_url ?>src/app/core/utils/buscar_clientes.js"></script>

    <!--DICTIONARY-->
    <script src="<?= $template_url ?>src/app/core/dictionary/module.js"></script>
    <script src="<?= $template_url ?>src/app/core/dictionary/dictionary.js"></script>

    <!--DIRECTIVES-->
    <script src="<?= $template_url ?>src/app/directives/module.js"></script>
    <script src="<?= $template_url ?>src/app/directives/iCheck.js"></script>
    <script src="<?= $template_url ?>src/app/directives/xlsx-model.js"></script>
    <script src="<?= $template_url ?>src/app/directives/form_validation/validation.js"></script>
    <script src="<?= $template_url ?>src/app/directives/form_validation/validate_form.js"></script>
    <script src="<?= $template_url ?>src/app/directives/form_validation/is_required.js"></script>
    <script src="<?= $template_url ?>src/app/directives/minnumber.js"></script>
    <script src="<?= $template_url ?>src/app/directives/decimal.js"></script>
    <script src="<?= $template_url ?>src/app/directives/decimal_lenght.js"></script>
    <script src="<?= $template_url ?>src/app/directives/modal.js"></script>
    <script src="<?= $template_url ?>src/app/directives/chosen_select.js"></script>
    <script src="<?= $template_url ?>src/app/directives/chosen_multiple.js"></script>
    <script src="<?= $template_url ?>src/app/directives/chosen_disabled_options.js"></script>
    <script src="<?= $template_url ?>src/app/directives/upload/file_model.js"></script>
    <script src="<?= $template_url ?>src/app/directives/valid_id_card.js"></script>
    <script src="<?= $template_url ?>src/app/directives/checklist-model.js"></script>

    <!--FILTERS-->
    <script src="<?= $template_url ?>src/app/filters/module.js"></script>
    <script src="<?= $template_url ?>src/app/filters/number/module.js"></script>
    <script src="<?= $template_url ?>src/app/filters/number/format_number.js"></script>

     <script src="<?= $template_url ?>src/app/librerias/FileSaver.js"></script>
     <script src="<?= $template_url ?>src/app/librerias/bootbox.min.js"></script>
     <script src="<?= $template_url ?>src/app/librerias/xlsx.full.min.js"></script>
  </head>
  <body ng-app="<?= $angular_app ?>">
    <div class="wrapper">
      <?php $this->load->view('theme/dashboard_menu') ?>
      <div class="content">
          <div class="container-fluid">
            <div class="row">
              <?= $content_for_layout ?>
            </div>
          </div>
        </div>
      <?php $this->load->view('theme/dashboard_footer') ?>
    </div>
  </body>
</html>
