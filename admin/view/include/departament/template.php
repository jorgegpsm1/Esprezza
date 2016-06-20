<li class="has-sub">		
	<a href="javascript:;">		
		<b class="caret pull-right"></b>		
		<i class="fa fa-align-left"></i> 		
		<span><?php echo self::$USER_ACCESS[0][$x][1]; ?></span>		
	</a>		
	<ul class="sub-menu">		
		<?php
			$Area = count(self::$USER_ACCESS[1][$x]);
			for($y=0; $y<$Area; $y++){		
				include($_SESSION['BASE_DIR_BACKEND'].'/view/include/area/template.php');
			}
		?>
	</ul>		
</li>