<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?php echo $app->app_name?></title>

    <meta name="description" content="top menu &amp; navigation" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- css default for blank page -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/font-awesome.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace-fonts.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/AdminLTE.css" class="ace-main-stylesheet" id="main-ace-style" />
    <script src="<?php echo base_url()?>assets/js/ace-extra.js"></script>
    <!-- css default for blank page -->
    <!-- Favicon -->

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery-ui.custom.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.gritter.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/select2.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/datepicker.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap-editable.css" />

    <link rel="shortcut icon" href="<?php echo PATH_IMG_DEFAULT.$app->app_logo?>">
  </head>

  <body class="no-skin">
    <!-- #section:basics/navbar.layout -->
    <div id="navbar" class="navbar navbar-default navbar-collapse h-navbar" style="background: gold">
      <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
      </script>

      <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
          <!-- #section:basics/navbar.layout.brand -->
          <a href="#" class="navbar-brand">
            <small>
              <img src="<?php echo PATH_IMG_DEFAULT.$app->app_logo?>" width="200px" style="margin: -16px -7px -14px"> &nbsp;
              <?php //echo $app->app_name?>
            </small>
          </a>

          <!-- /section:basics/navbar.layout.brand -->

          <!-- #section:basics/navbar.toggle -->
          <button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
            <span class="sr-only">Toggle user menu</span>
            <img src="<?php echo isset($this->session->userdata('user')->path_foto) ? base_url().PATH_PHOTO_PROFILE_DEFAULT.$this->session->userdata('user')->path_foto:base_url().'assets/avatars/user.jpg'?>" alt="<?php echo $this->session->userdata('user')->fullname?>'s Photo"/>

            <!-- <img src="<?php echo base_url()?>assets/avatars/avatar5.png" alt="<?php echo $this->session->userdata('user')->username?>" /> -->
          </button>

          <!-- <button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
          </button> -->

          <!-- /section:basics/navbar.toggle -->
        </div>

        <!-- #section:basics/navbar.dropdown -->
        <div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
          <ul class="nav ace-nav">
            <!-- #section:basics/navbar.user_menu -->
            <li class="green">
              <a href="#">
                <i class="ace-icon fa fa-user"></i>
                <?php echo $this->session->userdata('user')->username; ?>
              </a>
            </li>

            <li class="green">
              <a href="#">
                <i class="ace-icon fa fa-calendar"></i>
                <?php echo date('l, d F Y'); ?> 
              </a>
            </li>

            <li class="green user-min">
              <a data-toggle="dropdown" href="#" class="dropdown-toggle">
              <img class="nav-user-photo" src="<?php echo isset($this->session->userdata('user')->path_foto) ? base_url().PATH_PHOTO_PROFILE_DEFAULT.$this->session->userdata('user')->path_foto:base_url().'assets/avatars/user.jpg'?>" alt="<?php echo $this->session->userdata('user')->fullname?>'s Photo" height="95%"/>
                <span class="user-info">
                  <small>Welcome,</small>
                  <i><?php echo $this->session->userdata('user')->username?></i>
                </span>

                <i class="ace-icon fa fa-caret-down"></i>
              </a>

              <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
              
                <!-- <li>
                  <a href="#" onclick="getMenu('setting/Tmp_user/account_setting')">
                    <i class="ace-icon fa fa-key"></i>
                    Account
                  </a>
                </li>

                <li>
                  <a href="#" onclick="getMenu('setting/Tmp_user/form_update_profile')">
                    <i class="ace-icon fa fa-user"></i>
                    Profile
                  </a>
                </li> -->

                <li>
                  <a href="<?php echo base_url().'login/logout'?>">
                    <i class="ace-icon fa fa-power-off"></i>
                    Logout
                  </a>
                </li>
              </ul>
            </li>

            <!-- /section:basics/navbar.user_menu -->
          </ul>
        </div>

        <!-- /section:basics/navbar.dropdown -->
        <nav role="navigation" class="navbar-menu pull-left collapse navbar-collapse">
          <!-- #section:basics/navbar.nav -->
          <ul class="nav navbar-nav">


            <li>
              <a href="#" style="font-size: 16px; font-weight: bold; color: black">
                Aplikasi E-Performance
              </a>
            </li>
            
          </ul>

        </nav>
      </div><!-- /.navbar-container -->
    </div>

    <!-- /section:basics/navbar.layout -->
    <div class="main-container" id="main-container">
      <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
      </script>

      <!-- /section:basics/sidebar.horizontal -->
      <div class="main-content">
        <div class="main-content-inner">
          <!-- #section:basics/content.breadcrumbs -->
          <?php
            $arr_color_breadcrumbs = array('#f4ae11');
            shuffle($arr_color_breadcrumbs);
          ?>
          <div class="breadcrumbs" id="breadcrumbs" style="background-color:<?php echo array_shift($arr_color_breadcrumbs)?>">
            <script type="text/javascript">
              try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>
          </div>
          <div class="page-content">
            
            <div class="row">

              <!-- modul -->
              <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <!-- MODULE MENU -->
                
                  <?php 
                    foreach($modul as $key_row=>$rows_m) :
                      // $arr_color[$key_row] = array('bg-red','bg-yellow','bg-aqua','bg-blue','bg-light-blue','bg-green','bg-navy','bg-teal','bg-olive','bg-lime','bg-orange','bg-fuchsia','bg-purple','bg-maroon','bg-black'); 
                      $arr_color[$key_row] = array('bg-navy'); 
                      $arr_color_title = array('grey'); 
                    shuffle($arr_color[$key_row]);
                    shuffle($arr_color_title);

                  ?>
                    <div class="row">
                    <h3 class="header smaller lighter <?php echo array_shift($arr_color_title)?>">
                        <?php echo $rows_m['group_modul_name']?> 
                      </h3>
                      <?php foreach($rows_m['modul'] as $row_modul) : ?>
                        <div class="col-lg-2 col-xs-6" style="margin-top:-10px">
                          <!-- small box -->
                          <div class="small-box bg-navy">
                            <div class="inner">
                              <h3 style="font-size:16px"><?php echo strtoupper($row_modul->name)?></h3>
                              <p style="font-size:12px"><?php echo $row_modul->title?></p>
                            </div>
                            <div class="icon" style="margin-top:-10px">
                              <i class="<?php echo $row_modul->icon?>"></i>
                            </div>
                            <?php 
                              if($row_modul->is_new_tab=='N'){
                                echo '<a href="'.base_url().'dashboard?mod='.$row_modul->modul_id.'" class="small-box-footer">Selengkapnya  <i class="fa fa-arrow-circle-right"></i></a>';
                              }else{
                                echo '<a href="'.$row_modul->link_on_new_tab.'" target="_blank" class="small-box-footer">Selengkapnya  <i class="fa fa-arrow-circle-right"></i></a>';
                              }
                            ?>
                            
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  <?php endforeach; ?>
                <!-- END MODULE MENU -->

                <!-- PAGE CONTENT ENDS -->
              </div><!-- /.col -->

              <!-- end modul -->
              <div class="col-xs-12"> 
                  
                  <div class="row">
                    <form class="form-horizontal" method="post" id="form_default" action="<?php echo site_url('perencanaan/T_renja/process')?>" enctype="multipart/form-data">
                      
                      <p><b>PENCARIAN DATA</b></p>

                      <div class="form-group">
                        <label class="control-label col-md-1">Unit Kerja</label>
                        <div class="col-md-7">
                          <?php echo $this->master->custom_selection(array('table'=>'m_work_unit', 'where'=>array('is_active'=>'Y'), 'id'=>'wu_id', 'name' => 'wu_name'), $unit ,'wu_id','wu_id','chosen-slect form-control','','');?>
                        </div>
                        <div class="col-md-2" style="margin-left: -1.5%">
                            <?php echo $this->master->get_tahun( $current_year ,'renja_year','renja_year','form-control','','' ); ?>
                        </div>
                        <div class="col-md-1" style="margin-left: -1.5%">
                          <button type="button" id="btnSave" name="submit" onclick="loadDefaultContent()" class="btn btn-sm btn-info">
                              <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                              Tampilkan Data
                          </button>
                        </div>
                      </div>

                    </form>
                  </div>
                  <hr>
                  <center><b style="font-size: 18px">CAPAIAN INDIKATOR KINERJA <br>UNIT KERJA <span id="unit_title"></span> TAHUN <span id="year_selected"></span><br><span id="select_month">s/d BULAN <?php echo strtoupper($this->tanggal->getBulan(date('m')))?></span></b></center>
                  <div id="default_content"></div>

              </div>
              
            </div><!-- /.row -->

          </div><!-- /.page-content -->
        </div>
      </div><!-- /.main-content -->
      
      <div id="globalModalViewMedium" class="modal fade" tabindex="-1">

        <div class="modal-dialog" style="overflow-y: scroll; max-height:70%;  margin-top: 50px; margin-bottom:50px;width:70%">

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
      
      <div class="footer">
        <div class="footer-inner">
          <!-- #section:basics/footer -->
          <div class="footer-content">
            <span class="bigger-120">
              <?php echo $app->footer?>
            </span>
          </div>

          <!-- /section:basics/footer -->
        </div>
      </div>

      <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
      </a>
    </div><!-- /.main-container -->

    <!-- basic scripts -->

    <!--[if !IE]> -->
    <script type="text/javascript">
      window.jQuery || document.write("<script src='<?php echo base_url()?>assets/js/jquery.js'>"+"<"+"/script>");
    </script>

    <!-- <![endif]-->

    <!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='../assets/js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->
    <script type="text/javascript">
      if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url()?>assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
    </script>
    <script src="<?php echo base_url()?>assets/js/bootstrap.js"></script>

    <!-- page specific plugin scripts -->

    <!--[if lte IE 8]>
      <script src="<?php echo base_url()?>assets/js/excanvas.js"></script>
    <![endif]-->
    <script src="<?php echo base_url()?>assets/js/jquery-ui.custom.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.ui.touch-punch.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.gritter.js"></script>
    
    <!-- achtung loader -->
    <link href="<?php echo base_url()?>assets/achtung/ui.achtung-mins.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo base_url()?>assets/achtung/ui.achtung-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/achtung/achtung.js"></script> 

    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.form.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-validation/dist/jquery.validate.js"></script>

    <!-- the following scripts are used in demo only for onpage help and you don't need them -->
    <!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace.onpage-help.css" />

    <script type="text/javascript"> ace.vars['base'] = '..'; </script>
    <script src="<?php echo base_url()?>assets/js/ace/elements.onpage-help.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.onpage-help.js"></script> -->
    <script src="<?php echo base_url()?>assets/js/custom/menu_load_page.js"></script>
    <script src="<?php echo base_url()?>assets/js/date-time/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/datepicker.css" />

    <script>

      jQuery(function($) {

        $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
          $(this).prev().focus();
        });

      });

      $(document).ready(function(){
        
        if( $('#renstra').val() != '' || $('#wu_id').val() != '' || $('#renja_year').val() != '' ){
          loadDefaultContent();
        }

        $('select[name="renstra_id"]').change(function () {
            if ($(this).val()) {
              $.getJSON("perencanaan/T_renstra/get_periode_renstra?renstra_id=" + $(this).val(), '', function (data) {
                  $('#renja_year option').remove();
                  $('<option value="">-Pilih Tahun-</option>').appendTo($('#renja_year'));
                  $.each(data, function (i, o) {
                      $('<option value="' + o.ry_year + '">' + o.ry_year + '</option>').appendTo($('#renja_year'));
                  });
              });
            } else {
              $('#renja_year option').remove()
            }
        });

      })

      function loadDefaultContent(){
            
            var year_existing = <?php echo date('Y')?>;
            $('#unit_title').text( $( "#wu_id option:selected" ).text() );
            if( year_existing == $('#renja_year').val() ){
              $('#select_month').text( 's/d BULAN <?php echo strtoupper($this->tanggal->getBulan(date('m')))?>' );
            }else{
              $('#select_month').text('');
              
            }
            $('#year_selected').text( $( "#renja_year option:selected" ).text() );

            $('#default_content').load('main/Main/load_default_content?renstra='+$('#renstra_id').val()+'&unit='+$('#wu_id').val()+'&tahun='+$('#renja_year').val()+'');

            // $('#default_content').load('<?php echo base_url()?>front/Capaian/load_default_content?renstra='+$('#renstra_id').val()+'&unit='+$('#wu_id').val()+'&tahun='+$('#renja_year').val()+'');
        }

      // function loadDefaultContent(){
      //   $('#default_content').load('main/Main/load_default_content?renstra='+$('#renstra_id').val()+'&unit='+$('#wu_id').val()+'&tahun='+$('#renja_year').val()+'');
      // }

      function exc_my_account() {
        $('#form_tmp_user').submit();
        return false;
      }

      function exc_update_profile() {
        $('#form_update_profile').submit();
        return false;
      }

      function show_modal_medium(url, title){  
        preventDefault();
        $('#text_title_medium').text(title);
        $('#global_modal_content_detail_medium').load(url); 
        $("#globalModalViewMedium").modal();
      }

      function preventDefault(e) {
        e = e || window.event;
        if (e.preventDefault)
            e.preventDefault();
        e.returnValue = false;  
      }

      
    </script>


    

    
  </body>
</html>
