<script type="text/javascript" src="<?php echo base_url()?>assets/jquery_number/jquery.number.js"></script>
<script>
    $('.format_number').number( true, 0, '.' );
</script>

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
        <form class="form-horizontal" method="post" id="form-default" action="" enctype="multipart/form-data" autocomplete="off">

            
            <p style="font-weight: bold">CARI OBJEK PAJAK ATAU JENIS USAHA</p>

            <!-- hidden -->
            <input type="hidden" name="namawajibpajak" id="namawajibpajak" value="<?php echo isset($objek_pajak->nama_wp)?$objek_pajak->nama_wp:''?>">
            <input type="hidden" name="noktp" value="<?php echo isset($objek_pajak->noktp)?$objek_pajak->noktp:''?>" id="noktp">
            <input type="hidden" name="nama_usaha_op" id="nama_usaha_op" value="<?php echo isset($objek_pajak->nama_usaha)?$objek_pajak->nama_usaha:''?>">
            <input type="hidden" name="id_hop" id="id_hop" value="<?php echo isset($_GET['id_hop'])?$_GET['id_hop']:''?>">

            <div>
                <label for="form-field-mask-1">
                    Pilih Objek Pajak :
                </label>

                <div class="input-group col-md-12">
                    <input name="jenisusaha" id="jenisusaha" value="<?php echo isset($objek_pajak->nama_usaha)?$objek_pajak->nama_usaha:''?>"  class="form-control" type="text">
                </div>
            </div>

            <hr>
            
            <div id="wajib_pajak_profil" style="display:none">
                <p style="font-weight: bold">PROFIL WAJIB PAJAK</p>
                <span id="txt_nama_wp" style="font-size: 18px; font-weight: bold"></span><br>
                <span id="txt_alamat_wp" style="font-style: italic"></span>
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
                            <input name="periodeawal" id="periodeawal" value="<?php echo date('Y-m-d')?>"  class="form-control date-picker" type="text" data-date-format="yyyy-mm-dd">
                            <span class="input-group-addon">
                            <i class="ace-icon fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                    <label class="control-label col-md-1">s/d Tanggal</label>  
                    <div class="col-md-2">
                        <div class="input-group">
                            <input name="periodeakhir" id="periodeakhir" value="<?php echo date('Y-m-d', strtotime("+30 days"));?>"  class="form-control date-picker" type="text" data-date-format="yyyy-mm-dd">
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
                            <input name="tgllapor" id="tgllapor" value="<?php echo date('Y-m-d')?>"  class="form-control date-picker" type="text" data-date-format="yyyy-mm-dd">
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
                        <input name="dpp" id="dpp" value=""  class="form-control format_number" type="text">
                    </div>
                    <label class="control-label col-md-1">Tarif Pajak</label>
                    <div class="col-md-1">
                        <input name="trfpajak" id="trfpajak" value="10"  class="form-control" type="text">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2">Pajak Sebelum Pembulatan</label>
                    <div class="col-md-1">
                        <input name="pajaksblmpembulatan" id="pajaksblmpembulatan" value=""  class="form-control format_number" type="text">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2">Pajak Terutang</label>
                    <div class="col-md-1">
                        <input name="pajakterutang" id="pajakterutang" value="<?php echo isset($hop->pajakterutang)?$hop->pajakterutang:0?>"  class="form-control format_number" type="text">
                    </div>
                </div>

                
                
                <div class="col-md-4 no-padding" style="margin-left: -6px !important; padding-top: 20px !important">
                    
                    <a onclick="getMenu('sptpd/Sptpd_opd')" href="#" class="btn btn-sm btn-success">
                        <i class="ace-icon fa fa-arrow-left icon-on-right bigger-110"></i>
                        Kembali ke daftar
                    </a>
                    <?php if(!isset($_GET['act'])) : ?>
                    
                    <button type="submit" id="btnSave" name="submit" class="btn btn-sm btn-primary">
                        <i class="ace-icon fa fa-check-square-o icon-on-right bigger-110"></i>
                        Simpan Data
                    </button>
                    <button type="reset" id="btnReset" name="submit" class="btn btn-sm btn-danger" style="margin-left: -1px">
                        <i class="ace-icon fa fa-refresh icon-on-right bigger-110"></i>
                        Reset Form
                    </button>
                    <?php else:?>
                        <button type="button" id="btn_print" name="submit" class="btn btn-sm btn-inverse">
                        <i class="ace-icon fa fa-print icon-on-right bigger-110"></i>
                        Cetak SPTPD
                    </button>
                    <?php endif;?>

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
        
        <?php if(isset($objek_pajak->id_izin_usaha)) :?>
            getUsahaByID(<?php echo $objek_pajak->id_izin_usaha?>);
            $('#').focus();
        <?php endif; ?>
        
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
                $('#page-area-content').load('sptpd/Sptpd_opd');
                }else{
                $.achtung({message: jsonResponse.message, timeout:5, className: 'achtungFail'});
                $('#page-area-content').html('<div class="alert alert-danger"><strong><i class="fa fa-times-circle red"></i> Gagal !</strong><br>Maaf, proses Input Data e-SPTPD anda gagal dilakukan, silahkan coba beberapa saat lagi.</div>');
                }
                achtungHideLoader();
            }
        }); 

        $('#jenisusaha').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "Templates/References/getJenisUsaha",
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

                $('#jenisusaha').val(label_item);

                if (val_item) {
                    $('#npwpd').val('');
                    $('#nopd').val('');

                    getUsahaByID(val_item);

                } else {
                    $('#form_by_kodejenispajak').html('');
                }
                
            }
        });


        $('select[name="jenispajak"]').change(function () {
            if ($(this).val()) {
                $('#form-default').attr('action','sptpd/Sptpd/process_'+$(this).val()+'');
                $.getJSON("<?php echo site_url('Sptpd/changeForm') ?>/" + $(this).val() + "?id_hop="+$('#id_hop').val()+"", '', function (response) {
                    $('#form_by_kodejenispajak').html(response.html);
                });
            } else {
                $('#form_by_kodejenispajak').html('');
            }
        });

        $('select[name="jenisusaha"]').change(function () {
            if ($(this).val()) {
                $('#npwpd').val('');
                $('#nopd').val('');

                $.getJSON("<?php echo site_url('Templates/References/getUsahaByID') ?>/" + $(this).val(), '', function (response) {  

                    if(response.is_verified == 1){
                        // show hidden form
                        console.log(response.nama_usaha);
                        $('#main_form').show();
                        $('#nama_usaha_op').val(response.nama_usaha);
                        $('#npwpd').val(response.npwpd);
                        $('#nopd').val(response.nopd);   
                        // change jenis usaha
                        $('#jenispajak').val(response.kodejenispajak);
                        $('select[name="jenispajak"]').change();
                    }else{
                        alert('Mohon maaf objek pajak anda belum diverifikasi oleh Petugas Pajak, Silahkan hubungi Kantor Pajak terdekat.'); return false;
                    }
                    

                }); 
            } else {
                $('#form_by_kodejenispajak').html('');
            }
        });

    })

    function getUsahaByID(val_item){
        $.getJSON("<?php echo site_url('Templates/References/getUsahaByID') ?>/" + val_item, '', function (response) {  

            if(response.is_verified == 1){
                // show hidden form
                console.log(response.nama_usaha);
                $('#wajib_pajak_profil').show();
                $('#main_form').show();
                $('#txt_nama_wp').text(response.nama_wp);
                $('#txt_alamat_wp').text(response.alamat_usaha+', no. telp'+response.telp);
                $('#namawajibpajak').val(response.nama_wp);
                $('#noktp').val(response.noktp);
                $('#nama_usaha_op').val(response.nama_usaha);
                $('#npwpd').val(response.npwpd);
                $('#nopd').val(response.nopd);   
                // change jenis usaha
                $('#jenispajak').val(response.kodejenispajak);
                $('select[name="jenispajak"]').change();
            }else{
                alert('Mohon maaf objek pajak anda belum diverifikasi oleh Petugas Pajak, Silahkan hubungi Kantor Pajak terdekat.'); return false;
            }

        }); 
    }

    

</script>