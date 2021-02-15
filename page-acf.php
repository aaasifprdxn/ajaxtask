<?php
get_header();
?>

<?php if( have_rows('home') ):
	while( have_rows('home') ): the_row();
		switch (get_row_layout()) {
			//Banner Section
			case 'page_banner_section':
				$banner_image =	get_sub_field('banner_image');
				if(!empty($banner_image)) {
				?>
          <figure class="banner-image-cpi">
            <img src="<?php the_sub_field('banner_image'); ?>" alt="banner image">
          </figure>
				<?php }
				$main_heading =	get_sub_field('banner_main_heading');
				if(!empty($main_heading)) {
					?>
						<div class="banner-heading-main">
							<?php the_sub_field('banner_main_heading'); ?>
						</div>
					<?php } 
				$main_heading2 =	get_sub_field('banner_second_heading');
				if(!empty($main_heading2)) {
					?>
						<div class="banner-heading2-main">
							<?php the_sub_field('banner_second_heading'); ?>
						</div>
					<?php } 
				break;
					//Core Business SEction
			case 'core_business_section':
				$core_main_heading =	get_sub_field('core_main_heading');
				if(!empty($core_main_heading)) {
					?>
						<div class="core-heading-main">
							<?php the_sub_field('core_main_heading'); ?>
						</div>
					<?php } 

				$icon_image =	get_sub_field('icon_image');
				if(!empty($icon_image)) {
				?>
          <figure class="icon-image-cpi">
            <img src="<?php the_sub_field('icon_image'); ?>" alt="banner image">
          </figure>
				<?php }

				$icon_title =	get_sub_field('icon_title');
				if(!empty($icon_title)) {
					?>
						<div class="icon-title">
							<?php the_sub_field('icon_title'); ?>
						</div>
					<?php } 

				$icon_details =	get_sub_field('icon_details');
				if(!empty($icon_details)) {
					?>
						<div class="icon-details">
							<?php the_sub_field('icon_details'); ?>
						</div>
					<?php } 
				break;
					//Core Event SEction
			case 'event_section':
				$event_heading =	get_sub_field('event_heading');
				if(!empty($event_heading)) {
					?>
						<div class="event-heading">
							<?php the_sub_field('event_heading'); ?>
						</div>
					<?php } 

				$post_id =	get_sub_field('latest_event');					
				if(!empty($post_id)) {
					?>
						<div class="latest-event">
						<?php
						$post_content = get_post($post_id);
						$content = $post_content->post_content;
						echo $content;?>
						</div>
					<?php }
				break;

					//Newsletter Subscription Section
			case 'newsletter_subscription':
				$sub_heading =	get_sub_field('main_heading');
				if(!empty($sub_heading)) {
					?>
						<div class="sub-heading">
							<?php the_sub_field('main_heading'); ?>
						</div>
					<?php } 
				$heading_details =	get_sub_field('heading_details');
				if(!empty($heading_details)) {
					?>
						<div class="heading-details">
							<?php the_sub_field('heading_details'); ?>
						</div>
					<?php } 
				$button_text =	get_sub_field('button_text');
				if(!empty($button_text)) {
					?>
						<div class="button-text">
							<?php the_sub_field('button_text'); ?>
						</div>
					<?php }
				break;
				//Latest news Section
			case 'latest_news':
				$news_heading =	get_sub_field('main_heading');
				if(!empty($news_heading)) {
					?>
						<div class="latest-news-main_heading">
							<?php the_sub_field('main_heading'); ?>
						</div>
					<?php }
				$no_post =	get_sub_field('number_of_post_to_show');
				if(!empty($no_post)) {
					?>
						<div class="number_of_post_to_show">
							<?php the_sub_field('number_of_post_to_show'); ?>
							<?php $args = array(
    						'post_type' => 'post',
						    'post_status' => 'publish',
    						'posts_per_page' => $no_post,
								);
					$loop = new WP_Query( $args );?>
					<div class="mobile-blog-container">
					<?php
					if ( $loop->have_posts() ) {
							while ( $loop->have_posts()) : $loop->the_post();?>
							<div class="blog-post-styling">
							<?php if( get_field('thumbnail') ): ?>
							<img src="<?php the_field('thumbnail'); ?>">
							<?php endif; ?>
							<span class="publish-date"><?php echo get_the_date(); ?>
							</span>
								<a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 12 ); ?></a>
								<a class="entry-date" href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a>
							</div>
							<?php endwhile; 
						}?>
					</div>
					<?php
					wp_reset_postdata();
					?>
						</div>
					<?php }
				break;
				default:
				echo "default part";
				break;
		}
			?>
	<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
