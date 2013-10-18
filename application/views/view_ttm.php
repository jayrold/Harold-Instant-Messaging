<!doctype html>
<html lang="en">
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
	<base href="<?php echo base_url();?>" />
	<link href="http://www.tuberproductions.com/wp-content/themes/tuber/favicon.ico" rel="shortcut icon">		
	<title>Tuber Task Manager(TTM)</title>	
	
	<link rel="stylesheet" href="assets/css/style.css" type="text/css" media="screen" title="no title" charset="utf-8" />
	<script src="assets/js/jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"></script>

	<script src="assets/js/jquery-ui-1.9.2.custom.min.js" type="text/javascript" charset="utf-8"></script>
		
					
</head>	
<body style="background-color: #fff;">
	<div id="task_wrapper">
		<div class="task_header">
			<h1>TUBER TASK MANAGER(TTM)<span id="total_task"><b id="task_number"></b> Task(s)</span></h1>
		</div>
		<div class="mini-header">Logged in as <b><?php echo $username;?></b><span><a href="javascript:clear_all_tasks();" class="cancel" title="Are you sure you want to clear all your tasks?">Clear All Tasks</a><a href="" style="display: none;">Settings</a></span></div>
		<div class="task_body">	
			<ul id="sortable">
				<?php if($task_info):?>
					<?php echo $task_info->task_html;?>	
				<?php endif;?>	
			</ul>	
			
		</div>
		<div class="task_textbox">
			<div class="textbox_con">
				<textarea name="tast_message" id="message"></textarea>
			</div>
			<div class="textbox_submit">
				<img src="assets/images/add_task.png" id="addTask"/>
			</div>
			<div style="clear:both"></div>
		</div>	
	</div>	
	<script>
	
		function count_task(){
			var total_task = 0;
			var task_count = 0;
			$('ul#sortable li').each(function(index) {
				if($(this).find("img.done").is(":visible")){
					total_task++;
				}
				task_count++;
			});	
			if(task_count > 0){
				$("a.cancel").show();
			}
			else{
				$("a.cancel").hide();
			}
			$("b#task_number").html(total_task);
		}
		
		function clear_all_tasks(){
			localStorage.savedTasks = "";
			$(".task_body ul#sortable").html(localStorage.savedTasks);
			$("b#task_number").html(0);
			$("a.cancel").hide();
		}
	
	
		function saveTaskToDb(){
			var base_url = $("base").attr("href");
			var form_data = {
				task_html: $(".task_body ul#sortable").html(),
				ajax : '1'
			}
			
			$.ajax({
				url: base_url+"index.php/ttm/ajax_save_tasks",
				type: 'POST',
				data: form_data,
				success: function(msg){
					console.log(msg);	
					
					setTimeout(function(){
						saveTaskToDb()
					}, 2000);			
				}
			});
		}
	
	    $(function() {
	        $( "#sortable" ).sortable({
				stop: function( event, ui ) {
					localStorage.savedTasks = $(".task_body ul#sortable").html();
				}
			});
	        $( "#sortable" ).disableSelection();
	    });
	
		if(typeof(Storage)!=="undefined"){
			//alert(localStorage.lastname);
			if(localStorage.savedTasks){
				//localStorage.savedTasks = $(".task_body").html();
				<?php if($task_info):?>

				<?php else: ?>
					$(".task_body ul#sortable").html(localStorage.savedTasks);
				<?php endif; ?>				
			}
			else{
				localStorage.savedTasks = $(".task_body ul#sortable").html();
			}	
		  	
		}
		else{
		  alert("Not supported!");
		}
	
	
	 </script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			count_task();
			
			setTimeout(function(){
				saveTaskToDb();
			}, 2000);
	
			$("#message").val("");
			
			$("a.cancel").click(function(){
				return confirm($(this).attr("title"));
			});
			$("img.done").live("click", function() {
				$(this).parent().parent().addClass("task_done");
				localStorage.savedTasks = $(".task_body ul#sortable").html();
				count_task();
			});
			$("img.undone").live("click", function() {
				$(this).parent().parent().removeClass("task_done");
				localStorage.savedTasks = $(".task_body ul#sortable").html();
				count_task();
			});
			$("img.delete").live("click", function() {
				$(this).parent().parent().addClass("removed");
				$(this).parent().parent().removeClass("task_done");
				localStorage.savedTasks = $(".task_body ul#sortable").html();
				count_task();
			});
			$("#addTask").click(function(){
				var message = $("#message").val();
				message = $.trim(message);
				if(message == ""){
					
					$("#task_wrapper div.task_textbox div.textbox_con textarea").css({"border": "1px solid RED"});
					setTimeout(function(){
						$("#task_wrapper div.task_textbox div.textbox_con textarea").css({"border": "1px solid #000"});
					},3000);
					alert("Task is required!");
				}
				else{
					$("ul#sortable").prepend('<li><div class="icon-container"><img src="assets/images/unchecked.png" class="done" /><img src="assets/images/checked.png" class="undone" /><img src="assets/images/remove.png" style="margin-left: 5px;" class="delete" /></div>'+message+"</li>");
					localStorage.savedTasks = $(".task_body ul#sortable").html();
					$("#message").val("");
					count_task();
				}
			});
			
			
			$('#message').keypress(function(event){

				var keycode = (event.keyCode ? event.keyCode : event.which);
				if(keycode == '13'){
					var message = $("#message").val();
					message = $.trim(message);
					if(message == ""){

						$("#task_wrapper div.task_textbox div.textbox_con textarea").css({"border": "1px solid RED"});
						setTimeout(function(){
							$("#task_wrapper div.task_textbox div.textbox_con textarea").css({"border": "1px solid #000"});
						},3000);
						alert("Task is required!");
					}
					else{
						$("ul#sortable").prepend('<li><div class="icon-container"><img src="assets/images/unchecked.png" class="done" /><img src="assets/images/checked.png" class="undone" /><img src="assets/images/remove.png" style="margin-left: 5px;" class="delete" /></div>'+message+"</li>");
						localStorage.savedTasks = $(".task_body ul#sortable").html();
						$("#message").val("");
						count_task();
					}
				}

			});
		});
		

	</script>
			
</body>
</html>