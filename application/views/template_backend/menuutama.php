<?php 
    // $loginsession= $this->session->userdata('sess_cbham');
?> 
    
        <!-- BEGIN HORIZONTAL MENU PAGE SIDEBAR1 -->
        <div class="page-sidebar nav-collapse collapse">
            <ul class="page-sidebar-menu hidden-phone hidden-tablet">
                <li>
                    <div class="sidebar-toggler hidden-phone"></div>
                </li>
                
                <li class="start active">
                    <a href="<?php echo site_url('dashboard');?>">
                    <i class="icon-bar-chart"></i> 
                    <span class="title">Dashboard</span>
                    </a>
                </li>    
<!--                 <?php
                    if ((getSession('status')==1)||(getSession('status')==2)){
                ?>                
                <li >
                    <a href="javascript:;">
                    <i class="icon-group"></i> 
                    <span class="title">Siswa</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="<?php echo site_url('siswa_c');?>">
                            Entry</a>
                        </li>
                        <li >
                            <a href="https://karakterindonesia.com/absensi">
                            Absensi</a>
                        </li>                                                
                    </ul>
                </li>             
                <?php
                    }
                ?>                                
                <li >
                    <a href="javascript:;">
                    <i class="icon-folder-open"></i> 
                    <span class="title">Ruang Asesmen</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <?php
                            if ((getSession('status')==1)||(getSession('status')==2)||(getSession('status')==3)||(getSession('status')==5)||(getSession('status')==10)){
                        ?>                                        
                        <li>
                            <a href="javascript:;">
                            Tes Potensi IQ 1
                            <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo site_url('ist1_c');?>">Soal IST 01</a></li>
                                <li><a href="<?php echo site_url('ist2_c');?>">Soal IST 02</a></li>
                                <li><a href="<?php echo site_url('ist3_c');?>">Soal IST 03</a></li>
                                <li><a href="<?php echo site_url('ist4_c');?>">Soal IST 04</a></li>
                                <li><a href="<?php echo site_url('ist5_c');?>">Soal IST 05</a></li>
                                <li><a href="<?php echo site_url('ist6_c');?>">Soal IST 06</a></li>
                                <li><a href="<?php echo site_url('ist7_c');?>">Soal IST 07</a></li>
                                <li><a href="<?php echo site_url('ist8_c');?>">Soal IST 08</a></li>
                                <li><a href="<?php echo site_url('ist9_c');?>">Soal IST 09</a></li>
                            </ul>
                        </li>
                        <?php
                            }
                            if ((getSession('status')==1)||(getSession('status')==2)||(getSession('status')==6)||(getSession('status')==10)){
                        ?>                                                                                        
                        <li>
                            <a href="javascript:;">
                            Tes Potensi IQ 2
                            <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo site_url('spm_c');?>">Standart Progressive Matrics (SPM)</a></li>
                            </ul>
                        </li>
                        <?php
                            } 
                            if ((getSession('status')==1)||(getSession('status')==2)||(getSession('status')==3)||(getSession('status')==7)||(getSession('status')==10)){
                        ?>                                                                                                                
                        <li>
                            <a href="javascript:;">
                            Tes Potensi IQ 3
                            <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo site_url('krp_c');?>">Tes Kreapelin</a></li>
                            </ul>
                        </li>          
                        <li >
                            <a href="<?php echo site_url('epps_c');?>">
                            Tes EPPS</a>
                        </li>                                                
                        <?php
                            } 
                            if ((getSession('status')==1)||(getSession('status')==2)||(getSession('status')==3)||(getSession('status')==4)||(getSession('status')==10)){
                        ?>                                                                                                                                        
                        <li >
                            <a href="<?php echo site_url('disc_c');?>">
                            Tes Bakat Minat</a>
                        </li>                        
                        <?php
                            } 
                            if ((getSession('status')==1)||(getSession('status')==2)||(getSession('status')==8)||(getSession('status')==10)){
                        ?>   
                        <li >        
                            <a href="<?php echo site_url('kepribadian_c');?>">
                            Tes Kepribadian</a>
                        </li>
                        <?php
                            } 
                            if ((getSession('status')==1)||(getSession('status')==2)||(getSession('status')==9)||(getSession('status')==10)){
                        ?>                           
                        <li >        
                            <a href="<?php echo site_url('gayabelajar_c');?>">
                            Tes Gaya Belajar</a>
                        </li>                        
                        <li >        
                            <a href="<?php echo site_url('rmib_c');?>">
                            Tes Minat (RMIB)</a>
                        </li>                                                
                        <?php
                            }
                        ?>                                                   
                    </ul>
                </li>   
                <?php
                    if ((getSession('status')==1)||(getSession('status')==2)){
                ?>                                                        
                <li >
                    <a href="javascript:;">
                    <i class="icon-folder-open"></i> 
                    <span class="title">Report</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="javascript:;">
                            Report Tes Potensi IQ
                            <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo site_url('reportist_c');?>">Report Tes IST</a></li>
                                <li><a href="<?php echo site_url('reportspm_c');?>">Report Tes SPM</a></li>
                                <li><a href="<?php echo site_url('reportkrp_c');?>">Report Tes Kraepelin</a></li>
                            </ul>
                        </li>            
                        <li >
                            <a href="<?php echo site_url('reportdisc_c');?>">
                            Report Tes Bakat Minat</a>
                        </li>                        
                        <li >        
                            <a href="<?php echo site_url('reportkepribadian_c');?>">
                            Report Tes Kepribadian</a>
                        </li>
                        <li >        
                            <a href="<?php echo site_url('reportgayabelajar_c');?>">
                            Report Tes Gaya Belajar</a>
                        </li>                        
                        <li >        
                            <a href="<?php echo site_url('reportrmib_c');?>">
                            Report Tes Minat (RMIB)</a>
                        </li>                                                
                        <li >        
                            <a href="<?php echo site_url('reportpresensi_c');?>">
                            Report Absensi Online</a>
                        </li>                                                
                        <li >        
                            <a href="<?php echo site_url('reportrekap_c');?>">
                            Report Rekap Tes</a>
                        </li>
                        <li >        
                            <a href="<?php echo site_url('reportrekaportu_c');?>">
                            Report Rekap Tes (Ortu)</a>
                        </li>                        
                        <li >        
                            <a href="<?php echo site_url('reportepps_c');?>">
                            Report EPPS</a>
                        </li>                        
                        <li >        
                            <a href="<?php echo site_url('reportdudi_c');?>">
                            Dunia Usaha Dunia Industri (DuDi)</a>
                        </li>                                                
                        <li >        
                            <a href="<?php echo site_url('reportdudihasil_c');?>">
                            Report Dunia Usaha Dunia Industri (DuDi)</a>
                        </li>                                                                        
                    </ul>
                </li> -->

<!--                 <li class="start active">
                    <a href="<?php echo site_url('dashboard');?>">
                    <i class="icon-bar-chart"></i> 
                    <span class="title">Dashboard</span>
                    </a>
                </li>     -->

                <li >
                    <a href="<?php echo site_url('tindakan_c');?>">
                    <i class="icon-star"></i> 
                    <span class="title">Tindakan</span></a>
                </li>                             
                <li >
                    <a href="<?php echo site_url('kaskeluar_c');?>">
                    <i class="icon-tags"></i> 
                    <span class="title">Kas Keluar</span></a>
                </li>                                             
<!--                 <li >
                    <a href="<?php echo site_url('reporttindakan_c');?>">
                    <i class="icon-book"></i> 
                    <span class="title">Report</span></a>
                </li>                                              -->
                <li >
                    <a href="javascript:;">
                    <i class="icon-book"></i> 
                    <span class="title">Report</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="<?php echo site_url('reporttindakan_c');?>">
                            <i class="icon-book"></i> 
                            <span class="title">Report Tindakan</span></a>                            
                        </li>                                                
                        <li >
                            <a href="<?php echo site_url('reportlaba_c');?>">
                            <i class="icon-book"></i> 
                            <span class="title">Report Laba Rugi</span></a>
                        </li>
                        <li >
                            <a href="<?php echo site_url('reporttrenlaba_c');?>">
                            <i class="icon-book"></i> 
                            <span class="title">Report Trend Laba Rugi</span></a>
                        </li>                        
                    </ul>
                </li>                
                <li >
                    <a href="javascript:;">
                    <i class="icon-wrench"></i> 
                    <span class="title">Master Data</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="<?php echo site_url('pricelist_c');?>">
                            <i class="icon-money"></i> 
                            <span class="title">Price List</span>
                        </li>                                                
                        <li >
                            <a href="<?php echo site_url('dokter_c');?>">
                            <i class="icon-user-md"></i> 
                            <span class="title">Dokter</span>
                        </li>
                        <li >
                            <a href="<?php echo site_url('pasien_c');?>">
                            <i class="icon-group"></i> 
                            <span class="title">Pasien</span>
                        </li>                        
                        <li>
                            <a href="<?php echo site_url('sales_c');?>">
                            <i class="icon-user"></i> 
                            <span class="title">User Account</span>
                            </a>
                        </li>                                                            
<!--                         <li >
                            <a href="<?php echo site_url('kelas_c');?>">
                            Kelas</a>
                        </li>                        
                        <li >
                            <a href="<?php echo site_url('agama_c');?>">
                            Agama</a>
                        </li>
                        <li >
                            <a href="<?php echo site_url('tinggal_c');?>">
                            Jenis Tinggal</a>
                        </li>                        
                        <li >
                            <a href="<?php echo site_url('transport_c');?>">
                            Alat Transportasi</a>
                        </li>                                                
                        <li >
                            <a href="<?php echo site_url('jenjang_c');?>">
                            Jenjang Pendidikan</a>
                        </li>
                        <li >        
                            <a href="<?php echo site_url('pekerjaan_c');?>">
                            Jenis Pekerjaan</a>
                        </li>
                        <li >        
                            <a href="<?php echo site_url('penghasilan_c');?>">
                            Penghasilan</a>
                        </li>                       -->
<!--                         <?php
                            if (getSession('status')==1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('sales_c');?>">
                            <i class="icon-user"></i> 
                            <span class="title">User Account</span>
                            </a>
                        </li>                                    
                        <?php
                            }
                        ?>                                         -->
                    </ul>
                </li>     
                <?php
                    }
                ?>                                                                        
            </ul>
            
            <ul class="page-sidebar-menu visible-phone visible-tablet">
<!--                 <li>
                    <div class="sidebar-toggler hidden-phone"></div>
                </li> -->
<!--                 <li>
                    <form class="sidebar-search">
                        <div class="input-box">
                            <a href="javascript:;" class="remove"></a>
                            <input type="text" placeholder="Search..." />            
                            <input type="button" class="submit" value=" " />
                        </div>
                    </form>
                </li>

               -->

                <li>
                    <div class="sidebar-toggler hidden-phone"></div>
                </li>
                
                <li class="start active">
                    <a href="<?php echo site_url('dashboard');?>">
                    <i class="icon-bar-chart"></i> 
                    <span class="title">Dashboard</span>
                    </a>
                </li>    
                <?php
                    if ((getSession('status')==1)||(getSession('status')==2)){
                ?>                
                <li >
                    <a href="javascript:;">
                    <i class="icon-group"></i> 
                    <span class="title">Siswa</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="<?php echo site_url('siswa_c');?>">
                            Entry</a>
                        </li>
                        <li >
                            <a href="https://karakterindonesia.com/absensi">
                            Absensi</a>
                        </li>                        
                    </ul>
                </li>             
                <?php
                    }
                ?>                                
                <li >
                    <a href="javascript:;">
                    <i class="icon-folder-open"></i> 
                    <span class="title">Ruang Asesmen</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <?php
                            if ((getSession('status')==1)||(getSession('status')==2)||(getSession('status')==3)||(getSession('status')==5)||(getSession('status')==10)){
                        ?>                                        
                        <li>
                            <a href="javascript:;">
                            Tes Potensi IQ 1
                            <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo site_url('ist1_c');?>">Soal IST 01</a></li>
                                <li><a href="<?php echo site_url('ist2_c');?>">Soal IST 02</a></li>
                                <li><a href="<?php echo site_url('ist3_c');?>">Soal IST 03</a></li>
                                <li><a href="<?php echo site_url('ist4_c');?>">Soal IST 04</a></li>
                                <li><a href="<?php echo site_url('ist5_c');?>">Soal IST 05</a></li>
                                <li><a href="<?php echo site_url('ist6_c');?>">Soal IST 06</a></li>
                                <li><a href="<?php echo site_url('ist7_c');?>">Soal IST 07</a></li>
                                <li><a href="<?php echo site_url('ist8_c');?>">Soal IST 08</a></li>
                                <li><a href="<?php echo site_url('ist9_c');?>">Soal IST 09</a></li>
                            </ul>
                        </li>
                        <?php
                            }
                            if ((getSession('status')==1)||(getSession('status')==2)||(getSession('status')==6)||(getSession('status')==10)){
                        ?>                                                                                        
                        <li>
                            <a href="javascript:;">
                            Tes Potensi IQ 2
                            <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo site_url('spm_c');?>">Standart Progressive Matrics (SPM)</a></li>
                            </ul>
                        </li>
                        <?php
                            } 
                            if ((getSession('status')==1)||(getSession('status')==2)||(getSession('status')==3)||(getSession('status')==7)||(getSession('status')==10)){
                        ?>                                                                                                                
                        <li>
                            <a href="javascript:;">
                            Tes Potensi IQ 3
                            <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo site_url('krp_c');?>">Tes Kreapelin</a></li>
                            </ul>
                        </li>          
                        <li >
                            <a href="<?php echo site_url('disc_c');?>">
                            Tes Bakat Minat</a>
                        </li>                                                
                        <?php
                            } 
                            if ((getSession('status')==1)||(getSession('status')==2)||(getSession('status')==3)||(getSession('status')==4)||(getSession('status')==10)){
                        ?>                                                                                               
                        <?php
                            } 
                            if ((getSession('status')==1)||(getSession('status')==2)||(getSession('status')==8)||(getSession('status')==10)){
                        ?>   
                        <li >        
                            <a href="<?php echo site_url('kepribadian_c');?>">
                            Tes Kepribadian</a>
                        </li>
                        <li >
                            <a href="<?php echo site_url('epps_c');?>">
                            Tes EPPS</a>
                        </li>
                        <?php
                            } 
                            if ((getSession('status')==1)||(getSession('status')==2)||(getSession('status')==9)||(getSession('status')==10)){
                        ?>                           
                        <li >        
                            <a href="<?php echo site_url('gayabelajar_c');?>">
                            Tes Gaya Belajar</a>
                        </li>
                        <li >        
                            <a href="<?php echo site_url('rmib_c');?>">
                            Tes Minat (RMIB)</a>
                        </li>                                                                        
                        <?php
                            }
                        ?>                                                   
                    </ul>
                </li>   
                <?php
                    if ((getSession('status')==1)||(getSession('status')==2)){
                ?>                                                        
                <li >
                    <a href="javascript:;">
                    <i class="icon-folder-open"></i> 
                    <span class="title">Report</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="javascript:;">
                            Report Tes Potensi IQ
                            <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo site_url('reportist_c');?>">Report Tes IST</a></li>
                                <li><a href="<?php echo site_url('reportspm_c');?>">Report Tes SPM</a></li>
                                <li><a href="<?php echo site_url('reportkrp_c');?>">Report Tes Kraepelin</a></li>
                            </ul>
                        </li>            
                        <li >
                            <a href="<?php echo site_url('reportdisc_c');?>">
                            Report Tes Bakat Minat</a>
                        </li>                        
                        <li >        
                            <a href="<?php echo site_url('reportkepribadian_c');?>">
                            Report Tes Kepribadian</a>
                        </li>
                        <li >        
                            <a href="<?php echo site_url('reportgayabelajar_c');?>">
                            Report Tes Gaya Belajar</a>
                        </li>                      
                        <li >        
                            <a href="<?php echo site_url('reportrmib_c');?>">
                            Report Tes Minat (RMIB)</a>
                        </li>                                                                        
                        <li >        
                            <a href="<?php echo site_url('reportpresensi_c');?>">
                            Report Absensi Online</a>
                        </li>
                        <li >        
                            <a href="<?php echo site_url('reportrekap_c');?>">
                            Report Rekap Tes</a>
                        </li>                        
                        <li >        
                            <a href="<?php echo site_url('reportrekaportu_c');?>">
                            Report Rekap Tes (Ortu)</a>
                        </li>                                                                        
                        <li >        
                            <a href="<?php echo site_url('reportepps_c');?>">
                            Report EPPS</a>
                        </li>                        
                    </ul>
                </li>                                                 
                <li >
                    <a href="javascript:;">
                    <i class="icon-wrench"></i> 
                    <span class="title">Master Data</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="<?php echo site_url('kelas_c');?>">
                            Kelas</a>
                        </li>                        
                        <li >
                            <a href="<?php echo site_url('agama_c');?>">
                            Agama</a>
                        </li>
                        <li >
                            <a href="<?php echo site_url('tinggal_c');?>">
                            Jenis Tinggal</a>
                        </li>                        
                        <li >
                            <a href="<?php echo site_url('transport_c');?>">
                            Alat Transportasi</a>
                        </li>                                                
                        <li >
                            <a href="<?php echo site_url('jenjang_c');?>">
                            Jenjang Pendidikan</a>
                        </li>
                        <li >        
                            <a href="<?php echo site_url('pekerjaan_c');?>">
                            Jenis Pekerjaan</a>
                        </li>
                        <li >        
                            <a href="<?php echo site_url('penghasilan_c');?>">
                            Penghasilan</a>
                        </li>                      
                        <?php
                            if (getSession('status')==1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('sales_c');?>">
                            <i class="icon-user"></i> 
                            <span class="title">User Account</span>
                            </a>
                        </li>                                    
                        <?php
                            }
                        ?>                                        
                    </ul>
                </li>     
                <?php
                    }
                ?>                
            </ul>
        </div>        
        <!-- END BEGIN HORIZONTAL MENU PAGE SIDEBAR -->