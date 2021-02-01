<?php
	function thaiShortDate($strDate)
	{
		$strMonth = date("n",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai = $strMonthCut[$strMonth];
		return "$strMonthThai";
	}
?>