<li class="has-sub">		
	<a href="javascript:;">		
		<b class="caret pull-right"></b>		
		<i class="fa fa-align-left"></i> 		
		<span>Nominas</span>		
	</a>		
	<ul class="sub-menu">		
		<li class="has-sub">		
			<a href="javascript:;">		
				<b class="caret pull-right"></b>KPI	
			</a>		
			<ul class="sub-menu">
			<?php 
				foreach(self::$USER_ACCESS[1][$x] as $Area){
					switch($Area){
					case 1:
					require_once($_SESSION['BASE_DIR_BACKEND'].'/view/include/4/area/1.php');
					break;
					}
				} 
			?>		
			</ul>		
		</li>		
	</ul>		
</li>