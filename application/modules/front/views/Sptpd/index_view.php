<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?php echo $app->header_title?></title>

    <meta name="description" content="" />
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
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/images/LOGO_BU.png">
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

  </style>
  <body class="no-skin">
    <!-- #section:basics/navbar.layout -->
    <div id="navbar" class="navbar navbar-default    navbar-collapse       h-navbar ace-save-state" style="background: url('assets/images/<?php echo $app->style_header_color?>.png');">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<div class="navbar-header pull-left">
          <a href="<?php echo base_url()?>" class="navbar-brand">
            <small>
              <img src="<?php echo PATH_IMG_DEFAULT.$app->app_logo?>" height="100px" style="margin: -59px -23px -56px">
            </small>
          </a>

					<button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
						<span class="sr-only">Toggle user menu</span>
						<img src="<?php echo base_url()?>assets/images/LOGO_BU.png" alt="Jason's Photo">
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
					<ul class="nav navbar-nav">

						<li>
							<a href="#" onclick="getMenu('front/Register/form_register')">
              <i class="ace-icon fa fa-globe bigger-120"></i> 
								Website
							</a>
						</li>

            <li>
							<a href="#" onclick="getMenu('front/Register/form_cek_kta')">
              <i class="ace-icon fa fa-search bigger-120"></i> 
								Cek Masa Aktif Anggota
							</a>
						</li>

            <li>
							<a href="<?php echo base_url().'login'?>" target="_blank">
              <i class="ace-icon fa fa-lock bigger-120"></i> 
								Login Anggota
							</a>
						</li>

					</ul>

					<!-- <form class="navbar-form navbar-left form-search" role="search">
						<div class="form-group">
              <label class="">Cek Masa Aktif Anggota</label>
							<input type="text" placeholder="Masukan No KTA" style="width: 100px !important">
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
      <!-- /section:basics/sidebar -->
      <div class="main-content">
        <div class="main-content-inner">
          <!-- /section:basics/content.breadcrumbs -->
          <div class="page-content">
          
              <!-- PAGE CONTENT BEGINS -->
              <div id="page-area-content">
                <div class="row">
                  <!-- content here -->
                    <div class="page-header">
                        <h1>
                          <?php echo $title?>
                          <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            <?php echo isset($subtitle)?$subtitle:''?>
                          </small>
                        </h1>
                      </div>
          
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
							<span class="blue bolder">BHAYANGKARA UTAMA</span>
							| Sistem Informasi Keanggotaan © 2020-<?php echo date('Y')?>
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
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
            <img width="125px" src="<?php echo base_url('assets/images/logo.png') ?>" alt="Logo RSSM">
            <br>
            <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
            <br>
            <span class="">Transaksi sedang di proses harap menunggu</span>
        </div>
    </div>

    <div id="ModalSuccess" class="modal fade" tabindex="-1">

      <div class="modal-dialog" style="overflow-y: scroll; max-height:50%;  margin-top: 50px; margin-bottom:50px;width:50%;">

        <div class="modal-content">

          <div class="modal-header">

            <div class="table-header">

              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">

                <span class="white">&times;</span>

              </button>

              <span id="result_text_create_sep">SUKSES</span>

            </div>

          </div>

          <div class="modal-body">

            <div class="alert alert-succcess">
              BERHASIL
            </div>

          </div>

        </div><!-- /.modal-content -->

      </div><!-- /.modal-dialog -->

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

      function hitung_usia(DOB){

        var today = new Date(); 
          var d = DOB;
          if (!/\d{4}\-\d{2}\-\d{2}/.test(d)) {   // check valid format
          return false;
          }
          d = d.split("-");

          var byr = parseInt(d[0]); 
          var nowyear = today.getFullYear();
          if (byr >= nowyear || byr < 1900) {  // check valid year
          return false;
          }

          var bmth = parseInt(d[1],10)-1;  
          if (bmth<0 || bmth>11) {  // check valid month 0-11
          return false;
          }

          var bdy = parseInt(d[2],10); 
          if (bdy<1 || bdy>31) {  // check valid date according to month
          return false;
          }

          var age = nowyear - byr;
          var nowmonth = today.getMonth();
          var nowday = today.getDate();
          if (bmth > nowmonth) {age = age - 1}  // next birthday not yet reached
          else if (bmth == nowmonth && nowday < bdy) {age = age - 1}

          return age;
          //alert('You are ' + age + ' years old'); 
      }

      function getAge(paramsDate, style) {

        var dateString = getFormattedDate(paramsDate);

        var now = new Date();
        var today = new Date(now.getYear(),now.getMonth(),now.getDate());

        var yearNow = now.getYear();
        var monthNow = now.getMonth();
        var dateNow = now.getDate();

        var dob = new Date(dateString.substring(6,10),
                           dateString.substring(0,2)-1,                   
                           dateString.substring(3,5)                  
                           );

        var yearDob = dob.getYear();
        var monthDob = dob.getMonth();
        var dateDob = dob.getDate();
        var age = {};
        var ageString = "";
        var yearString = "";
        var monthString = "";
        var dayString = "";


        yearAge = yearNow - yearDob;

        if (monthNow >= monthDob)
          var monthAge = monthNow - monthDob;
        else {
          yearAge--;
          var monthAge = 12 + monthNow -monthDob;
        }

        if (dateNow >= dateDob)
          var dateAge = dateNow - dateDob;
        else {
          monthAge--;
          var dateAge = 31 + dateNow - dateDob;

          if (monthAge < 0) {
            monthAge = 11;
            yearAge--;
          }
        }

        age = {
            years: yearAge,
            months: monthAge,
            days: dateAge
            };

        if ( age.years > 1 ) yearString = " thn";
        else yearString = " thn";
        if ( age.months> 1 ) monthString = " bln";
        else monthString = " bln";
        if ( age.days > 1 ) dayString = " hr";
        else dayString = " hr";


        if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )
          ageString = age.years + yearString + ", " + age.months + monthString + ", " + age.days + dayString + " ";
        else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
          ageString = "" + age.days + dayString + " ";
        else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
          ageString = age.years + yearString + " Happy Birthday!!";
        else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
          ageString = age.years + yearString + ",  " + age.months + monthString + " ";
        else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
          ageString = age.months + monthString + ", " + age.days + dayString + " ";
        else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
          ageString = age.years + yearString + ", " + age.days + dayString + " ";
        else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
          ageString = age.months + monthString + " ";
        else ageString = "Oops! Could not calculate age!";

        if(style==1){
          return ageString;
        }else{
          return age.years;
        }

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

      function changeDiscount(field, id){
        //alert(field); return false;
        /*harga * diskon*/
        var harga_awal = $('#'+field+'_'+id).val();
        var discount = $('#diskon_'+field+'_'+id).val();
        /*modulus*/
        

        if(discount > 100){

          var modulus = discount % 100;
          disc = harga_awal * modulus/100;
          console.log(disc);
          var last_price = parseInt(harga_awal) + parseInt(disc);

        }else{
          disc = harga_awal * discount/100;
          var last_price = harga_awal - disc;
        }

        $('#total_diskon_'+field+'_'+id).val( last_price );
        format = formatMoney(last_price);
        $('#text_total_diskon_'+field+'_'+id).text( format );
        /*sum class name*/
        sum = sumClass('total_diskon_'+id+'');
        sumFormat = formatMoney(sum);
        $('#total_biaya_'+id+'').text( sumFormat );
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

      function submitUpdateTransaksi(kode_trans_pelayanan){

        preventDefault();
        achtungShowLoader();
        $.ajax({
            url: "pelayanan/Pl_pelayanan/updateBilling?kode="+kode_trans_pelayanan+"",
            data: $('#form_update_billing_'+kode_trans_pelayanan+'').serialize(),            
            dataType: "json",
            type: "POST",
            complete: function (xhr) {
              var data=xhr.responseText;  
              var jsonResponse = JSON.parse(data);  
              if(jsonResponse.status === 200){  
                $.achtung({message: jsonResponse.message, timeout:5});
                reset_table();
              }else{          
                $.achtung({message: jsonResponse.message, timeout:5});  
              } 
              achtungHideLoader();
            }
        });

      }

    </script>

  </body>
</html>
