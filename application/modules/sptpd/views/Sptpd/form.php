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
        <p style="font-weight: bold">CARI OBJEK PAJAK ATAU JENIS USAHA</p>

        <div>
            <label for="form-field-mask-1">
                Ketikan Nama Usaha Anda :
            </label>

            <div class="input-group">
            <input name="nama_usaha" id="nama_usaha" value=""  class="form-control" type="text">
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" type="button">
                        <i class="ace-icon fa fa-search bigger-110"></i>
                        Cari !
                    </button>
                </span>
            </div>
        </div>

        <hr>
        
        <div id="main_form" style="display: none">

            <p style="font-weight: bold">FORM INPUT SPTPD</p>
            <div class="form-group">
                <label class="control-label col-md-1">NPWPD</label>
                <div class="col-md-2">
                    <input name="npwpd" id="npwpd" value=""  class="form-control" type="text" readonly>
                </div>
                <label class="control-label col-md-1">NOPD</label>
                <div class="col-md-2">
                    <input name="nopd" id="nopd" value=""  class="form-control" type="text" readonly>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-1">Masa Pajak</label>  
                <div class="col-md-2">
                    <div class="input-group">
                        <input name="tgl_daftar" id="tgl_daftar" value="<?php echo date('Y-m-d')?>"  class="form-control date-picker" type="text" data-date-format="yyyy-mm-dd">
                        <span class="input-group-addon">
                        <i class="ace-icon fa fa-calendar"></i>
                        </span>
                    </div>
                </div>
                <label class="control-label col-md-1">s/d Tanggal</label>  
                <div class="col-md-2">
                    <div class="input-group">
                        <input name="tgl_daftar" id="tgl_daftar" value="<?php echo date('Y-m-d', strtotime("+30 days"));?>"  class="form-control date-picker" type="text" data-date-format="yyyy-mm-dd">
                        <span class="input-group-addon">
                        <i class="ace-icon fa fa-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-1">Tgl Lapor SPTPD</label>  
                <div class="col-md-2">
                    <div class="input-group">
                        <input name="tgl_daftar" id="tgl_daftar" value="<?php echo date('Y-m-d')?>"  class="form-control date-picker" type="text" data-date-format="yyyy-mm-dd">
                        <span class="input-group-addon">
                        <i class="ace-icon fa fa-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>

            <br>
            <p style="font-weight: bold">PILIH JENIS PAJAK</p>
            <div class="form-group">
                <label class="control-label col-md-1">Jenis Pajak</label>
                <div class="col-md-3">
                    <?php echo $this->master->custom_selection(array('table'=>'jenispajak', 'where'=>array(), 'id'=>'kodejenispajak', 'name' => 'jenispajak'),'','jenispajak','jenispajak','chosen-slect form-control','','');?>
                </div>
            </div>

            <div id="form_by_kodejenispajak"></div>

            <br>
            <p style="font-weight: bold">PAJAK TERHUTANG</p>
            <div class="form-group">
                <label class="control-label col-md-2">DPP</label>
                <div class="col-md-1">
                    <input name="nama_usaha" id="nama_usaha" value=""  class="form-control" type="text">
                </div>
                <label class="control-label col-md-1">Tarif Pajak</label>
                <div class="col-md-1">
                    <input name="nama_usaha" id="nama_usaha" value=""  class="form-control" type="text">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2">Pajak Sebelum Pembulatan</label>
                <div class="col-md-1">
                    <input name="nama_usaha" id="nama_usaha" value=""  class="form-control" type="text">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2">Pajak Terutang</label>
                <div class="col-md-1">
                    <input name="nama_usaha" id="nama_usaha" value=""  class="form-control" type="text">
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

        $('#nama_usaha').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "Templates/References/getUsaha",
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
                var val_item=item.split('-')[0];
                var val_label=item.split('-')[1];

                $('#nama_usaha').val(val_label);

                if (val_item) {          

                    $('#npwpd').val('');
                    $('#nopd').val('');

                    $.getJSON("<?php echo site_url('Templates/References/getUsahaByID') ?>/" + val_item, '', function (response) {  
                        // show hidden form
                        $('#main_form').show();

                        $('#npwpd').val(response.npwpd);
                        $('#nopd').val(response.nopd);   
                        // change jenis usaha
                        $('#jenispajak').val(response.kodejenispajak);
                        $('select[name="jenispajak"]').change();

                    }); 
                }      
            }
        });

        $('select[name="jenispajak"]').change(function () {
            if ($(this).val()) {
                $.getJSON("<?php echo site_url('Sptpd/changeForm') ?>/" + $(this).val(), '', function (response) {
                    $('#form_by_kodejenispajak').html(response.html);
                });
            } else {
                $('#form_by_kodejenispajak').html('');
            }
        });

    })

</script>