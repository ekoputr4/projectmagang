
<div class="alert alert-block alert-info fade in">
<marquee><h4 class="alert-heading"><b>KARAKTER INDONESIA</b></h4></marquee>
</div>

<!-- <div class="alert alert-block alert-danger fade in">
<marquee><h4><b><?php echo getSession('reminder') ?></b></h4></marquee>
</div> -->


<script type="text/javascript">

</script>

                <div id="dashboard">
                    <!-- BEGIN DASHBOARD STATS -->
                    <div class="row-fluid">
                      <div class="span12">
                        <div class="portlet">
                          <div class="form-search fright">
                            <form class="form-horizontal" action="<?php echo base_url()?>dashboard" method="post">
                              <!-- <div class="input-prepend">  
                                <span class="add-on">Nama Plant&nbsp;&nbsp;</span>            
                                <select data-placeholder="Pilih Profit Center" class="m-wrap medium" id="dept" name="dept">
                                  <option value="">Semua Plant BSP</option>
                                  <option value="BSP">Semua Plant BSP</option>
                                  <option value="BM">Semua Plant BM</option>
                                  <option value="BPC">Semua Plant BPC</option>
                                  <option value="BG">Semua Plant BG</option>
                                  <?php foreach ($dept as $row) {
                                      echo "<option value='".$row->deptid."'>".$row->nama."</option>";
                                  } ?>                                                  
                                </select>                                                  
                                <button type="submit" class="btn green" id="cari">
                                <span class="icon-search"></span> Cari
                              </div> -->
                            </form>
                            <div></div>    
                          </div>
                        </div>        
                    </div>

                    <div class="row-fluid"> 

                        <!-- <div class="span2 responsive" data-tablet="span6" data-desktop="span2">
                            <div class="dashboard-stat red">
                                <div class="details">
                                    <div class="number">
                                    </div>
                                    <div class="desc">                           
                                        RKAP
                                    </div>
                                </div>
                                <a class="more" href="#">
                                View more <i class="m-icon-swapright m-icon-white"></i>
                                </a>                 
                            </div>
                        </div>
                        <div class="span2 responsive" data-tablet="span6" data-desktop="span2">
                            <div class="dashboard-stat green">
                                <div class="details">
                                    <div class="number">
                                    </div>
                                    <div class="desc">                           
                                        On Hand
                                    </div>
                                </div>                                
                                <a class="more" href="#">
                                View more <i class="m-icon-swapright m-icon-white"></i>
                                </a>                 
                            </div>
                        </div>
                        <div class="span2 responsive" data-tablet="span6" data-desktop="span2">
                            <div class="dashboard-stat yellow">
                                <div class="details">
                                    <div class="number">
                                    </div>
                                    <div class="desc">                           
                                        Retail
                                    </div>
                                </div>                                
                                <a class="more" href="#">
                                View more <i class="m-icon-swapright m-icon-white"></i>
                                </a>                 
                            </div>
                        </div>
                        <div class="span2 responsive" data-tablet="span6" data-desktop="span2">
                            <div class="dashboard-stat blue">
                                <div class="details">
                                    <div class="number">                                        
                                    </div>
                                    <div class="desc">                           
                                        Must Win
                                    </div>
                                </div>                                
                                <a class="more" href="#">
                                View more <i class="m-icon-swapright m-icon-white"></i>
                                </a>                 
                            </div>
                        </div>
                        <div class="span2 responsive" data-tablet="span6" data-desktop="span2">
                            <div class="dashboard-stat purple">
                                <div class="details">
                                    <div class="number">
                                    </div>
                                    <div class="desc">                           
                                        Work In Progress
                                    </div>
                                </div>                                
                                <a class="more" href="#">
                                View more <i class="m-icon-swapright m-icon-white"></i>
                                </a>                 
                            </div>
                        </div>
                        <div class="span2 responsive" data-tablet="span6" data-desktop="span2">
                            <div class="dashboard-stat green">
                                <div class="details">
                                    <div class="number">
                                    </div>
                                    <div class="desc">                           
                                        Universal List
                                    </div>
                                </div>                                
                                <a class="more" href="#">
                                View more <i class="m-icon-swapright m-icon-white"></i>
                                </a>                 
                            </div>
                        </div>
                    </div> -->

<!--                     <div class="row-fluid"> 
                        <div class="span12 responsive" data-tablet="span6" data-desktop="span12">
                          <table class="table table-bordered table-hover table-full-width" >
                            <thead>
                            <tr bgcolor="#245397">
                              <th style="text-align:center"><font color="white">Keterangan</font></th>
                              <th style="text-align:center"><font color="white">Realisasi 2020</font></th>
                              <th style="text-align:center"><font color="white">Realisasi 2021</font></th>
                              <th style="text-align:center"><font color="white">RKAP 2022</font></th>
                              <th style="text-align:center"><font color="white">Prognosa 2022</font></th>
                              <th style="text-align:center"><font color="white">Real <?=date('F Y'); ?> s/d Kemarin</font></th>
                              <th style="text-align:center"><font color="white">Book Building 2022</font></th>
                            </tr>
                            </thead>
                            <tbody id='databpc'>
                              <?php 
                                if (count($datatabel)>0) {
                                  foreach ($datatabel as $row) { 
                                    ?>
                                      <tr>
                                          <td style="text-align:center"><?=$row->ket2; ?></td>
                                          <td style="text-align:right"><?=number_format($row->ket3, 0, ',', '.'); ?></td>
                                          <td style="text-align:right"><?=number_format($row->ket4, 0, ',', '.'); ?></td>
                                          <td style="text-align:right"><?=number_format($row->ket5, 0, ',', '.'); ?></td>
                                          <td style="text-align:right"><?=number_format($row->ket6, 0, ',', '.'); ?></td>
                                          <td style="text-align:right"><?=number_format($row->ket7, 0, ',', '.'); ?></td>
                                          <td style="text-align:right"><?=number_format($row->ket8, 0, ',', '.'); ?></td>
                                      </tr>
                              <?php }}?>          
                            </tbody>
                          </table>
                        </div>
                    </div> -->

<!--                     <div class="row-fluid"> 
                        <div class="span12 responsive" data-tablet="span6" data-desktop="span12">
                          <div class="Row">
                              <div class="Column" id="chart-container1" align='center'>FusionCharts XT will load here!</div>
                          </div>                      
                        </div>                    
                    </div>
                    <div class="row-fluid"> 
                        <div class="span12 responsive" data-tablet="span6" data-desktop="span6">
                          <div class="Row">
                              <div class="Column" id="chart-container2" align='center'>FusionCharts XT will load here!</div>
                          </div>                      
                        </div>                    
                        <div class="span12 responsive" data-tablet="span6" data-desktop="span6">
                          <div class="Row">
                              <div class="Column" id="chart-container3" align='center'>FusionCharts XT will load here!</div>
                          </div>                      
                        </div>                                            
                    </div> -->

<!--                     <div class="row-fluid"> 
                        <div class="span12 responsive" data-tablet="span6" data-desktop="span6">
                          <div class="Row">
                              <div class="Column" id="chart-container3" align='center'>FusionCharts XT will load here!</div>
                          </div>                      
                        </div>                    
                    </div> -->


<!-- <div class="row-fluid">
    <div class="span6">
        <a href="customer_c">
            <div class="tile bg-blue selected">
                <div class="corner"></div>
                <div class="check"></div>
                <div class="tile-body">
                    <i class="icon-user"></i>
                </div>
                <div class="tile-object">
                    <div class="name">
                        Customer
                    </div>
                </div>
            </div>               
        </a> 
        <a href="supplier_c">
            <div class="tile bg-yellow selected">
                <div class="corner"></div>
                <div class="check"></div>
                <div class="tile-body">
                    <i class="icon-user"></i>
                </div>
                <div class="tile-object">
                    <div class="name">
                        Supplier
                    </div>
                </div>
            </div>                            
        </a>
        <a href="pegawai_c">
            <div class="tile bg-purple selected">
                <div class="corner"></div>
                <div class="check"></div>
                <div class="tile-body">
                    <i class="icon-user"></i>
                </div>
                <div class="tile-object">
                    <div class="name">
                        Karyawan
                    </div>
                </div>
            </div>                            
        </a>
        <a href="kendaraan_c">
            <div class="tile bg-green selected">
                <div class="corner"></div>
                <div class="check"></div>
                <div class="tile-body">
                    <i class="icon-truck"></i>
                </div>
                <div class="tile-object">
                    <div class="name">
                        Kendaraan
                    </div>
                </div>
            </div>                            
        </a>
        <a href="item_c">
            <div class="tile bg-grey selected">
                <div class="corner"></div>
                <div class="check"></div>
                <div class="tile-body">
                    <i class="icon-list-ul"></i>
                </div>
                <div class="tile-object">
                    <div class="name">
                        Item
                    </div>
                </div>
            </div>                            
        </a>
        <a href="pembelian_c">
            <div class="tile bg-red selected">
                <div class="corner"></div>
                <div class="check"></div>
                <div class="tile-body">
                    <i class="icon-shopping-cart"></i>
                </div>
                <div class="tile-object">
                    <div class="name">
                        Pembelian Barang
                    </div>
                </div>
            </div>                            
        </a>
        <a href="receipt_c">
            <div class="tile bg-grey selected">
                <div class="corner"></div>
                <div class="check"></div>
                <div class="tile-body">
                    <i class="icon-dropbox"></i>
                </div>
                <div class="tile-object">
                    <div class="name">
                        Penerimaan Barang
                    </div>
                </div>
            </div>                            
        </a>
        <a href="service_c">
            <div class="tile bg-blue selected">
                <div class="corner"></div>
                <div class="check"></div>
                <div class="tile-body">
                    <i class="icon-cogs"></i>
                </div>
                <div class="tile-object">
                    <div class="name">
                        Service & Penjualan
                    </div>
                </div>
            </div>                                                                            
        </a>
        <a href="persediaan_c">
            <div class="tile bg-yellow selected">
                <div class="corner"></div>
                <div class="check"></div>
                <div class="tile-body">
                    <i class="icon-sitemap"></i>
                </div>
                <div class="tile-object">
                    <div class="name">
                        Persediaan
                    </div>
                </div>
            </div>               
        </a>             
        <a href="stockcard_c">
            <div class="tile bg-purple selected">
                <div class="corner"></div>
                <div class="check"></div>
                <div class="tile-body">
                    <i class="icon-book"></i>
                </div>
                <div class="tile-object">
                    <div class="name">
                        Kartu Stok
                    </div>
                </div>
            </div>                                            
        </a>
        <a href="opskasmasuk_c">
            <div class="tile bg-green selected">
                <div class="corner"></div>
                <div class="check"></div>
                <div class="tile-body">
                    <i class="icon-money"></i>
                </div>
                <div class="tile-object">
                    <div class="name">
                        Kas Masuk
                    </div>  
                </div>
            </div>                            
        </a>
        <a href="opskaskeluar_c">
            <div class="tile bg-purple selected">
                <div class="corner"></div>
                <div class="check"></div>
                <div class="tile-body">
                    <i class="icon-dollar"></i>
                </div>
                <div class="tile-object">
                    <div class="name">
                        Kas Keluar
                    </div>
                </div>
            </div>                            
        </a>
        <a href="reportjual_c">
            <div class="tile bg-red selected">
                <div class="corner"></div>
                <div class="check"></div>
                <div class="tile-body">
                    <i class="icon-bar-chart"></i>
                </div>
                <div class="tile-object">
                    <div class="name">
                        Laporan Penjualan
                    </div>
                </div>
            </div>                                                                            
        </a>
        <a href="reportkeuangan_c">
            <div class="tile bg-grey selected">
                <div class="corner"></div>
                <div class="check"></div>
                <div class="tile-body">
                    <i class="icon-bar-chart"></i>
                </div>
                <div class="tile-object">
                    <div class="name">
                        Laporan Keuangan
                    </div>
                </div>
            </div>                            
        </a>
        <div class="tile bg-blue selected">
            <div class="corner"></div>
            <div class="check"></div>
            <div class="tile-body">
                <i class="icon-bar-chart"></i>
            </div>
            <div class="tile-object">
                <div class="name">
                    Laporan Laba Rugi
                </div>
            </div>
        </div>                                                            
    </div>         -->
<!--     <div class="span6">
        <div class="portlet box grey">
            <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>Antrian</div>
            </div>
            <div class="portlet-body">
                <div class="scroller" data-height="400px">
                    <table class="table table-striped table-bordered table-hover table-full-width" >
                        <thead>
                            <tr bgcolor="#245397">
                                <th><font color="white">No.Service</th>
                                <th><font color="white">Tanggal</th>
                                <th><font color="white">No.Polisi</th>
                                <th><font color="white">Pelanggan</th>
                                <th><font color="white">Mekanik</th>
                                <th><font color="white">Status</th>                                
                            </tr>
                        </thead>
                        <tbody id='statusservice'>
                            <?php 
                                if (count($dataservice)>0) {
                                  foreach ($dataservice as $row) { 
                                    ?>
                                      <tr>
                                          <td><?=$row->noservice; ?></td>
                                          <td><?=$row->tglservice; ?></td>
                                          <td><?=$row->nopol; ?></td>
                                          <td><?=$row->pemilik; ?></td>
                                          <td><?=$row->nama; ?></td>
                                          <?php
                                          if ($row->status=='1'){                                            
                                          ?>
                                                <td><span class="label label-important">Menunggu</span></td>
                                          <?php
                                          }elseif($row->status=='2'){
                                          ?>
                                                <td><span class="label label-warning">Diproses</span></td>
                                          <?php
                                          }elseif($row->status=='3'){
                                          ?>
                                                <td><span class="label label-success">Selesai</span></td>
                                          <?php                                          
                                          }elseif($row->status=='4'){
                                          ?>
                                                <td><span class="label label-primary">Return Job</span></td>
                                          <?php
                                          }
                                          ?>
                                      </tr>
                            <?php }}?>                                                                 
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>        
    </div> -->
</div>


    </div>
</div>


