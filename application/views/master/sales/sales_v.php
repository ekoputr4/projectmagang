<?php echo @$err; ?>
<div id='alert'></div>

  <div class="row-fluid" style="height:750px !important; overflow-y: scroll;">
    <div class="span12">
      <div class="portlet">
        <div class="form-search fright">
          <a style='float:right; margin-right: 10px;' class="btn yellow" id="keluar" href="<?php echo site_url('dashboard'); ?>"><i class="icon-signout icon-white"></i> Keluar</a>
          <a style='float:right; margin-right: 10px;' class="btn purple" onClick="location.href='<?=base_url()."index.php/sales_c/cetaksales"?>'"><i class="icon-download"></i> Download</a>
          <a class="btn blue" style='float:right; margin-right: 10px;' data-toggle="modal" href="#tambah"><i class="icon-plus"></i> Tambah </a>
          <div class="input-prepend">
            <span class="add-on">Nama</span>
            <input class="m-wrap medium" type="text" placeholder="Cari Nama" id="cari" name="cari" onchange="carisales();" oninput="this.onchange();"/>
          </div>
        </div>
      </div>
        
      <table class="table table-striped table-bordered table-hover table-full-width" >
        <thead>
        <tr bgcolor="#245397">
          <th style="text-align:center"><font color="white">No</font></th>
          <th style="text-align:center"><font color="white">Nama</font></th>          
          <th style="text-align:center"><font color="white">HP</font></th>          
          <th style="text-align:center"><font color="white">Email</font></th>          
          <th style="text-align:center"><font color="white">Role</font></th>          
          <th style="text-align:center"><font color="white">Username</font></th>          
          <th style="text-align:center"><font color="white">Action</font></th>
        </tr>
        </thead>
        <tbody id='sales'>
          <?php 
          $no=0;
          if (count($sales)>0) {
          foreach ($sales as $row) { 
            $no++;
          ?>
              <tr>
                  <td style="text-align:center"><?=$no; ?></td>                            
                  <td><?=$row->nama ?></td>
                  <td><?=$row->hp ?></td>
                  <td><?=$row->email ?></td>
                  <td><?=$row->role ?></td>
                  <td><?=$row->username ?></td>
                  <td style="text-align:center">
                      <a class="btn mini yellow sbold" data-toggle="modal" href="#edit" onClick="editsales('<?php echo $row->noindex?>')"><i class="icon-edit"></i> Edit </a>
                      <a class="btn mini red sbold" data-toggle="modal" href="#delete" onClick="hapussales('<?php echo $row->noindex?>')"><i class="icon-trash"></i> Hapus</a> 
                  </td>
              </tr>
          <?php }}?>
        </tbody>
      </table>

  </div>
</div>

<div id="tambah" class="modal fade" tabindex="-1" data-width="80%">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      <h4 class="modal-title"><i class='icon-plus'></i> Tambah</h4>
  </div>
  <div class="modal-body ">
    <div class="row-fluid">
      <div class="span6">
        <form class="form-horizontal " id="form">
<!--           <div class="control-group">
            <label class="control-label">Plant</label>
            <div class="controls">
              <select class="s-wrap span8" data-placeholder="Pilih Plant" id="dept" name="dept">
                  <option value=""></option>
                  <?php foreach ($dept as $row) {
                      echo "<option value='".$row->deptid."'>".$row->deptid." - ".$row->nama."</option>";
                  } ?>
              </select>
            </div>
          </div>          
          <div class="control-group">
            <label class="control-label">No.Badge</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="kopeg">
            </div>
          </div> -->
          <div class="control-group">
            <label class="control-label">Nama</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="nama">
            </div>
          </div>          
          <div class="control-group">
            <label class="control-label">No.Handphone</label>
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
        </form>
      </div>
      <div class="span6">
        <form class="form-horizontal " id="form">      
<!--           <div class="control-group">
            <label class="control-label">Jenis Kelamin</label>
            <div class="controls">              
              <select class="form-control" id="kelamin">
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>                                    
            </div>
          </div>          
          <div class="control-group">
            <label class="control-label">Jabatan</label>
            <div class="controls">              
              <select class="form-control" id="jabatan">
                <option value="Pelaksana">Pelaksana</option>
                <option value="Kepala Regu">Kepala Regu</option>
                <option value="Kepala Seksi">Kepala Seksi</option>
                <option value="Kepala Bagian">Kepala Bagian</option>
                <option value="Kepala Divisi">Kepala Divisi</option>
                <option value="Direktur Operasional">Direktur Operasional</option>
                <option value="Direktur Utama">Direktur Utama</option>
              </select>                                    
            </div>
          </div>          --> 
          <div class="control-group">
            <label class="control-label">Role</label>
            <div class="controls">              
              <select class="form-control" id="role">
                <option value="User">User (DISC,IST,Kreapelin)</option>
                <option value="User DISC">User DISC</option>
                <option value="User IST">User IST</option>
                <option value="User SPM">User SPM</option>
                <option value="User Kraepelin">User Kraepelin</option>
                <option value="User Kepribadian">User Kepribadian</option>
                <option value="User Gaya Belajar">User Gaya Belajar</option>
                <option value="User Tes Lengkap">User Tes Lengkap</option>
                <option value="Admin">Admin</option>
              </select>                                    
            </div>
          </div>          
          <div class="control-group">
            <label class="control-label">Username</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="username">
            </div>
          </div>                    
          <div class="control-group">
            <label class="control-label">Password</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="password">
            </div>
          </div>                    
        </form>
      </div>
    </div>
    <div class="modal-footer">
        <a class="btn green" href="#" onclick="simpansales()"><i class="icon-save"></i> Simpan</a>
        <a class="btn red" data-dismiss="modal" href="#"></i> Keluar</a>
    </div>
  </div>
</div>

<div id="edit" class="modal fade" tabindex="-1" data-width="80%">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      <h4 class="modal-title"><i class='icon-edit'></i> Edit</h4>
  </div>
  <div class="modal-body ">
    <div class="row-fluid">
      <div class="span6">
        <form class="form-horizontal " id="form">
<!--           <div class="control-group">
            <label class="control-label">Plant</label>
            <div class="controls">
              <select class="s-wrap span8" data-placeholder="Pilih Plant" id="dept1" name="dept1">
                  <option value=""></option>
                  <?php foreach ($dept as $row) {
                      echo "<option value='".$row->deptid."'>".$row->deptid." - ".$row->nama."</option>";
                  } ?>
              </select>
              <input type="hidden" class="s-wrap span3" id="id1" disabled>
            </div>
          </div>          
          <div class="control-group">
            <label class="control-label">No.Badge</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="kopeg1">
            </div>
          </div> -->
          <div class="control-group">
            <label class="control-label">Nama</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="nama1">
              <input type="hidden" class="s-wrap span3" id="id1" disabled>
            </div>
          </div>          
          <div class="control-group">
            <label class="control-label">No.Handphone</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="hp1">
            </div>
          </div>          
          <div class="control-group">
            <label class="control-label">Email</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="email1">
            </div>
          </div>          
        </form>
      </div>
      <div class="span6">
        <form class="form-horizontal " id="form">      
<!--           <div class="control-group">
            <label class="control-label">Jenis Kelamin</label>
            <div class="controls">              
              <select class="form-control" id="kelamin1">
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>                                    
            </div>
          </div>          
          <div class="control-group">
            <label class="control-label">Jabatan</label>
            <div class="controls">              
              <select class="form-control" id="jabatan1">
                <option value="Sales">Sales</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Manager">Manager</option>
                <option value="General Manager">General Manager</option>
              </select>                                    
            </div>
          </div>           -->
          <div class="control-group">
            <label class="control-label">Role</label>
            <div class="controls">              
              <select class="form-control" id="role1">
                <option value="User">User (DISC,IST,Kreapelin)</option>
                <option value="User DISC">User DISC</option>
                <option value="User IST">User IST</option>
                <option value="User SPM">User SPM</option>
                <option value="User Kraepelin">User Kraepelin</option>
                <option value="User Kepribadian">User Kepribadian</option>
                <option value="User Gaya Belajar">User Gaya Belajar</option>
                <option value="User Tes Lengkap">User Tes Lengkap</option>
                <option value="Admin">Admin</option>
              </select>                                    
            </div>
          </div>          
          <div class="control-group">
            <label class="control-label">Username</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="username1">
            </div>
          </div>                    
          <div class="control-group">
            <label class="control-label">Password</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="password1">
            </div>
          </div>                    
        </form>
      </div>
    </div>    
    <div class="modal-footer">
        <a class="btn green" href="#" onclick="updatesales()"><i class="icon-save"></i> Update</a>
        <a class="btn red" data-dismiss="modal" href="#"></i> Keluar</a>
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
              <input type="text" class="s-wrap span8" id="sales2">
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
        <a class="btn green" href="#" onclick="deletesales()"><i class="icon-save"></i> Hapus</a>
        <a class="btn red" data-dismiss="modal" href="#"></i> Keluar</a>
    </div>
  </div>
</div>

<script type="application/javascript">
function simpansales(){
   xajax_simpansales(
                      document.getElementById("nama").value,
                      document.getElementById("hp").value,
                      document.getElementById("email").value,                      
                      document.getElementById("role").value,
                      document.getElementById("username").value,
                      document.getElementById("password").value
    );
}

function editsales(noindex){
  xajax_editsales(noindex);
}

function hapussales(noindex){
  xajax_hapussales(noindex);
}

function updatesales(){
  xajax_updatesales(document.getElementById("id1").value,
                      document.getElementById("nama1").value,
                      document.getElementById("hp1").value,
                      document.getElementById("email1").value,
                      document.getElementById("role1").value,
                      document.getElementById("username1").value,
                      document.getElementById("password1").value
              );
}

function deletesales(){
  if(document.getElementById("alasan").value!=''){
    xajax_deletesales(document.getElementById("id2").value,document.getElementById("sales2").value,document.getElementById("alasan").value);
  }else{
    alert('Alasan harus diisi');
  }
}

$('#cari').on('input',function(e){
    xajax_carisales(document.getElementById('cari').value);
});
</script>

