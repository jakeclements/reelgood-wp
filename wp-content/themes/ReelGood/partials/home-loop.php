<div class="post-overview column large-16">
				
	<div class="post-overview__image">
	
		<?php $image = get_field('small_feature_image', $p->ID); 
			
			$thumb = $image['sizes']['rg_thumb'];
			
			if($thumb == ''){
				
				/*
				$image = get_field('featured_wide', $p->ID);
				$thumb = $image['sizes']['rg_thumb'];
				*/
				
				$thumb = catch_first_image(get_post($p->ID));
				
			};
			
			if(REELGOOD_STAGE == true){ 
				
				$thumb = str_replace('pilot.', '', $thumb);
				
			}


		?>
		
		<a href="<?php echo get_permalink($p->ID);?>"><img alt="<?php echo get_the_title($p->ID); ?>" src="<?php echo $thumb ?>" /></a>
					
					
		<div class="post-meta">
					
			<div class="post-meta--l">
							
				<div class="post-meta__date"><?php the_time('j F, Y'); ?></div>

				<div class="post-meta__comments"><a href="<?php echo get_permalink($p->ID);?>"><span class="bold"><fb:comments-count href="<?php echo get_permalink($p->ID); ?>"></fb:comments-count></span> Comments</a></div>
						
			</div>
						
			<div class="post-meta--r">
				<div class="post-meta__author"><span class="bold">By</span> <a href="<?php echo get_author_posts_url( $p->post_author ); ?>"><?php echo get_the_author_meta('nickname', $p->post_author ); ?></a></div>
							
				<div class="post-meta__share"><a href="">Share</a></div>
						
			</div>
					
		</div>
					
	</div>
				
	<div class="post-overview__info">
				
		<h4><a href="<?php echo get_permalink($p->ID);?>"><?php echo get_the_title($p->ID); ?></a></h4>
		
		<p><?php if(get_field('brief_post_description', $p->ID)){
		
			echo get_field('brief_post_description', $p->ID);
		
		}else{
		
			echo excerpt(25);
		
		};?></p>		

		
	</div>
			
</div>