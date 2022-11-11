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
        <input type="hidden" name="id" value="<?php echo isset($value->npwpd)?$value->npwpd:0?>">

        <div class="form-group">
            <label class="control-label col-md-1">Tgl Daftar</label>  
            <div class="col-md-2">
                <div class="input-group">
                    <input name="tgldaftar" id="tgldaftar" value="<?php echo isset($value->tgldaftar)?$value->tgldaftar:date('Y-m-d')?>"  class="form-control date-picker" type="text" data-date-format="yyyy-mm-dd">
                    <span class="input-group-addon">
                    <i class="ace-icon fa fa-calendar"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1">No. KTP</label>
            <div class="col-md-2">
                <input name="no_ktp" id="no_ktp" value="<?php echo isset($value->noktp)?$value->noktp:''?>"  class="form-control" type="text">
            </div>
            <label class="control-label col-md-1">Nama WP</label>
            <div class="col-md-2">
                <input name="nama" id="nama" value="<?php echo isset($value->nama)?$value->nama:''?>"  class="form-control" type="text">
            </div>
        </div>

        <div class="form-group" style="margin-bottom: 4px">
            <label class="control-label col-md-1">Alamat</label>
            <div class="col-md-4">
            <textarea class="form-control" name="alamat" style="height: 60px !important"><?php echo isset($value->alamat)?$value->alamat:''?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1">Tempat Lahir</label>
            <div class="col-md-2">
                <input name="tempatlahir" id="tempatlahir" value="<?php echo isset($value->tempatlahir)?$value->tempatlahir:''?>"  class="form-control" type="text">
            </div>
            <label class="control-label col-md-1">Tgl Lahir</label>  
            <div class="col-md-2">
                <div class="input-group">
                    <input name="tanggallahir" id="tanggallahir" value="<?php echo isset($value->tanggallahir)?$value->tanggallahir:''?>"  class="form-control date-picker" type="text" data-date-format="yyyy-mm-dd">
                    <span class="input-group-addon">
                    <i class="ace-icon fa fa-calendar"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1">Kecamatan</label>
            <div class="col-md-2">
                <input id="inputKecamatan" class="form-control" name="kecamatan" type="text" placeholder="Masukan 3 karakter" value="<?php echo isset($value->nama_kecamatan)?$value->nama_kecamatan:''?>" readonly/>
                <input type="hidden" name="kecamatanHidden" value="<?php echo isset($value->kecamatan)?$value->kecamatan:''?>" id="kecamatanHidden">
            </div>
            <label class="control-label col-md-1">Kelurahan</label>
            <div class="col-md-2">
                <input id="inputKelurahan" class="form-control" name="kelurahan" type="text" placeholder="Masukan 3 karakter" value="<?php echo isset($value->nama_kelurahan)?$value->nama_kelurahan:''?>"/>
                <input type="hidden" name="kelurahanHidden" value="<?php echo isset($value->kelurahan)?$value->kelurahan:''?>" id="kelurahanHidden">
            </div>
        </div>


        <div class="form-group">
            <label class="control-label col-md-1">Kode Pos</label>
            <div class="col-md-2">
                <input id="kodepos" class="form-control" name="kodepos" type="text" value="<?php echo isset($value->kodepos)?$value->kodepos:''?>"/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1">No Telp/WA</label>
            <div class="col-md-2">
                <input id="telp" class="form-control" name="telp" type="text" value="<?php echo isset($value->telp)?$value->telp:''?>"/>
            </div>
        </div>
        <br>
        <p><b>UPLOAD FOTO KTP</b></p>
        <div class="form-group">
            <label class="control-label col-md-1">Upload file</label>  
            <div class="col-md-2">
                <input id="file" class="form-control" name="file" type="file" />
            </div>
            <?php if(isset($value) AND $value->file_attachment != NULL) : ?>
                <div class="col-md-2" style="padding-top: 3px">
                    <i><a href="<?php echo base_url().'Templates/Attachment/download?refno='.$value->npwpd.'&refname=wajibpajak'?>" target="_blank"><i class="fa fa-download"></i> Download Lampiran</a></i>
                </div>
            <?php endif; ?>
        </div>
        
        
        <?php if($this->session->userdata('logged') == false) :?>
        <br>
        <p><b>BUAT AKUN</b></p>
        <div class="form-group">
            <label class="control-label col-md-2">Email</label>
            <div class="col-md-2">
                <input id="username" class="form-control" name="username" type="text"/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Kata Sandi</label>
            <div class="col-md-2">
                <input id="password" class="form-control" name="password" type="password"/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Konfirmasi Kata Sandi</label>
            <div class="col-md-2">
                <input id="password" class="form-control" name="konfirm_password" type="password"/>
            </div>
        </div>
        <?php endif; ?>

        <div class="col-md-4 no-padding" style="margin-left: -6px !important; padding-top: 20px !important">
            <?php if($flag == 'update') :?>
            <button type="submit" id="btnSave" name="submit" class="btn btn-sm btn-success">
                <i class="ace-icon fa fa-check-circle icon-on-right bigger-110"></i>
                Ubah Data
            </button>
            <?php else: ?>
                <button type="submit" id="btnSave" name="submit" class="btn btn-sm btn-primary">
                <i class="ace-icon fa fa-check-square-o icon-on-right bigger-110"></i>
                Simpan Data
            </button>
            <button type="reset" id="btnReset" name="submit" class="btn btn-sm btn-danger" style="margin-left: -1px">
                <i class="ace-icon fa fa-refresh icon-on-right bigger-110"></i>
                Reset Form
            </button>
            <?php endif; ?>
            
        </div>

        </form>
    </div>
    
    
<!-- end content here -->
</div>

<script src="<?php echo base_url()?>assets/js/typeahead.js"></script>

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
            achtungShowFadeIn(); 
        },
        uploadProgress: function(event, position, total, percentComplete) {
        },
        complete: function(xhr) {     
          var data=xhr.responseText;
          var jsonResponse = JSON.parse(data);
          if(jsonResponse.status === 200){
            $.achtung({message: jsonResponse.message, timeout:5});
            $('#page-area-content').html('<div class="alert alert-success" style="margin: 50px"><strong style="font-size: 14px"><i class="fa fa-check-circle green"></i> Sukses</strong><br> Terima kasih telah Mendaftar Wajib Pajak, data anda akan segera diproses oleh petugas kami.</div>');
          }else{
            $.achtung({message: jsonResponse.message, timeout:5, className: 'achtungFail'});
            // $('#page-area-content').html('<br><br><div class="alert alert-danger"><strong><i class="fa fa-times-circle red"></i> Gagal !</strong><br>Maaf, proses Registrasi Wajib Pajak gagal dilakukan, silahkan coba beberapa saat lagi.</div>');
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