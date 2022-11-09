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
    <a href="#" class="btn btn-xs btn-primary" onclick="getMenu('Objek_pajak/form')"><i class="fa fa-plus-circle"></i> Tambah Objek Pajak</a>
    <hr class="separator">
    <!-- div.table-responsive -->
    <!-- div.dataTables_borderWrap -->
    <div style="margin-top:-27px">
      <table id="dynamic-table" base-url="objek_pajak/Objek_pajak" class="table table-bordered table-hover">
       <thead>
        <tr>  
          <th width="30px" class="center">No</th>
          <th width="180px">No. Objek Pajak</th>
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
    </div>
  </div><!-- /.col -->
</div><!-- /.row -->

<script src="<?php echo base_url().'assets/js/custom/als_datatable.js'?>"></script>



