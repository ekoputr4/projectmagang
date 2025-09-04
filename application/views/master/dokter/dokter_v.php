<?php echo @$err; ?>
<div id='alert'></div>

  <div class="row-fluid" style="height:750px !important; overflow-y: scroll;">
    <div class="span12">
      <div class="portlet">
        <div class="form-search fright">
          <a style='float:right; margin-right: 10px;' class="btn yellow" id="keluar" href="<?php echo site_url('dashboard'); ?>"><i class="icon-signout icon-white"></i> Keluar</a>
          <a style='float:right; margin-right: 10px;' class="btn purple" onClick="location.href='<?=base_url()."index.php/dokter_c/cetakdokter"?>'"><i class="icon-download"></i> Download</a>
          <a class="btn blue" style='float:right; margin-right: 10px;' data-toggle="modal" href="#tambah"><i class="icon-plus"></i> Tambah </a>
          <div class="input-prepend">
            <span class="add-on">Nama Dokter</span>
            <input class="m-wrap medium" type="text" placeholder="Cari Nama Dokter" id="cari" name="cari" onchange="caridokter();" oninput="this.onchange();"/>
          </div>
        </div>
      </div>
        
      <table class="table table-striped table-bordered table-hover table-full-width" >
        <thead>
        <tr bgcolor="#245397">
          <th style="text-align:center"><font color="white">No</font></th>
          <th style="text-align:center"><font color="white">ID</font></th>          
          <th style="text-align:center"><font color="white">Nama</font></th>          
          <th style="text-align:center"><font color="white">NIK</font></th>          
          <th style="text-align:center"><font color="white">Jenis Kelamin</font></th>          
          <th style="text-align:center"><font color="white">Alamat</font></th>          
          <th style="text-align:center"><font color="white">HP</font></th>          
          <th style="text-align:center"><font color="white">Email</font></th>          
          <th style="text-align:center"><font color="white">Tgl Lahir</font></th>          
          <th style="text-align:center"><font color="white">Action</font></th>
        </tr>
        </thead>
        <tbody id='datadokter'>
          <?php 
          $no=0;
          if (count($datadokter)>0) {
          foreach ($datadokter as $row) { 
            $no++;
          ?>
              <tr>
                  <td style="text-align:center"><?=$no; ?></td>
                  <td style="text-align:center"><?=$row->noref ?></td>                  
                  <td><?=$row->nama ?></td>
                  <td><?=$row->nik ?></td>
                  <td><?=$row->kelamin ?></td>
                  <td><?=$row->alamat ?></td>
                  <td><?=$row->hp ?></td>
                  <td><?=$row->email ?></td>
                  <td><?=$row->tgllahir ?></td>
                  <td style="text-align:center">
                      <a class="btn mini yellow sbold" data-toggle="modal" href="#tambah" onClick="editdokter('<?php echo $row->noindex?>')"><i class="icon-edit"></i> Edit </a>
                      <a class="btn mini red sbold" data-toggle="modal" href="#delete" onClick="hapusdokter('<?php echo $row->noindex?>')"><i class="icon-trash"></i> Hapus</a> 
                  </td>
              </tr>
          <?php }}?>
        </tbody>
      </table>

  </div>
</div>

<div id="tambah" class="modal fade" tabindex="-1" data-width="760">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      <h4 class="modal-title"><i class='icon-plus'></i> Tambah</h4>
  </div>
  <div class="modal-body ">
    <div class="row-fluid">
      <div class="span12">
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">NIK</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="nik">
              <input type="hidden" class="s-wrap span2" id="noindex">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Nama</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="nama">
            </div>
          </div>
          <div class="control-group">  
            <label class="control-label">Jenis Kelamin</label>
            <div class="controls"> 
              <select class="form-control" id="kelamin">                
                <option value="Laki-laki">Laki-laki</option>                
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
          </div>                                  
          <div class="control-group">
            <label class="control-label">Alamat</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="alamat">
            </div>
          </div>                    
          <div class="control-group">
            <label class="control-label">No.HP / WA</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="hp">
            </div>
          </div>                              
          <div class="control-group">
            <label class="control-label">Email</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="email">
            </div>
          </div>                                      
          <div class="control-group">
            <label class="control-label">Tanggal Lahir</label>
            <div class="controls">
              <div class="input-append date date-picker">
                <input class="m-wrap m-ctrl-small date-picker" size="2" type="text" value="<?=date('Y-m-d'); ?>" id="tgllahir" onchange="cekusia()"/><span class="add-on"><i class="icon-calendar"></i></span>
              </div>                         
            </div>            
          </div>                               
        </form>
      </div>
    </div>
    <div class="modal-footer">
        <a class="btn green" href="#" onclick="simpandokter()"><i class="icon-save"></i> Simpan</a>
        <a class="btn red" data-dismiss="modal" href="#"><i class="icon-signout"></i> Keluar</a>
    </div>
  </div>
</div>

<div id="delete" class="modal fade" tabindex="-1" data-width="760">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      <h4 class="modal-title"><i class='icon-remove'></i> Hapus</h4>
  </div>
  <div class="modal-body ">
    <div class="row-fluid">
      <div class="span12">
        <div class="control-group">
          <label class="control-label">Anda yakin akan menghapus data berikut ?</label>
        </div>                          
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Nama</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="dokter2">
              <input type="hidden" class="s-wrap span3" id="id2" disabled>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Alasan</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="alasan">
            </div>
          </div>          
        </form>
      </div>
    </div>
    <div class="modal-footer">
        <a class="btn green" href="#" onclick="deletedokter()"><i class="icon-save"></i> Hapus</a>
        <a class="btn btn-outline dark" data-dismiss="modal" href="#"></i> Keluar</a>
    </div>
  </div>
</div>

<script type="application/javascript">
function simpandokter(){
   xajax_simpandokter(
                        document.getElementById("noindex").value,
                        document.getElementById("nik").value,
                        document.getElementById("nama").value,
                        document.getElementById("kelamin").value,
                        document.getElementById("alamat").value,
                        document.getElementById("hp").value,
                        document.getElementById("email").value,
                        document.getElementById("tgllahir").value
                      );
   kosong();
}

function kosong(){
      document.getElementById("noindex").value='';
      document.getElementById("nik").value='';
      document.getElementById("nama").value='';
      document.getElementById("kelamin").value='Laki-laki';
      document.getElementById("alamat").value='';
      document.getElementById("hp").value='';
      document.getElementById("email").value='';
}

function editdokter(noindex){
  xajax_editdokter(noindex);
}

function hapusdokter(noindex){
  xajax_hapusdokter(noindex);
}

function deletedokter(){
  if(document.getElementById("alasan").value!=''){
    xajax_deletedokter(document.getElementById("id2").value,document.getElementById("dokter2").value,document.getElementById("alasan").value);
  }else{
    alert('Alasan harus diisi');
  }
}

$('#cari').on('input',function(e){
    xajax_caridokter(document.getElementById('cari').value);
});
</script>

