<?php if($res):?>
	<?php $i = 1;?>
	<?php foreach($res as $r):?>
		<?php if(!empty($r->total_replies)):?>
			<li style="background-color: #F6EAFC;" rel="<?php echo $r->id;?>" title="<?php echo $r->title;?>"><?php echo $i++;?>.
		<?php else:?>
			<li  rel="<?php echo $r->id;?>" title="<?php echo $r->title;?>"><?php echo $i++;?>.
		<?php endif;?>		
			<b><?php 
					$len = strlen($r->title);
					if($len > 30){
						$r->title = substr($r->title, 0, 27)."...";
					}
					echo $r->title;
				?>
			</b>
			<?php if(!empty($r->total_replies)):?>
				<abbr class="blinkThis"><?php echo $r->total_replies;?></abbr>
			<?php endif;?>
			<br>
			<?php if(!empty($r->last_name)):?>
				<em>Last updated: <?php echo str_replace("[]", "at", date("d M Y [] h:i a", mysql_to_unix($r->last_date)));?>, by: <b><?php echo $r->last_name;?></b></em>
			<?php else:?>
				<em>Created: <?php echo str_replace("[]", "at", date("d M Y [] h:i a", mysql_to_unix($r->time)));?></em>
			<?php endif;?>
			<span>By: <?php echo $r->username;?></span>
		</li>
	<?php endforeach;?>
<?php else:?>
	<li>
		No result
	</li>

<?php endif;?>

<script src="assets/js/ajax_group_chat_js.js" type="text/javascript" charset="utf-8"></script>
