
<div class="main-container">
  <div class="main-content">
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1">
        <div class="login-container" style="padding-top: 100px">

          <div class="center">
            <h1>
              <!-- <img src="<?php echo PATH_IMG_DEFAULT.$profile_apps->app_logo?>" width="100%"> -->
            </h1>
            <!-- <h3 class="dark" id="id-text" style="font-size: 14px; margin-top: -5px; color: #213a6d  !important; font-weight: bold"><?php echo $profile_apps->app_name?><br><small></small></h3> -->
            <!-- <h4 class="dark" id="company-text" style="font-size: 24px;">Dashboard Admin</h4> -->
          </div>
          <div class="space-6"></div>
          <div class="position-relative">
            <div id="login-box" class="login-box visible widget-box">
              <div class="widget-body">
                
                <div class="widget-main">
                  <img src="" width="100%">
                  <h4 class="header blue lighter bigger">
                    <i class="ace-icon fa fa-lock blue"></i>
                    FORM LOGIN
                  </h4>
                  <div class="space-6"></div>
                  <form method="post" action="<?php echo base_url().'index.php/login/process'?>" id="form-login">
                    <fieldset>
                      <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                          <input type="text" class="form-control" placeholder="Username" name="username" id="username" value="<?php echo set_value('username')?>" />
                          <i class="ace-icon fa fa-user"></i>
                          <?php echo form_error('username'); ?>
                        </span>
                      </label>

                      <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                          <input type="password" class="form-control" placeholder="Password" name="password" id="password" value="<?php echo set_value('password')?>" />
                          <i class="ace-icon fa fa-lock"></i>
                          <?php echo form_error('password'); ?>
                        </span>
                      </label>

                      <!-- <label for='message'>Masukan kode dibawah ini </label>
                      <center>
                        <img src="<?php echo base_url().'assets/captcha/captcha.php?rand='.rand().''?>" id="captchaimg" width="200px"> -->
                        <!-- <p id="captImg"><?php echo $captchaImg; ?></p>
                      </center>

                      <br>
                      <input type="text" class="form-control" placeholder="Validation code" name="captcha_code" id="captcha_code" value="" />
                      <?php echo form_error('captcha_code'); ?>
                      <br>
                      

                      Tidak dapat melihat gambar? Klik <a href="javascript:void(0);" class="refreshCaptcha" >disini</a> untuk refresh. -->
                      

                      <div class="space"></div>

                      <div class="clearfix">
                        <label class="inline">
                          <input type="checkbox" class="ace" />
                          <span class="lbl"> Ingatkan saya</span>
                        </label>

                        <input type="button" id="button-login" value="Sign In" class="width-35 pull-right btn btn-sm btn-primary" >

                        <!-- <button id="button-login" name="Submit" value="submit" class="width-35 pull-right btn btn-sm btn-primary">
                          <i class="ace-icon fa fa-key"></i>
                          <span class="bigger-110">Masuk</span>
                        </button> -->
                      </div>
                      
                      <div class="space-4"></div>
                    </fieldset>
                  </form>
                  <br>
                  
                  <div class="space-6"></div>

                </div><!-- /.widget-main -->
                
              </div><!-- /.widget-body -->
            </div><!-- /.login-box -->

          </div><!-- /.position-relative -->

          <!-- <div class="navbar-fixed-top align-right">
            <br />
            &nbsp;
            <a id="btn-login-dark" href="#">Dark</a>
            &nbsp;
            <span class="blue">/</span>
            &nbsp;
            <a id="btn-login-blur" href="#">Blur</a>
            &nbsp;
            <span class="blue">/</span>
            &nbsp;
            <a id="btn-login-light" href="#">Light</a>
            &nbsp; &nbsp; &nbsp;
          </div> -->
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.main-content -->
</div><!-- /.main-container -->

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
                  window.location = '<?php echo base_url().'main'?>';
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