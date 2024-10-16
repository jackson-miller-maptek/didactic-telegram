<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Maptek_Labs
 */

get_header();
?>

<main id="primary" class="site-main">

	<section class="error-404 not-found">
		<div class="container">
			<div class="row">
				<div class="col-md-10 mx-auto">
					<header class="page-header">
						<h1 class="page-title text-center"><?php esc_html_e('404 - Not found', 'maptek-labs'); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
						<p class="text-center"><?php esc_html_e('It looks like nothing was found at this location. Have a browser of our current experiments.', 'maptek-labs'); ?></p>

						<hr>

						<?php
						// Get front page ID
						$frontpage_id = get_option('page_on_front');

						if (!empty($frontpage_id)) {
							// Get front page posts
							$front_page_posts 	= get_field('front-page-posts', $frontpage_id);
						}
						?>

						<?php if (!empty($front_page_posts)) : ?>
							<h2 class="text-center mt-5">See our experiments</h2>
							<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
								<?php foreach ($front_page_posts as $fp_post) : ?>
									<?php if ($fp_post->post_status === "publish" ) : ?>
										<?php
										$fp_post_ID = $fp_post->ID;
										?>
										<div class="col">
											<div class="card h-100 mb-0 text-center shadow-sm">
												<div class="ratio ratio-21x9 card-img-top labs-tile-img" style="background: center / cover no-repeat url('<?php echo get_the_post_thumbnail_url($fp_post_ID); ?>')"></div>
												<div class="card-body">
													<h3 class="card-title mt-0">
														<?php echo $fp_post->post_title; ?>
													</h3>
													<!-- <p class="card-text">
											<?php echo $fp_post->post_excerpt; ?>
										</p> -->
												</div>
												<div class="card-footer">
													<a href="<?php echo get_permalink($fp_post_ID); ?>" class="btn btn-primary btn-sm stretched-link">Read more</a>
												</div>
											</div>
										</div>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

					</div>
				</div>
			</div>
		</div><!-- .page-content -->
	</section><!-- .error-404 -->

</main><!-- #main -->

<?php
get_footer();
