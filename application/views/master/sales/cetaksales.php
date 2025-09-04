<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <!-- FUSION CHARTS -->
	   </head>
    <body>
	
	   <?php    
	     ob_start(); 
         header("Content-type: application/octet-stream");
         header("Content-Disposition: attachment; filename=Master_User.xls");
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
			  <td align="center" valign="middle" colspan="13" bgcolor="#FFFFFF"><font color="black" style="font-size:18px">MASTER USER ACCOUNT</font></td>			 
			 </tr>			 
			 
			<tr><td></td></tr>
			<tr><td></td></tr>
			<tr><td></td></tr>

			</table>

		<table border="1" style="border-collapse: collapse; width: 100%; text-align: left;" class="data-table">
<!--            <colgroup align="left">
       			<col width="10%" />
	          	<col width="10%" />
	          	<col width="10%" />
                <col width="10%" />
	          	<col width="10%" />
	          	<col width="10%" />
	       </colgroup>   -->
		   <tr>
		   	  <td align="center" bgcolor="#666666"><font color="#FFFFFF">ID</font></td>
		      <td align="center" bgcolor="#666666"><font color="#FFFFFF">Nama</font></td>
		      <td align="center" bgcolor="#666666"><font color="#FFFFFF">HP</font></td>
		      <td align="center" bgcolor="#666666"><font color="#FFFFFF">Email</font></td>
		      <td align="center" bgcolor="#666666"><font color="#FFFFFF">Role</font></td>
		      <td align="center" bgcolor="#666666"><font color="#FFFFFF">Created At</font></td>
			  <td align="center" bgcolor="#666666"><font color="#FFFFFF">Created By</font></td>			
			  <td align="center" bgcolor="#666666"><font color="#FFFFFF">Update At</font></td>			
			  <td align="center" bgcolor="#666666"><font color="#FFFFFF">Update By</font></td>			
			</tr>				

<?php 		
	  foreach($dataku as $data2)
	  {		  						
	    ?> 		
		<tr>			    
		    <td align="left"><?=$data2->noref?></td>
		    <td align="left"><?=$data2->nama?></td>
		    <td align="left"><?=$data2->hp?></td>
		    <td align="left"><?=$data2->email?></td>
		    <td align="left"><?=$data2->role?></td>
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