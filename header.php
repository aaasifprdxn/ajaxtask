<?php
/**
 * header
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php wp_head(); ?>
		<title>my theme</title>
</head>
<body>
	<div class="wrapper"> 
	<div>

			
			<?php if( get_theme_mod( 'theme_logo' ) != '') { ?>
				<div  class="website-logo"> 
				<figure>
    		<img src="<?php echo get_theme_mod('theme_logo'); ?>">
				</figure>
				</div>
			<?php } ?>
				<nav>
<?php
			wp_nav_menu(
				array(
					'theme_location'=>'top-menu',
				)
			);
		?>
	</nav>
		</div>
