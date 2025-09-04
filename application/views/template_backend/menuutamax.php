<?php 
    // $loginsession= $this->session->userdata('sess_cbham');
?> 
    
        <!-- BEGIN HORIZONTAL MENU PAGE SIDEBAR1 -->
        <div class="page-sidebar nav-collapse collapse">
            <ul class="page-sidebar-menu hidden-phone hidden-tablet">
                <li>
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler hidden-phone"></div>
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                </li>
                <li>
                    <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                    <form class="sidebar-search">
                        <div class="input-box">
                            <a href="javascript:;" class="remove"></a>
                            <input type="text" placeholder="Search..." />            
                            <input type="button" class="submit" value=" " />
                        </div>
                    </form>
                    <!-- END RESPONSIVE QUICK SEARCH FORM -->
                </li>
                <li class="start active">
                    <a href="<?php echo site_url('dashboard');?>">
                    <i class="icon-home"></i> 
                    <span class="title">Dashboard</span>
                    </a>
                </li>                
                <li>
                    <a href="javascript:;">
                    <i class="icon-cogs"></i> 
                    <span class="title">Master</span>
                    <span class="selected "></span>
                    <span class="arrow open"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="active">
                            <a href="<?php echo site_url('pelanggan_c');?>">Pelanggan</a>
                        </li>        
                        <li>
                            <a href="<?php echo site_url('karyawan_c');?>">Karyawan</a>
                        </li>       
                        <li>
                            <a href="<?php echo site_url('supplier_c');?>">Supplier</a>
                        </li>       
                        <li>
                            <a href="<?php echo site_url('part_c');?>">Part</a>
                        </li>
                        <li>
                            <a href="layout_horizontal_sidebar_menu.html">Bahan</a>
                        </li>    
                        <li>
                            <a href="<?php echo site_url('jasaservis_c');?>">Jasa Service</a>
                        </li>           
                        <li>
                            <a href="<?php echo site_url('merk_c');?>">Merk & Type</a>
                        </li>        
                        <li>
                            <a href="<?php echo site_url('satuan_c');?>">Satuan</a> 
                        </li>     
                        <li>
                            <a href="<?php echo site_url('warna_c');?>">Warna</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('kota_c');?>">Kota</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('divisi_c');?>">Divisi Jasa & Part</a>
                        </li>                 
                        <li>
                            <a href="layout_horizontal_sidebar_menu.html">Paket</a>
                        </li>    
                        <li>
                            <a href="<?php echo site_url('diskon_c');?>">Diskon</a>
                        </li>     
                        <li>
                            <a href="<?php echo site_url('insentif_c');?>">Master Insentif</a>
                        </li>              
                        <li>
                            <a href="<?php echo site_url('targetrevenue_c');?>">Target</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('referensi_c');?>">Referensi</a>
                        </li>     
                        <li>
                            <a href="<?php echo site_url('cabang_c');?>">Cabang</a>
                        </li>     
                        <li>
                            <a href="<?php echo site_url('vendor_c');?>">Vendor</a>
                        </li>     
                        <li>
                            <a href="<?php echo site_url('groupcabang_c');?>">Group Cabang</a>
                        </li>           
                        <li>
                            <a href="<?php echo site_url('targetrevenue_c');?>"> Target Revenue</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('dept_c');?>">Departemen</a>
                        </li>                        
                        <li>
                            <a href="layout_horizontal_sidebar_menu.html">Group Karyawan</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('posisi_c');?>">Posisi Karyawan</a>
                        </li>                        
                    </ul>
                </li>                
                <li>
                    <a href="javascript:;">
                    <i class="icon-star"></i> 
                    <span class="title">Front Office</span>
                    <span class="selected "></span>
                    <span class="arrow open"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo site_url('tiketcuci_c');?>">Tiket Cuci</a>
                        </li>
                    </ul>
                </li>
                <li >
                    <a href="javascript:;">
                    <i class="icon-shopping-cart"></i> 
                    <span class="title">Toko</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="portlet_general.html">
                            General Portlets                    </a>
                        </li>
                        <li >
                            <a href="portlet_draggable.html">
                            Draggable Portlets                     </a>
                        </li>
                    </ul>
                </li>
                <li >
                    <a href="javascript:;">
                    <i class="icon-tags"></i> 
                    <span class="title">Pembelian</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="maps_google.html">
                            Google Maps                   </a>
                        </li>
                        <li >
                            <a href="maps_vector.html">
                            Vector Maps                   </a>
                        </li>
                    </ul>
                </li>
                <li >
                    <a href="javascript:;">
                    <i class="icon-dollar"></i> 
                    <span class="title">Kasir</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="maps_google.html">
                            Google Maps                   </a>
                        </li>
                        <li >
                            <a href="maps_vector.html">
                            Vector Maps                   </a>
                        </li>
                    </ul>
                </li>                
                <li >
                    <a href="javascript:;">
                    <i class="icon-truck"></i> 
                    <span class="title">Gudang</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="maps_google.html">
                            Google Maps                   </a>
                        </li>
                        <li >
                            <a href="maps_vector.html">
                            Vector Maps                   </a>
                        </li>
                    </ul>
                </li>                
                <li >
                    <a href="javascript:;">
                    <i class="icon-money"></i> 
                    <span class="title">Akunting</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="maps_google.html">
                            Google Maps                   </a>
                        </li>
                        <li >
                            <a href="maps_vector.html">
                            Vector Maps                   </a>
                        </li>
                    </ul>
                </li>                
                <li >
                    <a href="javascript:;">
                    <i class="icon-group"></i> 
                    <span class="title">HRD</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="maps_google.html">
                            Google Maps                   </a>
                        </li>
                        <li >
                            <a href="maps_vector.html">
                            Vector Maps                   </a>
                        </li>
                    </ul>
                </li>                
                <li >
                    <a href="javascript:;">
                    <i class="icon-tasks"></i> 
                    <span class="title">GA</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="maps_google.html">
                            Google Maps                   </a>
                        </li>
                        <li >
                            <a href="maps_vector.html">
                            Vector Maps                   </a>
                        </li>
                    </ul>
                </li>                
                <li >
                    <a href="javascript:;">
                    <i class="icon-user"></i> 
                    <span class="title">User</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="maps_google.html">
                            Google Maps                   </a>
                        </li>
                        <li >
                            <a href="maps_vector.html">
                            Vector Maps                   </a>
                        </li>
                    </ul>
                </li>                
                <li >
                    <a href="javascript:;">
                    <i class="icon-book"></i> 
                    <span class="title">Laporan</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="maps_google.html">
                            Google Maps                   </a>
                        </li>
                        <li >
                            <a href="maps_vector.html">
                            Vector Maps                   </a>
                        </li>
                    </ul>
                </li>                
                <li >
                    <a href="javascript:;">
                    <i class="icon-comments-alt"></i> 
                    <span class="title">SMS</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="maps_google.html">
                            Google Maps                   </a>
                        </li>
                        <li >
                            <a href="maps_vector.html">
                            Vector Maps                   </a>
                        </li>
                    </ul>
                </li>                
            </ul>            
            <ul class="page-sidebar-menu visible-phone visible-tablet">
                <li>
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler hidden-phone"></div>
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                </li>
                <li>
                    <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                    <form class="sidebar-search">
                        <div class="input-box">
                            <a href="javascript:;" class="remove"></a>
                            <input type="text" placeholder="Search..." />            
                            <input type="button" class="submit" value=" " />
                        </div>
                    </form>
                    <!-- END RESPONSIVE QUICK SEARCH FORM -->
                </li>
                <li class="start active">
                    <a href="<?php echo site_url('dashboard');?>">
                    <i class="icon-home"></i> 
                    <span class="title">Dashboard</span>
                    </a>
                </li>                
                <li>
                    <a href="javascript:;">
                    <i class="icon-cogs"></i> 
                    <span class="title">Master</span>
                    <span class="selected "></span>
                    <span class="arrow open"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="active">
                            <a href="<?php echo site_url('pelanggan_c');?>">Pelanggan</a>
                        </li>        
                        <li>
                            <a href="<?php echo site_url('karyawan_c');?>">Karyawan</a>
                        </li>       
                        <li>
                            <a href="<?php echo site_url('supplier_c');?>">Supplier</a>
                        </li>       
                        <li>
                            <a href="<?php echo site_url('part_c');?>">Part</a>
                        </li>
                        <li>
                            <a href="layout_horizontal_sidebar_menu.html">
                            Bahan                     </a>
                        </li>    
                        <li>
                            <a href="<?php echo site_url('jasaservis_c');?>">Jasa Service</a>
                        </li>           
                        <li>
                            <a href="<?php echo site_url('merk_c');?>">Merk & Type</a>
                        </li>        
                        <li>
                            <a href="<?php echo site_url('satuan_c');?>">Satuan</a> 
                        </li>     
                        <li>
                            <a href="<?php echo site_url('warna_c');?>">Warna</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('kota_c');?>">Kota</a>
                        </li>
                        <li>
                            <a href="layout_horizontal_sidebar_menu.html">
                            Divisi Jasa & Part                     </a>
                        </li>                 
                        <li>
                            <a href="layout_horizontal_sidebar_menu.html">
                            Paket                     </a>
                        </li>    
                        <li>
                            <a href="layout_horizontal_sidebar_menu.html">
                            Diskon                     </a>
                        </li>     
                        <li>
                            <a href="<?php echo site_url('insentif_c');?>">Insentif</a>
                        </li>              
                        <li>
                            <a href="<?php echo site_url('targetrevenue_c');?>">Target</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('referensi_c');?>">Referensi</a>
                        </li>     
                        <li>
                            <a href="layout_horizontal_sidebar_menu.html">
                            Cabang                     </a>
                        </li>     
                        <li>
                            <a href="layout_horizontal_sidebar_menu.html">
                            Vendor                     </a>
                        </li>     
                        <li>
                            <a href="<?php echo site_url('groupcabang_c');?>">Group Cabang</a>
                        </li>           
                        <li>
                            <a href="layout_horizontal_sidebar_menu.html">
                            Target Revenue                     </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('dept_c');?>">Departemen</a>
                        </li>                        
                        <li>
                            <a href="layout_horizontal_sidebar_menu.html">
                            Group Karyawan                     </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('posisi_c');?>">Posisi Karyawan</a>
                        </li>                                                
                    </ul>
                </li>                
                <li>
                    <a href="javascript:;">
                    <i class="icon-star"></i> 
                    <span class="title">Front Office</span>
                    <span class="selected "></span>
                    <span class="arrow open"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="active">
                            <a href="layout_horizontal_sidebar_menu.html">
                            Horzontal & Sidebar Menu                     </a>
                        </li>
                        <li >
                            <a href="layout_horizontal_menu1.html">
                            Horzontal Menu 1                    </a>
                        </li>
                        <li >
                            <a href="layout_horizontal_menu2.html">
                            Horzontal Menu 2                    </a>
                        </li>
                        <li >
                            <a href="layout_promo.html">
                            Promo Page                    </a>
                        </li>
                        <li >
                            <a href="layout_email.html">
                            Email Templates                     </a>
                        </li>
                        <li >
                            <a href="layout_ajax.html">
                            Content Loading via Ajax</a>
                        </li>
                        <li >
                            <a href="layout_sidebar_closed.html">
                            Sidebar Closed Page                    </a>
                        </li>
                        <li >
                            <a href="layout_blank_page.html">
                            Blank Page                    </a>
                        </li>
                        <li >
                            <a href="layout_boxed_page.html">Boxed Page</a>
                        </li>
                        <li >
                            <a href="layout_boxed_not_responsive.html">
                            Non-Responsive Boxed Layout                     </a>
                        </li>
                    </ul>
                </li>
                <li >
                    <a href="javascript:;">
                    <i class="icon-shopping-cart"></i> 
                    <span class="title">Toko</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="portlet_general.html">
                            General Portlets                    </a>
                        </li>
                        <li >
                            <a href="portlet_draggable.html">
                            Draggable Portlets                     </a>
                        </li>
                    </ul>
                </li>
                <li >
                    <a href="javascript:;">
                    <i class="icon-tags"></i> 
                    <span class="title">Pembelian</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="maps_google.html">
                            Google Maps                   </a>
                        </li>
                        <li >
                            <a href="maps_vector.html">
                            Vector Maps                   </a>
                        </li>
                    </ul>
                </li>
                <li >
                    <a href="javascript:;">
                    <i class="icon-dollar"></i> 
                    <span class="title">Kasir</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="maps_google.html">
                            Google Maps                   </a>
                        </li>
                        <li >
                            <a href="maps_vector.html">
                            Vector Maps                   </a>
                        </li>
                    </ul>
                </li>                
                <li >
                    <a href="javascript:;">
                    <i class="icon-truck"></i> 
                    <span class="title">Gudang</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="maps_google.html">
                            Google Maps                   </a>
                        </li>
                        <li >
                            <a href="maps_vector.html">
                            Vector Maps                   </a>
                        </li>
                    </ul>
                </li>                
                <li >
                    <a href="javascript:;">
                    <i class="icon-money"></i> 
                    <span class="title">Akunting</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="maps_google.html">
                            Google Maps                   </a>
                        </li>
                        <li >
                            <a href="maps_vector.html">
                            Vector Maps                   </a>
                        </li>
                    </ul>
                </li>                
                <li >
                    <a href="javascript:;">
                    <i class="icon-group"></i> 
                    <span class="title">HRD</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="maps_google.html">
                            Google Maps                   </a>
                        </li>
                        <li >
                            <a href="maps_vector.html">
                            Vector Maps                   </a>
                        </li>
                    </ul>
                </li>                
                <li >
                    <a href="javascript:;">
                    <i class="icon-tasks"></i> 
                    <span class="title">GA</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="maps_google.html">
                            Google Maps                   </a>
                        </li>
                        <li >
                            <a href="maps_vector.html">
                            Vector Maps                   </a>
                        </li>
                    </ul>
                </li>                
                <li >
                    <a href="javascript:;">
                    <i class="icon-user"></i> 
                    <span class="title">User</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="maps_google.html">
                            Google Maps                   </a>
                        </li>
                        <li >
                            <a href="maps_vector.html">
                            Vector Maps                   </a>
                        </li>
                    </ul>
                </li>                
                <li >
                    <a href="javascript:;">
                    <i class="icon-book"></i> 
                    <span class="title">Laporan</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="maps_google.html">
                            Google Maps                   </a>
                        </li>
                        <li >
                            <a href="maps_vector.html">
                            Vector Maps                   </a>
                        </li>
                    </ul>
                </li>                
                <li >
                    <a href="javascript:;">
                    <i class="icon-comments-alt"></i> 
                    <span class="title">SMS</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="maps_google.html">
                            Google Maps                   </a>
                        </li>
                        <li >
                            <a href="maps_vector.html">
                            Vector Maps                   </a>
                        </li>
                    </ul>
                </li>             
            </ul>
        </div>        
        <!-- END BEGIN HORIZONTAL MENU PAGE SIDEBAR -->