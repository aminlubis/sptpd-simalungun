<script type="text/javascript" src="<?php echo base_url()?>assets/jquery_number/jquery.number.js"></script>
<script>
    $('.format_number').number( true, 0, '.' );

    $(document).ready(function(){
        sumOmset();
    })
    
    function sumOmset(){
        // Omset
        var a = $('#totalpembayarankamar').val();
        var b = $('#totalbayarfasilitas').val();
        var omset = parseInt(a) + parseInt(b);
        $('#ttlomset').val(omset);
        // DPP
        $('#dpp').val(omset);
        // perhitungan
        var pajak = (omset * $('#trfpajak').val()) / 100;
        // Pajak sebelum pembulatan
        $('#pajaksblmpembulatan').val(pajak);
        $('#pajakterutang').val(pajak);

    }

</script>

<br>
<p style="font-weight: bold">PEMBAYARAN <?php echo strtoupper($pajak->jenispajak); ?></p>

<div class="form-group">
    <label class="control-label col-md-2">Omset Pembayaran Kamar</label>
    <div class="col-md-1">
        <input name="totalpembayarankamar" id="totalpembayarankamar" value="<?php echo isset($value->totalpembayarankamar)?$value->totalpembayarankamar:0?>" onchange="sumOmset()" class="form-control format_number" type="text">
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-2">Omset Pembayaran Fasilitas</label>
    <div class="col-md-1">
        <input name="totalbayarfasilitas" id="totalbayarfasilitas" value="<?php echo isset($value->totalbayarfasilitas)?$value->totalbayarfasilitas:0?>" onchange="sumOmset()" class="form-control format_number" type="text">
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-2">Total Omset</label>
    <div class="col-md-1">
        <input name="ttlomset" id="ttlomset" value=""  class="form-control format_number" type="text" readonly>
    </div>
</div>

<br>
<p style="font-weight: bold">UPLOAD REKAP PENDAPATAN</p>
<div class="form-group">
    <label class="control-label col-md-2">Upload file</label>
    <div class="col-md-2">
        <input name="file" id="file" value=""  class="form-control" type="file">
    </div>
</div>


