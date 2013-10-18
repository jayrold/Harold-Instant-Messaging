<?php 
	$users_online_count = 0;
	$new_messages = "";
?>
<?php if($users): ?>
	<?php foreach($users as $u):?>
		<li class="li_chat <?php if($c_username == $u->username) echo "active_chat";?>  <?php if($u->status == 1) echo "li_online";?>"  title="<?php echo $u->message;?>" rel="<?php echo $u->username;?>">
			<b><?php echo $u->name;?></b>
			<?php if($u->new_flag == 1):?>
				<abbr class="blinkThis">New</abbr>
				<?php $new_messages .= $u->name.", ";?>
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
<input type="hidden" name="total_online_users" id="ajax_total_online" value="<?php echo $users_online_count;?>" />
<?php if(!empty($new_messages)):?>
	<?php 
		$new_messages = trim($new_messages);
		$new_messages = substr_replace($new_messages ,"",-1);
	?>
	<script type="text/javascript">
		flash_message = "<?php echo $new_messages;?> messaged you";
	</script>
<?php else:?>
	<script type="text/javascript">
		flash_message = "";
	</script>	
<?php endif;?>	
<script src="assets/js/ajax_online_js.js" type="text/javascript" charset="utf-8"></script>
