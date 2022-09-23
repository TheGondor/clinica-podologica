<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Panel Administracion
        </title>
        <meta name="description" content="Administracion">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/app.bundle.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="css/notifications/sweetalert2/sweetalert2.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/theme-demo.css">
        <link rel="stylesheet" media="screen, print" href="css/modal.css">
        <link rel="stylesheet" media="screen, print" href="css/formplugins/summernote/summernote.css">

    </head>
    <body class="mod-bg-1 ">
        <input type="hidden" name="id_paciente" value="0" id="id_paciente">
        <!-- DOC: script to save and load page settings -->
        <script>
            /**
             *	This script should be placed right after the body tag for fast execution
             *	Note: the script is written in pure javascript and does not depend on thirdparty library
             **/
            'use strict';

            var classHolder = document.getElementsByTagName("BODY")[0],
                /**
                 * Load from localstorage
                 **/
                themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
                {},
                themeURL = themeSettings.themeURL || '',
                themeOptions = themeSettings.themeOptions || '';
            /**
             * Load theme options
             **/
            if (themeSettings.themeOptions)
            {
                classHolder.className = themeSettings.themeOptions;
                console.log("%c✔ Theme settings loaded", "color: #148f32");
            }
            else
            {
                console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
            }
            if (themeSettings.themeURL && !document.getElementById('mytheme'))
            {
                var cssfile = document.createElement('link');
                cssfile.id = 'mytheme';
                cssfile.rel = 'stylesheet';
                cssfile.href = themeURL;
                document.getElementsByTagName('head')[0].appendChild(cssfile);
            }
            /**
             * Save to localstorage
             **/
            var saveSettings = function()
            {
                themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
                {
                    return /^(nav|header|mod|display)-/i.test(item);
                }).join(' ');
                if (document.getElementById('mytheme'))
                {
                    themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
                };
                localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
            }
            /**
             * Reset settings
             **/
            var resetSettings = function()
            {
                localStorage.setItem("themeSettings", "");
            }

        </script>
        <!-- BEGIN Page Wrapper -->
        <div class="page-wrapper">
            <div class="page-inner">
                <!-- BEGIN Left Aside -->
                <aside class="page-sidebar">
                    <div class="page-logo">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                            <span class="page-logo-text mr-1">Panel Administración</span>
                            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                        </a>
                    </div>
                    <!-- BEGIN PRIMARY NAVIGATION -->
                    <nav id="js-primary-nav" class="primary-nav" role="navigation">
                        <div class="nav-filter">
                            <div class="position-relative">
                                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                                    <i class="fal fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <ul id="js-nav-menu" class="nav-menu">
                            <a onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                                <i class="fal fa-angle-down"></i>
                            </a>
                             <li id="menu_pacientes">
                                <a href="#" title="Pacientes" data-filter-tags="pacientes">
                                    <i class="fal fa-users"></i>
                                    <span class="nav-link-text" data-i18n="nav.pacientes">Pacientes</span>
                                </a>
                            </li>
                            <li id="menu_protocolos">
                                <a href="#" title="Protocolos" data-filter-tags="protocolos">
                                    <i class="fal fa-file-alt"></i>
                                    <span class="nav-link-text" data-i18n="nav.protocolos">Protocolos</span>
                                </a>
                            </li>
                            <li id="menu_paciente" style="display: none">
                                <a href="#" title="Paciente" data-filter-tags="paciente">
                                    <i class="fal fa-user"></i>
                                    <span class="nav-link-text" id="menu_nombre_paciente" data-i18n="nav.paciente">Paciente</span>
                                </a>
                                <ul>
                                    <li id="menu_personales">
                                        <a href="#" title="Antecedentes Personales" data-filter-tags="antecedentes personales">
                                            <span class="nav-link-text" data-i18n="nav.home_portada">Atecedentes Personales</span>
                                        </a>
                                    </li>
                                    <li id="menu_morbido">
                                        <a href="#" title="Antecedentes Morbidos" data-filter-tags="antecedentes morbidos">
                                            <span class="nav-link-text" data-i18n="nav.home_confia_en_nosotros">Antecedentes Morbidos</span>
                                        </a>
                                        <ul>
                                            <li id="menu_ficha_morbido">
                                            <a href="#" title="Ficha Morbidos" data-filter-tags="ficha morbidos">
                                                <span class="nav-link-text" data-i18n="nav.home_confia_en_nosotros">Ficha</span>
                                            </a>
                                            </li>
                                            <li id="menu_enfermedad">
                                                <a href="#" title="Enfermedades" data-filter-tags="enfermedades">
                                                    <span class="nav-link-text" data-i18n="nav.home_confia_en_nosotros">Enfermedades</span>
                                                </a>
                                            </li>
                                            <li id="menu_medicamento">
                                                <a href="#" title="Medicamentos" data-filter-tags="medicamentos">
                                                    <span class="nav-link-text" data-i18n="nav.home_quienes_somos">Medicamentos</span>
                                                </a>
                                            </li>
                                            <li id="menu_patologia">
                                                <a href="#" title="Patologias" data-filter-tags="patologias">
                                                    <span class="nav-link-text" data-i18n="nav.home_videos">Patologias</span>
                                                </a>
                                            </li>
                                            <li id="menu_habito">
                                                <a href="#" title="Habitos Nocivos" data-filter-tags="habitos nocivos">
                                                    <span class="nav-link-text" data-i18n="nav.home_videos">Habitos Nocivos</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li id="menu_examen_general">
                                        <a href="#" title="Examen General" data-filter-tags="examen general">
                                            <span class="nav-link-text" data-i18n="nav.home_quienes_somos">Examen Fisico</span>
                                        </a>
                                        <ul>
                                            <li id="menu_ficha_examen">
                                            <a href="#" title="Ficha Examen" data-filter-tags="ficha examen">
                                                <span class="nav-link-text" data-i18n="nav.home_confia_en_nosotros">Ficha</span>
                                            </a>
                                            </li>
                                            <li id="menu_pies">
                                                <a href="#" title="Pies" data-filter-tags="pies">
                                                    <span class="nav-link-text" data-i18n="nav.home_confia_en_nosotros">Pies</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li id="menu_atencion">
                                        <a href="#" title="Atenciones" data-filter-tags="atenciones">
                                            <span class="nav-link-text" data-i18n="nav.home_videos">Atenciones</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="filter-message js-filter-message bg-success-600"></div>
                    </nav>
                </aside>
                <div class="page-content-wrapper">
                    <!-- BEGIN Page Header -->
                    <header class="page-header" role="banner">
                        <!-- we need this logo when user switches to nav-function-top -->
                        <div class="page-logo">
                            <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                                <span class="page-logo-text mr-1">Panel Administración</span>
                                <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                                <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                            </a>
                        </div>
                        <!-- DOC: nav menu layout change shortcut -->
                        <div class="hidden-md-down dropdown-icon-menu position-relative">
                            <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
                                <i class="ni ni-menu"></i>
                            </a>
                            <ul>
                                <li>
                                    <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation">
                                        <i class="ni ni-minify-nav"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation">
                                        <i class="ni ni-lock-nav"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- DOC: mobile button appears during mobile width -->
                        <div class="hidden-lg-up">
                            <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
                                <i class="ni ni-menu"></i>
                            </a>
                        </div>
                        <div class="ml-auto d-flex">
                            <!-- app user menu -->
                            <div>
                                <a href="#" data-toggle="dropdown" title="{{ Auth::user()->email }}" class="header-icon d-flex align-items-center justify-content-center ml-2">
                                    <i class="fal fa-cog"></i>
                                    <!-- you can also add username next to the avatar with the codes below:
									<span class="ml-1 mr-1 text-truncate text-truncate-header hidden-xs-down">Me</span>
									<i class="ni ni-chevron-down hidden-xs-down"></i> -->
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                                    <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                        <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                                            <div class="info-card-text">
                                                <div class="fs-lg text-truncate text-truncate-lg">{{ Auth::user()->name }}</div>
                                                <span class="text-truncate text-truncate-md opacity-80">{{ Auth::user()->email }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Panel Administración</a></li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                    </ol>
                    <div class="subheader">
                        <h1 class="subheader-title">
                            <i class='subheader-icon fal fa-exclamation-circle'></i> Bienvenido/a
                            <small>
                                Aqui podra administrar a sus pacientes.
                            </small>
                        </h1>
                    </div>

                    <div class="row">
                        <div class="col-xl-12">

                        </div>
                    </div>
                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Shortcuts -->
                    <div class="modal fade modal-backdrop-transparent" id="modal-shortcut" tabindex="-1" role="dialog" aria-labelledby="modal-shortcut" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-top modal-transparent" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <ul class="app-list w-auto h-auto p-0 text-left">
                                        <li>
                                            <a href="/administracion" class="app-list-item text-white border-0 m-0">
                                                <div class="icon-stack">
                                                    <i class="base base-7 icon-stack-3x opacity-100 color-primary-500 "></i>
                                                    <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                                    <i class="fal fa-home icon-stack-1x opacity-100 color-white"></i>
                                                </div>
                                                <span class="app-list-name">
                                                    Home
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Shortcuts -->
                    <!-- BEGIN Color profile -->
                    <!-- this area is hidden and will not be seen on screens or screen readers -->
                    <!-- we use this only for CSS color refernce for JS stuff -->
                    <p id="js-color-profile" class="d-none">
                        <span class="color-primary-50"></span>
                        <span class="color-primary-100"></span>
                        <span class="color-primary-200"></span>
                        <span class="color-primary-300"></span>
                        <span class="color-primary-400"></span>
                        <span class="color-primary-500"></span>
                        <span class="color-primary-600"></span>
                        <span class="color-primary-700"></span>
                        <span class="color-primary-800"></span>
                        <span class="color-primary-900"></span>
                        <span class="color-info-50"></span>
                        <span class="color-info-100"></span>
                        <span class="color-info-200"></span>
                        <span class="color-info-300"></span>
                        <span class="color-info-400"></span>
                        <span class="color-info-500"></span>
                        <span class="color-info-600"></span>
                        <span class="color-info-700"></span>
                        <span class="color-info-800"></span>
                        <span class="color-info-900"></span>
                        <span class="color-danger-50"></span>
                        <span class="color-danger-100"></span>
                        <span class="color-danger-200"></span>
                        <span class="color-danger-300"></span>
                        <span class="color-danger-400"></span>
                        <span class="color-danger-500"></span>
                        <span class="color-danger-600"></span>
                        <span class="color-danger-700"></span>
                        <span class="color-danger-800"></span>
                        <span class="color-danger-900"></span>
                        <span class="color-warning-50"></span>
                        <span class="color-warning-100"></span>
                        <span class="color-warning-200"></span>
                        <span class="color-warning-300"></span>
                        <span class="color-warning-400"></span>
                        <span class="color-warning-500"></span>
                        <span class="color-warning-600"></span>
                        <span class="color-warning-700"></span>
                        <span class="color-warning-800"></span>
                        <span class="color-warning-900"></span>
                        <span class="color-success-50"></span>
                        <span class="color-success-100"></span>
                        <span class="color-success-200"></span>
                        <span class="color-success-300"></span>
                        <span class="color-success-400"></span>
                        <span class="color-success-500"></span>
                        <span class="color-success-600"></span>
                        <span class="color-success-700"></span>
                        <span class="color-success-800"></span>
                        <span class="color-success-900"></span>
                        <span class="color-fusion-50"></span>
                        <span class="color-fusion-100"></span>
                        <span class="color-fusion-200"></span>
                        <span class="color-fusion-300"></span>
                        <span class="color-fusion-400"></span>
                        <span class="color-fusion-500"></span>
                        <span class="color-fusion-600"></span>
                        <span class="color-fusion-700"></span>
                        <span class="color-fusion-800"></span>
                        <span class="color-fusion-900"></span>
                    </p>
                    <!-- END Color profile -->
                </div>
            </div>
        </div>
        <!-- END Page Wrapper -->
        <!-- BEGIN Quick Menu -->
        <!-- to add more items, please make sure to change the variable '$menu-items: number;' in your _page-components-shortcut.scss -->
        <nav class="shortcut-menu d-none d-sm-block">
            <input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
            <label for="menu_open" class="menu-open-button ">
                <span class="app-shortcut-icon d-block"></span>
            </label>
            <a href="#" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Volver Arriba">
                <i class="fal fa-arrow-up"></i>
            </a>
            <a class="menu-item btn" title="Salir" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fal fa-sign-out"></i>
            </a>
            <a href="#" class="menu-item btn" data-action="app-fullscreen" data-toggle="tooltip" data-placement="left" title="Pantalla Completa">
                <i class="fal fa-expand"></i>
            </a>
        </nav>
        <!-- END Quick Menu -->

        <!-- base vendor bundle:
			 DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations
						+ pace.js (recommended)
						+ jquery.js (core)
						+ jquery-ui-cust.js (core)
						+ popper.js (core)
						+ bootstrap.js (core)
						+ slimscroll.js (extension)
						+ app.navigation.js (core)
						+ ba-throttle-debounce.js (core)
						+ waves.js (extension)
						+ smartpanels.js (extension)
						+ src/../jquery-snippets.js (core) -->
        <script src="js/vendors.bundle.js"></script>
        <script src="js/app.bundle.js"></script>
        <script src="js/notifications/sweetalert2/sweetalert2.bundle.js"></script>
        <script src="js/datagrid/datatables/datatables.bundle.js"></script>
        <script src="js/formplugins/summernote/summernote.js"></script>
        <script src="{{ asset('js/modal-loading.js') }}"></script>
        <script>
            var modal;
            function cargando(title,descripcion) {
                var loading = new Loading({
                    direction: 'hor',
                    discription: descripcion,
                    title: title,
                    animationIn: false,
                    animationOut: false,
                    defaultApply: 	true,
                });
                return loading;
            }
        $("#menu_pacientes").click(function(){
            $( "#js-page-content" ).load( "/admin_pacientes", function( response, status, xhr ) {
                if ( status == "error" ) {
                    window.location.replace("/login");
                }
            });
        })

        $("#menu_protocolos").click(function(){
            $( "#js-page-content" ).load( "/admin_protocolos", function( response, status, xhr ) {
                if ( status == "error" ) {
                    window.location.replace("/login");
                }
            });
        })

        $("#menu_personales").click(function(){
            $( "#js-page-content" ).load( "/admin_paciente/"+$("#id_paciente").val(), function( response, status, xhr ) {
                if ( status == "error" ) {
                    window.location.replace("/login");
                }
            });
        })

        $("#menu_ficha_morbido").click(function(){
            $( "#js-page-content" ).load( "/admin_morbido/"+$("#id_paciente").val(), function( response, status, xhr ) {
                if ( status == "error" ) {
                    window.location.replace("/login");
                }
            });
        })

        $("#menu_enfermedad").click(function(){
            $( "#js-page-content" ).load( "/admin_enfermedad/"+$("#id_paciente").val(), function( response, status, xhr ) {
                if ( status == "error" ) {
                    window.location.replace("/login");
                }
            });
        })

        $("#menu_medicamento").click(function(){
            $( "#js-page-content" ).load( "/admin_medicamento/"+$("#id_paciente").val(), function( response, status, xhr ) {
                if ( status == "error" ) {
                    window.location.replace("/login");
                }
            });
        })

        $("#menu_patologia").click(function(){
            $( "#js-page-content" ).load( "/admin_patologia/"+$("#id_paciente").val(), function( response, status, xhr ) {
                if ( status == "error" ) {
                    window.location.replace("/login");
                }
            });
        })

        $("#menu_habito").click(function(){
            $( "#js-page-content" ).load( "/admin_habito/"+$("#id_paciente").val(), function( response, status, xhr ) {
                if ( status == "error" ) {
                    window.location.replace("/login");
                }
            });
        })

        $("#menu_ficha_examen").click(function(){
            $( "#js-page-content" ).load( "/admin_ficha_examen/"+$("#id_paciente").val(), function( response, status, xhr ) {
                if ( status == "error" ) {
                    window.location.replace("/login");
                }
            });
        })

        $("#menu_pies").click(function(){
            $( "#js-page-content" ).load( "/admin_pies/"+$("#id_paciente").val(), function( response, status, xhr ) {
                if ( status == "error" ) {
                    window.location.replace("/login");
                }
            });
        })

        $("#menu_atencion").click(function(){
            $( "#js-page-content" ).load( "/admin_atencion/"+$("#id_paciente").val(), function( response, status, xhr ) {
                if ( status == "error" ) {
                    window.location.replace("/login");
                }
            });
        })

        </script>
        <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support -->
    </body>
</html>
