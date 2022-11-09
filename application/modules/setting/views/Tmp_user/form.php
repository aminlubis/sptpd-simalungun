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
  
    $('#form_Tmp_user').ajaxForm({
      beforeSend: function() {
        achtungShowLoader();  
      },
      uploadProgress: function(event, position, total, percentComplete) {
      },
      complete: function(xhr) {     
        var data=xhr.responseText;
        var jsonResponse = JSON.parse(data);

        if(jsonResponse.status === 200){
          $.achtung({message: jsonResponse.message, timeout:5});
          $('#page-area-content').load('setting/Tmp_user?_=' + (new Date()).getTime());
        }else{
          $.achtung({message: jsonResponse.message, timeout:5, className: 'achtungFail'});
        }
        achtungHideLoader();
      }
    }); 
})

</script>

<div class="page-header">
  <h1>
    <?php echo $title?>
    <small>
      <i class="ace-icon fa fa-angle-double-right"></i>
      <?php echo $breadcrumbs?>
    </small>
  </h1>
</div><!-- /.page-header -->

<div class="row">
  <div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
          <div class="widget-body">
            <div class="widget-main no-padding">
              <form class="form-horizontal" method="post" id="form_Tmp_user" action="<?php echo site_url('setting/Tmp_user/process')?>" enctype="multipart/form-data">
                <br>

                <div class="form-group">
                  <label class="control-label col-md-2">ID</label>
                  <div class="col-md-1">
                    <input name="id" id="id" value="<?php echo isset($value)?$value->user_id:0?>" placeholder="Auto" class="form-control" type="text" readonly>
                  </div>
                  
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Fullname</label>
                  <div class="col-md-2">
                    <input name="fullname" id="fullname" value="<?php echo isset($value)?$value->fullname:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Email</label>
                  <div class="col-md-2">
                    <input name="email" id="email" value="<?php echo isset($value)?$value->email:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Username</label>
                  <div class="col-md-2">
                    <input name="username" id="username" value="<?php echo isset($value)?$value->username:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Password</label>
                  <div class="col-md-2">
                    <input name="password" id="password" value="<?php echo isset($value)?$value->password:''?>" placeholder="" class="form-control" type="password" <?php echo ($flag=='read')?'readonly':''?> >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Password Confirmation</label>
                  <div class="col-md-2">
                    <input name="confirm" id="confirm" value="" placeholder="" class="form-control" type="password" <?php echo ($flag=='read')?'readonly':''?> >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">PIC</label>
                  <div class="col-md-2">
                    <?php echo $this->master->custom_selection(array('table'=>'global_parameter', 'where'=>array('is_active'=>'Y', 'flag' => 'pic'), 'id'=>'value', 'name' => 'label'),isset($value)?$value->pic_id:'','pic_id','pic_id','chosen-slect form-control',($flag=='read')?'readonly':'','');?>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Is active?</label>
                  <div class="col-md-2">
                    <div class="radio">
                          <label>
                            <input name="is_active" type="radio" class="ace" value="Y" <?php echo isset($value) ? ($value->is_active == 'Y') ? 'checked="checked"' : '' : 'checked="checked"'; ?> <?php echo ($flag=='read')?'readonly':''?> />
                            <span class="lbl"> Ya</span>
                          </label>
                          <label>
                            <input name="is_active" type="radio" class="ace" value="N" <?php echo isset($value) ? ($value->is_active == 'N') ? 'checked="checked"' : '' : ''; ?> <?php echo ($flag=='read')?'readonly':''?>/>
                            <span class="lbl">Tidak</span>
                          </label>
                    </div>
                  </div>
                </div>

                &nbsp;


                <div class="form-actions center">

                  <!--hidden field-->
                  <!-- <input type="text" name="id" value="<?php echo isset($value)?$value->user_id:0?>"> -->

                  <a onclick="getMenu('setting/Tmp_user')" href="#" class="btn btn-sm btn-success">
                    <i class="ace-icon fa fa-arrow-left icon-on-right bigger-110"></i>
                    Kembali ke daftar
                  </a>
                  <?php if($flag != 'read'):?>
                  <button type="reset" id="btnReset" class="btn btn-sm btn-danger">
                    <i class="ace-icon fa fa-close icon-on-right bigger-110"></i>
                    Reset
                  </button>
                  <button type="submit" id="btnSave" name="submit" class="btn btn-sm btn-info">
                    <i class="ace-icon fa fa-check-square-o icon-on-right bigger-110"></i>
                    Submit
                  </button>
                <?php endif; ?>
                </div>
              </form>
            </div>
          </div>
    
    <!-- PAGE CONTENT ENDS -->
  </div><!-- /.col -->
</div><!-- /.row -->


