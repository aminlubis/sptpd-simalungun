<script type="text/javascript" src="<?php echo base_url()?>assets/jquery_number/jquery.number.js"></script>
<script>
    $('.format_number').number( true, 0, '.' );

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
        <input name="bayarmakanan" id="bayarmakanan" value="" onchange="sumOmset()" class="form-control format_number" type="text">
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-2">Minuman</label>
    <div class="col-md-1">
        <input name="bayarminum" id="bayarminum" value="" onchange="sumOmset()" class="form-control format_number" type="text">
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-2">Makanan & Minuman</label>
    <div class="col-md-1">
        <input name="bayarmakanminum" id="bayarmakanminum" value="" onchange="sumOmset()" class="form-control format_number" type="text">
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-2">Nasi Kotak/Nasi Bungkus</label>
    <div class="col-md-1">
        <input name="byrnasikotak" id="byrnasikotak" value="" onchange="sumOmset()" class="form-control format_number" type="text">
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-2">Pelayanan Prasmanan</label>
    <div class="col-md-1">
        <input name="byrpelayanan" id="byrpelayanan" value="" onchange="sumOmset()" class="form-control format_number" type="text">
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-2">Pembayarann Lainnya</label>
    <div class="col-md-1">
        <input name="byrlainnya" id="byrlainnya" value="" onchange="sumOmset()" class="form-control format_number" type="text">
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


