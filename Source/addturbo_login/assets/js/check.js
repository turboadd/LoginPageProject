///$(document).ready(function(){
	//////////////////
function chk_person_id(){
	var i;
	var item;
	var value1;
	var value2;

	M1 = window.document.webForm.pid1.value*13;
	M2 = window.document.webForm.pid2.value*12;
	M3 = window.document.webForm.pid3.value*11;
	M4 = window.document.webForm.pid4.value*10;
	M5 = window.document.webForm.pid5.value*9;
	M6 = window.document.webForm.pid6.value*8;
	M7 = window.document.webForm.pid7.value*7;
	M8 = window.document.webForm.pid8.value*6;
	M9 = window.document.webForm.pid9.value*5;
	M10 = window.document.webForm.pid10.value*4;
	M11 = window.document.webForm.pid11.value*3;
	M12 = window.document.webForm.pid12.value*2;
	sumM=M1+M2+M3+M4+M5+M6+M7+M8+M9+M10+M11+M12;
	value1=11-(sumM%11);
	value2=String(value1);
	value2=value2.substr((value2.length-1),1);
     if(window.document.webForm.pid13.value!=value2){
			alert('fail .');
			//return false;
			return true;

		} else 
		alert('ok .');
			return true;
}


//////////////////
//});

