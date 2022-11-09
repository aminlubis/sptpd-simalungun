
<div class="main-container">
  <div class="main-content">
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1">
      <div class="login-container" style="padding-top: 0px">
        <div class="space-6"></div>
          <div class="position-relative">
              <div id="login-box" class="login-box visible widget-box no-border">
                  <center>
                    <img src="<?php echo base_url()?>assets/images/logo.png" width="150px"><br>
                    <br>
                    <div class="social-or-login center">
                      <span class="bigger-110" ><i>Aplikasi e-SPTPD</i></span><br>
                      <span>Kab. Simalungun, Sumatera Utara</span>
                    </div>
                  </center>

                  <div class="widget-body" style="border: 1px solid grey;margin-top: 32px;">
                      <div class="widget-main">
                    <!-- <center></center> -->
                    <h4 class="header blue lighter bigger">
                      <i class="ace-icon fa fa-lock green"></i>
                      Login
                    </h4>
                    <div class="space-6"></div>
                    <form method="post" action="<?php echo base_url().'login/process'?>" id="form-login">
                      <fieldset>
                        <label class="block clearfix">
                          <label style="font-weight: bold">Login sebagai :</label><br>
                          <span class="block input-icon input-icon-right">
                            <select class="form-control" name="user_level">
                              <option value="">-Login Sebagai-</option>
                              <option value="2">Wajib Pajak</option>
                              <option value="1">Petugas Pajak</option>
                            </select>
                            <i class="ace-icon fa fa-user"></i>
                          </span>
                        </label>

                        <label class="block clearfix">
                        <label style="font-weight: bold">Email/Username :</label><br>
                          <span class="block input-icon input-icon-right">
                            <input type="text" class="form-control" placeholder="Username" name="username" id="username" value=""/>
                            <i class="ace-icon fa fa-envelope"></i>
                          </span>
                        </label>

                        <label class="block clearfix">
                        <label style="font-weight: bold">Password :</label><br>
                          <span class="block input-icon input-icon-right">
                            <input type="password" class="form-control" placeholder="Password" name="password" id="password" value=""/>
                            <i class="ace-icon fa fa-key"></i>
                          </span>
                        </label>

                        <div class="space"></div>

                        <div class="clearfix">
                          <label class="inline">
                            <input type="checkbox" class="ace" />
                            <span class="lbl"> Ingatkan saya</span>
                          </label>

                          <input type="button" id="button-login" value="Masuk" class="width-35 pull-right btn btn-sm btn-primary" >

                        </div>
                        <div class="space-4"></div>
                      </fieldset>
                    </form>
                    <br>
                  
                    <div class="space-6"></div>
                  </div><!-- /.widget-body -->

              <div class="toolbar clearfix" style="background: black">
                  <div style="width:100% !important; text-align:center; font-size:11px;color:white;padding-top:15px">
                    <i class="fa fa-clock"></i><span id='ct6' style=" font-size: 16px;" ></span>
                  </div>
                </div>
            </div><!-- /.login-box -->

          </div><!-- /.position-relative -->

          </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.main-content -->
</div><!-- /.main-container -->

<script>
      function display_ct6() {
        var x = new Date()
        var ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';
        hours = x.getHours( ) % 12;
        hours = hours ? hours : 12;
        var x1=x.getMonth() + 1+ "/" + x.getDate() + "/" + x.getFullYear(); 
        x1 = x1 + " - " +  hours + ":" +  x.getMinutes() + ":" +  x.getSeconds() + ":" + ampm;
        document.getElementById('ct6').innerHTML = x1;
        display_c6();
      }
      function display_c6(){
        var refresh=1000; // Refresh rate in milli seconds
        mytime=setTimeout('display_ct6()',refresh)
      }
      display_c6()
      </script>
      
<script>
  
  $('document').ready(function() {  

    /*========== PROCESS LOGIN ================*/
    $("#form-login").validate({focusInvalid:true});     
    $( "#username" )
      .keypress(function(event) {
        var keycode =(event.keyCode?event.keyCode:event.which); 
        if(keycode ==13){
          event.preventDefault();
          if($(this).valid()){
            $('#password').focus();
          }
          return false;       
        }
    });
    
    $( "#password" )
      .keypress(function(event) {
        var keycode =(event.keyCode?event.keyCode:event.which); 
        if(keycode ==13){
          if($("#form-login").valid()) {  
            $('#form-login').ajaxForm({
              beforeSend: function() {
                achtungShowLoader();
              },
              uploadProgress: function(event, position, total, percentComplete) {
              },
              complete: function(xhr) {     
                var data=xhr.responseText;
                var jsonResponse = JSON.parse(data);

                if(jsonResponse.status === 200){
                  window.location = '<?php echo base_url().'home'?>';
                }else{
                  $.achtung({message: jsonResponse.message, timeout:5, className: 'achtungFail'});
                }
                achtungHideLoader();
              }

            });
          }
          $("#form-login").submit();
        }
    });
    
    $( "#button-login" )
      .on("click",function(event) {
        var keycode =(event.keyCode?event.keyCode:event.which); 
          if($("#form-login").valid()) {  
            $('#form-login').ajaxForm({
              beforeSend: function() {
                achtungShowLoader();
              },
              complete: function(xhr) {  
                //alert(xhr.responseText); return false;
                var data=xhr.responseText;
                var jsonResponse = JSON.parse(data);

                if(jsonResponse.status === 200){
                  window.location = '<?php echo base_url().'home'?>';
                }else{
                  $.achtung({message: jsonResponse.message, timeout:5, className: 'achtungFail'});
                }
                achtungHideLoader();
              }
            });
          }
          $("#form-login").submit();
        
    });
    
    $("#form-login input:text").first().focus();

    /*========== END PROCESS LOGIN ================*/
    
  });

</script>