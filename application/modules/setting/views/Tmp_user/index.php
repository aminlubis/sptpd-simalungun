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

    <div class="clearfix" style="margin-bottom:-5px">
      

    </div>
    <hr class="separator">
    <!-- div.table-responsive -->

    <!-- div.dataTables_borderWrap -->
    <div style="margin-top:-27px">
      <table id="dynamic-table" base-url="setting/Tmp_user" data-id="reftbl=qrcode_user&fldid=id" url-detail="Templates/References/get_detail_table" class="table table-bordered table-hover">

       <thead>
        <tr>  
          <th width="40px" class="center"></th>
          <th width="40px" class="center"></th>
          <th width="40px" class="center"></th>
          <th width="50px">ID</th>
          <th>Nama</th>
          <th>Email</th>
          <th>No KTP</th>
          <th>Status</th>
          <th>Tanggal Aktif</th>
          <th>Level</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    </div>
  </div><!-- /.col -->
</div><!-- /.row -->


<script src="<?php echo base_url().'assets/js/custom/als_datatable_with_detail_custom_url.js'?>"></script>

