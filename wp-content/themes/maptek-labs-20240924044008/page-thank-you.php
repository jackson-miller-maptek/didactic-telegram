<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Maptek_Labs
 */

get_header();
?>

<main id="primary" class="site-main standard-page-main">

	<div class="container-fluid panelgrey mt-0 pt-4 pb-3">
		<div class="container">
			<div class="row">
				<div class="col-md-10 mx-auto">
					<?php
					while (have_posts()) :
						the_post();
						get_template_part('template-parts/content', 'page');
						// If comments are open or we have at least one comment, load up the comment template.
						if (comments_open() || get_comments_number()) :
							comments_template();
						endif;
					endwhile; // End of the loop.
					?>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-10 mx-auto">

				<?php
				// Get front page ID
				$frontpage_id = get_option('page_on_front');

				if (!empty($frontpage_id)) {
					// Get front page posts
					$front_page_posts 	= get_field('front-page-posts', $frontpage_id);
				}
				?>

				<?php if (!empty($front_page_posts)) : ?>
					<h2 class="h3 text-center mt-5">See our other experiments</h2>
					<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 gy-3 gx-3 gx-lg-4">
						<?php foreach ($front_page_posts as $fp_post) : ?>
							<?php if ($fp_post->post_status === "publish" && $fp_post->ID !== get_the_ID()) : ?>
								<?php
								$fp_post_ID = $fp_post->ID;
								?>
								<div class="col">
									<div class="card h-100 shadow-sm hover-rise">
										<div class="row h-100 gx-3">
											<div class="col-4">
												<div class="labs-related-img h-100" style="background: center / cover no-repeat url('<?php echo get_the_post_thumbnail_url($fp_post_ID); ?>')"></div>
											</div>
											<div class="col-8">
												<div class="d-flex align-items-center h-100 pe-2">
													<h3 class="h4 card-title mt-0 mb-1 py-2">
														<a href="<?php echo get_permalink($fp_post_ID); ?>" class="stretched-link" style="color:#666">
															<?php echo $fp_post->post_title; ?>
														</a>
													</h3>
												</div>
											</div>
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

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
