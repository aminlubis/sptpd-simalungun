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

    <!-- div.table-responsive -->
    <a href="#" onclick="getMenu('sptpd/Sptpd/form')" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i> Entri SPTPD</a>
    <!-- div.dataTables_borderWrap -->
    <div style="margin-top:0px">
      <table id="dynamic-table" base-url="sptpd/Sptpd/get_data" class="table table-bordered table-hover">
       <thead>
        <tr>  
          <th width="30px" class="center">No</th>
          <th width="30px">ID</th>
          <th width="80px">No. Objek Pajak</th>
          <th width="200px">Nama Usaha</th>
          <th width="70px">Periode Awal</th>
          <th width="70px">Periode Akhir</th>
          <!-- <th width="70px">No. Virtual Account</th> -->
          <th width="50px">Omset</th>
          <th width="50px">Pajak Terutang</th>
          <th width="50px">Download</th>
          
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    </div>
  </div><!-- /.col -->
</div><!-- /.row -->

<script src="<?php echo base_url().'assets/js/custom/als_datatable.js'?>"></script>



