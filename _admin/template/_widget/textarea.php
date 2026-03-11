		<dl> 
			<dt><?php _e($info['name']);?>:</dt> 
			<?php
				$value = isset($info['value'])?$info['value']:'';
				// get_magic_quotes_gpc() 函数在 PHP 7.4 及以上版本已被移除
				if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()){
					$value = stripslashes($value);
				}
			?>
			<dd><textarea class="tarea" cols="50" name="<?php _e($info['key']);?>" rows="5"><?php _e(htmlspecialchars($value));?></textarea></dd>
			<dd class='tipe'><?php _e($info['tipe']);?></dd>
		</dl>