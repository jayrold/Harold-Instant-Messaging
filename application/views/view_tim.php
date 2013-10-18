<!doctype html>
<html lang="en">
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
	<base href="<?php echo base_url();?>" />
	<link href="http://www.tuberproductions.com/wp-content/themes/tuber/favicon.ico" rel="shortcut icon">		
	<title>Tuber Instant Messaging(TIM)</title>	
	
	<link rel="stylesheet" href="assets/css/style.css" type="text/css" media="screen" title="no title" charset="utf-8" />
	<script src="assets/js/jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"></script>

					
</head>	
<?php $users_online_count = 0;?>
<body style="width: 950px; height: 650px; overflow: hidden;">

	<div id="wrapper">
		<span style="display:none" id="versionChecker">V03</span>
		<div class="jmodal_overlay"></div>
		<div class="jmodal_overlay_text">
			<div class="text_inside">
				
				<div class="global_chat_inside">
					<div style="border-bottom: 1px solid #ccc;">
						<p style="margin: 0; font-size: 7pt;">Users involved: <em class="users_involved"></em></p>
						<h1 style="margin: 0; text-align: left;">
							<b class="b_gc_title"></b>
							<span class="gc_box_close" title="Close" style="float: right; font-weight: normal; font-size: 7pt;">CLOSE</span>
						</h1>
						<p style="margin: 0; font-size: 8pt; font-style: italic;">Created by: <b class="b_gc_creator"></b>, <em class="b_gc_created"></em></p>
					</div>
					<div class="gc_con">
						

					</div>
					<div class="gc_send">
						<form action="#" method="post" id="gc_submit">
							<textarea name="chat_message" cols="30" id="gc_msg" rows="2"></textarea>
							<input type="submit" name="submit" class="btn" value="SEND" />
						</form>
					</div>		
					
				</div>													
			</div>
		</div>
		
		
		
		<div class="tim_container" style="height: 620px;">
			<div class="tim_head">
				<h1>TUBER INSTANT MESSAGING(TIM)</h1>
				<p>
					<b class="users_online_count">0</b> user(s) online
					<span>Welcome <b><?php echo $user_info->username;?></b> | <a href="javascript:tim_logout();">Logout</a></span>
				</p>
			</div>
			<div class="tim_users" style="position: relative;">
				<b style="font-size: 8pt; padding-left: 10px;">My Status:</b>
				<a href="javascript:myStatus();" class="btn" style="position: absolute; top: 3px; right: 5px;font-size: 8pt; padding: 1px 2px;">Update</a>
				<p class="status" style="font-size: 8pt;margin: 5px 10px;">
					<?php echo $user_info->message;?>
				</p>
				<h1 class="header_title">CHAT</h1>
				<ul class="users">
					<?php if($users): ?>
						<?php foreach($users as $u):?>
							<li class="li_chat <?php if($u->status == 1) echo 'li_online';?>"  title="<?php echo $u->message;?>" rel="<?php echo $u->username;?>">
								<b><?php echo $u->name;?></b>
								<?php if($u->new_flag == 1):?>
									<abbr>New</abbr>
								<?php endif;?>
								<?php if($u->status == 1):?>
									<?php $users_online_count++;?>
									<span class="online">Online</span>
								<?php else:?>
									<span class="offline">Offline</span>
								<?php endif;?>	
								<p style="margin:0; font-size: 7.5pt;"><?php echo $u->message;?></p>
							</li>
						<?php endforeach;?>
					<?php endif; ?>
				</ul>
			</div>							
		</div>
		
		
		<div class="tim_container" style="height: 520px; position: relative; top: -531px; left: 301px; z-index: 8;">	
			<div class="tim_global" style="position:relative;">
				<!--
				<div style="width: 100%; height: 100%; background-color: #000; opacity: 0.5; position: absolute; left:0; top: 0; z-index: 100;"></div>
				<div style="width: 100%; height: 100%; position: absolute; left:0; top: 0; z-index: 101;">
					<h1 style="color: #fff; margin-top: 120px;">This feature will be available soon!</h1>
				</div>
				-->
				<h1 class="header_title">GROUP CHAT<span class="global_start">START TOPIC</span></h1>
				<ul class="global_chat">
					<li>Loading...</li>
				</ul>
				<!--
				<div style="padding: 10px; text-align: right;">
					<a href="#" class="btn">MORE</a>
				</div>
				-->	
			</div>					
		</div>
		
		
		<div style="clear: both;"></div>
		<div class="message_box" style="display: none;">
			<div class="box_header">
				<h1>Chat with <b class="message_username"></b> <abbr class="box_head_span" style="display: none;">New Message</abbr><span class="close_chat" style="float: right; cursor: pointer; margin-right: 5px; font-size: 8pt;" title="Close Chat Box">Close</span></h1>
				<p class="individual_status">
					I am currently working on proposals for MYCS.
				</p>
			</div>
			<div class="box_messages">
					<ul class="messages">
	
						
					</ul>
			</div>
			<div class="box_send">
				<form action="#" method="post" id="msg_submit">
					<textarea name="chat_message" cols="30" id="msg_msg" rows="2"></textarea>
					<input type="submit" name="submit" class="btn" value="SEND" />
				</form>	
				
			</div>
		</div>
		
		
		<div class="status_box" style="display: none;">
			<h1 style="text-align: left">Hi <?php echo $user_info->username;?>!<span class="close_status" style="float: right; cursor: pointer; margin-right: 5px; font-size: 8pt; font-weight: normal;" title="Close Chat Box">Close</span></h1>
			<p>What are you gonna do today? <em style="font-size: 8pt;">150 chars</em></p>
			<form action="#" method="post" id="status_submit">
				<textarea name="status_message" cols="30" maxlength="150" id="msg_status" rows="2"><?php echo $user_info->message;?></textarea>
				<input type="submit" name="submit" class="btn" value="UPDATE" />
			</form>	
		</div>	
		
		<div class="global_box" style="display: none;">
			<h1 style="text-align: left">Start a topic<span class="close_global" style="float: right; cursor: pointer; margin-right: 5px; font-size: 8pt; font-weight: normal;" title="Close Chat Box">Close</span></h1>
			
			<form action="#" method="post" id="global_submit">
				<p style="margin: 0;">Title:</p>
				<input type="text" name="title" id="global_title" class="textbox" style="margin-bottom: 5px;"/>
				<p style="margin: 0;">Message:</p>
				<textarea name="global_message" cols="30" maxlength="150" id="msg_global" rows="2"></textarea>
				<p style="margin: 0;">To:</p>
				<input type="radio" name="to_option" value="all" id="option_all" CHECKED > All<br>
				<input type="radio" name="to_option" value="some" id="option_custom" > Some<br>
				<div class="option_con" style="display: none;">
					<?php if($users): ?>
						<?php $l = 1;?>
						<?php foreach($users as $u):?>
							<input type="checkbox" name="option_<?php $l++;?>" value="<?php echo $u->username;?>"/><?php echo $u->username;?>
						<?php endforeach;?>
					<?php endif;?>
				</div>
				
				<input type="submit" name="submit" class="btn" value="START" style="position: absolute; left: 10px; bottom: 5px;" />
			</form>	
		</div>
		
	</div>	
<script type="text/javascript">
	
	var this_user = '<?php echo $user_info->username;?>';
	var base_url = $('base').attr("href");
	var to = "";
	var ready_flag = true;
	var last_online_str = "";
	var last_msg_str = "";
	var last_group_msg = "";
	var last_group_msg_box = "";
	var last_group_users_msg_box = "";
	var active_msg_user = "";
	var g_option = 'all';
	var gc_to = "";
	var flash_message = "";
	var original = document.title;
	var timeout = null;
	$(document).ready(function(){
		
		$('#msg_global').val('');
		$('#global_title').val('');
		
		$('span.gc_box_close').click(function(){
			
			
			var form_data = {
				ajax : '1'
			}
		
			$.ajax({
				url: base_url+"index.php/tim/ajax_gc_close",
				type: 'POST',
				data: form_data,
				//dataType: 'json',
				success: function(msg){
					$('div.jmodal_overlay').fadeOut();
					$('div.jmodal_overlay_text').fadeOut();
					gc_to = "";				
				}
			});
		});
		
		$('#gc_submit').submit(function(){
			var gc_msg = $('#gc_msg').val();
			gc_msg = gc_msg.trim();
			if(gc_msg !== "" && gc_to != ""){
				var form_data = {
					gc_msg: gc_msg,
					gc_to: gc_to,
					ajax : '1'
				}
			
				$.ajax({
					url: base_url+"index.php/tim/ajax_set_gc_individual",
					type: 'POST',
					data: form_data,
					//dataType: 'json',
					success: function(msg){
						$('#gc_msg').val("");
					}
				});
			}
			return false;
		});
		
		$('#global_submit').submit(function(){
			var g_msg = $('#msg_global').val();
			var g_title = $('#global_title').val();
			var g_tos = "";
			var error_msg = "";
			var error_flag = false;
			$('div.option_con input:checkbox').each(function(){
				var val = $(this).val();
				var ck = $(this).is(':checked');
				if(ck){
					g_tos = g_tos + val + ",";
				}
			});
			
			g_msg = g_msg.trim();
			g_title = g_title.trim();
			g_tos = g_tos.trim();

			if(g_title === ""){
				$('#global_title').val("");
				error_msg = error_msg + "Title is required!\n";
				error_flag = true;
			}
		
			if(g_msg === ""){
				$('#msg_global').val("");
				error_msg = error_msg + "Message is required!\n";
				error_flag = true;
			}
			if(g_option == 'some'){
				if(g_tos === ""){
					error_msg = error_msg + "Please select users!\n";
					error_flag = true;
				}	
			}
			
			if(error_flag){
				alert(error_msg);
			}
			else{
				var form_data = {
					from: this_user,
					g_msg: g_msg,
					g_title: g_title,
					g_option: g_option,
					g_tos: g_tos,
					ajax : '1'
				}
			
				$.ajax({
					url: base_url+"index.php/tim/ajax_set_group_chat",
					type: 'POST',
					data: form_data,
					//dataType: 'json',
					success: function(msg){
						//alert(msg);
						$('#msg_global').val('');
						$('#global_title').val('');
						var vis_flag = $('.global_box').is(":visible");
						if(vis_flag){
							$('.global_box').animate({width: 'toggle'}, 100);
						}
						
					}
				});
			}
			return false;
		});
		
		if($('#option_all').is(':checked')){
			$('div.option_con').slideUp();
			g_option = 'all';
		}
		else{
			$('div.option_con').slideDown();
			g_option = 'some';
		}
		
		$('b.users_online_count').html('<?php echo $users_online_count;?>');
		

		$("input:radio[name=to_option]").click(function(){
			var value = $(this).val();
			if(value == "all"){
				$('div.option_con').slideUp();
				g_option = 'all';
			}
			else{
				$('div.option_con').slideDown();
				g_option = 'some';
			}
		});
		
		$('#msg_submit').submit(function(){
			var c_msg = $("#msg_msg").val();
			
			if(to != "" && c_msg != ""){
				var form_data = {
					to: to,
					from: this_user,
					c_msg: c_msg,
					ajax : '1'
				}
			
				$.ajax({
					url: base_url+"index.php/tim/ajax_jchat",
					type: 'POST',
					data: form_data,
					//dataType: 'json',
					success: function(msg){
						$("#msg_msg").val('');
						$('ul.messages').html(msg);
						$('ul.messages').scrollTop(5000);
						
					}
				});
			}
			return false;
		});
		
		
		
		$('#status_submit').submit(function(){
			var c_msg = $("#msg_status").val();
			
			if(c_msg != ""){
				var form_data = {
					from: this_user,
					c_msg: c_msg,
					ajax : '1'
				}
			
				$.ajax({
					url: base_url+"index.php/tim/ajax_add_status",
					type: 'POST',
					data: form_data,
					//dataType: 'json',
					success: function(msg){
						$(".status_box").hide();
						$('p.status').html(c_msg);					
					}
				});
			}
			return false;
		});
		
		
		$('span.close_chat').click(function(){
			var vis_flag = $('.message_box').is(":visible");
			if(vis_flag){				
				var form_data = {
					ajax : '1'
				}
			
				$.ajax({
					url: base_url+"index.php/tim/ajax_chat_close_user",
					type: 'POST',
					data: form_data,
					//dataType: 'json',
					success: function(msg){
						$('.message_box').animate({width: 'toggle'}, 100);
						$('li.li_chat').removeClass('active_chat');
						to = "";
						$("b.message_username").html("");				
					}
				});
			}	
		});
		
		$('span.close_status').click(function(){
			var vis_flag = $('.status_box').is(":visible");
			if(vis_flag){
				$('.status_box').animate({width: 'toggle'}, 100);
			}	
		});
		
		$('span.close_global').click(function(){
			var vis_flag = $('.global_box').is(":visible");
			if(vis_flag){
				$('.global_box').animate({width: 'toggle'}, 100);
			}	
		});
	
	
		$('span.global_start').click(function(){
			
			var vis_flag = $('.message_box').is(":visible");
			if(vis_flag){
				$('.message_box').animate({width: 'toggle'}, 100);
				$('li.li_chat').removeClass('active_chat');
				$('b.message_username').html("");
				to = "";
			}

			$('.global_box').show();
		});
		
		if(typeof(EventSource)!=="undefined"){
			var source=new EventSource(base_url+"index.php/tim/ajax_jchat_get_online");
		  
			source.addEventListener('message', function(e) {
				var data = JSON.parse(e.data);
				  //console.log(data.msg);
			 
			}, false);
			
			source.addEventListener('update', function(e) {
				 // console.log(e.data);
				var new_html_flag = false;
				if(last_online_str != e.data){
					$('ul.users').html(e.data);
					last_online_str = e.data;
					new_html_flag = true;
				}
				
				if(flash_message === ""){
					if(timeout){
						clearTimeout(timeout);
					}
					document.title == original;
					console.log("empty");
				}
				else{
					if(!timeout){
						console.log("first run");
						flashTitle(flash_message, 1000);
					}
					else{
						if(new_html_flag){
							console.log("start new run");
							clearTimeout(timeout);
							flashTitle(flash_message, 1000);
						}
					}
				}
			}, false);
			
			source.addEventListener('updateGroup', function(e) {
				if(last_group_msg != e.data){
					$('ul.global_chat').html(e.data);
					last_group_msg = e.data;
				}
				//console.log(e.data);
			}, false);
			
			
			source.addEventListener('updateChat', function(e) {
				var data = JSON.parse(e.data);
				
				if(last_msg_str != data.msg){
					$('ul.messages').html(data.msg);
					last_msg_str = data.msg;
				}
				
				if(data.new_flag == 'yes'){
					$('abbr.box_head_span').show();
					$('ul.messages').scrollTop(10000);
					setTimeout(function(){
						$('abbr.box_head_span').hide();
					}, 5000);
					
				}
				
				//console.log(data.msg);
			}, false);
			
			source.addEventListener('updateGroupChat', function(e) {
				var data = JSON.parse(e.data);		
				$("b.b_gc_title").html(data.gc_title);	
				$("b.b_gc_creator").html(data.creator);	
				
				$("em.b_gc_created").html(data.time_created);
				
				if(last_group_msg_box != data.msg){
					$("div.gc_con").html(data.msg);
					last_group_msg_box = data.msg;
					$("div.gc_con").scrollTop(10000);
				}
				
				if(last_group_users_msg_box != data.gc_users){
					$("em.users_involved").html(data.gc_users);
					last_group_users_msg_box = data.gc_users;
				}

			//	console.log(data.msg);
			}, false);
			
			
			source.addEventListener('open', function(e) {
			  //console.log("Open");
			}, false);

			source.addEventListener('error', function(e) {
				console.log(e);
			  if (e.readyState == EventSource.CLOSED) {
			    // Connection was closed.
				//console.log("Connection Closed!");
			  }
			}, false);

			
		
		}
		else{
			document.getElementById("result").innerHTML="Sorry, your browser does not support server-sent events...";
		}


	});
	
	blink('.blinkThis');


	function blink(selector){
		$(selector).fadeOut('slow', function(){
		    $(this).fadeIn('slow', function(){
		        blink(this);
		    });
		});
	}
	
	
	$(document).keypress(function(event){

		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){
			var c_msg = $("#msg_msg").val();
			
			if(to != "" && c_msg != ""){
				var form_data = {
					to: to,
					from: this_user,
					c_msg: c_msg,
					ajax : '1'
				}
			
				$.ajax({
					url: base_url+"index.php/tim/ajax_jchat",
					type: 'POST',
					data: form_data,
					//dataType: 'json',
					success: function(msg){
						$("#msg_msg").val('');
						$('ul.messages').html(msg);
						$('ul.messages').scrollTop(10000);
						
					}
				});
			}
			
			else{
				var gc_msg = $('#gc_msg').val();
				gc_msg = gc_msg.trim();
				if(gc_msg !== "" && gc_to != ""){
					var form_data = {
						gc_msg: gc_msg,
						gc_to: gc_to,
						ajax : '1'
					}

					$.ajax({
						url: base_url+"index.php/tim/ajax_set_gc_individual",
						type: 'POST',
						data: form_data,
						//dataType: 'json',
						success: function(msg){
							$('#gc_msg').val("");
						}
					});
				}
			}
			
		}

	});
	
	function myStatus(){
		var vis_flag = $('.message_box').is(":visible");
		if(vis_flag){
			$('.message_box').animate({width: 'toggle'}, 100);
			$('li.li_chat').removeClass('active_chat');
			$('b.message_username').html("");
			to = "";
		}
		
		$('.status_box').show();
	}
	
	function tim_logout(){
		var form_data = {
			ajax : '1'
		}

		$.ajax({
			url: base_url+"index.php/tim/logout",
			type: 'POST',
			data: form_data,
			//dataType: 'json',
			success: function(msg){
				opener.location.href = base_url+"index.php/tim";
				close();
			}
		});
	}			
</script>	

<script src="assets/js/flash_title.js" type="text/javascript" charset="utf-8"></script>
	
	
</body>
</html>