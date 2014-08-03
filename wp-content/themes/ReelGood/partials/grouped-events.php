<?php 
	//print_r($eventList);
	
	if($eventList):

		echo '<ul>';
	
		foreach($eventList as $e): ?>
	
			<li class="grouped-event">
			
				<h3><a href="<?php echo $e['event_link'] ?>"><?php echo $e['event_name']; ?></a></h3>
				
				<?php $Edate = $e['event_end_date']; ?>
				
				<div class="date-box <?php if($Edate){ echo 'double'; }?>">
					
					<div class="start-date"><?php $Sdate = $e['event_start_date'];
						$date = DateTime::createFromFormat('Ymd', $Sdate);
						echo '<span class="num">' . $date->format('jS'). '</span>';
						echo '<span class="month">' . $date->format('M'). '</span>';
					 ?>
					</div>
					
					<?php if( $e['event_end_date'] ){ ?> 
					
						<div class="end-date"> - <?php
						$edate = DateTime::createFromFormat('Ymd', $Edate);
						echo '<span class="end-num">' . $edate->format('jS'). '</span>';
						echo '<span class="end-month">' . $edate->format('M'). '</span>'; ?></div>
					
					<?php }; ?>
					
					<div class="event_time"><?php 
					
						$startevent = strtotime($e['event_time']);
						echo date('h:i A', $startevent);
						
					?></div>
				</div>				
				
				<?php if( $e['event_image'] ){
					
					echo '<img src="' . $e['event_image'] . '" alt="' . $e['event_name'] . '" />';
					
				}; ?>
			
				<p><?php echo $e['event_writeup']; ?></p>
				
				<!-- -->
			
				<?php if($e['festival_connection']){
				
					//echo 'connected to a festival';
					//get_festival_connection($e['festival_connection']);	
					
				}; ?>
			
			</li>
		
		<?php endforeach;

		echo '</ul>';
	
	endif;
?>