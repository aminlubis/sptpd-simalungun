<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?php echo APP_TITLE; ?></title>

    <meta name="description" content="<?php echo APP_TITLE; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/font-awesome.css" />

    <!-- page specific plugin styles -->
    <!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/css/AdminLTE.css" class="ace-main-stylesheet" id="main-ace-style" /> -->
    <!-- text fonts -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace-fonts.css" />
    <!-- css date-time -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap-timepicker.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/datepicker.css" />
    <!-- end css date-time -->
    <!-- ace styles -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/css_custom.css" />
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/images/logo.png">
    <!--[if lte IE 9]>
      <link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace-part2.css" class="ace-main-stylesheet" />
    <![endif]-->

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace-ie.css" />
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="<?php echo base_url()?>assets/js/ace-extra.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="<?php echo base_url()?>assets/js/html5shiv.js"></script>
    <script src="<?php echo base_url()?>assets/js/respond.js"></script>
    <![endif]-->
    <!-- timepicker -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap-timepicker.css" />

  </head>

  <style>
    .no-skin .navbar .navbar-toggle {
        background-color: #d25942 !important;
    }
    .navbar .navbar-nav > li > a {
        font-size: 14px !important;
    }

    .navbar .navbar-nav>li {
        border: 1px solid #80808052 !important;
    }

    /* .ace-nav > li > a {
      background-color: #383432 !important;
    } */
    .page-header h1{
      font-size: 12px !important;
    }


  </style>
  <body class="no-skin">

    <!-- #section:basics/navbar.layout -->
    <div id="navbar" class="navbar navbar-default    navbar-collapse       h-navbar ace-save-state" style="background: #0a6960">
    <!-- background: linear-gradient(150deg, #fa1414, #f6eb34c7); -->
			<div class="navbar-container ace-save-state" id="navbar-container">
				<div class="navbar-header pull-left">
          <a href="<?php echo base_url()?>" class="navbar-brand" style="padding-top: 13px !important">
            <small>
              <img src="<?php echo base_url().'assets/images/logo.png'?>" style="width: 34px; margin: -9px 0px -7px;">
              <?php echo APP_TITLE; ?>
            </small>
          </a>

					<button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
						<span class="sr-only">Toggle user menu</span>
						<img src="<?php echo base_url()?>assets/images/logo.png" alt="Jason's Photo">
					</button>

          <button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar" aria-expanded="false">
						<span class="sr-only">Toggle sidebar</span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>
					</button>

				</div>


				<div class="navbar-buttons navbar-header pull-right  navbar-collapse collapse" role="navigation" aria-expanded="false" style="height: 1px;">
					<ul class="nav ace-nav" style="">
            <li>
              <a href="#">
                <i class="ace-icon fa fa-calendar"></i>
                <?php echo date('l, d F Y'); ?> 
              </a>
            </li> 
					</ul>
				</div>

				<nav role="navigation" class="navbar-menu pull-left navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
					
					<!-- <form class="navbar-form navbar-right form-search" role="search">
						<div class="form-group" style="padding-top: 2px">
              <label class="white" style="font-size: 14px"><i class="fa fa-search"></i> Cek NPWP</label>
							<input type="text" placeholder="Masukan No Wajib Pajak" style="width: 200px !important">
						</div>

						<button type="button" class="btn btn-mini btn-info2">
							<i class="ace-icon fa fa-search icon-only bigger-110"></i>
						</button>
					</form> -->
				</nav>
			</div><!-- /.navbar-container -->
		</div>

    <!-- /section:basics/navbar.layout -->
    <div class="main-container" id="main-container">

      <div id="sidebar" class="sidebar      h-sidebar                navbar-collapse collapse          ace-save-state" data-sidebar="true" data-sidebar-scroll="true" data-sidebar-hover="true" style="margin-top: 17px;">
          <script type="text/javascript">
            try{ace.settings.loadState('sidebar')}catch(e){}
          </script>

          <!-- /.sidebar-shortcuts -->

          <div class="nav-wrap-up pos-rel"><div class="nav-wrap"><div style="position: relative; top: 0px; transition-property: top; transition-duration: 0.15s;"><div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
              <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
              </button>

              <button class="btn btn-info">
                <i class="ace-icon fa fa-pencil"></i>
              </button>

              <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
              </button>

              <button class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
              </button>
            </div>

            <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
              <span class="btn btn-success"></span>

              <span class="btn btn-info"></span>

              <span class="btn btn-warning"></span>

              <span class="btn btn-danger"></span>
            </div>
          </div>
          <ul class="nav nav-list">
            <li class="hover">
              <a href="<?php echo base_url().'home'?>">
                <i class="menu-icon fa fa-desktop"></i>
                <span class="menu-text"> Dashboard </span>
              </a>

              <b class="arrow"></b>
            </li>

            <?php if(in_array($this->session->userdata('user')->user_level, array(2))) :?>
            <li class="hover">
              <a href="#" onclick="getMenu('front/Register/form_register/<?php echo $this->session->userdata('user')->noktp?>')" class="dropdown-toggle">
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text">
                  Wajib Pajak
                </span>

                <b class="arrow fa fa-angle-down"></b>
              </a>
            </li>

            <li class="hover">
              <a href="#" onclick="getMenu('objek_pajak/Objek_pajak')" class="dropdown-toggle">
                <i class="menu-icon fa fa-globe"></i>
                <span class="menu-text">
                  Objek Pajak
                </span>
                <b class="arrow fa fa-angle-down"></b>
              </a>
            </li>

            <li class="hover">
              <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text"> S P T P D </span>

                <b class="arrow fa fa-angle-down"></b>
              </a>

              <b class="arrow"></b>

              <ul class="submenu can-scroll ace-scroll scroll-disabled" style="">
                <li class="hover">
                  <a href="#" onclick="getMenu('Sptpd/form')">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Entri e-SPTPD
                  </a>

                  <b class="arrow"></b>
                </li>

                <li class="hover">
                  <a href="#" onclick="getMenu('Sptpd')">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Riwayat Entri SPTPD
                  </a>

                  <b class="arrow"></b>
                </li>
              </ul><div class="scroll-track scroll-detached no-track scroll-thin scroll-margin scroll-visible" style="display: none; top: 69px; left: 183px;"><div class="scroll-bar" style="top: 0px;"></div></div>
            </li>

            <?php endif; ?>

            <?php if(in_array($this->session->userdata('user')->user_level, array(3))) :?>
            
              <li class="hover">
                <a href="#" onclick="getMenu('objek_pajak/Objek_pajak_opd')" class="dropdown-toggle">
                  <i class="menu-icon fa fa-globe"></i>
                  <span class="menu-text">
                    Objek Pajak
                  </span>
                  <b class="arrow fa fa-angle-down"></b>
                </a>
              </li>
              
            <li class="hover">
              <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text"> S P T P D </span>

                <b class="arrow fa fa-angle-down"></b>
              </a>

              <b class="arrow"></b>

              <ul class="submenu can-scroll ace-scroll scroll-disabled" style="">
                <li class="hover">
                  <a href="#" onclick="getMenu('sptpd/Sptpd_opd/form')">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Entri e-SPTPD
                  </a>

                  <b class="arrow"></b>
                </li>

                <li class="hover">
                  <a href="#" onclick="getMenu('sptpd/Sptpd_opd')">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Riwayat Entri SPTPD
                  </a>

                  <b class="arrow"></b>
                </li>
              </ul><div class="scroll-track scroll-detached no-track scroll-thin scroll-margin scroll-visible" style="display: none; top: 69px; left: 183px;"><div class="scroll-bar" style="top: 0px;"></div></div>
            </li>

            <?php endif; ?>

            <?php if(in_array($this->session->userdata('user')->user_level, array(1))) :?>
            <li class="hover">
              <a href="#" onclick="getMenu('Verifikasi')" class="dropdown-toggle">
                <i class="menu-icon fa fa-search"></i>
                <span class="menu-text">
                  Verifikasi Data
                </span>
                <b class="arrow fa fa-angle-down"></b>
              </a>
            </li>

            <li class="hover">
              <a href="#" onclick="getMenu('setting/Tmp_user')" class="dropdown-toggle">
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text">
                  Pengguna
                </span>
                <b class="arrow fa fa-angle-down"></b>
              </a>
            </li>

            <?php endif; ?>

            <?php if(in_array($this->session->userdata('user')->user_level, array(1,2,3))) :?>
            <li class="hover">
              <a href="#" onclick="getMenu('change-password')" class="dropdown-toggle">
                <i class="menu-icon fa fa-lock"></i>
                <span class="menu-text">
                  Ganti Password
                </span>
                <b class="arrow fa fa-angle-down"></b>
              </a>
            </li>

            <li class="hover">
              <a href="<?php echo base_url()?>login/logout">
                <i class="menu-icon fa fa-sign-out"></i>
                <span class="menu-text">
                  Logout
                </span>
                <b class="arrow fa fa-angle-down"></b>
              </a>
            </li>
            <?php endif; ?>

          </ul>
        </div>
      </div>
      <div class="ace-scroll nav-scroll scroll-disabled">
        <div class="scroll-track" style="display: none;">
          <div class="scroll-bar" style="top: 0px; transition-property: top; transition-duration: 0.1s;"></div>
        </div>
        <div class="scroll-content" style=""><div>
      </div>
    </div>
  </div>
</div><!-- /.nav-list -->
			</div>

      <!-- /section:basics/sidebar -->
      <div class="main-content">
        <div class="main-content-inner">
          <!-- /section:basics/content.breadcrumbs -->
          <div class="page-content">
            <div class="page-header">

              <?php if($this->session->userdata('user')->user_level == 2) :?>
              <span>Nomor Wajib Pajak : <br><b><?php echo $profil_wp->npwpd?></b> | <i>registered at <?php echo $this->tanggal->formatDateFormDmy($profil_wp->tgldaftar)?></i></span><br>
              <span style="font-weight: bold; font-size: 16px"><?php echo $profil_wp->nama?> [ <?php echo $profil_wp->noktp?> ]</span>
              <!-- hidden -->
              <input type="hidden" name="namawajibpajak" value="<?php echo $profil_wp->nama?>">
              <?php else :
                $level_name = ($this->session->userdata('user')->user_level == 1)?'Petugas Pajak':'OPD';
              ?>
                <span style="font-size: 16px; font-weight: bold"><?php echo $this->session->userdata('user')->fullname?></span> <br>[<?php echo $level_name?>]
                
              <?php endif; ?>
            </div>
            
              <!-- PAGE CONTENT BEGINS -->
              <div id="page-area-content">
                <div class="row">
                  <!-- content here -->
                    
                    <div id="content_graph"></div>
                    
                  <!-- end content here -->
                </div>
              </div>
              <!-- PAGE CONTENT ENDS -->
              
          </div><!-- /.page-content -->
        </div>
      </div><!-- /.main-content -->

      <div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder"><?php echo APP_TITLE; ?></span> © 2022 <?php echo (date('Y') == 2022) ? '' : ' - '.date('Y')?>
						</span>
					</div>
				</div>
			</div>

      <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
      </a>

    </div><!-- /.main-container -->

    <div id="proses-loading">
        <div class="loading-content">
            <img width="125px" src="<?php echo base_url('assets/images/logo.png') ?>" alt="<?php echo APP_TITLE; ?>">
            <br>
            <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
            <br>
            <span class="">Transaksi sedang di proses harap menunggu</span>
        </div>
    </div>

    <!-- GLOBAL MODAL -->

    <div id="globalModalView" class="modal fade" tabindex="-1">

      <div class="modal-dialog" style="overflow-y: scroll; max-height:90%;  margin-top: 50px; margin-bottom:50px;width:90%">

        <div class="modal-content">

          <div class="modal-header">

            <div class="table-header">

              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">

                <span class="white">&times;</span>

              </button>

              <span id="text_title">TITLE</span>

            </div>

          </div>

          <div class="modal-body">

            <div id="global_modal_content_detail"></div>

          </div>

        </div><!-- /.modal-content -->

      </div><!-- /.modal-dialog -->

    </div>

    <div id="globalModalViewMedium" class="modal fade" tabindex="-1">

      <div class="modal-dialog" style="overflow-y: scroll; max-height:70%;  margin-top: 50px; margin-bottom:50px;width:50%">

        <div class="modal-content">

          <div class="modal-header">

            <div class="table-header">

              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">

                <span class="white">&times;</span>

              </button>

              <span id="text_title_medium">TITLE</span>

            </div>

          </div>

          <div class="modal-body">

            <div id="global_modal_content_detail_medium"></div>

          </div>

        </div><!-- /.modal-content -->

      </div><!-- /.modal-dialog -->

    </div>
    <!-- maps -->
    <!--[if !IE]> -->
    
    <script type="text/javascript">
      window.jQuery || document.write("<script src='<?php echo base_url()?>/assets/js/jquery.js'>"+"<"+"/script>");
    </script>

    <script type="text/javascript">
      if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url()?>/assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
    </script>
    <script src="<?php echo base_url()?>assets/js/app.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap.js"></script>

    <script src="<?php echo base_url()?>assets/js/bootstrap-multiselect.js"></script>

    <!-- page specific plugin scripts -->


    <script src="<?php echo base_url()?>/assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url()?>/assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url()?>/assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
    <script src="<?php echo base_url()?>/assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>
    
    <!-- ace scripts -->
    <script src="<?php echo base_url()?>assets/js/ace/elements.scroller.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/elements.colorpicker.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/elements.fileinput.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/elements.typeahead.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/elements.wysiwyg.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/elements.spinner.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/elements.treeview.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/elements.wizard.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/elements.aside.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.ajax-content.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.touch-drag.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.sidebar.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.sidebar-scroll-1.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.submenu-hover.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.widget-box.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.settings.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.settings-rtl.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.settings-skin.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.widget-on-reload.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.searchbox-autocomplete.js"></script>

    <!-- achtung loader -->
    <link href="<?php echo base_url()?>assets/achtung/ui.achtung-mins.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo base_url()?>assets/achtung/ui.achtung-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/achtung/achtung.js"></script> 

    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.form.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-validation/dist/jquery.validate.js"></script>
    
    <script type="text/javascript">
        ace.vars['base'] = '..';
        App.setAppUrl("<?php echo base_url() ?>")
    </script>
    <script src="<?php echo base_url()?>assets/js/ace/elements.onpage-help.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.onpage-help.js"></script>

    <!-- form date-time-->
    <script src="<?php echo base_url()?>assets/js/date-time/bootstrap-timepicker.js"></script>
    <script src="<?php echo base_url()?>assets/js/date-time/bootstrap-datepicker.js"></script>
    <!-- end form date-time-->
    
    
    <!-- highchat modules -->
    <script src="<?php echo base_url()?>assets/chart/highcharts.js"></script>
    <script src="<?php echo base_url()?>assets/chart/modules/exporting.js"></script>
    <script src="<?php echo base_url()?>assets/chart/modules/script.js"></script>
    <!-- end highchat modules -->
    
    <script src="<?php echo base_url()?>assets/js/custom/menu_load_page.js"></script>

    <script type="text/javascript">
      
      
      function show_modal(url, title){

          preventDefault();
          
          $('#text_title').text(title);

          $('#global_modal_content_detail').load(url); 

          $("#globalModalView").modal();
          
      }

      function PopupCenter(url, title, w, h) {
          // Fixes dual-screen position                         Most browsers      Firefox
          var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
          var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

          var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
          var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

          var left = ((width / 2) - (w / 2)) + dualScreenLeft;
          var top = ((height / 2) - (h / 2)) + dualScreenTop;
          var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

          // Puts focus on the newWindow
          if (window.focus) {
              newWindow.focus();
          }

          /*custom hide after show popup*/
          $('#modalCetakTracer').modal('hide');
      }

      function preventDefault(e) {
        e = e || window.event;
        if (e.preventDefault)
            e.preventDefault();
        e.returnValue = false;  
      }


      function getFormattedDate(paramsDate) {
          var date = new Date(paramsDate);
          let year = date.getFullYear();
          let month = (1 + date.getMonth()).toString().padStart(2, '0');
          let day = date.getDate().toString().padStart(2, '0');        
          return month + '/' + day + '/' + year;
      }

      function getFormatSqlDate(paramsDate) {
          var date = new Date(paramsDate);
          let year = date.getFullYear();
          let month = (1 + date.getMonth()).toString().padStart(2, '0');
          let day = date.getDate().toString().padStart(2, '0');        
          return year + '-' + month + '-' + date;
      }

      function formatMoney(number){
        money = new Intl.NumberFormat().format(number);
        format = 'Rp. ' +money+ ',-';
        return format;
      }

      function sumClass(classname){

        var sum = 0;

        $("."+classname).each(function() {
            var val = $.trim( $(this).val() );
            
            if ( val ) {
                val = parseFloat( val.replace( /^\$/, "" ) );
            
                sum += !isNaN( val ) ? val : 0;
            }
        });


        return sum;
      }

    </script>

    <!-- disabled inspect  -->
    <?php if( ENVIRONMENT == 'production') :?>
    <script> 
      document.addEventListener('contextmenu', event=> event.preventDefault()); 
      document.onkeydown = function(e) { 
      if(event.keyCode == 123) { 
      return false; 
      } 
      if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){ 
      return false; 
      } 
      if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){ 
      return false; 
      } 
      if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){ 
      return false; 
      } 
      } 
    </script> 
    <?php endif; ?>
    

  </body>
</html>
