<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <!-- FUSION CHARTS -->
	   </head>
    <body>
	
	   <?php    
	     ob_start(); 
         header("Content-type: application/octet-stream");
         header("Content-Disposition: attachment; filename=Master_Karyawan.xls");
         header("Pragma: no-cache");
         header("Expires: 0");
    ?>

	 <?php
     $cek=0;
	 foreach($dataku as $data1)
	   {
         if ($cek==0){ ?>
	  <?php   }
         $cek=1;
       } ?>

			<table border="0" style="border-collapse: collapse; width: 100%; text-align: left;" class="data-table">
		     <tr>
			  <td align="center" valign="middle" colspan="14" bgcolor="#FFFFFF"><font color="black" style="font-size:18px">MASTER KARYAWAN</font></td>			 
			 </tr>			 
			 
			<tr><td></td></tr>
			<tr><td></td></tr>
			<tr><td></td></tr>

			</table>

		<table border="1" style="border-collapse: collapse; width: 100%; text-align: left;" class="data-table">
		   <tr>
		   	  <td align="center" bgcolor="#666666"><font color="#FFFFFF">Kode karyawan</font></td>
		      <td align="center" bgcolor="#666666"><font color="#FFFFFF">Nama karyawan</font></td>
		      <td align="center" bgcolor="#666666"><font color="#FFFFFF">PIC</font></td>
		      <td align="center" bgcolor="#666666"><font color="#FFFFFF">Alamat</font></td>
		      <td align="center" bgcolor="#666666"><font color="#FFFFFF">Kota</font></td>
		      <td align="center" bgcolor="#666666"><font color="#FFFFFF">Telp</font></td>
		      <td align="center" bgcolor="#666666"><font color="#FFFFFF">HP</font></td>
		      <td align="center" bgcolor="#666666"><font color="#FFFFFF">Fax</font></td>
		      <td align="center" bgcolor="#666666"><font color="#FFFFFF">NPWP</font></td>
		      <td align="center" bgcolor="#666666"><font color="#FFFFFF">Dueday</font></td>
		      <td align="center" bgcolor="#666666"><font color="#FFFFFF">Created At</font></td>
			  <td align="center" bgcolor="#666666"><font color="#FFFFFF">Created By</font></td>			
			  <td align="center" bgcolor="#666666"><font color="#FFFFFF">Update At</font></td>			
			  <td align="center" bgcolor="#666666"><font color="#FFFFFF">Update By</font></td>					      	
			</tr>				

<?php 	
	$xunit="";
	  foreach($dataku as $data2)
	  {		  						
	    ?> 		
		<tr>			    
		    <td align="left"><?=$data2->karyawan_code?></td>
		    <td align="left"><?=$data2->karyawan?></td>
		    <td align="left"><?=$data2->pic?></td>
		    <td align="left"><?=$data2->alamat?></td>
		    <td align="left"><?=$data2->kota?></td>	
		    <td align="left"><?=$data2->telp?></td>
		    <td align="left"><?=$data2->hp?></td>
		    <td align="left"><?=$data2->fax?></td>
		    <td align="left"><?=$data2->npwp?></td>
		    <td align="left"><?=$data2->dueday?></td>
		    <td align="left"><?=$data2->createdAt?></td>
		    <td align="left"><?=$data2->createdBy?></td>
		    <td align="left"><?=$data2->updatedAt?></td>
		    <td align="left"><?=$data2->updatedBy?></td>
		</tr>
<?php				
		
		}
	?> 
				      	
  </table>       				
	
</body>
</html>