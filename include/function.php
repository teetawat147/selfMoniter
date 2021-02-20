<?php
	function thaiShortDate($date)
    {
        $mon = array('ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
        $byear = substr(substr($date,0,4)+543,0,4);
        $bmon = substr($date,5,2);
        $bday = substr($date,8,2);
        $xdate = (($bday+0>0)?($bday+0).' ':''). $mon[$bmon-1].' '. substr($byear,-2);
        $xdate = ((is_null($date)) or ($date == "") or ($date == "0000-00-00"))?"&nbsp;":$xdate;
        return $xdate;
    }


    function dateThai($strDate) {
        $strYear = date('Y',strtotime($strDate))+543;
        $strMonth= date('n',strtotime($strDate));
        // $strDay= date('j',strtotime($strDate));
        // $strHour= date('H',strtotime($strDate));
        // $strMinute= date('i',strtotime($strDate));
        // $strSeconds= date('s',strtotime($strDate));
        $strMonthCut = Array('','มกราคม' , 'กุมภาพันธ์' , 'มีนาคม' , 'เมษายน' , 'พฤษภาคม' , 'มิถุนายน' , 'กรกฏาคม' , 'สิงหาคม' , 'กันยายน' , 'ตุลาคม' ,'พฤศจิกายน' , 'ธันวาคม' );


        $strMonthThai=$strMonthCut[$strMonth];
        return "$strMonthThai $strYear";
    }
?>