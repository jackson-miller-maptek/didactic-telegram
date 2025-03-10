<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Maptek_Labs
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Google Tag Manager -->
	<script>
		(function (w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start': new Date().getTime(),
				event: 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src =
				'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-THGH3FD');
	</script>
	<!-- End Google Tag Manager -->
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://use.typekit.net/kkb1mca.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-THGH3FD" height="0" width="0"
			style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary">
			<?php esc_html_e('Skip to content', 'maptek-labs'); ?>
		</a>
		<header class="sticky-top custom-header">
			<div class="custom-header-inner">
				<div class="container">
					<a href="/" class="brand custom-brand">
						<img alt="Maptek Labs" src="<?php echo get_template_directory_uri(); ?>/images/maptek_labs.svg"
							class="shadow-sm custom-image">
					</a>
				</div>
			</div>
		</header>
		<nav class="custom-nav">
			<div class="container w-100">
				<div class="">
					<div class="d-md-block d-flex align-items-center">
						<div class="b-crumb crumb-spacing text-white small pt-md-2 pb-md-1 pb-lg-0 mt-2 mt-md-0">
							<?php simple_breadcrumbs() ?>
						</div>
					</div>
				</div>
			</div>
		</nav>