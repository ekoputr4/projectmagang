<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <!-- FUSION CHARTS -->
	   </head>
    <body>
	
	<?php    
	     ob_start(); 
         header("Content-type: application/octet-stream");
         header("Content-Disposition: attachment; filename=MasterDokter.xls");
         header("Pragma: no-cache");
         header("Expires: 0");
    ?>

		<table border="0" style="border-collapse: collapse; width: 100%; text-align: left;" class="data-table">
	     	<tr>
		  		<td align="center" valign="middle" colspan="9" bgcolor="#FFFFFF"><font color="black" style="font-size:18px">Data Master Dokter</font></td>			 
		 	</tr>			 			 
			<tr><td></td></tr>
			<tr><td></td></tr>
		</table>

		<table border="1" style="border-collapse: collapse; width: 100%; text-align: left;" class="data-table">
		   <tr>
		   	  	<td align="center" bgcolor="#666666"><font color="#FFFFFF">No</font></td>
				<td align="center" bgcolor="#666666"><font color="#FFFFFF">ID</font></td>
				<td align="center" bgcolor="#666666"><font color="#FFFFFF">NIK</font></td>
				<td align="center" bgcolor="#666666"><font color="#FFFFFF">Nama</font></td>
				<td align="center" bgcolor="#666666"><font color="#FFFFFF">Kelamin</font></td>
				<td align="center" bgcolor="#666666"><font color="#FFFFFF">Alamat</font></td>
				<td align="center" bgcolor="#666666"><font color="#FFFFFF">HP/WA</font></td>
				<td align="center" bgcolor="#666666"><font color="#FFFFFF">Email</font></td>
				<td align="center" bgcolor="#666666"><font color="#FFFFFF">Tanggal Lahir</font></td>
			</tr>				
			<?php 		
				$no=0;
			  	foreach($dataku as $row)
			  	{
			  		$no++;		  						
			?> 		
				<tr>			    
					<td align="left"><?=$no?></td>
					<td align="left"><?=$row->noref?></td>
					<td align="left"><?=$row->nik?></td>
					<td align="left"><?=$row->nama?></td>
					<td align="left"><?=$row->kelamin?></td>
					<td align="left"><?=$row->alamat?></td>
					<td align="left"><?=$row->hp?></td>
					<td align="left"><?=$row->email?></td>
					<td align="left"><?=$row->tgllahir?></td>								    
				</tr>
			<?php						
				}
			?> 				      	
	  	</table>       				
	
</body>
</html>