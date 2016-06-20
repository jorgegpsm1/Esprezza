<li class="has-sub">		
	<a href="javascript:;">		
		<b class="caret pull-right"></b><?php echo self::$USER_ACCESS[1][$x][$y][1]; ?>		
	</a>		
	<ul class="sub-menu">
		<?php
			$Module = count(self::$USER_ACCESS[2][$x][$y]);
			for($z=0; $z<$Module; $z++){		
				include($_SESSION['BASE_DIR_BACKEND'].'/view/include/module/template.php');
			}
		?>	
	</ul>		
</li>		