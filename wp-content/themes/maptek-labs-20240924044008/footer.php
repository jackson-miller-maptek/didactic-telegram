<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Maptek_Labs
 */

?>

</div><!-- #page -->
<div class="container">
	<p class="mt-5 small text-center" style="color:#999999">Technologies shown on Maptek Labs are subject to change, and
		Maptek
		makes no commitment that these technologies will be made commercially available.</p>
</div>

<footer id="colophon" class="site-footer footer">
	<div class="container">
		<div class="row d-flex align-items-center">
			<?php if (is_active_sidebar('footer-widgets')): ?>
				<?php dynamic_sidebar('footer-widgets'); ?>
			<?php endif; ?>
		</div>
	</div>
</footer><!-- #colophon -->

<?php wp_footer(); ?>
<script>
	const year = new Date().getFullYear();
	document.getElementById('year').textContent = year;
</script>

</body>

</html>