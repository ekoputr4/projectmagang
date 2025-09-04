<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <!-- FUSION CHARTS -->
	   </head>
    <body>
	
	<?php    
	     ob_start(); 
         header("Content-type: application/octet-stream");
         header("Content-Disposition: attachment; filename=Alat_Transportasi.xls");
         header("Pragma: no-cache");
         header("Expires: 0");
    ?>

		<table border="0" style="border-collapse: collapse; width: 100%; text-align: left;" class="data-table">
	     	<tr>
		  		<td align="center" valign="middle" colspan="5" bgcolor="#FFFFFF"><font color="black" style="font-size:18px">ALAT TRANSPORTASI</font></td>			 
		 	</tr>			 			 
			<tr><td></td></tr>
			<tr><td></td></tr>
		</table>

		<table border="1" style="border-collapse: collapse; width: 100%; text-align: left;" class="data-table">
		   <tr>
		   	  <td align="center" bgcolor="#666666"><font color="#FFFFFF">Alat Transportasi</font></td>
		      <td align="center" bgcolor="#666666"><font color="#FFFFFF">Created At</font></td>
			  <td align="center" bgcolor="#666666"><font color="#FFFFFF">Created By</font></td>			
			  <td align="center" bgcolor="#666666"><font color="#FFFFFF">Update At</font></td>			
			  <td align="center" bgcolor="#666666"><font color="#FFFFFF">Update By</font></td>			
			</tr>				
			<?php 		
			  	foreach($dataku as $row)
			  	{		  						
			?> 		
				<tr>			    
				    <td align="left"><?=$row->transport?></td>
				    <td align="left"><?=$row->createdAt?></td>	    
				    <td align="left"><?=$row->createdBy?></td>
				    <td align="left"><?=$row->updatedAt?></td>
				    <td align="left"><?=$row->updatedBy?></td>
				</tr>
			<?php						
				}
			?> 				      	
	  	</table>       				
	
</body>
</html>