<?php echo @$err; ?>
<div id='alert'></div>

  <div class="row-fluid" style="height:750px !important; overflow-y: scroll;">
    <div class="span12">
      <div class="portlet">
        <div class="form-search fright">
          <a style='float:right; margin-right: 10px;' class="btn yellow" id="keluar" href="<?php echo site_url('dashboard'); ?>"><i class="icon-signout icon-white"></i> Keluar</a>
          <a style='float:right; margin-right: 10px;' class="btn purple" onClick="location.href='<?=base_url()."index.php/kelas_c/cetakkelas"?>'"><i class="icon-download"></i> Download</a>
          <a class="btn blue" style='float:right; margin-right: 10px;' data-toggle="modal" href="#tambah"><i class="icon-plus"></i> Tambah </a>
          <div class="input-prepend">
            <span class="add-on">Kelas</span>
            <input class="m-wrap medium" type="text" placeholder="Cari Kelas" id="cari" name="cari" onchange="carikelas();" oninput="this.onchange();"/>
          </div>
        </div>
      </div>
        
      <table class="table table-striped table-bordered table-hover table-full-width" >
        <thead>
        <tr bgcolor="#245397">
          <th style="text-align:center"><font color="white">No</font></th>
          <th style="text-align:center"><font color="white">Kelas</font></th>          
          <th style="text-align:center"><font color="white">Jurusan</font></th>          
          <th style="text-align:center"><font color="white">Keterangan</font></th>          
          <th style="text-align:center"><font color="white">Action</font></th>
        </tr>
        </thead>
        <tbody id='datakelas'>
          <?php 
          $no=0;
          if (count($datakelas)>0) {
          foreach ($datakelas as $row) { 
            $no++;
          ?>
              <tr>
                  <td style="text-align:center"><?=$no; ?></td>
                  <td style="text-align:center"><?=$row->kelas ?></td>                  
                  <td><?=$row->jurusan ?></td>
                  <td><?=$row->keterangan ?></td>
                  <td style="text-align:center">
                      <a class="btn mini yellow sbold" data-toggle="modal" href="#tambah" onClick="editkelas('<?php echo $row->noindex?>')"><i class="icon-edit"></i> Edit </a>
                      <a class="btn mini red sbold" data-toggle="modal" href="#delete" onClick="hapuskelas('<?php echo $row->noindex?>')"><i class="icon-trash"></i> Hapus</a> 
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
            <label class="control-label">Kelas</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="kelas">
              <input type="hidden" class="s-wrap span2" id="noindex">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Jurusan</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="jurusan">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Keterangan</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="keterangan">
            </div>
          </div>                    
        </form>
      </div>
    </div>
    <div class="modal-footer">
        <a class="btn green" href="#" onclick="simpankelas()"><i class="icon-save"></i> Simpan</a>
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
            <label class="control-label">Kelas</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="kelas2">
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
        <a class="btn green" href="#" onclick="deletekelas()"><i class="icon-save"></i> Hapus</a>
        <a class="btn btn-outline dark" data-dismiss="modal" href="#"></i> Keluar</a>
    </div>
  </div>
</div>

<script type="application/javascript">
function simpankelas(){
   xajax_simpankelas(document.getElementById("noindex").value,document.getElementById("kelas").value,document.getElementById("jurusan").value,document.getElementById("keterangan").value);
}

function editkelas(noindex){
  xajax_editkelas(noindex);
}

function hapuskelas(noindex){
  xajax_hapuskelas(noindex);
}

function deletekelas(){
  if(document.getElementById("alasan").value!=''){
    xajax_deletekelas(document.getElementById("id2").value,document.getElementById("kelas2").value,document.getElementById("alasan").value);
  }else{
    alert('Alasan harus diisi');
  }
}

$('#cari').on('input',function(e){
    xajax_carikelas(document.getElementById('cari').value);
});
</script>

