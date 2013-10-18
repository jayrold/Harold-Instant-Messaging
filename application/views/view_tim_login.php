<!doctype html>
<html lang="en">
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
	<base href="<?php echo base_url();?>" />
	<link href="http://www.tuberproductions.com/wp-content/themes/tuber/favicon.ico" rel="shortcut icon">		
	<title>Login | Tuber Instant Messaging</title>	
	
	<link rel="stylesheet" href="assets/css/style.css" type="text/css" media="screen" title="no title" charset="utf-8" />
	<link rel="stylesheet" href="assets/css/login.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<script src="assets/js/jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"></script>


					
</head>	

	
<body>
	<div id="login_wrapper">		
		<form action="index.php/tim/process_login" method="post" id="login_form">
			<span class="tree-container">
				<a href="http://www.tuberproductions.com" title="Tuber Productions">
					<?php


						$c_month = date('m', time());

						if($c_month == '01' || $c_month == '02' || $c_month == '03'){
							$c_tree = 'winter_small';
						}
						else if($c_month == '04' || $c_month == '05' || $c_month == '06'){
							$c_tree = 'spring_small';
						}
						else if($c_month == '07' || $c_month == '08' || $c_month == '09'){
							$c_tree = 'summer_small';
						}
						else{
							$c_tree = 'autumn_small';
						}

							$seasons = array(
								0 => $c_tree
					//			0 => 'original_small'
							);

							shuffle($seasons);
					?>
		
					<img src="http://www.tuberproductions.com/wp-content/themes/tuber/images/tuber_tree/tree_<?php echo $seasons[0];?>.jpg" alt="Tuber Productions Logo" class="tuber-logo" />
				</a>
				<h1>Tuber Instant Messaging Login</h1>
			</span>
			<div id="logged_in" style="display: none;">
				<span>
					<p style="text-align: center;">Welcome <b id="username_label"><?php echo $this->session->userdata("username");?></b>!</p>					
				</span>
				<span style="text-align: center;">
					<a href="javascript:open_tim();" class="button">Open Chat</a>
					<a href="javascript:open_ttm();" class="button">Open Task Manager</a>
				</span>
			</div>	
			
			<div id="login_form_container">
				<span class="error">			
				</span>
				<span>
					<label>Email</label>
					<input type="text" name="email" id="email" class="textbox" value="<?php echo set_value('email');?>" >
				</span>
				<span>
					<label>Password</label>
					<input type="password" id="password" name="password" class="textbox" value="" >
				</span>
				<span>
					<label style="color: #fff;">Remember Me</label>
					<input type="checkbox" id="remember_me" name="remember_me" class="checkbox" CHECKED value="1" />Remember Me
				</span>
				<span style="text-align: right;">
					<input type="submit" class="button" name="submit" value="Login" style="margin-right: 10px;"/>
				</span>	
			</div>
		</form>
	</div>	

<script type="text/javascript">
	var base_url = $("base").attr("href");
	var user_key = "";

	function open_tim(){
		myWindow=window.open('index.php/tim/user/'+user_key,'_blank','left=400, top=100,scrollbars=0,width=950,height=750,titlebar=0,toolbar=0,menubar=0,resizable=0,location=0,status=no');
	}
	
	function open_ttm(){
		myWindow2=window.open('index.php/ttm/user/'+user_key,'_blank','left=400, top=100,scrollbars=0,width=530,height=650,titlebar=0,toolbar=0,menubar=0,resizable=0,location=0,status=no');
	}	

	$(document).ready(function(){
		
		
		<?php if($login_flag): ?>
			$("#login_form_container").hide();
			$("#logged_in").fadeIn();
			$("title").html("Tuber Instant Messaging");
			user_key = "<?php echo $this->session->userdata('key'); ?>";
			setTimeout(function(){
				open_tim();												
			},2000);
			/*
			setTimeout(function(){
				open_ttm();												
			},5000);
			*/
		<?php endif; ?>
		
		$("#login_form").submit(function(){
			//console.log("submitted");
			var email = $("#email").val();
			var password = $("#password").val();
			var remember_me = $("#remember_me").val();
			
			console.log(email+" "+password+" "+remember_me);
			
			
			
			var form_data = {
				email : email,
				password : password,
				remember_me : remember_me,
				ajax : '1'
			}
		
			$.ajax({
				url: base_url+"index.php/tim/process_login",
				type: 'POST',
				data: form_data,
				dataType: 'json',
				success: function(res_data){
					console.log(res_data.msg);	
					console.log(res_data.error_flag);	
					if(res_data.error_flag === "yes"){
						$("span.error").html(res_data.msg);
						$("span.error").css({ 'display' : 'block', 'visibility' : 'hidden'});
						$("span.error").css({opacity: 0.1, visibility: "visible"}).animate({opacity: 1.0}, 200);
					}
					else{
						$("b#username_label").html(res_data.username);
						$("#login_form_container").hide();
						$("#logged_in").fadeIn();
						$("title").html("Tuber Instant Messaging");
						user_key = res_data.key;
						open_tim();	
					}	
				},
				error: function(e){
					console.log("error");
				}
			});
			
			
			return false;
		});
	});
</script>	
	
	
	
</body>
</html>