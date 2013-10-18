$(document).ready(function(){
	
	if($("span#versionChecker").html() !== "V03"){
		window.location.href=window.location.href;
	}
	else{
	
	
		var b_user_html = $("b.users_online_count").html();
		var ajax_user_total = $("input#ajax_total_online").val();
		if(b_user_html === ajax_user_total){		
		}
		else{
			$("b.users_online_count").html(ajax_user_total);
		}
	
	
		blink(".blinkThis");
		$("ul.users").on("click", "li", function (){

				var vis_flag = $(".message_box").is(":visible");
				var cur_username = $("b.message_username").html();
				var username = $(this).attr("rel");
				$("p.individual_status").html($(this).attr("title"));
			
				$(".status_box").hide();
				$(".global_box").hide();
				to = username;
				active_msg_user = username;
				if(cur_username === username){
				}
				else{

					if(!vis_flag){
						$("ul.messages").html("");	
						var form_data = {
							to: to,
							from: this_user,
							ajax : "1"
						}

						$.ajax({
							url: base_url+"index.php/tim/ajax_jchat_update_set_user",
							type: "POST",
							data: form_data,
							dataType: "json",
							success: function(msg){
								
								$("#msg_msg").val("");
								$("ul.messages").html(msg.msg);
								setTimeout(function(){
									ready_flag = true;
								}, 300);
								$("ul.messages").scrollTop(5000);
								
					
							}
						});
						$(".message_box").animate({width: "toggle"}, 100);
						$("b.message_username").html(username);	
						$("li.li_chat").removeClass("active_chat");
						$(this).addClass("active_chat");
				
				
					}
					else{
					//	$(".message_box").hide();
						$("ul.messages").html("");					
						$(".message_box").animate({
							width: "toggle"
							}, 50, function(){
								$("#msg_msg").val("");
								var form_data = {
									to: to,
									from: this_user,
									ajax : "1"
								}

								$.ajax({
									url: base_url+"index.php/tim/ajax_jchat_update_set_user",
									type: "POST",
									data: form_data,
									dataType: "json",
									success: function(msg){
										$("#msg_msg").val("");
										$("ul.messages").html(msg.msg);
										$(".message_box").animate({width: "toggle"}, 100);
										$("ul.messages").scrollTop(5000);
									}
								});



						});	
						$("b.message_username").html(username);
						$("li.li_chat").removeClass("active_chat");
						$(this).addClass("active_chat");
					}
		
				}	
			//}		
		});


	}

});
