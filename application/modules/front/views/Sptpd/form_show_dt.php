<?php if(isset($value->id)) :?>
<div class="signup-box widget-box no-border">
    <div class="widget-body">
        <div class="widget-main">
            
            <div class="space-6"></div>
            <?php echo isset($value->id) ? '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong>Data ditemukan.</strong><br>Pencarian dengan keyword ditemukan.</div>' : 'Data tidak ditemukan' ; ?>

            <form>
                <fieldset>
                <div class="col-md-12 no-padding">
                <div class="box box-primary" id="box_identity">
                    <img id="avatar" class="profile-user-img img-responsive center" src="<?php echo isset($value->pas_foto)? base_url().PATH_IMG_DEFAULT.$value->pas_foto : base_url().'assets/img/avatar.png'?>" alt="Pas Foto Anggota" style="width:100%">
                    
                    <div id="no_kta"><?php echo isset($value->no_kta) ? '<h3 class="profile-username text-center">'.$value->no_kta.'</h3>' : '<center><b>-No KTA anda belum diterbitkan-</b></center><br>' ; ?></div>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                        <small style="color: blue; font-weight: bold; font-size: 11px">Nama Anggota: </small><div id="nama_anggota"><?php echo isset($value->nama) ? $value->nama : '' ; ?></div>
                        </li>
                        <li class="list-group-item">
                        <small style="color: blue; font-weight: bold; font-size: 11px">NIK: </small><div id="no_ktp"><?php echo isset($value->no_id) ? $value->no_id : '' ; ?></div>
                        </li>
                        <li class="list-group-item">
                        <small style="color: blue; font-weight: bold; font-size: 11px">Tempat/Tgl Lahir: </small><div id="tgl_lhr"><?php echo isset($value->tmp_lhr) ? $value->tmp_lhr : '' ; ?>, <?php echo isset($value->tgl_lhr) ? $value->tgl_lhr : '' ; ?></div>
                        </li>
                        <li class="list-group-item">
                        <small style="color: blue; font-weight: bold; font-size: 11px">Umur: </small><div id="umur"><?php echo isset($value->tgl_lhr) ? $this->tanggal->umur($value->tgl_lhr) : '' ; ?></div>
                        </li>
                        <li class="list-group-item">
                        <small style="color: blue; font-weight: bold; font-size: 11px">Alamat: </small><div id="alamat"><?php echo isset($value->alamat_ktp) ? $value->alamat_ktp : '' ; ?></div>
                        </li>
                        <li class="list-group-item">
                        <small style="color: blue; font-weight: bold; font-size: 11px">No Telp/HP: </small>
                        <div id="hp"><?php echo isset($value->no_telp) ? $value->no_telp : '' ; ?></div>
                        <div id="no_telp"></div>
                        </li>
                        <li class="list-group-item">
                        <small style="color: blue; font-weight: bold; font-size: 11px">Masa Aktif: </small><div id="masa_aktif"><?php echo isset($value->masa_aktif) ? $value->masa_aktif : '<span class="red">Tidak Aktif</span>' ; ?></div>
                        </li>

                        <li class="list-group-item">
                        <small style="color: blue; font-weight: bold; font-size: 11px">Surat Tugas: </small><div id="masa_aktif"><a href="<?php echo base_url().PATH_FILE_DEFAULT.$value->surat_tugas; ?>" target="_blank">Download Surat Tugas</a></div>
                        </li>

                        <li class="list-group-item">
                        <small style="color: blue; font-weight: bold; font-size: 11px">KTA: </small><div id="masa_aktif"><a href="<?php echo base_url().PATH_IMG_DEFAULT.$value->kta; ?>" target="_blank">Download KTA</a></div>
                        </li>

                        <li class="list-group-item">
                        <small style="color: blue; font-weight: bold; font-size: 11px">Catatan: </small><div id="catatan_pasien">
                            <?php echo isset($value->tgl_verifikasi)?'<b>Terverifikasi</b> sebagai Anggota '.$value->jenis_anggota.' pada tanggal '.$value->tgl_verifikasi.'':'<b>Belum terverifikasi</b> sebagai Anggota '.$value->jenis_anggota.'. (Dalam proses)';?>
                        </div>
                        </li>
                    </ul>

                </div>
                </div>
                </fieldset>
            </form>
        </div>

    </div><!-- /.widget-body -->
</div>
<?php else: ?>
    <div class="alert alert-danger"><strong>Tidak ada data ditemukan !</strong><br>Silahkan masukan No. KTA atau No. Identitas anda dengan benar.</div>
<?php endif; ?>