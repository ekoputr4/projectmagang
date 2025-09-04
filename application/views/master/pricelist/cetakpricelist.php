<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <!-- FUSION CHARTS -->
	   </head>
    <body>
	
	<?php    
	     ob_start(); 
         header("Content-type: application/octet-stream");
         header("Content-Disposition: attachment; filename=PriceList.xls");
         header("Pragma: no-cache");
         header("Expires: 0");
    ?>

		<table border="0" style="border-collapse: collapse; width: 100%; text-align: left;" class="data-table">
	     	<tr>
		  		<td align="center" valign="middle" colspan="7" bgcolor="#FFFFFF"><font color="black" style="font-size:18px">Price List</font></td>			 
		 	</tr>			 			 
			<tr><td></td></tr>
			<tr><td></td></tr>
		</table>

		<table border="1" style="border-collapse: collapse; width: 100%; text-align: left;" class="data-table">
		   <tr>
		   	  <td align="center" bgcolor="#666666"><font color="#FFFFFF">No</font></td>
		      <!-- <td align="center" bgcolor="#666666"><font color="#FFFFFF">Kategori</font></td> -->
		      <td align="center" bgcolor="#666666"><font color="#FFFFFF">Nama</font></td>
		      <td align="center" bgcolor="#666666"><font color="#FFFFFF">Biaya</font></td>
		      <td align="center" bgcolor="#666666"><font color="#FFFFFF">Created At</font></td>
			  <td align="center" bgcolor="#666666"><font color="#FFFFFF">Created By</font></td>			
			  <td align="center" bgcolor="#666666"><font color="#FFFFFF">Update At</font></td>			
			  <td align="center" bgcolor="#666666"><font color="#FFFFFF">Update By</font></td>			
			</tr>				
			<?php 		
				$no=0;
			  	foreach($dataku as $row)
			  	{
			  		$no++;		  						
			?> 		
				<tr>			    
				    <td align="left"><?=$no?></td>
				    <!-- <td align="left"><?=$row->kategori?></td> -->
				    <td align="left"><?=$row->nama?></td>
				    <td align="right"><?=number_format($row->biaya, 2, ',', '.')?></td>
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