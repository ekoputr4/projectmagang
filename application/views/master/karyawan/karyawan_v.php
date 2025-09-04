<?php echo @$err; ?>
<div id='alert'></div>

  <div class="row-fluid" style="height:750px !important; overflow-y: scroll;">
    <div class="span12">
      <div class="portlet">
        <div class="form-search fright">
          <a style='float:right; margin-right: 10px;' class="btn yellow" id="keluar" href="<?php echo site_url('dashboard'); ?>"><i class="icon-signout icon-white"></i> Keluar</a>
          <a style='float:right; margin-right: 10px;' class="btn purple" onClick="location.href='<?=base_url()."index.php/karyawan_c/cetakkaryawan"?>'"><i class="icon-download"></i> Download</a>
          <a class="btn blue" style='float:right; margin-right: 10px;' data-toggle="modal" href="#tambah" onclick="carikodecus()"><i class="icon-plus"></i> Tambah</a>
          <div class="input-prepend">
            <span class="add-on">Karyawan</span>
            <input class="m-wrap medium" type="text" placeholder="Cari Karyawan" id="cari" name="cari" onchange="carikaryawan();" oninput="this.onchange();"/>
          </div>
        </div>
      </div>
        
      <table class="table table-striped table-bordered table-hover table-full-width" >
        <thead>
        <tr bgcolor="#245397">
          <th><font color="white">NIK</font></th>
          <th><font color="white">Karyawan</font></th>
          <th><font color="white">HP</font></th>
          <th><font color="white">Posisi</font></th>
          <th><font color="white">Cabang</font></th>
          <th><font color="white">Departemen</font></th>
          <th><font color="white">Action</font></th>
        </tr>
        </thead>
        <tbody id='datakaryawan'>
          <?php 
            if (count($karyawan)>0) {
              foreach ($karyawan as $row) { ?>
                  <tr>
                      <td><?=$row->karyawan_code; ?></td>
                      <td><?=$row->karyawan; ?></td>
                      <td><?=$row->hp; ?></td>
                      <td><?=$row->posisi; ?></td>
                      <td><?=$row->cabang; ?></td>
                      <td><?=$row->dept; ?></td>
                      <td>
                          <a class="btn mini yellow sbold" data-toggle="modal" href="#edit" onClick="editkaryawan('<?php echo $row->karyawanid?>')"><i class="icon-edit"></i> Edit </a>
                          <a class="btn mini yellow sbold" data-toggle="modal" href="#editkel" onClick="editkeluarga('<?php echo $row->karyawanid?>')"><i class="icon-edit"></i> Edit Keluarga</a>                          
                          <a class="btn mini red sbold" data-toggle="modal" href="#delete" onClick="hapuskaryawan('<?php echo $row->karyawanid?>')"><i class="icon-trash"></i> Hapus</a> 
                      </td>
                  </tr>
          <?php }}?>
        </tbody>
      </table>

  </div>
</div>

<div id="tambah" class="modal fade" tabindex="-1" data-width="100%">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      <h4 class="modal-title"><i class='icon-add'></i> Tambah Karyawan</h4>
  </div>

  <div class="modal-body ">
    <div class="row-fluid">
      <div class="span4">
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Kode</label>
            <div class="controls">
              <input type="text" class="s-wrap span4" id="kode" readonly>
            </div>
          </div>
        </form>
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Karyawan*</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="karyawan">
            </div>
          </div>
        </form> 
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Panggilan</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="panggilan">
            </div>
          </div>
        </form>               
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Alamat</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="alamat">
            </div>
          </div>
        </form>        
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">KTP</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="ktp">
            </div>
          </div>
        </form>        
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Kota</label>
            <div class="controls">              
              <select class="form-control" id="kota">
                <?php foreach ($listkota as $row) {
                  echo "<option value=".$row->kota.">".$row->kota."</option>";
                } ?>
              </select>                                    
            </div>
          </div>
        </form>        
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Telp</label>
            <div class="controls">
              <input type="text" class="s-wrap span6" id="telp">
            </div>
          </div>
        </form>                
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">HP</label>
            <div class="controls">
              <input type="text" class="s-wrap span6" id="hp">
            </div>
          </div>
        </form>                
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Email</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="email">
            </div>
          </div>
        </form> 
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label"><font color="red">*) wajib diisi</font></label>
          </div>
        </form>                                                                                                   
      </div>
      <div class="span4">
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Tempat Lahir</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="tempatlahir">
            </div>
          </div>
        </form> 
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Tgl Lahir</label>
            <div class="controls">
              <div class="input-append date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                <input class="m-wrap m-ctrl-medium date-picker" size="16" type="text" value="" id="tgllahir"/><span class="add-on"><i class="icon-calendar"></i></span>
              </div>
            </div>          
          </div>
        </form>            
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Jenis Kelamin</label>
            <div class="controls">              
              <select class="form-control" id="kelamin">
                <option value="LAKI-LAKI">LAKI-LAKI</option>
                <option value="PEREMPUAN">PEREMPUAN</option>
              </select>                                    
            </div>
          </div>
        </form>                           
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Status</label>
            <div class="controls">              
              <select class="form-control" id="status">
                <option value="TETAP">TETAP</option>
                <option value="KONTRAK">KONTRAK</option>
                <option value="FREELANCE">FREELANCE</option>
              </select>                                    
            </div>
          </div>
        </form>               
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Posisi</label>
            <div class="controls">              
              <select class="form-control" id="posisi">
                <?php foreach ($listposisi as $row) {
                  echo "<option value=".$row->posisi.">".$row->posisi."</option>";
                } ?>
              </select>                                    
            </div>
          </div>
        </form>               
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Divisi</label>
            <div class="controls">              
              <select class="form-control" id="divisi">
                <option value="PUNDAK KANAN">PUNDAK KANAN</option>
                <option value="PUNDAK KIRI">PUNDAK KIRI</option>
                <option value="SIRAH">SIRAH</option>
              </select>                                    
            </div>
          </div>
        </form>               
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Departemen</label>
            <div class="controls">              
              <select class="form-control" id="dept">
                <?php foreach ($listdept as $row) {
                  echo "<option value=".$row->nama.">".$row->nama."</option>";
                } ?>
              </select>                                    
            </div>
          </div>
        </form>                                                   
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Cabang</label>
            <div class="controls">              
              <select class="form-control" id="cabang">
                <?php foreach ($listcabang as $row) {
                  echo "<option value=".$row->cabang.">".$row->cabang."</option>";
                } ?>
              </select>                                    
            </div>
          </div>
        </form>
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">NPWP</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="npwp">
            </div>
          </div>
        </form>                                 
      </div>
      <div class="span4">                                                          
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Username</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="username">
            </div>
          </div>
        </form>                        
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Password</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="password">
            </div>
          </div>
        </form>                
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Target Revenue</label>
            <div class="controls">
              <input type="text" class="s-wrap span6" id="targetrevenue">
            </div>
          </div>
        </form>                        
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Target Unit</label>
            <div class="controls">
              <input type="text" class="s-wrap span6" id="targetunit">
            </div>
          </div>
        </form>                                
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">No.Rekening</label>
            <div class="controls">
              <input type="text" class="s-wrap span6" id="norekening">
            </div>
          </div>
        </form>
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Bank</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="bank">
            </div>
          </div>
        </form>                                               
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Mulai Bekerja</label>
            <div class="controls">
              <div class="input-append date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                <input class="m-wrap m-ctrl-medium date-picker" size="16" type="text" value="" id="mulaikerja"/><span class="add-on"><i class="icon-calendar"></i></span>
              </div>
            </div>          
          </div>
        </form>            
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Pendidikan Terakhir</label>
            <div class="controls">              
              <select class="form-control" id="pendidikan">
                <option value="S2">S2</option>
                <option value="S1">S1</option>
                <option value="D3">D3</option>
                <option value="D2">D2</option>
                <option value="D1">D1</option>
                <option value="SMU">SMU</option>
                <option value="SMP">SMP</option>
                <option value="SD">SD</option>
              </select>                                    
            </div>
          </div>
        </form>                       
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Nama Sekolah</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="namasekolah">
            </div>
          </div>
        </form>   
      </div>      
    </div>    
    <div class="modal-footer">
        <a class="btn green" href="#" onclick="simpankaryawan()"><i class="icon-save"></i> Simpan</a>
        <a class="btn btn-outline dark" data-dismiss="modal" href="#"></i> Keluar</a>
    </div>
  </div>
</div>

<div id="edit" class="modal fade" tabindex="-1" data-width="100%">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      <h4 class="modal-title"><i class='icon-add'></i> Edit Karyawan</h4>
  </div>
  <div class="modal-body ">
    <div class="row-fluid">
      <div class="span4">
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Kode</label>
            <div class="controls">
              <input type="text" class="s-wrap span4" id="kode1" readonly>
              <input type="hidden" class="s-wrap span4" id="karyawanid1" readonly>
            </div>
          </div>
        </form>
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Karyawan*</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="karyawan1">
            </div>
          </div>
        </form> 
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Panggilan</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="panggilan1">
            </div>
          </div>
        </form>               
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Alamat</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="alamat1">
            </div>
          </div>
        </form>        
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">KTP</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="ktp1">
            </div>
          </div>
        </form>        
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Kota</label>
            <div class="controls">              
              <select class="form-control" id="kota1">
                <?php foreach ($listkota as $row) {
                  echo "<option value='".$row->kota."'>".$row->kota."</option>";
                } ?>
              </select>                                    
            </div>
          </div>
        </form>        
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Telp</label>
            <div class="controls">
              <input type="text" class="s-wrap span6" id="telp1">
            </div>
          </div>
        </form>                
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">HP</label>
            <div class="controls">
              <input type="text" class="s-wrap span6" id="hp1">
            </div>
          </div>
        </form>                
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Email</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="email1">
            </div>
          </div>
        </form> 
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label"><font color="red">*) wajib diisi</font></label>
          </div>
        </form>                                                                                                   
      </div>
      <div class="span4">
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Tempat Lahir</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="tempatlahir1">
            </div>
          </div>
        </form> 
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Tgl Lahir</label>
            <div class="controls">
              <div class="input-append date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                <input class="m-wrap m-ctrl-medium date-picker" size="16" type="text" value="" id="tgllahir1"/><span class="add-on"><i class="icon-calendar"></i></span>
              </div>
            </div>          
          </div>
        </form>            
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Jenis Kelamin</label>
            <div class="controls">              
              <select class="form-control" id="kelamin1">
                <option value="LAKI-LAKI">LAKI-LAKI</option>
                <option value="PEREMPUAN">PEREMPUAN</option>
              </select>                                    
            </div>
          </div>
        </form>                           
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Status</label>
            <div class="controls">              
              <select class="form-control" id="status1">
                <option value="TETAP">TETAP</option>
                <option value="KONTRAK">KONTRAK</option>
                <option value="FREELANCE">FREELANCE</option>
              </select>                                    
            </div>
          </div>
        </form>               
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Posisi</label>
            <div class="controls">              
              <select class="form-control" id="posisi1">
                <?php foreach ($listposisi as $row) {
                  echo "<option value='".$row->posisi."'>".$row->posisi."</option>";
                } ?>
              </select>                                    
            </div>
          </div>
        </form>               
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Divisi</label>
            <div class="controls">              
              <select class="form-control" id="divisi1">
                <option value="PUNDAK KANAN">PUNDAK KANAN</option>
                <option value="PUNDAK KIRI">PUNDAK KIRI</option>
                <option value="SIRAH">SIRAH</option>
              </select>                                    
            </div>
          </div>
        </form>               
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Departemen</label>
            <div class="controls">              
              <select class="form-control" id="dept1" >
                <?php foreach ($listdept as $row) {
                  echo "<option value='".$row->nama."'>".$row->nama."</option>";
                } ?>
              </select>                                    
            </div>
          </div>
        </form>                                                    
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Cabang</label>
            <div class="controls">              
              <select class="form-control" id="cabang1">
                <?php foreach ($listcabang as $row) {
                  echo "<option value='".$row->cabang."'>".$row->cabang."</option>";
                } ?>
              </select>                                    
            </div>
          </div>
        </form>
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">NPWP</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="npwp1">
            </div>
          </div>
        </form>                                 
      </div>
      <div class="span4">                                                          
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Username</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="username1">
            </div>
          </div>
        </form>                        
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Password</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="password1">
            </div>
          </div>
        </form>                
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Target Revenue</label>
            <div class="controls">
              <input type="text" class="s-wrap span6" id="targetrevenue1">
            </div>
          </div>
        </form>                        
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Target Unit</label>
            <div class="controls">
              <input type="text" class="s-wrap span6" id="targetunit1">
            </div>
          </div>
        </form>                                
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">No.Rekening</label>
            <div class="controls">
              <input type="text" class="s-wrap span6" id="norekening1">
            </div>
          </div>
        </form>
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Bank</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="bank1">
            </div>
          </div>
        </form>                                               
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Mulai Bekerja</label>
            <div class="controls">
              <div class="input-append date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                <input class="m-wrap m-ctrl-medium date-picker" size="16" type="text" value="" id="mulaikerja1"/><span class="add-on"><i class="icon-calendar"></i></span>
              </div>
            </div>          
          </div>
        </form>            
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Pendidikan Terakhir</label>
            <div class="controls">              
              <select class="form-control" id="pendidikan1">
                <option value="S2">S2</option>
                <option value="S1">S1</option>
                <option value="D3">D3</option>
                <option value="D2">D2</option>
                <option value="D1">D1</option>
                <option value="SMU">SMU</option>
                <option value="SMP">SMP</option>
                <option value="SD">SD</option>
              </select>                                    
            </div>
          </div>
        </form>                       
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Nama Sekolah</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="namasekolah1">
            </div>
          </div>
        </form>   
      </div>      
    </div>    
    <div class="modal-footer">
        <a class="btn green" href="#" onclick="updatekaryawan()"><i class="icon-save"></i> Update</a>
        <a class="btn btn-outline dark" data-dismiss="modal" href="#"></i> Keluar</a>
    </div>
  </div>
</div>

<div id="delete" class="modal fade" tabindex="-1" data-width="1200">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      <h4 class="modal-title"><i class='icon-add'></i> Hapus Karyawan</h4>
  </div>
  <div class="modal-body ">
    <div class="row-fluid">
      <div class="span12">
        <div class="control-group">
          <label class="control-label">Anda yakin akan menghapus data berikut ?</label>
        </div>                                                
        <form class="form-horizontal " id="form">
          <div class="row-fluid">
            <div class="span12">
              <form class="form-horizontal " id="form">
                <div class="control-group">
                  <label class="control-label">Kode</label>
                  <div class="controls">
                    <input type="text" class="s-wrap span4" id="kode2">
                    <input type="hidden" class="s-wrap span4" id="karyawanid2">
                  </div>
                </div>
              </form>
            </div>
          </div>    
          <div class="row-fluid">
            <div class="span12">
              <form class="form-horizontal " id="form">
                <div class="control-group">
                  <label class="control-label">Karyawan</label>
                  <div class="controls">
                    <input type="text" class="s-wrap span6" id="karyawan2">
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="row-fluid">
            <div class="span12">
              <form class="form-horizontal " id="form">
                <div class="control-group">
                  <label class="control-label">Alasan</label>
                  <div class="controls">
                    <input type="text" class="s-wrap span8" id="alasan">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
        <a class="btn green" href="#" onclick="deletekaryawan()"><i class="icon-save"></i> Hapus</a>
        <a class="btn btn-outline dark" data-dismiss="modal" href="#"></i> Keluar</a>
    </div>
  </div>
</div>

<div id="editkel" class="modal fade" tabindex="-1" data-width="100%">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      <h4 class="modal-title"><i class='icon-add'></i> Edit Keluarga</h4>
  </div>
  <div class="modal-body ">
    <div class="row-fluid">
      <div class="span4">
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Kode</label>
            <div class="controls">
              <input type="text" class="s-wrap span4" id="kode3" readonly>
              <input type="hidden" class="s-wrap span4" id="karyawanid3" readonly>
            </div>
          </div>
        </form>
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Ayah Kandung</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="ayah">
            </div>
          </div>
        </form>               
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Ibu Kandung</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="ibu">
            </div>
          </div>
        </form>        
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Saudara 1</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="saudara1">
            </div>
          </div>
        </form>        
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Saudara 2</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="saudara2">
            </div>
          </div>
        </form>                
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Saudara 3</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="saudara3">
            </div>
          </div>
        </form>                
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">No.KK</label>
            <div class="controls">
              <input type="text" class="s-wrap span6" id="kk">
            </div>
          </div>
        </form>                
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">NIK KTP Istri</label>
            <div class="controls">
              <input type="text" class="s-wrap span6" id="nikistri">
            </div>
          </div>
        </form>                
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">NIK Anak 1</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="nikanak1">
            </div>
          </div>
        </form>
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">NIK Anak 2</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="nikanak2">
            </div>
          </div>
        </form>         
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">NIK Anak 3</label>
            <div class="controls">
              <input type="text" class="s-wrap span8" id="nikanak3">
            </div>
          </div>
        </form>        
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label"><font color="red">*) wajib diisi</font></label>
          </div>
        </form>                                                                                                   
      </div>

      <div class="span4">
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Karyawan*</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="karyawan3" readonly>
            </div>
          </div>
        </form> 
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">No HP Ayah</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="nohpayah">
            </div>
          </div>
        </form> 
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">No HP Ibu</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="nohpibu">
            </div>
          </div>
        </form>         
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">No HP Saudara 1</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="nohpsaudara1">
            </div>
          </div>
        </form>         
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">No HP Saudara 2</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="nohpsaudara2">
            </div>
          </div>
        </form>         
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">No HP Saudara 3</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="nohpsaudara3">
            </div>
          </div>
        </form>                 
        <form class="form-horizontal" id="form">
          <div class="control-group">
            <label class="control-label">.</label>
            <div class="controls"></div>          
          </div>
        </form>        
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Nama Istri</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="istri">
            </div>
          </div>
        </form>                         
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Nama Anak 1</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="anak1">
            </div>
          </div>
        </form>                         
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Nama Anak 2</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="anak2">
            </div>
          </div>
        </form>                         
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Nama Anak 3</label>
            <div class="controls">
              <input type="text" class="s-wrap span12" id="anak3">
            </div>
          </div>
        </form>                         
      </div>

      <div class="span4">                                                          
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Cabang</label>
            <div class="controls">              
              <select class="form-control" id="cabang3" disabled>
                <?php foreach ($listcabang as $row) {
                  echo "<option value='".$row->cabang."'>".$row->cabang."</option>";
                } ?>
              </select>                                    
            </div>
          </div>
        </form>
        <form class="form-horizontal" id="form">
          <div class="control-group">
            <label class="control-label">.</label>
            <div class="controls"></div>          
          </div>
        </form>
        <form class="form-horizontal" id="form">
          <div class="control-group">
            <label class="control-label">.</label>
            <div class="controls"></div>          
          </div>
        </form>
        <form class="form-horizontal" id="form">
          <div class="control-group">
            <label class="control-label">.</label>
            <div class="controls"></div>          
          </div>
        </form>        
        <form class="form-horizontal" id="form">
          <div class="control-group">
            <label class="control-label">.</label>
            <div class="controls"></div>          
          </div>
        </form>
        <form class="form-horizontal" id="form">
          <div class="control-group">
            <label class="control-label">.</label>
            <div class="controls"></div>          
          </div>
        </form>
        <form class="form-horizontal" id="form">
          <div class="control-group">
            <label class="control-label">.</label>
            <div class="controls"></div>          
          </div>
        </form>
        <form class="form-horizontal" id="form">
          <div class="control-group">
            <label class="control-label">.</label>
            <div class="controls"></div>          
          </div>
        </form>                                        
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Tgl Lahir Anak 1</label>
            <div class="controls">
              <div class="input-append date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                <input class="m-wrap m-ctrl-medium date-picker" size="16" type="text" value="" id="tgllahiranak1"/><span class="add-on"><i class="icon-calendar"></i></span>
              </div>
            </div>          
          </div>
        </form>            
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Tgl Lahir Anak 2</label>
            <div class="controls">
              <div class="input-append date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                <input class="m-wrap m-ctrl-medium date-picker" size="16" type="text" value="" id="tgllahiranak2"/><span class="add-on"><i class="icon-calendar"></i></span>
              </div>
            </div>          
          </div>
        </form>                    
        <form class="form-horizontal " id="form">
          <div class="control-group">
            <label class="control-label">Tgl Lahir Anak 3</label>
            <div class="controls">
              <div class="input-append date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                <input class="m-wrap m-ctrl-medium date-picker" size="16" type="text" value="" id="tgllahiranak3"/><span class="add-on"><i class="icon-calendar"></i></span>
              </div>
            </div>          
          </div>
        </form>                    
      </div>      
    </div>    
    <div class="modal-footer">
        <a class="btn green" href="#" onclick="simpankeluarga()"><i class="icon-save"></i> Simpan</a>
        <a class="btn btn-outline dark" data-dismiss="modal" href="#"></i> Keluar</a>
    </div>
  </div>
</div>

<script type="application/javascript">

function carikodecus(){
   xajax_carikodecus();
}

function simpankaryawan(){   
   xajax_simpankaryawan(document.getElementById("kode").value,
                        document.getElementById("karyawan").value,
                        document.getElementById("panggilan").value,
                        document.getElementById("alamat").value,
                        document.getElementById("ktp").value,
                        document.getElementById("kota").value,
                        document.getElementById("telp").value,
                        document.getElementById("hp").value,
                        document.getElementById("email").value,
                        document.getElementById("tempatlahir").value,
                        document.getElementById("tgllahir").value,
                        document.getElementById("kelamin").value,
                        document.getElementById("status").value,
                        document.getElementById("posisi").value,
                        document.getElementById("divisi").value,
                        document.getElementById("dept").value,
                        document.getElementById("cabang").value,
                        document.getElementById("npwp").value,
                        document.getElementById("username").value,
                        document.getElementById("password").value,
                        document.getElementById("targetrevenue").value,
                        document.getElementById("targetunit").value,
                        document.getElementById("norekening").value,
                        document.getElementById("bank").value,
                        document.getElementById("mulaikerja").value,
                        document.getElementById("pendidikan").value,
                        document.getElementById("namasekolah").value);   
}

function editkaryawan(noindex){
  xajax_editkaryawan(noindex);
}

function editkeluarga(noindex){
  xajax_editkeluarga(noindex);
}

function hapuskaryawan(noindex){
  xajax_hapuskaryawan(noindex);
}

function updatekaryawan(){
   xajax_updatekaryawan(document.getElementById("karyawanid1").value,
                        document.getElementById("kode1").value,
                        document.getElementById("karyawan1").value,
                        document.getElementById("panggilan1").value,
                        document.getElementById("alamat1").value,
                        document.getElementById("ktp1").value,
                        document.getElementById("kota1").value,
                        document.getElementById("telp1").value,
                        document.getElementById("hp1").value,
                        document.getElementById("email1").value,
                        document.getElementById("tempatlahir1").value,
                        document.getElementById("tgllahir1").value,
                        document.getElementById("kelamin1").value,
                        document.getElementById("status1").value,
                        document.getElementById("posisi1").value,
                        document.getElementById("divisi1").value,
                        document.getElementById("dept1").value,
                        document.getElementById("cabang1").value,
                        document.getElementById("npwp1").value,
                        document.getElementById("username1").value,
                        document.getElementById("password1").value,
                        document.getElementById("targetrevenue1").value,
                        document.getElementById("targetunit1").value,
                        document.getElementById("norekening1").value,
                        document.getElementById("bank1").value,
                        document.getElementById("mulaikerja1").value,
                        document.getElementById("pendidikan1").value,
                        document.getElementById("namasekolah1").value);   
}

function simpankeluarga(){
   xajax_simpankeluarga(document.getElementById("karyawanid3").value,
                        document.getElementById("kode3").value,
                        document.getElementById("ayah").value,
                        document.getElementById("ibu").value,
                        document.getElementById("saudara1").value,
                        document.getElementById("saudara2").value,
                        document.getElementById("saudara3").value,
                        document.getElementById("kk").value,
                        document.getElementById("nikistri").value,
                        document.getElementById("nikanak1").value,
                        document.getElementById("nikanak2").value,
                        document.getElementById("nikanak3").value,
                        document.getElementById("nohpayah").value,
                        document.getElementById("nohpibu").value,
                        document.getElementById("nohpsaudara1").value,
                        document.getElementById("nohpsaudara2").value,
                        document.getElementById("nohpsaudara3").value,
                        document.getElementById("istri").value,
                        document.getElementById("anak1").value,
                        document.getElementById("anak2").value,
                        document.getElementById("anak3").value,
                        document.getElementById("tgllahiranak1").value,
                        document.getElementById("tgllahiranak2").value,
                        document.getElementById("tgllahiranak3").value);
}

function deletekaryawan(){
   xajax_deletekaryawan(document.getElementById("karyawanid2").value,document.getElementById("alasan").value);       
}

$('#cari').on('input',function(e){
    xajax_carikaryawan(document.getElementById('cari').value);
});

</script>

