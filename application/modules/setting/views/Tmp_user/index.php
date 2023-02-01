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
      <a href="#" class="btn btn-xs btn-primary" onclick="getMenu('setting/Tmp_user/form')"><i class="fa fa-plus"></i> Tambah Pengguna</a>
      <a href="#" class="btn btn-xs btn-danger" id="button_delete"><i class="ace-icon fa fa-trash-o bigger-50"></i>Hapus yang dipilih</a>

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
          <th width="120px">Status</th>
          <th width="150px">Tanggal Aktif</th>
          <th width="120px">Level</th>
          <th width="150px">Aksi</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    </div>
  </div><!-- /.col -->
</div><!-- /.row -->


<script src="<?php echo base_url().'assets/js/custom/als_datatable_with_detail_custom_url.js'?>"></script>
<script>
  function aktivasi_akun(myid){
  if(confirm('Are you sure?')){
    $.ajax({
        url: 'setting/Tmp_user/aktivasi',
        type: "post",
        data: {ID:myid},
        dataType: "json",
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
            reload_table();
          }else{
            $.achtung({message: jsonResponse.message, timeout:5, className: 'achtungFail'});
          }
          achtungHideLoader();
        }

      });

  }else{
    return false;
  }
  
}
</script>
