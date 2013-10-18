
	$(document).ready(function(){
		
		blink(".blinkThis");
		$("ul.global_chat").on("click", "li", function (){
			var gc_id = $(this).attr("rel");
			var gc_title = $(this).attr("title");
			gc_to = gc_id;
			var form_data = {
				gc_id: gc_id,
				ajax : "1"
			}

			$.ajax({
				url: base_url+"index.php/tim/ajax_set_gc_id",
				type: "POST",
				data: form_data,
				dataType: "json",
				success: function(msg){	
					$("b.b_gc_title").html(msg.gc_title);	
					$("b.b_gc_creator").html(msg.creator);	
					$("em.users_involved").html(msg.gc_users);
					$("em.b_gc_created").html(msg.time_created);
					$("div.jmodal_overlay").fadeIn();
					$("div.jmodal_overlay_text").fadeIn();
					$("#gc_msg").val("");
				}
			});
			
			
			
			
			//alert(gc_id);
			//alert(gc_title);
		});	
		
	});
