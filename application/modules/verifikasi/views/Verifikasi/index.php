<div class="row">
  <div class="col-xs-12">

    <div class="page-header">
      <h1>
        <?php echo $title?>
        <small>
          <i class="ace-icon fa fa-angle-double-right"></i>
          <?php echo isset($breadcrumbs)?$breadcrumbs:''?>
        </small>
      </h1>
    </div><!-- /.page-header -->

    <div class="clearfix"></div>

    <!-- div.table-responsive -->
    <form class="form-horizontal" method="post" id="form-default" action="<?php echo site_url('verifikasi/Verifikasi/find_data')?>" enctype="multipart/form-data">
      <br>

      <p style="font-weight: bold">PARAMETER PENCARIAN DATA</p>

      <div class="form-group">
        <label class="control-label col-md-1">Status</label>
        <div class="col-md-2">
            <select name="status" id="status" class="form-control">
              <option value="">-Pilih semua-</option>
              <option value="0" selected>Belum di verifikasi</option>
              <option value="1">Sudah di verifikasi</option>
            </select>
        </div>
        <label class="control-label col-md-1">Jenis Pajak</label>
        <div class="col-md-2">
            <?php echo $this->master->custom_selection(array('table'=>'jenispajak', 'where'=>array(), 'id'=>'kodejenispajak', 'name' => 'jenispajak'),'','jenispajak','jenispajak','chosen-slect form-control','','');?>
        </div>
        <label class="control-label col-md-1">Kecamatan</label>
        <div class="col-md-2">
            <?php echo $this->master->custom_selection(array('table'=>'kode_kecamatan', 'where'=>array(), 'id'=>'kode_kecamatan', 'name' => 'nama_kecamatan'),'','kecamatan','kecamatan','chosen-slect form-control','','');?>
        </div>

        <label class="control-label col-md-1">Kelurahan</label>
        <div class="col-md-2">
            <?php echo $this->master->custom_selection(array('table'=>'kode_kelurahan', 'where'=>array(), 'id'=>'kode_kelurahan', 'name' => 'nama_kelurahan'),'','kelurahan','kelurahan','chosen-slect form-control','','');?>
        </div>
        <div class="col-md-1">
            <a class="btn btn-xs btn-danger" href="#" onclick="reset_form()"><i class="fa fa-refresh"></i> Reset Pencarian</a>
        </div>
      </div>
    <hr>
    <p style="font-weight: bold">HASIL PENCARIAN DATA</p>
    <br>
    <!-- div.dataTables_borderWrap -->
    <div style="margin-top:-10px">
      <table id="dynamic-table" base-url="verifikasi/Verifikasi" class="table table-bordered table-hover">
       <thead>
        <tr>  
          <th width="30px" class="center">No</th>
          <th width="180px">No. Objek Pajak</th>
          <th>Jenis Pajak</th>
          <th>Nama Usaha</th>
          <th>Izin Usaha</th>
          <th width="100px">Jenis Usaha</th>
          <th width="130px">Tanggal Daftar</th>
          <th width="150px">Alamat Usaha</th>
          <th width="150px">Kecamatan</th>
          <th width="120px">Kelurahan</th>
          <th width="150px">Aksi</th>
          
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>

    </form>
    </div>
  </div><!-- /.col -->
</div><!-- /.row -->

<script src="<?php echo base_url().'assets/js/custom/als_datatable.js'?>"></script>
<script>
  $('#status, #jenispajak, #kecamatan, #kelurahan').change(function() {
		reload_grid();
	});

  $('select[name="kecamatan"]').change(function () {
      if ($(this).val()) {
          $.getJSON("<?php echo site_url('Templates/References/getVillagesByDistrict') ?>/" + $(this).val(), '', function (data) {
              $('#kelurahan option').remove();
              $('<option value="">-Pilih semua-</option>').appendTo($('#kelurahan'));
              $.each(data, function (i, o) {
                  $('<option value="' + o.kode_kelurahan + '">' + o.nama_kelurahan + '</option>').appendTo($('#kelurahan'));
              });

          });
      } else {
          $('#kelurahan option').remove()
      }
  });

  function reload_grid(){

    oTable.ajax.url($('#dynamic-table').attr('base-url')+'/get_data?status='+$('#status').val()+'&jenispajak='+$('#jenispajak').val()+'&kelurahan='+$('#kelurahan').val()+'&kecamatan='+$('#kecamatan').val()+'').load();

  }

  function reset_form(){
    preventDefault();
    $('#form-default')[0].reset();
    oTable.ajax.url($('#dynamic-table').attr('base-url')+'/get_data?status=0').load();
  }

</script>



