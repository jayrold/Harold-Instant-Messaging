<!doctype html>
<html lang="en">
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
	<base href="<?php echo base_url();?>" />	
	<title>Tuber Instant Messaging(TIM)</title>	
	
	<script src="assets/js/jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"></script>

					
</head>	

<body>
	
	<h1>Getting server updates</h1>
	<div id="result"></div>
	
	
	<script>
	var base_url = $('base').attr("href");
	if(typeof(EventSource)!=="undefined"){
		var source=new EventSource(base_url+"index.php/tim/ajax_jchat_get_online");
	  	source.onmessage=function(event){
	    	//document.getElementById("result").innerHTML+=event.data + "<br>";
			$('#result').html($('#result').html()+event.data + "<br>");
	    };
	}
	else{
		document.getElementById("result").innerHTML="Sorry, your browser does not support server-sent events...";
	}
	</script>
	
	
</body>
</html>