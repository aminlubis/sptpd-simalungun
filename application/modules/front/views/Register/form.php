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
    <div class="col-sm-12">
        <form class="form-horizontal" method="post" id="form-default" action="<?php echo site_url('front/Register/process')?>" enctype="multipart/form-data" autocomplete="off">
        
        <br>
        <p><b>BIODATA WAJIB PAJAK</b></p>
        <div class="form-group">
            <label class="control-label col-md-1">Tgl Daftar</label>  
            <div class="col-md-2">
                <div class="input-group">
                    <input name="tgl_daftar" id="tgl_daftar" value=""  class="form-control date-picker" type="text" data-date-format="yyyy-mm-dd">
                    <span class="input-group-addon">
                    <i class="ace-icon fa fa-calendar"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1">No. KTP</label>
            <div class="col-md-2">
                <input name="no_ktp" id="no_ktp" value=""  class="form-control" type="text">
            </div>
            <label class="control-label col-md-1">Nama WP</label>
            <div class="col-md-2">
                <input name="nama" id="nama" value=""  class="form-control" type="text">
            </div>
        </div>

        <div class="form-group" style="margin-bottom: 4px">
            <label class="control-label col-md-1">Alamat</label>
            <div class="col-md-4">
            <textarea class="form-control" name="alamat" style="height: 60px !important"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1">Tempat Lahir</label>
            <div class="col-md-2">
                <input name="tempatlahir" id="tempatlahir" value=""  class="form-control" type="text">
            </div>
            <label class="control-label col-md-1">Tgl Lahir</label>  
            <div class="col-md-2">
                <div class="input-group">
                    <input name="tanggallahir" id="tanggallahir" value=""  class="form-control date-picker" type="text" data-date-format="yyyy-mm-dd">
                    <span class="input-group-addon">
                    <i class="ace-icon fa fa-calendar"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1">Kecamatan</label>
            <div class="col-md-2">
                <input id="inputKecamatan" class="form-control" name="kecamatan" type="text" placeholder="Masukan 3 karakter" value=""/>
                <input type="hidden" name="kecamatanHidden" value="" id="kecamatanHidden">
            </div>
            <label class="control-label col-md-1">Kelurahan</label>
            <div class="col-md-2">
                <input id="inputKecamatan" class="form-control" name="kecamatan" type="text" placeholder="Masukan 3 karakter" value=""/>
                <input type="hidden" name="kecamatanHidden" value="" id="kecamatanHidden">
            </div>
        </div>


        <div class="form-group">
            <label class="control-label col-md-1">Kode Pos</label>
            <div class="col-md-2">
                <input id="kodepos" class="form-control" name="kodepos" type="text"/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1">No Telp/WA</label>
            <div class="col-md-2">
                <input id="telp" class="form-control" name="telp" type="text"/>
            </div>
        </div>

        <br>
        <p><b>BUAT AKUN</b></p>
        <div class="form-group">
            <label class="control-label col-md-2">Nama Akun</label>
            <div class="col-md-2">
                <input id="username" class="form-control" name="username" type="text"/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Kata Sandi</label>
            <div class="col-md-2">
                <input id="username" class="form-control" name="username" type="text"/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Konfirmasi Kata Sandi</label>
            <div class="col-md-2">
                <input id="username" class="form-control" name="username" type="text"/>
            </div>
        </div>

        <div class="col-md-4 no-padding" style="margin-left: -6px !important; padding-top: 20px !important">
            <button type="submit" id="btnSave" name="submit" class="btn btn-sm btn-primary">
                <i class="ace-icon fa fa-check-square-o icon-on-right bigger-110"></i>
                Simpan Data
            </button>
            <button type="reset" id="btnReset" name="submit" class="btn btn-sm btn-danger" style="margin-left: -1px">
                <i class="ace-icon fa fa-refresh icon-on-right bigger-110"></i>
                Reset Form
            </button>
        </div>

        </form>
    </div>
    
    
<!-- end content here -->
</div>

<!-- <script src="<?php echo base_url().'assets/js/custom/als_datatable.js'?>"></script>
<script src="<?php echo base_url()?>assets/js/typeahead.js"></script> -->

<script>
    jQuery(function($) {  


        $('.date-picker').datepicker({  
        autoclose: true,   
        todayHighlight: true,
        format: 'yyyy-mm-dd', 
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
            $('#page-area-content').html('<br><br><div class="alert alert-success"><strong>Berhasil !</strong> Terima kasih telah mendaftar menjadi anggota Bhayangkara Utama, data anda akan diproses oleh Admin kami.</div>');
          }else{
            $.achtung({message: jsonResponse.message, timeout:5, className: 'achtungFail'});
          }
          achtungHideLoader();
        }
      }); 

      $('#tmp_lhr').typeahead({
        source: function (query, result) {
            $.ajax({
                url: "Templates/References/getRegencyByKeyword",
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

            $('#tmp_lhr').val(label_item);
        }
        });

        $('#inputKecamatan').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "Templates/References/getDistricts",
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

                if (val_item) {          

                $('#provinsiHidden').val('');
                $('#inputProvinsi').val('');
                $('#kotaHidden').val('');
                $('#inputKota').val('');           

                $.getJSON("<?php echo site_url('Templates/References/getDistrictsById') ?>/" + val_item, '', function (data) {  
                    
                    $('#provinsiHidden').val(data.province_id);
                    $('#inputProvinsi').val(data.province_name);
                    $('#kotaHidden').val(data.regency_id);
                    $('#inputKota').val(data.regency_name);           

                }); 
                $('#kecamatanHidden').val(val_item);
                $('#prov').show('fast');
                $('#village').show('fast'); 
                }      
            }
            });

            $('input[type=radio][name=tipe_anggota]').change(function() {
                if (this.value == 'old') {
                    $('#div_kta_old').show('fast');
                }
                else {
                    $('#div_kta_old').hide('fast');
                }
            });
        
    })

</script>