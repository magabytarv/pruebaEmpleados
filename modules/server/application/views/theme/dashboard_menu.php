<?php
	$template_url = base_url() . "../client/";
  $user_login = $this->session->userdata('loggedIn');
  $tipo_cargo = $user_login['tipo_cargo'];
  $foto = (strlen($user_login['foto']) > 0)?$user_login['foto']:"user.png";
?>
      <div class="sidebar" data-background-color="black" data-active-color="intranet">
        <div class="sidebar-wrapper">
          <div class="logo">
            <a href="<?=site_url('servicios/reporte_contratos')."?ID=".$_GET['ID']."&IDB=".$_GET['IDB']."#/"?>" class="simple-text">
                <img src="<?= $template_url ?>src/assets/images/logob.png" width="180">
            </a>
          </div>
          <ul class="nav">
            <? if($tipo_cargo == 1) { ?>
            <li class="<?=$reporte_contratos?>">
              <a href="<?=site_url('servicios/reporte_contratos')."?ID=".$_GET['ID']."&IDB=".$_GET['IDB']."#/"?>">
                <i class="ti-agenda"></i>
                <p>Reporte Contratos</p>
              </a>
            </li>
            <li class="<?=$reporte_contratos_pet?>">
              <a href="<?=site_url('servicios/reporte_contratos_pet')."?ID=".$_GET['ID']."&IDB=".$_GET['IDB']."#/"?>">
                <i class="ti-user"></i>
                <p>Reporte Contratos Pet</p>
              </a>
            </li>
            <? } elseif($tipo_cargo == 2)  { ?>

            <li class="<?=$registrar_contrato?>">
              <a href="<?=site_url('servicios/registrar_contrato')."?ID=".$_GET['ID']."&IDB=".$_GET['IDB']."#/"?>">
                <i class="ti-view-list-alt"></i>
                <p>Nuevo Contrato</p>
              </a>
            </li>

            <li class="<?=$registrar_contrato_pet?>">
              <a href="<?=site_url('servicios/registrar_contrato_pet')."?ID=".$_GET['ID']."&IDB=".$_GET['IDB']."#/"?>">
                <i class="ti-view-list-alt"></i>
                <p>Nuevo Contrato Pet</p>
              </a>
            </li>

            <li class="<?=$listado_contratos?>">
              <a href="<?=site_url('servicios/listado_contratos')."?ID=".$_GET['ID']."&IDB=".$_GET['IDB']."#/"?>">
                <i class="ti-view-list-alt"></i>
                <p>Listado de contratos</p>
              </a>
            </li>

            <li class="<?=$proforma?>">
              <a href="<?=site_url('servicios/proforma')."?ID=".$_GET['ID']."&IDB=".$_GET['IDB']."#/"?>">
                <i class="ti-view-list-alt"></i>
                <p>Proforma</p>
              </a>
            </li>
            
            <? } ?>
          </ul>
        </div>
      </div>

      <div class="main-panel" ng-controller="homeCtrl">
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar bar1"></span>
              <span class="icon-bar bar2"></span>
              <span class="icon-bar bar3"></span>
              </button>
              <span class="navbar-brand"><?=$description_for_layout?></span>
            </div>
            <div class="collapse navbar-collapse">
              <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                  <a href="#/" class="dropdown-toggle" data-toggle="dropdown" role="button">
                    <img src="<?=$template_url?>src/assets/intranet/iconos/<?=$foto?>" alt="User" class="user-image">
                    <p><?=$user_login['nombre']?></p>
                    <b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="#/change_password">
                        Cambiar Contraseña
                      </a>
                      <a href="#/" type="button" ng-click="logout();">
                        Cerrar Sesión
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
