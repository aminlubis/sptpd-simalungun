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
          if(confirm('Apakah anda akan melakuka Entri SPTPD?')){
            $('#page-area-content').load('sptpd/sptpd_opd/form?id_izin_usaha='+jsonResponse.id_izin_usaha+'');
          }else{
            $('#page-area-content').load('objek_pajak/Objek_pajak_opd?_=' + (new Date()).getTime());
          }
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
    
    $('#search_wp').typeahead({
      source: function (query, result) {
          $.ajax({
              url: "Templates/References/getWajibPajak",
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
          var val_item=item.split(':')[0];
          var label_item=item.split(':')[1];

          $('#search_wp').val(label_item);
          $('#npwpd').val(val_item);
          $('#div_npwpd').show();
          $('#txt_npwpd').text(val_item);
          // get detail wp
          $.getJSON("<?php echo site_url('Templates/References/getDetailWp') ?>/" + val_item, '', function (response) {  
            $('#alamat_usaha').val(response.alamat);
            $('#kodepos_usaha').val(response.kodepos);
            $('#kecamatanHidden').val(response.kecamatan);
            $('#kelurahanHidden').val(response.kelurahan);
          }); 
          
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
              <form class="form-horizontal" method="post" id="form-default" action="<?php echo site_url('objek_pajak/Objek_pajak_opd/process')?>" enctype="multipart/form-data">
                <br>

                <div>
                    <label for="form-field-mask-1">
                        Pilih Wajib Pajak :
                    </label>

                    <div class="input-group col-md-12">
                        <input name="search_wp" id="search_wp" value=""  class="form-control" type="text">
                    </div>
                </div>
                <br>
                <div id="div_npwpd" style="display:none">
                  <span>NPWPD : </span><br>
                  <span style="font-size: 20px; font-weight: bold" id="txt_npwpd"></span>
                </div>

                <hr>

                <input name="npwpd" id="npwpd" value="" class="form-control" type="hidden" >
                <input name="id" id="id" value="<?php echo isset($value)?$value->id_izin_usaha:0?>" class="form-control" type="hidden" >
                <input type="hidden" name="kecamatanHidden" value="<?php echo isset($value->kecamatan_usaha)?$value->kecamatan_usaha:''?>" id="kecamatanHidden">
                <input type="hidden" name="kelurahanHidden" value="<?php echo isset($value->kode_kelurahan)?$value->kode_kelurahan:''?>" id="kelurahanHidden">
                <input id="kodepos_usaha" class="form-control" name="kodepos_usaha" type="hidden" value="<?php echo isset($value->kodepos_usaha)?$value->kodepos_usaha:''?>"/>

                <p style="font-weight: bold">PILIH JENIS PAJAK & JENIS USAHA</p>

                <div class="form-group">
                  <label class="control-label col-md-2">Jenis Kegiatan</label>
                  <div class="col-md-8">
                    <div class="radio">
                          <label>
                            <input name="jenispajak" type="radio" class="ace" value="2" <?php echo isset($value) ? ($value->kodejenispajak == '1') ? 'checked="checked"' : '' : 'checked="checked"'; ?> <?php echo ($flag=='read')?'readonly':''?> />
                            <span class="lbl"> Makan & Minum</span>
                          </label>
                          <label>
                            <input name="jenispajak" type="radio" class="ace" value="1" <?php echo isset($value) ? ($value->kodejenispajak == '2') ? 'checked="checked"' : '' : ''; ?> <?php echo ($flag=='read')?'readonly':''?>/>
                            <span class="lbl">Hotel / Penginapan</span>
                          </label>
                    </div>
                  </div>
                </div>

                <!-- <div class="form-group">
                  <label class="control-label col-md-2">Jenis Pajak</label>
                  <div class="col-md-4">
                      <?php echo $this->master->custom_selection(array('table'=>'jenispajak', 'where'=>array(), 'id'=>'kodejenispajak', 'name' => 'jenispajak'),isset($value)?$value->kodejenispajak:'','jenispajak','jenispajak','chosen-slect form-control','','');?>
                  </div>
                </div> -->

                <!-- <div class="form-group">
                  <label class="control-label col-md-2">Jenis Usaha</label>
                  <div class="col-md-3">
                      <?php echo $this->master->custom_selection(array('table'=>'jenisusaha', 'where'=>array(), 'id'=>'idjenisusaha', 'name' => 'jenisusaha'),isset($value)?$value->idjenis_usaha:'','jenisusaha','jenisusaha','chosen-slect form-control','','');?>
                  </div>
                </div> -->

                <!-- <br>
                <p style="font-weight: bold">DATA PERIZINAN</p>
                <div class="form-group">
                  <label class="control-label col-md-2">No Izin Usaha</label>
                  <div class="col-md-2">
                    <input name="noizinusaha" id="noizinusaha" value="<?php echo isset($value)?$value->noizinusaha:''?>" class="form-control" type="text" >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Tanggal Berlaku Izin</label>
                  <div class="col-md-2">
                    <div class="input-group">
                        <input name="tanggal_awal_usaha" id="tanggal_awal_usaha" value="<?php echo isset($value)?$value->tanggal_awal_usaha:''?>"  class="form-control date-picker" type="text" data-date-format="yyyy-mm-dd">
                        <span class="input-group-addon">
                        <i class="ace-icon fa fa-calendar"></i>
                        </span>
                    </div>
                  </div>
                  <label class="control-label col-md-1">s.d Tanggal</label>
                  <div class="col-md-2">
                    <div class="input-group">
                        <input name="tanggal_akhir_usaha" id="tanggal_akhir_usaha" value="<?php echo isset($value)?$value->tanggal_akhir_usaha:''?>"  class="form-control date-picker" type="text" data-date-format="yyyy-mm-dd">
                        <span class="input-group-addon">
                        <i class="ace-icon fa fa-calendar"></i>
                        </span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Upload Dokumen Perizinan</label>
                  <div class="col-md-2" style="padding-left: 18px">
                    <input name="file" id="file" value="" class="form-control" type="file" >
                  </div>
                  <?php if(isset($value) AND $value->file_attachment != NULL) : ?>
                      <div class="col-md-2" style="padding-top: 3px">
                          <i><a href="<?php echo base_url().'Templates/Attachment/download?refno='.$value->nopd.'&refname=objek_pajak'?>" target="_blank"><i class="fa fa-download"></i> Download Lampiran</a></i>
                      </div>
                  <?php endif; ?>
                </div> -->

                <div class="form-group">
                  <label class="control-label col-md-2">Nama Kegiatan</label>
                  <div class="col-md-3">
                    <input name="nama_usaha" id="nama_usaha" value="<?php echo isset($value)?$value->nama_usaha:''?>" class="form-control" type="text" >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Alamat Usaha</label>
                  <div class="col-md-4">
                    <textarea name="alamat_usaha" id="alamat_usaha" class="form-control" <?php echo ($flag=='read')?'':''?> style="height:50px !important" readonly><?php echo isset($value)?$value->alamat_usaha:''?></textarea>
                  </div>
                </div>
                
                <div class="form-group" style="padding-top: 3px">
                    <label class="control-label col-md-2">No Telp/WA</label>
                    <div class="col-md-2">
                        <input id="telp" class="form-control" name="telp" type="text" value="<?php echo isset($value->telp)?$value->telp:''?>"/>
                    </div>
                </div>

                <div class="form-actions center">

                  <a onclick="getMenu('objek_pajak/Objek_pajak_opd')" href="#" class="btn btn-sm btn-success">
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


