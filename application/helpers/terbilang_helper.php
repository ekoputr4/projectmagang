<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Page: FusionCharts.php
// Author: InfoSoft Global (P) Ltd.
// This page contains functions that can be used to render FusionCharts.


// encodeDataURL function encodes the dataURL before it's served to FusionCharts.
// If you've parameters in your dataURL, you necessarily need to encode it.
// Param: $strDataURL - dataURL to be fed to chart
// Param: $addNoCacheStr - Whether to add aditional string to URL to disable caching of data
if ( ! function_exists('number_to_words'))
{
 function number_to_words($number)
	    {
	        $before_comma = trim(to_word($number));			
	        $after_comma = trim(comma($number));
			if ($after_comma =="")
			{return ucwords($results = $before_comma.' Rupiah');
			}
			else
	        {return ucwords($results = $before_comma.' koma '.$after_comma.' Rupiah');
			}
	    }
	 
	    function to_word($number)
	    {
	        $words = "";
	        $arr_number = array(
	        "",
	        "satu",
	        "dua",
	        "tiga",
	        "empat",
	        "lima",
	        "enam",
	        "tujuh",
	        "delapan",
	        "sembilan",
	        "sepuluh",
	        "sebelas");
	 
	        if($number<12)
	        {
	            $words = " ".$arr_number[$number];
	        }
	        else if($number<20)
	        {
	            $words = to_word($number-10)." belas";
	        }
	        else if($number<100)
	        {
	            $words = to_word($number/10)." puluh ".to_word($number%10);
	        }
	        else if($number<200)
	        {
	            $words = "seratus ".to_word($number-100);
	        }
	        else if($number<1000)
	        {
	            $words = to_word($number/100)." ratus ".to_word($number%100);
	        }
	        else if($number<2000)
	        {
	            $words = "seribu ".to_word($number-1000);
	        }
	        else if($number<1000000)
	        {
	            $words = to_word($number/1000)." ribu ".to_word($number%1000);
	        }
	        else if($number<1000000000)
	        {
	            $words = to_word($number/1000000)." juta ".to_word($number%1000000);
	        }
	        else
	        {
	            $words = "undefined";
	        }
	        return $words;
	    }
	 
	    function comma($number)
	    {
		    $pos = strrpos($number, ",");
		    if($pos === FALSE){
			 $after_comma = stristr($number,'.');
			}
			else{
		    $after_comma = stristr($number,',');
			}		
	        //$after_comma = stristr($number,',');
	        $arr_number = array(
	        "nol",
	        "satu",
	        "dua",
	        "tiga",
	        "empat",
	        "lima",
	        "enam",
	        "tujuh",
	        "delapan",
	        "sembilan");
	 
	        $results = "";
	        $length = strlen($after_comma);
	        $i = 1;
	        while($i<$length)
	        {
	            $get = substr($after_comma,$i,1);
	            $results .= " ".$arr_number[$get];
	            $i++;
	        }
	        return $results;
		}		

		function number_to_romawi($bul)
	    {
	        if ($bul=='01'){
				$xbul='I';
			}
			if ($bul=='02'){
				$xbul='II';
			}
			if ($bul=='03'){
				$xbul='III';
			}
			if ($bul=='04'){
				$xbul='IV';
			}
			if ($bul=='05'){
				$xbul='V';
			}
			if ($bul=='06'){
				$xbul='VI';
			}
			if ($bul=='07'){
				$xbul='VII';
			}
			if ($bul=='08'){
				$xbul='VIII';
			}
			if ($bul=='09'){
				$xbul='IX';
			}
			if ($bul=='10'){
				$xbul='X';
			}
			if ($bul=='11'){
				$xbul='XI';
			}
			if ($bul=='12'){
				$xbul='XII';
			}
	        return $xbul;
	    }	

	    function numbertomonth($num)
	    {
	    	$month = array(
	    			'1' => 'Januari', 
	    			'2' => 'Februari',
	    			'3' => 'Maret',
	    			'4' => 'April',
	    			'5' => 'Mei',
	    			'6' => 'Juni',
	    			'7' => 'Juli',
	    			'8' => 'Agustus',
	    			'9' => 'September',
	    			'10' => 'Oktober',
	    			'11' => 'November',
	    			'12' => 'Desember'
	    		);
	    	return $month[$num];
	    }

	    function monthtonumber($month)
	    {
	    	$num = array(
	    			'January'  => '01', 
	    			'Februari' => '02',
	    			'March'    => '03',
	    			'April'    => '04',
	    			'May'      => '05',
	    			'June'     => '06',
	    			'July'     => '07',
	    			'August'   => '08',
	    			'September'=> '09',
	    			'October'  => '10',
	    			'November' => '11',
	    			'December' => '12'
	    		);
	    	return $num[$month];
	    }
}
?>