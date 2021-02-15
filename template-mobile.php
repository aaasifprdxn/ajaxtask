<?php
/*
Template Name: Mobile listing page
*/
get_header();

$loop = new WP_Query( array( 'post_type' => 'mobile' ) ); ?>

<div class="mobile-blog-container">
<?php
while ( $loop->have_posts() ) : $loop->the_post();
$the_cat = get_the_category();
$category_name = $the_cat[0]->cat_name;
if ($category_name == "mobile") {
?>
	<div class="blog-post-styling">
		<?php if( get_field('thumbnail') ): ?>
  	<img src="<?php the_field('thumbnail'); ?>">
		<?php endif; ?>
		<div class="entry-date"><span><?php echo get_the_date(); ?>		<?php
		echo " | Category : ".$category_name;
		?>
		</span>
	</div>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<a class="entry-date" href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a>
	</div>
<?php
}
endwhile; ?>
</div>	
<?php
get_footer();