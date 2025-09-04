<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>MK Dental Clinic</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="<?php echo base_url(); ?>public/assets/fonts/font.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>public/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>public/assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>public/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>public/assets/css/style-metro.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>public/assets/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>public/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
        <!-- <link href="<?php echo base_url(); ?>public/assets/css/themes/blue.css" rel="stylesheet" type="text/css" id="style_color"/> -->
        <link href="<?php echo base_url(); ?>public/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo base_url(); ?>public/assets/css/pages/login-soft.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>public/assets/img/bg/mktrans2.png" />
        <!--<link rel="shortcut icon" href="<?php echo base_url(); ?>public/assets/img/bg/logo1.png" />-->
        <!-- END PAGE LEVEL STYLES -->
        <!-- <link rel="shortcut icon" href="<?php echo base_url(); ?>public/assets/img/vub.jpg" /> -->

        <?php 
            echo $xajax_js;
        ?>
       
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <!-- <img src="<?php echo base_url(); ?>public/assets/img/bg/logo-big.png" alt="" />  -->
            <!-- <img src="<?php echo base_url(); ?>public/assets/img/bg/logologin2.png" alt="" />  -->
            <!-- <img src="<?php echo base_url(); ?>public/assets/img/logo-big.png" alt="" />  -->
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
        
            
            <!-- BEGIN LOGIN FORM -->
            <form id="formsaya" class="form-vertical login-form" method="POST" action="<?php echo site_url('login/do_login') ?>"  >
                <!-- <h3 class="form-title"><font color="red"><b>VARIABETON APP</b></font></h3> -->
                <h4 class="form-title"><font color="yellow">Login to your account</font></h4>
                
                <?php echo $this->session->flashdata('flash_msg'); ?>

                <div class="control-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <div class="controls">
                        <div class="input-icon left">
                            <i class="icon-user"></i>
                            <input class="m-wrap placeholder-no-fix" type="text" placeholder="User ID" name="userid" id="userid" value="<?php echo set_value('userid') ?>"/>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="controls">
                        <div class="input-icon left">
                            <i class="icon-lock"></i>
                            <input class="m-wrap placeholder-no-fix" type="password" placeholder="Password" name="password" id="password" value="<?php echo set_value('password'); ?>"/>
                        </div>
                    </div>
                </div>
<!--                 <div class="control-group">
                    <label class="control-label visible-ie8 visible-ie9">Handphone</label>
                    <div class="controls">
                        <div class="input-icon left">
                            <i class="icon-lock"></i>
                            <input class="m-wrap placeholder-no-fix" type="text" placeholder="Handphone Number" name="hp" id="hp" value="<?php echo set_value('hp'); ?>"/>
                        </div>
                    </div>
                </div>                                 -->
<!--                 <div class="control-group">
                    <label class="control-label visible-ie8 visible-ie9">Handphone</label>
                    <div class="controls">
                        <div class="input-icon left">
                            <i class="icon-lock"></i>
                            <input class="m-wrap placeholder-no-fix" type="text" placeholder="Handphone Number" name="hp" id="hp" value="<?php echo set_value('hp'); ?>"/>
                        </div>
                    </div>
                </div>                 -->
                <div class="form-actions">
                    <button type="submit" class="btn yellow pull-right" value="Submit" name="submit">
                        Login <i class="m-icon-swapright m-icon-white"></i>
                    </button>            
                </div>

<!--                 <div class="forget-password">
                    <h4>Forgot your password ?</h4>
                    <p>
                        no worries, click <a href="javascript:;" class="" id="forget-password">here</a>
                        to reset your password.
                    </p>
                </div> -->

<!--                 <div class="create-account"></div>
                
                <div class="forget-password">
                    <h4>Don't have an account yet ?</h4>
                    <p>
                        Click <a href="<?php echo site_url('login/registrasi') ?>" class="" id="register-btn">here to create an account.</a>                        
                    </p>
                </div>                 -->
                
<!--                 <div class="create-account">
                    <p>
                        Don't have an account yet ?&nbsp; 
                        <a href="<?php echo site_url('login/registrasi') ?>" id="register-btn" class="">Create an account</a>
                    </p>
                </div>

<!--                 <div class="create-account">
                    <p>
                        Don't have an account yet ?&nbsp; 
                        <a href="<?php echo site_url('login/registrasi') ?>" id="register-btn" class="">Create an account</a>
                        <a href="<?php echo site_url('registrasi_c');?>" id="register-btn" class="">Create an account</a>
                        <a href="javascript:;" id="register-btn" class="">Create an account</a>
                    </p>
                </div> -->

            </form>
            <!-- END LOGIN FORM -->        
            <!-- BEGIN FORGOT PASSWORD FORM -->

            <!-- END FORGOT PASSWORD FORM -->
            <form class="form-vertical register-form" action="index.html">
                <h3 class="">Sign Up</h3>
                <p>Enter your account details below:</p>
                <div class="control-group">
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <div class="controls">
                        <div class="input-icon left">
                            <i class="icon-user"></i>
                            <input class="m-wrap placeholder-no-fix" type="text" placeholder="Username" name="username"/>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="controls">
                        <div class="input-icon left">
                            <i class="icon-lock"></i>
                            <input class="m-wrap placeholder-no-fix" type="password" id="register_password" placeholder="Password" name="password"/>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
                    <div class="controls">
                        <div class="input-icon left">
                            <i class="icon-ok"></i>
                            <input class="m-wrap placeholder-no-fix" type="password" placeholder="Re-type Your Password" name="rpassword"/>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <div class="controls">
                        <div class="input-icon left">
                            <i class="icon-envelope"></i>
                            <input class="m-wrap placeholder-no-fix" type="text" placeholder="Email" name="email"/>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <label class="checkbox">
                        <input type="checkbox" name="tnc"/> I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                        </label>  
                        <div id="register_tnc_error"></div>
                    </div>
                </div>
                <div class="form-actions">
                    <button id="register-back-btn" type="button" class="btn">
                    <i class="m-icon-swapleft"></i>  Back
                    </button>
                    <button type="submit" id="register-submit-btn" class="btn blue pull-right">
                    Sign Up <i class="m-icon-swapright m-icon-white"></i>
                    </button>            
                </div>
            </form>            
            <!-- BEGIN REGISTRATION FORM -->

            <!-- END REGISTRATION FORM -->
        </div>
        <!-- END LOGIN -->

<!-- ===========================================ganti password-->
        <div id="modalgantipasswd" class="modal fade" style="display:none;" tabindex="-1" data-width="760">
            <form class="form-horizontal" id="uploadForm">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="kosong()"></button>
                <h4>FORM UPDATE PASSWORD</h4><br>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                <div class="span12">    
                    <div class="control-group">
                        <input class="span4 m-wrap" type="text" value='No.Badge' readonly/>
                        <input class="span8 m-wrap" type="text" id="kopegx" name="kopegx"/>
                    </div>                    
                    <div class="control-group">
                        <input class="span4 m-wrap" type="text" value='Username' readonly/>
                        <input class="span8 m-wrap" type="text" id="usernamex" name="usernamex"/>
                    </div>                                        
                    <div class="control-group">
                        <input class="span4 m-wrap" type="text" value='Password Lama' readonly/>
                        <input class="span8 m-wrap" type="password" id="passlama" name="passlama"/>
                    </div>                                                            
                    <div class="control-group">
                        <input class="span4 m-wrap" type="text" value='Password Baru' readonly/>
                        <input class="span8 m-wrap" type="password" id="passbaru" name="passbaru"/>
                    </div>
                    <div class="control-group">
                        <input class="span4 m-wrap" type="text" value='Ulangi Password Baru' readonly/>
                        <input class="span8 m-wrap" type="password" id="passbaruulang" name="passbaruulang"/>
                    </div>                    
                </div>
            </div>
            <div class="modal-footer">
                <a data-toggle="modal" href="#modallupapswd">Lupa Password ?</a>
                <button type="button" class="btn blue" data-dismiss="modal" data-toggle="modal" onclick="simpanupdpass()">Simpan</button>
            </div>
            </form>    
        </div>     

<!-- ===========================================ganti password-->
        <div id="modallupapswd" class="modal fade" style="display:none;" tabindex="-1" data-width="760">
            <form class="form-horizontal" id="uploadForm">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="kosong()"></button>
                <h4>FORM LUPA PASSWORD</h4><br>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                <div class="span12">    
                    Masukkan No.Badge dan Username dengan benar, selanjutnya System akan mengirimkan notifikasi via Whatsapp ke No.HP dari No.Badge tersebut
                    <div class="control-group">
                        <input class="span4 m-wrap" type="text" value='No.Badge' readonly/>
                        <input class="span8 m-wrap" type="text" id="kopegy" name="kopegy"/>
                    </div>                    
                    <div class="control-group">
                        <input class="span4 m-wrap" type="text" value='Username' readonly/>
                        <input class="span8 m-wrap" type="text" id="usernamey" name="usernamey"/>
                    </div>                                        
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn blue" data-dismiss="modal" data-toggle="modal" onclick="simpanlupapass()">Kirim</button>
            </div>
            </form>    
        </div>   

        <!-- BEGIN COPYRIGHT -->
        <div class="copyright">
            2023 &copy; - Copyright by IT Dept VUB .
        </div>
        <!-- END COPYRIGHT -->
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo base_url(); ?>public/assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
        <!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
        <script src="<?php echo base_url(); ?>public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
        <script src="<?php echo base_url(); ?>public/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!--[if lt IE 9]>
        <script src="assets/plugins/excanvas.min.js"></script>
        <script src="assets/plugins/respond.min.js"></script>  
        <![endif]-->   
        <script src="<?php echo base_url(); ?>public/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
        <script src="<?php echo base_url(); ?>public/assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url(); ?>public/assets/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>public/assets/scripts/app.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/assets/scripts/login-soft.js" type="text/javascript"></script>      
        <!-- END PAGE LEVEL SCRIPTS --> 

    </script>

    <script type="text/javascript">
        function simpanupdpass(){ 
          if(document.getElementById("kopegx").value==''||document.getElementById("usernamex").value==''||document.getElementById("passlama").value==''||document.getElementById("passbaru").value==''||document.getElementById("passbaruulang").value==''){
            if(document.getElementById("kopegx").value==''){
                alert('No.Badge tidak boleh kosong !');
            }else if(document.getElementById("usernamex").value==''){
                alert('Username tidak boleh kosong !');
            }else if(document.getElementById("passlama").value==''){
                alert('Password Lama tidak boleh kosong !');                
            }else if(document.getElementById("passbaru").value==''){
                alert('Password Baru tidak boleh kosong !');                                
            }else if(document.getElementById("passbaruulang").value==''){
                alert('Ulangi Password Baru tidak boleh kosong !');                                                
            }
          }else{            
            if(document.getElementById("passbaru").value==document.getElementById("passbaruulang").value){
                xajax_simpanupdpass(document.getElementById('kopegx').value,document.getElementById('usernamex').value,document.getElementById('passlama').value,document.getElementById('passbaru').value,document.getElementById('passbaruulang').value);            
            }else{
                alert('Password Baru yang Anda ketik ulang tidak sama !');
            }
          }  
        }                

        function simpanlupapass(){ 
          if(document.getElementById("kopegy").value==''||document.getElementById("usernamey").value==''){
            if(document.getElementById("kopegy").value==''){
                alert('No.Badge tidak boleh kosong !');
            }else if(document.getElementById("usernamey").value==''){
                alert('Username tidak boleh kosong !');
            }
          }else{            
            xajax_simpanlupapass(document.getElementById('kopegy').value,document.getElementById('usernamey').value);            
          }  
        }                        
    </script>
    
    <script>
        jQuery(document).ready(function() {     
          // App.init();
          // Login.init();
          $.backstretch([
                // "<?php echo base_url(); ?>public/assets/img/bg/5.jpg",
                "<?php echo base_url(); ?>public/assets/img/bg/mklogin1.jpg",
                // "<?php echo base_url(); ?>public/assets/img/bg/6X.jpg",
                // "<?php echo base_url(); ?>public/assets/img/bg/bgloginweb.jpg",
                // "<?php echo base_url(); ?>public/assets/img/bg/7.jpg",
                ], {
                  fade: 1000,
                  duration: 4000
              });
        });

    </script>
    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>