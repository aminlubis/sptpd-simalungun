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
        
        
        <p><b>GANTI PASSWORD</b></p>
        <div class="form-group">
            <label class="control-label col-md-2">Kata Sandi Lama</label>
            <div class="col-md-2">
                <input id="old_password" class="form-control" name="old_password" type="text"/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Kata Sandi Baru</label>
            <div class="col-md-2">
                <input id="password" class="form-control" name="password" type="password"/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Konfirmasi Kata Sandi Baru</label>
            <div class="col-md-2">
                <input id="password" class="form-control" name="konfirm_password" type="password"/>
            </div>
        </div>

        <div class="col-md-4 no-padding" style="margin-left: -6px !important; padding-top: 20px !important">
            <button type="submit" id="btnSave" name="submit" class="btn btn-sm btn-primary">
                <i class="ace-icon fa fa-check-square-o icon-on-right bigger-110"></i>
                Simpan Data
            </button>
            
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