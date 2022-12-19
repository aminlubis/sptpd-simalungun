<script type="text/javascript" src="<?php echo base_url()?>assets/jquery_number/jquery.number.js"></script>
<script>
    $('.format_number').number( true, 0, '.' );

    $(document).ready(function(){
        sumOmset();
    })
    function sumOmset(){
        // Omset
        var a = $('#bayarmakanan').val();
        var b = $('#bayarminum').val();
        var c = $('#bayarmakanminum').val();
        var d = $('#byrnasikotak').val();
        var e = $('#byrpelayanan').val();
        var f = $('#byrlainnya').val();
        var omset = parseInt(a) + parseInt(b) + parseInt(c) + parseInt(d) + parseInt(e) + parseInt(f);
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
    <label class="control-label col-md-2">Makanan</label>
    <div class="col-md-1">
        <input name="bayarmakanan" id="bayarmakanan" value="<?php echo isset($value->bayarmakanan)?$value->bayarmakanan:0?>" onchange="sumOmset()" class="form-control format_number" type="text">
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-2">Minuman</label>
    <div class="col-md-1">
        <input name="bayarminum" id="bayarminum" value="<?php echo isset($value->bayarminum)?$value->bayarminum:0?>" onchange="sumOmset()" class="form-control format_number" type="text">
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-2">Makanan & Minuman</label>
    <div class="col-md-1">
        <input name="bayarmakanminum" id="bayarmakanminum" value="<?php echo isset($value->bayarmakanminum)?$value->bayarmakanminum:0?>" onchange="sumOmset()" class="form-control format_number" type="text">
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-2">Nasi Kotak/Nasi Bungkus</label>
    <div class="col-md-1">
        <input name="byrnasikotak" id="byrnasikotak" value="<?php echo isset($value->byrnasikotak)?$value->byrnasikotak:0?>" onchange="sumOmset()" class="form-control format_number" type="text">
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-2">Pelayanan Prasmanan</label>
    <div class="col-md-1">
        <input name="byrpelayanan" id="byrpelayanan" value="<?php echo isset($value->byrpelayanan)?$value->byrpelayanan:0?>" onchange="sumOmset()" class="form-control format_number" type="text">
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-2">Pembayarann Lainnya</label>
    <div class="col-md-1">
        <input name="byrlainnya" id="byrlainnya" value="<?php echo isset($value->byrlainnya)?$value->byrlainnya:0?>" onchange="sumOmset()" class="form-control format_number" type="text">
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-2">Total Omset</label>
    <div class="col-md-1">
        <input name="ttlomset" id="ttlomset" value="<?php echo isset($value->ttlomset)?$value->ttlomset:0?>"  class="form-control format_number" type="text" readonly>
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


