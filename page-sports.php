<?php
get_header();
?>
<form class="js-form-filter">
<select>
<?php
$wcatTerms = get_terms('sport_cat', array('hide_empty' => 0, 'parent' =>0)); 
   foreach($wcatTerms as $wcatTerm) : 
   ?>
   <option class="js-filter-item" value="<?= $wcatTerm->term_id; ?>">
		<?= $wcatTerm->name; ?>
	 </option>
<?php 
   endforeach;
	 ?> 
</select>
</form>
<div class="js-filter">
<main>
<?php
$loop = new WP_Query( array( 'post_type' => 'sport' ) ); ?>

<div class="mobile-blog-container">
<?php
while ( $loop->have_posts() ) : $loop->the_post();
$terms = get_the_terms($post->ID, 'sport_cat');
?>

	<div class="blog-post-styling">
		<?php if( has_post_thumbnail() ): ?>
		<div class="post-thumbnail">
  	<?php the_post_thumbnail(array(300,168)); ?>
		</div>
		<?php endif; ?>
		<div class="entry-date"><span><?php echo get_the_date(); ?>		<?php
		echo " | Category : ".$terms[0]->slug;
		?>
		</span>
	</div>
			<div class="post-title-sport"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
			<div class="post-excerpt-sport"><a class="entry-date" href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a></div>
	</div>
<?php

endwhile; ?>
</div>	

</main>
</div>
<?php
  get_footer();
?>