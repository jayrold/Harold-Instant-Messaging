
<div class=\"gc_box <?php if($first_message->username == $this->session->userdata('username')) echo 'own';?>\">
	<h2><?php echo $first_message->username;?> Says:<span><?php echo date('d M Y h:i:s a', mysql_to_unix($first_message->time));?></span></h2>
	<p>
		<?php
			$string = $first_message->message;
			
			preg_match('/[a-zA-Z]+:\/\/[0-9a-zA-Z;.\/\-?:@=_#&%~,+$]+/', $string, $matches);		
			$url_arrs = array();
			$url_arrs['harold_key1'] = "";
			$url_arrs['harold_key2'] = "";
			$url_arrs['harold_key3'] = "";
			//first url
			if($matches){
				$string = str_replace($matches[0], "[harold_key1]",$string);
				$url_arrs['harold_key1'] = $matches[0];
				preg_match('/[a-zA-Z]+:\/\/[0-9a-zA-Z;.\/\-?:@=_#&%~,+$]+/', $string, $matches);

				//second url
				if($matches){
					$string = str_replace($matches[0], "[harold_key2]",$string);
					$url_arrs['harold_key2'] = $matches[0];
					preg_match('/[a-zA-Z]+:\/\/[0-9a-zA-Z;.\/\-?:@=_#&%~,+$]+/', $string, $matches);

					//third url
					if($matches){
						$string = str_replace($matches[0], "[harold_key3]",$string);
						$url_arrs['harold_key3'] = $matches[0];
						//preg_match('/[a-zA-Z]+:\/\/[0-9a-zA-Z;.\/\-?:@=_#&%~,+$]+/', $string, $matches);
					}
				}

			}

			if(!empty($url_arrs['harold_key1'])){
				$string = str_replace('[harold_key1]', '<a href=\"'.$url_arrs['harold_key1'].'\" target=\"_blank\">'.$url_arrs['harold_key1'].'</a>', $string);
			}
			if(!empty($url_arrs['harold_key2'])){
				$string = str_replace('[harold_key2]', '<a href=\"'.$url_arrs['harold_key2'].'\" target=\"_blank\">'.$url_arrs['harold_key2'].'</a>', $string);
			}
			if(!empty($url_arrs['harold_key3'])){
				$string = str_replace('[harold_key3]', '<a href=\"'.$url_arrs['harold_key3'].'\" target=\"_blank\">'.$url_arrs['harold_key3'].'</a>', $string);
			}
			
			$first_message->message = $string;
		
		?>
		
		
		
		<?php echo nl2br($first_message->message);?>
	</p>
</div>
<?php if($all_message):?>
	<?php foreach($all_message as $am):?>
		<div class=\"gc_box <?php if($am->username == $this->session->userdata('username')) echo 'own';?>\">
			<h2><?php echo $am->username;?> Says:<span><?php echo date('d M Y h:i:s a', mysql_to_unix($am->time));?></span></h2>
			<p>
				<?php
					$string = $am->message;

					preg_match('/[a-zA-Z]+:\/\/[0-9a-zA-Z;.\/\-?:@=_#&%~,+$]+/', $string, $matches);		
					$url_arrs = array();
					$url_arrs['harold_key1'] = "";
					$url_arrs['harold_key2'] = "";
					$url_arrs['harold_key3'] = "";
					//first url
					if($matches){
						$string = str_replace($matches[0], "[harold_key1]",$string);
						$url_arrs['harold_key1'] = $matches[0];
						preg_match('/[a-zA-Z]+:\/\/[0-9a-zA-Z;.\/\-?:@=_#&%~,+$]+/', $string, $matches);

						//second url
						if($matches){
							$string = str_replace($matches[0], "[harold_key2]",$string);
							$url_arrs['harold_key2'] = $matches[0];
							preg_match('/[a-zA-Z]+:\/\/[0-9a-zA-Z;.\/\-?:@=_#&%~,+$]+/', $string, $matches);

							//third url
							if($matches){
								$string = str_replace($matches[0], "[harold_key3]",$string);
								$url_arrs['harold_key3'] = $matches[0];
								//preg_match('/[a-zA-Z]+:\/\/[0-9a-zA-Z;.\/\-?:@=_#&%~,+$]+/', $string, $matches);
							}
						}

					}

					if(!empty($url_arrs['harold_key1'])){
						$string = str_replace('[harold_key1]', '<a href=\"'.$url_arrs['harold_key1'].'\" target=\"_blank\">'.$url_arrs['harold_key1'].'</a>', $string);
					}
					if(!empty($url_arrs['harold_key2'])){
						$string = str_replace('[harold_key2]', '<a href=\"'.$url_arrs['harold_key2'].'\" target=\"_blank\">'.$url_arrs['harold_key2'].'</a>', $string);
					}
					if(!empty($url_arrs['harold_key3'])){
						$string = str_replace('[harold_key3]', '<a href=\"'.$url_arrs['harold_key3'].'\" target=\"_blank\">'.$url_arrs['harold_key3'].'</a>', $string);
					}

					$am->message = $string;

				?>
				
				<?php echo nl2br($am->message);?> 
			</p>
		</div>
	<?php endforeach;?>
<?php endif;?>
