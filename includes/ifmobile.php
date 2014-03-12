<?php


 $mobile_browser = '0';



 if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {

 $mobile_browser++;

 }



 if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {

 $mobile_browser++;

 }



 $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));

$mobile_agents = Array(





		"240x320",

		"acer",

		"acoon",

		"acs-",

		"abacho",

		"ahong",

		"airness",

		"alcatel",

		"amoi",	

		"android",

		"anywhereyougo.com",

		"applewebkit/525",

		"applewebkit/532",

		"asus",

		"audio",

		"au-mic",

		"avantogo",

		"becker",

		"benq",

		"bilbo",

		"bird",

		"blackberry",

		"blazer",

		"bleu",

		"cdm-",

		"compal",

		"coolpad",

		"danger",

		"dbtel",

		"dopod",

		"elaine",

		"eric",

		"etouch",

		"fly " ,

		"fly_",

		"fly-",

		"go.web",

		"goodaccess",

		"gradiente",

		"grundig",

		"haier",

		"hedy",

		"hitachi",

		"htc",

		"huawei",

		"hutchison",

		"inno",

		"ipad",

		"ipaq",

		"ipod",

		"jbrowser",

		"kddi",

		"kgt",

		"kwc",

		"lenovo",

		"lg ",

		"lg2",

		"lg3",

		"lg4",

		"lg5",

		"lg7",

		"lg8",

		"lg9",

		"lg-",

		"lge-",

		"lge9",

		"longcos",

		"maemo",

		"mercator",

		"meridian",

		"micromax",

		"midp",

		"mini",

		"mitsu",

		"mmm",

		"mmp",

		"mobi",

		"mot-",

		"moto",

		"nec-",

		"netfront",

		"newgen",

		"nexian",

		"nf-browser",

		"nintendo",

		"nitro",

		"nokia",

		"nook",

		"novarra",

		"obigo",

		"palm",

		"panasonic",

		"pantech",

		"philips",

		"phone",

		"pg-",

		"playstation",

		"pocket",

		"pt-",

		"qc-",

		"qtek",

		"rover",

		"sagem",

		"sama",

		"samu",

		"sanyo",

		"samsung",

		"sch-",

		"scooter",

		"sec-",

		"sendo",

		"sgh-",

		"sharp",

		"siemens",

		"sie-",

		"softbank",

		"sony",

		"spice",

		"sprint",

		"spv",

		"symbian",

		"tablet",

		"talkabout",

		"tcl-",

		"teleca",

		"telit",

		"tianyu",

		"tim-",

		"toshiba",

		"tsm",

		"up.browser",

		"utec",

		"utstar",

		"verykool",

		"virgin",

		"vk-",

		"voda",

		"voxtel",

		"vx",

		"wap",

		"wellco",

		"wig browser",

		"wii",

		"windows ce",

		"iemobile",

		"wireless",

		"xda",

		"xde",

		"zte"

	);





 if (in_array($mobile_ua,$mobile_agents)) {

 $mobile_browser++;

 }



 if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini') > 0) {

 $mobile_browser++;

 }

 

 if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows') > 0) {

 $mobile_browser = 0;

 }

 

  if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'iemobile')>0) {

$mobile_browser++;

}

  if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'zunewp')>0) {

$mobile_browser++;

}


  if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'mobile')>0) {

$mobile_browser++;

}



 if ($mobile_browser > 0) {

header('Location: http://vem.vento-consulting.com/mob');

 }

 else { 

 // do something else

 }



 ?>
