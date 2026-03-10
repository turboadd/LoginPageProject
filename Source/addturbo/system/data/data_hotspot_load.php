<?php
include_once('../../config/routeros_api.class.php');
include "../../include/config.inc.php";
include_once("../../include/conn.php");
$ipRouteros = $IP_ACCOUNT;
$Username=$USER_ACCOUNT;
$Pass=$PASS_ACCOUNT;
$api_port=$PORT_ACCOUNT;
$API = new routeros_api();
	$API->debug = false;
	if ($API->connect($ipRouteros , $Username , $Pass, $api_port)) {

 #############################################################################################
   $user_chart = $API->comm("/ip/hotspot/user/print");
			$profile_chart = $API->comm("/ip/hotspot/user/profile/print");
			$num_prochart =count($profile_chart);
			$num_userchart =count($user_chart);
			  
			for($ch=0; $ch<$num_prochart; $ch++){
      
						 $user_down=0;
						 $user_up=0;
				  for($i=0; $i<$num_userchart; $i++){
				
				
	        	
			if(!empty($user_chart[$i]['profile'])){
                          
	       if($user_chart[$i]['profile']==$profile_chart[$ch]['name']){

				  
				$user_up=$user_up+(round($user_chart[$i]['bytes-in']/1073741824,2));
				$user_down=$user_down+(round($user_chart[$i]['bytes-out']/1073741824,2));

				
				
			 if(($user_up+$user_down) >0){
				$num_up[$ch]=array(
					          "name"=>"".$user_chart[$i]['profile']."",
					           "y"=>("".$user_up.""),
				               );

				$num_down[$ch]=array(
					          "name"=>"".$user_chart[$i]['profile']."",
					           "y"=>("".$user_down.""),
				               );
				  
				 }
				 }}
				 }}

					
				 for($ch=0; $ch<$num_prochart; $ch++){
				  if((!empty($num_up[$ch]['y']))&&(!empty($num_down[$ch]['y']))){
			    $pro=$profile_chart[$ch]['name'];
			
			    $num_up1=$num_up[$ch]['y'];
			
				$num_down1=$num_down[$ch]['y'];
				
				
				$rows[]= array('name' =>$pro,'y' =>$num_up1,'drilldown'=>$pro.'_up');
				$rows1[]= array('name' =>$pro,'y' =>$num_down1,'drilldown'=>$pro.'_down');
				
				$series0['series']=array(array('name'=>'UPLOAD','data'=>$rows),array('name'=>'DOWNLOAD','data'=>$rows1));
               }}

				unset($num_up);
				unset($num_down);
			               
		/****************************** end $series0  **********************************************/
					
				 for($ch=0; $ch<$num_prochart; $ch++){
      				for($i=0; $i<$num_userchart; $i++){  
			
					
			   		
			if(!empty($user_chart[$i]['profile'])){
                            
	       if($user_chart[$i]['profile']==$profile_chart[$ch]['name']){
			   
				if((($user_chart[$i]['bytes-in']/1073741824)+($user_chart[$i]['bytes-out']/1073741824)) >0){
				
					 
				$user_upload=round($user_chart[$i]['bytes-in']/1073741824,2);
			    $user_download=round($user_chart[$i]['bytes-out']/1073741824,2);


				$aa[$ch][$i]=array('name'=>"".$user_chart[$i]['name']."",'upload'=>$user_upload);
				$aa1[$ch][$i]=array('name'=>"".$user_chart[$i]['name']."",'download'=>$user_download);
				
				$ee[$ch][]=array("".$aa[$ch][$i]['name']."",$aa[$ch][$i]['upload']);
				$ee1[$ch][]=array("".$aa1[$ch][$i]['name']."",$aa1[$ch][$i]['download']);
				  
				  $data=array('name'=>$profile_chart[$ch]['name'].' UPLOAD',
					'id'=>$profile_chart[$ch]['name'].'_up',
					'data'=>$ee[$ch]);

				  $data1=array('name'=>$profile_chart[$ch]['name'].' DOWNLOAD',
					'id'=>$profile_chart[$ch]['name'].'_down',
					'data'=>$ee1[$ch]);
				  
			 } 
			 
			 }}}
			 		   
				 if((!empty($data))||(!empty($data1))){	 
				  $series1['drilldown'][] =$data;
				   $series1['drilldown'][] =$data1;	
				
				 }
				  	unset($data);
					unset($data1);
				  }
	}			  

		/*********************************  end $series1  ********************************************************/
	 $data_title['title']=array('text'=>'Hotspot TxRx Bytes');
	$nodata_title['title']=array('text'=>'NO DATA USER IN HOTSPOT');
    $data_subtitle['subtitle']=array('text'=>'แสดงค่า upload/download users');
	$rows_empty[]= array('name' =>"empty",'y' =>0,'drilldown'=>null);
	$series0_empty['series']=array(array('name'=>'UPLOAD','data'=>$rows_empty),array('name'=>'DOWNLOAD','data'=>$rows_empty));
	$series1_empty['drilldown']=array('name'=>'Empty',
					'id'=>'Empty',
					'data'=>array('name'=>"Empty",'upload-download'=>0));

if(!empty($series0)){				  
$result = array();
array_push($result,$series0);
array_push($result,$series1);
array_push($result,$data_title);
array_push($result,$data_subtitle);
print json_encode($result, JSON_NUMERIC_CHECK);

}else{
$result = array();
array_push($result,$series0_empty);
array_push($result,$series1_empty);
array_push($result,$nodata_title);
array_push($result, $data_subtitle);
print json_encode($result, JSON_NUMERIC_CHECK);

}
				?>