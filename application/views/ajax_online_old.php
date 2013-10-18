<?php $users_online_count = 0;?>
<?php if($users): ?>
	<?php foreach($users as $u):?>
		<li class="li_chat <?php if($c_username == $u->username) echo "active_chat";?>  <?php if($u->status == 1) echo "li_online";?>"  title="<?php echo $u->message;?>" rel="<?php echo $u->username;?>">
			<b><?php echo $u->name;?></b>
			<?php if($u->new_flag == 1):?>
				<abbr class="blinkThis">New</abbr>
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

