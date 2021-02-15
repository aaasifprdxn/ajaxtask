<?php
/*
 footer
 */
?>

<footer>
	<div class="footer-menu">
		<div class="footer-nav-menu">
			<h2>our pages</h2>
			<?php
			wp_nav_menu(
				array(
						'theme_location'=>'top-menu',
					)
				);
			?>
		</div>
		<div class="icon-social-link">
			<h3>social links</h3>
			<div class="social-link">
				<a href="#FIXME" title="facebook_logo"><span class="icon facebook"></span></a>
				<a href="#FIXME" title="instagram logo"><span class="icon instagram"></span></a>
				<a href="#FIXME" title="twitter logo"><span class="icon twitter"></span></a>
			</div>
		</div>
	</div>

<div>
	<div class="footer-logo-text">
		<?php if( get_theme_mod( 'theme_logo' ) != '') { ?>
				<div  class="website-logo-footer"> 
				<figure>
    		<img src="<?php echo get_theme_mod('theme_logo'); ?>">
				</figure>
				</div>
			<?php } ?>

	<div class="footer-copyright-text">
		<span><?php echo get_theme_mod('copyright_text'); ?></span>
	</div>
</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>