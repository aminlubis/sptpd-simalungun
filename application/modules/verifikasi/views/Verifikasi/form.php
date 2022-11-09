<script src="<?php echo base_url()?>assets/js/date-time/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/datepicker.css" />
<script src="<?php echo base_url()?>assets/js/typeahead.js"></script>

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
  
    $('#form-default').ajaxForm({
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
          $('#page-area-content').load('verifikasi/Verifikasi?_=' + (new Date()).getTime());
        }else{
                      $.achtung({message: jsonResponse.message, timeout:5, className: 'achtungFail'});
                    }
        achtungHideLoader();
      }
    }); 

    $('#inputKelurahan').typeahead({
      source: function (query, result) {
          $.ajax({
              url: "Templates/References/getVillage",
              data: 'keyword=' + query ,         
              dataType: "json",
              type: "POST",
              success: function (response) {
                  result($.map(response, function (item) {
                      return item;
                  }));
              }
          });
      },
      afterSelect: function (item) {
          // do what is needed with item
          var kode_kecamatan=item.split('.')[0];
          var kelurahan=item.split('.')[1];
          var val_item=kelurahan.split(':')[0];
          var val_label=item.split(':')[1];
          $('#inputKelurahan').val(val_label);
          $('#kelurahanHidden').val(val_item);

          if (val_item) {          

              $('#provinsiHidden').val('');

              $.getJSON("<?php echo site_url('Templates/References/getDistrictsById') ?>/" + kode_kecamatan, '', function (data) {  
                  
                  $('#kecamatanHidden').val(data.kode_kecamatan);
                  $('#inputKecamatan').val(data.nama_kecamatan);         

              }); 
          }      
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
              <form class="form-horizontal" method="post" id="form-default" action="<?php echo site_url('verifikasi/Verifikasi/process')?>" enctype="multipart/form-data">
                <br>

                <input name="id" id="id" value="<?php echo isset($value)?$value->id_izin_usaha:0?>" class="form-control" type="hidden" >
                <input name="npwpd" id="npwpd" value="<?php echo isset($value)?$value->npwpd:0?>" class="form-control" type="hidden" >
                <input name="kodejenispajak" id="kodejenispajak" value="<?php echo isset($value)?$value->kodejenispajak:0?>" class="form-control" type="hidden" >
                <input name="kode_kelurahan" id="kode_kelurahan" value="<?php echo isset($value)?$value->kode_kelurahan:0?>" class="form-control" type="hidden" >

                  <p><b>BIODATA WAJIB PAJAK</b> <?php echo ($value->wp_verified == 1)?'<span style="color: green; font-weight: bold"><i class="fa fa-check-circle-o green"></i> Terverifikasi </span>':'[ <span style="color: red; font-weight: bold"><i class="fa fa-exclamation red"></i> Belum diverifikasi </span> ]'; ?> </p>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                          <label class="control-label col-md-2">Tgl Daftar</label>  
                          <div class="col-md-4" style="padding: 5px 19px"> 
                            <?php echo isset($value->tgldaftar)?$value->tgldaftar:date('Y-m-d')?>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-2">No. KTP</label>
                          <div class="col-md-4" style="padding: 5px 19px"> 
                            <?php echo isset($value->noktp)?$value->noktp:''?>
                          </div>
                          <label class="control-label col-md-2">Nama WP</label>
                          <div class="col-md-4" style="padding: 5px 19px"> 
                            <?php echo isset($value->nama)?$value->nama:''?>
                          </div>
                      </div>

                      <div class="form-group" >
                          <label class="control-label col-md-2">Alamat</label>
                          <div class="col-md-4" style="padding: 5px 19px"> 
                            <?php echo isset($value->alamat)?$value->alamat:''?>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-2">Tempat Lahir</label>
                          <div class="col-md-4" style="padding: 5px 19px"> 
                            <?php echo isset($value->tempatlahir)?$value->tempatlahir:''?>
                          </div>
                          <label class="control-label col-md-2">Tgl Lahir</label>  
                          <div class="col-md-4" style="padding: 5px 19px"> 
                            <?php echo isset($value->tanggallahir)?$value->tanggallahir:''?>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-2">Kecamatan</label>
                          <div class="col-md-4" style="padding: 5px 19px"> 
                            <?php echo isset($value->nama_kecamatan)?$value->nama_kecamatan:''?>
                          </div>
                          <label class="control-label col-md-2">Kelurahan</label>
                          <div class="col-md-4" style="padding: 5px 19px"> 
                            <?php echo isset($value->nama_kelurahan)?$value->nama_kelurahan:''?>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-2">Kode Pos</label>
                          <div class="col-md-4" style="padding: 5px 19px"> 
                            <?php echo isset($value->kodepos)?$value->kodepos:''?>
                          </div>
                          <label class="control-label col-md-2">No Telp/WA</label>
                          <div class="col-md-4" style="padding: 5px 19px"> 
                            <?php echo isset($value->telp)?$value->telp:''?>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <br>
                      Foto KTP :<br>
                      <a href="<?php echo base_url().PATH_FILE_DEFAULT.$value->path_ktp?>" target="_blank"><img src="<?php echo base_url().PATH_FILE_DEFAULT.$value->path_ktp?>" width="200px"></a>
                      <br>
                      <div style="padding-top: 10px">
                        <label style="font-weight: bold">Verifikasi Data : </label>
                        <div class="col-md-12 no-padding" >
                          <select class="form-control" name="verifikasi_data">
                            <option>-Pilih-</option>
                            <option value="1" <?php echo ($value->wp_verified == 1)?'selected':''?>>Data Lengkap</option>
                            <option value="0" <?php echo ($value->wp_verified == 0)?'selected':''?>>Data Belum Lengkap</option>
                          </select>
                        </div>
                      </div>
                      
                      
                    </div>
                  </div>
                  
                
                <br>
                <p style="font-weight: bold">OBJEK PAJAK <?php echo ($value->is_verified == 1)?'<span style="color: green; font-weight: bold"><i class="fa fa-check"></i> Terverifikasi </span>':'[ <span style="color: red; font-weight: bold"><i class="fa fa-exclamation red"></i> Belum diverifikasi </span> ]'; ?></p>
                <div class="row">
                  <div class="col-md-8">

                    <div class="form-group">
                      <label class="control-label col-md-2">Jenis Pajak</label>
                      <div class="col-md-4" style="padding: 5px 19px">
                        <?php echo isset($value)?$value->jenispajak:''?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-2">Jenis Usaha</label>
                      <div class="col-md-3" style="padding: 5px 19px">
                        <?php echo isset($value)?$value->jenisusaha:''?>
                      </div>
                    </div>

                    <br>
                    <p style="font-weight: bold">DATA PERIZINAN</p>
                    <div class="form-group">
                      <label class="control-label col-md-2">No Izin Usaha</label>
                      <div class="col-md-2" style="padding: 5px 19px">
                        <?php echo isset($value)?$value->noizinusaha:''?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-2">Tanggal Berlaku Izin</label>
                      <div class="col-md-2" style="padding: 5px 19px">
                        <?php echo isset($value)?$value->tanggal_awal_usaha:''?>
                      </div>
                      <label class="control-label col-md-2">s.d Tanggal</label>
                      <div class="col-md-2" style="padding: 5px 19px">
                        <?php echo isset($value)?$value->tanggal_akhir_usaha:''?>
                      </div>
                    </div>

                    <br>
                    <p style="font-weight: bold">PROFIL USAHA</p>
                    <div class="form-group">
                      <label class="control-label col-md-2">Nama Usaha</label>
                      <div class="col-md-3" style="padding: 5px 19px">
                        <?php echo isset($value)?$value->nama_usaha:''?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-2">Alamat Usaha</label>
                      <div class="col-md-4" style="padding: 5px 19px">
                        <?php echo isset($value)?$value->alamat_usaha:''?>
                      </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Kecamatan</label>
                        <div class="col-md-3" style="padding: 5px 19px">
                          <?php echo isset($value)?$value->nama_kecamatan:''?>
                        </div>
                        <label class="control-label col-md-2">Kelurahan</label>
                        <div class="col-md-3" style="padding: 5px 19px">
                          <?php echo isset($value)?$value->nama_kelurahan:''?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Kode Pos</label>
                        <div class="col-md-3" style="padding: 5px 19px">
                          <?php echo isset($value->kodepos_usaha)?$value->kodepos_usaha:''?>
                        </div>
                        <label class="control-label col-md-2">No Telp/WA</label>
                        <div class="col-md-3" style="padding: 5px 19px">
                          <?php echo isset($value->telp)?$value->telp:''?>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                      <br>
                      Dokumen Perizinan :<br>
                      <a href="<?php echo base_url().PATH_FILE_DEFAULT.$value->path_file_izin?>" target="_blank"><i>Download Lampiran</i></a>

                      <div style="padding-top: 10px">
                        <label style="font-weight: bold">Verifikasi Dokumen : </label>
                        <div class="col-md-12 no-padding" >
                          <select class="form-control" name="verifikasi_dokumen">
                            <option>-Pilih-</option>
                            <option value="1" <?php echo ($value->is_verified == 1)?'selected':''?>>Dokumen Lengkap</option>
                            <option value="0" <?php echo ($value->is_verified == 0)?'selected':''?>>Dokumen Belum Lengkap</option>
                          </select>
                        </div>
                      </div>

                      <br>
                      
                      <div style="margin-top: 20px">
                        <label style="font-weight: bold">Petugas Verifikasi : </label>
                        <div class="col-md-12 no-padding" >
                          <input type="text" class="form-control" value="<?php echo $this->session->userdata('user')->username;?>">
                        </div>
                      </div>

                  </div>
                </div>
                

                <div class="form-actions center">

                  <a onclick="getMenu('verifikasi/Verifikasi')" href="#" class="btn btn-sm btn-success">
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


