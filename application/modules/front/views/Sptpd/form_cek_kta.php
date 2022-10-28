<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="login-container">
            

            <div class="space-6"></div>

            <div class="position-relative">

                <div id="forgot-box" class="forgot-box widget-box no-border">
                    <div class="widget-body">
                        <div class="widget-main">
                            <h4 class="header red lighter bigger">
                                <i class="ace-icon fa fa-key"></i>
                                Cek Masa Aktif Anggota
                            </h4>

                            <div class="space-6"></div>
                            <p>
                                Masukan Nomor KTA/No Identitas (KTP/SIM/Passport)
                            </p>

                            <form>
                                <fieldset>
                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" id="keyword" class="form-control" placeholder="Masukan No.KTA/ No. Identitas" />
                                            <i class="ace-icon fa fa-lock"></i>
                                        </span>
                                    </label>

                                    <div class="clearfix">
                                        <button type="button" onclick="show_data()" class="width-35 pull-right btn btn-sm btn-danger">
                                            <i class="ace-icon fa fa-lightbulb-o"></i>
                                            <span class="bigger-110">Tampilkan!</span>
                                        </button>
                                    </div>
                                </fieldset>
                            </form>
                        </div><!-- /.widget-main -->

                    </div><!-- /.widget-body -->
                </div><!-- /.forgot-box -->

                <div id="show-result-data"></div><!-- /.signup-box -->

            </div><!-- /.position-relative -->

        </div>
    </div><!-- /.col -->
</div>

<script>
    function show_data(){
        $('#show-result-data').load('front/Register/show_data?key='+$('#keyword').val()+'');
    }
</script>