<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Maptek_Labs
 */

get_header();

// Get ACF Fields
$subheading = get_field('front-page-subheading');
$front_page_posts = get_field('front-page-posts');
?>

<main id="primary" class="site-main">
	<section class="hero-section mb-5">
		<div class="overlay"></div>
		<div class="hero-media">
			<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Miners" class="img-fluid w-100">
		</div>
		<div class="hero-content container">
			<div class="hero-text-content animated">
				<h1 class="animate fadeInUp delay-title animated">
					<?php single_post_title(); ?>
				</h1>
				<div class="animate fadeIn delay-sub animated">
					<?php if (!empty($subheading)): ?>
						<p>
							<?php echo $subheading ?>
						</p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<div class="container">
		<!-- <header class="text-center py-5">
					<h1 class="page-title display-3 fw-lighter"><?php single_post_title(); ?></h1>
					<?php if (!empty($subheading)): ?>
						<h2><?php echo $subheading ?></h2>
					<?php endif; ?>
				</header> -->
		<?php if (!empty(get_the_content())): ?>
			<div class="row justify-content-center mb-4">
				<div class="col-lg-12 text-dark lead">
					<div>
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if (!empty($front_page_posts)): ?>
			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
				<?php foreach ($front_page_posts as $post): ?>
					<?php if ($post->post_status === "publish"): ?>
						<?php
						$ID = $post->ID;
						$status = get_field('status', $ID);
						?>
						<div class="col">
							<div class="m-item-card h-100">
								<a href="<?php echo get_permalink($ID); ?>" class="m-item-link"></a>
								<img src="<?php echo get_the_post_thumbnail_url($ID); ?>" alt="<?php echo $post->post_title; ?>">
								<div class="m-3">
									<h3 class="mb-0">
										<?php echo $post->post_title; ?>
									</h3>
									<?php if (!empty($status)): ?>
										<span class="mb-1 mt-2 <?php echo strtolower($status); ?>_badge">
											<?php echo $status; ?>
										</span>
									<?php endif; ?>
									<div class="m-item-card-text">
										<p>
											<?php echo $post->post_excerpt; ?>
										</p>
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>

			</div>

		<?php endif; ?>
	</div>

</main><!-- #main -->

<?php
get_footer();
