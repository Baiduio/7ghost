		<dl>
			<dt><?php _e($info['name']);?>:</dt>
			<?php
				//低版本PHP使用
				//$value = get_magic_quotes_gpc()?stripslashes($info['value']):$info['value']; 
				
				$value = addslashes('')?stripslashes($info['value']):$info['value'];
			?>
			<dd><input type="text" size="32" value="<?php _e(htmlspecialchars($value));?>" name="<?php _e($info['key']);?>"></dd>
			<dd class='tipe'><?php _e($info['tipe']);?></dd>
		</dl>