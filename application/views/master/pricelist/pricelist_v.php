<?php echo @$err; ?>
<div id='alert'></div>

  <div class="row-fluid" style="height:750px !important; overflow-y: scroll;">
    <div class="span12">
      <div class="portlet">
        <div class="form-search fright">
          <a style='float:right; margin-right: 10px;' class="btn yellow" id="keluar" href="<?php echo site_url('dashboard'); ?>"><i class="icon-signout icon-white"></i> Keluar</a>
          <a style='float:right; margin-right: 10px;' class="btn purple" onClick="location.href='<?=base_url()."index.php/pricelist_c/cetakpricelist"?>'"><i class="icon-download"></i> Download</a>
          <a class="btn blue" style='float:right; margin-right: 10px;' data-toggle="modal" href="#tambah"><i class="icon-plus"></i> Tambah </a>
          <div class="input-prepend">
            <span class="add-on">Jenis Tindakan</span>
            <input class="m-wrap medium" type="text" placeholder="Cari Jenis Tindakan" id="cari" name="cari" onchange="caripricelist();" oninput="this.onchange();"/>
          </div>
        </div>
      </div>
        
      <table class="table table-striped table-bordered table-hover table-full-width" >
        <thead>
        <tr bgcolor="#245397">
          <th style="text-align:center"><font color="white">No</font></th>
<!--           <th style="text-align:center"><font color="white">Kategori</font></th>           -->
          <th style="text-align:center"><font color="white">Nama</font></th>          
          <th style="text-align:center"><font color="white">Biaya</font></th>          
          <th style="text-align:center"><font color="white">Action</font></th>
        </tr>
        </thead>
        <tbody id='datapricelist'>
          <?php 
          $no=0;
          if (count($datapricelist)>0) {
          foreach ($datapricelist as $row) { 
            $no++;
          ?>
              <tr>
                  <td style="text-align:center"><?=$no; ?></td>
                  <!-- <td style="text-align:center"><?=$row->kategori ?></td>                   -->
                  <td><?=$row->nama ?></td>
                  <td style="text-align:right;"><?=number_format($row->biaya, 0, ',', '.') ?></td>
                  <td style="text-align:center">
                      <a class="btn mini yellow sbold" data-toggle="modal" href="#tambah" onClick="editpricelist('<?php echo $row->noindex?>')"><i class="icon-edit"></i> Edit </a>
                      <a class="btn mini red sbold" data-toggle="modal" href="#delete" onClick="hapuspricelist('<?php echo $row->noindex?>')"><i class="icon-trash"></i> Hapus</a> 
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
<!--           <div class="control-group">
            <label class="control-label">Kategori</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="kategori">
              <input type="hidden" class="s-wrap span2" id="noindex">
            </div>
          </div> -->
          <div class="control-group">
            <label class="control-label">Nama</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="nama">
              <input type="hidden" class="s-wrap span2" id="noindex">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Biaya</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="biaya">
            </div>
          </div>                    
        </form>
      </div>
    </div>
    <div class="modal-footer">
        <a class="btn green" href="#" onclick="simpanpricelist()"><i class="icon-save"></i> Simpan</a>
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
              <input type="text" class="s-wrap span8" id="pricelist2">
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
        <a class="btn green" href="#" onclick="deletepricelist()"><i class="icon-save"></i> Hapus</a>
        <a class="btn btn-outline dark" data-dismiss="modal" href="#"></i> Keluar</a>
    </div>
  </div>
</div>

<script type="application/javascript">
function simpanpricelist(){
   // xajax_simpanpricelist(document.getElementById("noindex").value,document.getElementById("kategori").value,document.getElementById("nama").value,document.getElementById("biaya").value);
   xajax_simpanpricelist(document.getElementById("noindex").value,document.getElementById("nama").value,document.getElementById("biaya").value);   
}

function editpricelist(noindex){
  xajax_editpricelist(noindex);
}

function hapuspricelist(noindex){
  xajax_hapuspricelist(noindex);
}

function deletepricelist(){
  if(document.getElementById("alasan").value!=''){
    xajax_deletepricelist(document.getElementById("id2").value,document.getElementById("pricelist2").value,document.getElementById("alasan").value);
  }else{
    alert('Alasan harus diisi');
  }
}

$('#cari').on('input',function(e){
    xajax_caripricelist(document.getElementById('cari').value);
});
</script>

