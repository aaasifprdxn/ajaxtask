<?php
/**
* functions
 */

//linking to html
function tasktheme_enqueue_style() {
		wp_enqueue_style( 'stylesheet', get_stylesheet_uri(), [],filemtime(get_template_directory().'/style.css') );
		wp_enqueue_script('jscript',get_template_directory_uri().'/js/script.js');
		wp_enqueue_script('ajax',get_template_directory_uri().'/js/ajax.js', array('jquery'), NULL, true);
		wp_localize_script('ajax', 'wpAjax', array(
			'ajaxUrl' => admin_url('admin-ajax.php'),
		) );
} 
add_action( 'wp_enqueue_scripts', 'tasktheme_enqueue_style' );

/* ajax function*/


add_action('wp_ajax_filter', 'filter_ajax');
add_action('wp_ajax_nopriv_filter', 'filter_ajax');

function filter_ajax() {
	$category = $_POST['category'];
	$args = array(
		'post_type' => 'sport',
		'tax_query' => array(
				array(
				'taxonomy' => 'sport_cat',
				'field' => 'term_id',
				'terms' => $category
				 )
			)
		);
		$query = new WP_Query( $args );
?>

<div class="mobile-blog-container">
<?php
while ( $query->have_posts() ) : $query->the_post();
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


<?php
		die();
}





/* font awsome */
add_action( 'wp_enqueue_scripts', 'custom_fa_css' );

function custom_fa_css() {
wp_enqueue_style( 'custom-fa', 'https://use.fontawesome.com/releases/v5.0.6/css/all.css' );
}
//adding menu
add_theme_support('menus');

add_theme_support('post-thumbnails');

register_nav_menus(
		array(
				'top-menu'=> 'Top Menu Location',
				//'bottom-menu'=> 'Bottom Menu Location',
		)
);

//custom post type
function my_post_type() { 
		$args = array(
				'labels' => array(
						'name' => 'News',
						'singular_name' => 'News',
						'add_new' => 'Add New News',
						'add_new_item' => 'Add New News',
						'edit_item' => 'Edit News',
						'new_item' => 'New News',
						'all_items' => 'All News',
						'view_item' => 'View News',
						'search_items' => 'Search News',
						'not_found' =>  'No News Found',
						'not_found_in_trash' => 'No News found in Trash', 
						'parent_item_colon' => '',
						'menu_name' => 'News',
				),
				'public' => true,
				'has_archive' => true,
				'menu_icon' => 'dashicons-admin-site-alt3',
				'supports' => array('title','editor','thumbnail','custom-fields'),
				'capability_type' => 'post',
		);
		register_post_type('news', $args);
}

add_action('init', 'my_post_type');

//custom taxonomy news category
function my_taxonomy() {
	$args = array(
			'labels' => array(
					'name' => 'News Category',
					'singular_name' => 'News Category',
			),
			'public' => true,
			'hierarchical' => true,
	);

	register_taxonomy('news_cat', array('news'),$args);

}

add_action('init', 'my_taxonomy');

//custom post type mobile
function my_mobile_post_type() { 
	$args = array(
			'labels' => array(
					'name' => 'Mobile',
					'singular_name' => 'Mobiles',
					'add_new' => 'Add New Mobile',
					'add_new_item' => 'Add New Mobile',
					'edit_item' => 'Edit Mobile',
					'new_item' => 'New Mobile',
					'all_items' => 'All Mobile',
					'view_item' => 'View Mobile',
					'search_items' => 'Search Mobile',
					'not_found' =>  'No Mobile Found',
					'not_found_in_trash' => 'No Mobile found in Trash', 
					'parent_item_colon' => '',
					'menu_name' => 'Mobile',
			),
			'public' => true,
			'has_archive' => true,
			'menu_icon' => 'dashicons-button',
			'supports' => array('title','editor','custom-fields'),
			'capability_type' => 'post',
	);
	register_post_type('mobile', $args);
}
function mobile_taxonomy() {
	$args = array(
			'labels' => array(
					'name' => 'Mobile Category',
					'singular_name' => 'Mobile Category',
			),
			'public' => true,
			'hierarchical' => true,
	);

	register_taxonomy('mobile_cat', array('mobile'),$args);

}

add_action('init', 'mobile_taxonomy');

add_action('init', 'my_mobile_post_type');

/*
customizer api

 */
function news_customize_register( $wp_customize) {

	$wp_customize->add_panel('header_footer_settings', array(
		'title' => 'Header And Footer',
		'description' => '',
		'priority' => 10,
	));

	$wp_customize->add_section('header_footer_settings', array(
		'title' => 'Website',
		'panel' => 'header_footer_settings',
	));
	$wp_customize->add_setting( 'theme_logo' );
	$wp_customize->add_control( 
			new WP_Customize_Image_Control(
					$wp_customize,'theme_logo',array(
							'label' => 'Logo',
							'section' => 'header_footer_settings',
							'settings' => 'theme_logo',
							'priority' => 1
					)
			)
	);
	$wp_customize->add_setting( 'copyright_text', array(
		'default' => '',
	) );

	$wp_customize->add_control('copyright_text',array(
							'label' => 'Copyright Text',
							'section' => 'header_footer_settings',
							'priority' => 2
					)
	);
}
add_action('customize_register', 'news_customize_register');


//custom sports type

//custom post type
function sport_post_type() { 
	$args = array(
			'labels' => array(
					'name' => 'Sport',
					'singular_name' => 'Sports',
					'add_new' => 'Add New Sport News',
					'add_new_item' => 'Add New Sport News',
					'edit_item' => 'Edit Sport News',
					'new_item' => 'New Sport',
					'all_items' => 'All Sport',
					'view_item' => 'View Sport',
					'search_items' => 'Search Sport',
					'not_found' =>  'No Sport Found',
					'not_found_in_trash' => 'No Sport found in Trash', 
					'parent_item_colon' => '',
					'menu_name' => 'Sport',
			),
			'public' => true,
			'has_archive' => true,
			'menu_icon' => 'dashicons-admin-site-alt3',
			'supports' => array('title','editor','thumbnail','custom-fields','excerpt'),
			'capability_type' => 'post',
	);
	register_post_type('sport', $args);
}

add_action('init', 'sport_post_type');

//custom taxonomy news category
function sport_taxonomy() {
$args = array(
		'labels' => array(
				'name' => 'Sport Category',
				'singular_name' => 'Sports Category',
		),
		'public' => true,
		'hierarchical' => true,
);

register_taxonomy('sport_cat', array('sport'),$args);

}

add_action('init', 'sport_taxonomy');




//excerpt length
function custom_excerpt_length( $length ) {
	return 15;
}
add_filter( 'excerpt_length', 'custom_excerpt_length',999 );

/*[...] to Read
function excerpt_read($more) {
	global $post;
	return ' <a href="'. get_permalink($post->ID) . '">Read more</a>';
}
add_filter( 'excerpt_more', 'excerpt_read' );
*/
add_filter("the_content", "content_filter");

function content_filter($content) {
  return substr($content, 0, 300);
}

add_filter('get_the_excerpt',function($excerpt, $post){
	if (has_excerpt()) {
		$excerpt_length = apply_filters('excerpt_length',16);
		$excerpt = wp_trim_words($excerpt,$excerpt_length);
	}
	return $excerpt;

},10,2)
?>
