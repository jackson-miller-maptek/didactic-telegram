<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Maptek_Labs
 */


// Get custom fields
$mining_stages = get_field('mining_stage');
$status = get_field('status');
$cta_link = get_field('cta_link');
$updated_date = get_field('updated_date');
$masthead_image = get_field('masthead_image');

$enable_contact_form = get_field('enable_contact_form');
$campaign_id = get_field('contact_form_campaign_id');
$product_interest = get_field('contact_form_product_interest');
$redirect_product = get_field('redirect_product');
$redirect_link = get_field('redirect_link');
$redirect_text = get_field('redirect_text');

?>
<div class="container">
	<div class="row justify-content-center mt-4">
		<div class="col-lg-12">
			<img src="<?php echo $masthead_image; ?>" class="img-fluid rounded mb-4 shadow-sm"
				alt="<?php echo get_the_title(); ?>" style="min-height:150px; object-fit: cover;">
			<div class="row">
				<div class="col-lg-9 pe-lg-3">
					<div style="border-left: 4px solid #4d9d37;" class="ps-3">
						<?php
						if (is_singular()):
							the_title('<h1 class="entry-title mt-0 display-4 fw-lighter mb-0 text-dark">', '</h1>'); ?>
							<?php if (!empty(get_the_excerpt())): ?>
								<p class="lead mb-lg-4 mt-1">
									<?php echo get_the_excerpt() ?>
								</p>
							<?php endif; ?>
							<?php
						else:
							the_title('<h2 class="entry-title mt-0"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
						endif;
						?>
					</div>

					<div class="d-lg-none mb-3">
						<?php if (!(empty($mining_stages) && empty($status) && empty($cta_link) && empty($updated_date))): ?>
							<aside style="position: sticky; top: 90px" class="p-4 bg-white shadow-sm">
								<div class="small w-100 uppercase"
									style="border-bottom: 1px solid #e6e6e6; margin-bottom: 1rem;">KEY DETAILS
								</div>
								<?php if (!empty($status)): ?>
									<div class="d-flex flex-start mb-3 align-items-center gap-2">
										<p class="text-dark mb-0"><strong>Status:</strong></p>
										<span class="<?php echo strtolower($status); ?>_badge">
											<?php echo $status; ?>
										</span>
									</div>
								<?php endif; ?>
								<?php if (!empty($mining_stages)): ?>
									<div class="d-flex flex-start mb-3 align-items-center gap-2">
										<p class="text-dark mb-0">
											<strong>Stage:</strong>
										</p>
										<p class="mb-0">
											<?php echo implode(", ", $mining_stages) ?>
										</p>
									</div>

								<?php endif; ?>



								<?php if (!empty($updated_date)): ?>
									<div class="d-flex flex-start mb-3 align-items-center gap-2">
										<p class="text-dark mb-0">
											<strong>Updated:</strong>
										</p>
										<p class="mb-0">
											<?php echo $updated_date; ?>
										</p>
									</div>
								<?php endif; ?>

								<?php if (!empty($cta_link)): ?>
									<a class="btn btn-primary" href="<?php echo $cta_link['url']; ?>"
										target="<?php echo $cta_link['target']; ?>">
										<?php echo $cta_link['title']; ?>
									</a>
								<?php endif; ?>

								<?php if ($enable_contact_form && !empty($campaign_id)): ?>
									<button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal"
										data-bs-target="#contactModal">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="16px"
											style="vertical-align:inherit; margin-top:-4px"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
											<path fill="#ffffff"
												d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
										</svg> Contact Maptek
									</button>
								<?php endif; ?>
								<?php if ($redirect_product && !empty($redirect_link) && !empty($redirect_text)): ?>
									<a class="btn btn-primary btn-block" href="<?= $redirect_link ?>">
										<?= $redirect_text ?>
									</a>
								<?php endif; ?>
							</aside>
						<?php endif; ?>
					</div>
					<?php
					the_content(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'maptek-labs'),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							wp_kses_post(get_the_title())
						)
					);
					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__('Pages:', 'maptek-labs'),
							'after' => '</div>',
						)
					);
					?>
				</div>
				<div class="col-lg-3 d-none d-lg-block mt-lg-2 pb-3">
					<?php if (!(empty($mining_stages) && empty($status) && empty($cta_link) && empty($updated_date))): ?>
						<aside style="position: sticky; top: 90px" class="p-4 bg-white shadow-sm rounded">
							<div class="small w-100 uppercase"
								style="border-bottom: 1px solid #e6e6e6; margin-bottom: 1rem;">KEY DETAILS
							</div>
							<?php if (!empty($status)): ?>
								<div class="d-flex flex-start mb-3 align-items-center gap-2">
									<p class="text-dark mb-0"><strong>Status:</strong></p>
									<span class="<?php echo strtolower($status); ?>_badge">
										<?php echo $status; ?>
									</span>
								</div>
							<?php endif; ?>
							<?php if (!empty($mining_stages)): ?>
								<div class="d-flex flex-start mb-3 align-items-center gap-2">
									<p class="text-dark mb-0">
										<strong>Stage:</strong>
									</p>
									<p class="mb-0">
										<?php echo implode(", ", $mining_stages) ?>
									</p>
								</div>

							<?php endif; ?>



							<?php if (!empty($updated_date)): ?>
								<div class="d-flex flex-start mb-3 align-items-center gap-2">
									<p class="text-dark mb-0">
										<strong>Updated:</strong>
									</p>
									<p class="mb-0">
										<?php echo $updated_date; ?>
									</p>
								</div>
							<?php endif; ?>

							<?php if (!empty($cta_link)): ?>
								<a class="btn btn-primary btn-block" href="<?php echo $cta_link['url']; ?>"
									target="<?php echo $cta_link['target']; ?>">
									<?php echo $cta_link['title']; ?>
								</a>
							<?php endif; ?>

							<?php if ($enable_contact_form && !empty($campaign_id) && !$redirect_link): ?>
								<button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal"
									data-bs-target="#contactModal">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="17px"
										style="vertical-align:inherit; margin-top:-4px"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
										<path fill="#ffffff"
											d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
									</svg> Contact Maptek
								</button>
							<?php endif; ?>
							<?php if ($redirect_product && !empty($redirect_link) && !empty($redirect_text)): ?>
									<a class="btn btn-primary btn-block" href="<?= $redirect_link ?>">
										<?= $redirect_text ?>
									</a>
								<?php endif; ?>

						</aside>
					<?php endif; ?>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<?php
					// Get front page ID
					$frontpage_id = get_option('page_on_front');

					if (!empty($frontpage_id)) {
						// Get front page posts
						$front_page_posts = get_field('front-page-posts', $frontpage_id);
					}
					?>
					<?php if (!empty($front_page_posts)): ?>
						<hr class="mt-5" style="border-top:1px solid #e6e6e6">
						<div class="d-flex mb-4">

							<div class="d-none pt-4 me-3 align-items-start d-md-flex justify-content-end">
								<img alt="Maptek Labs."
									src="<?php echo get_template_directory_uri(); ?>/images/labs_logo.svg"
									class="d-none d-md-block" width="72px" height="72px">
							</div>
							<div class="col-md-11 col-12">
								<div class="d-flex gap-2 align-items-end mb-3 mb-md-0">
									<img alt="Maptek Labs."
										src="<?php echo get_template_directory_uri(); ?>/images/labs_logo.svg"
										class="d-md-none" width="48px" height="48px">
									<h3 class="text-dark mb-2 mb-md-default">Maptek Labs</h3>
								</div>

								<p>
									One of the Maptek guiding principles is Create Tomorrow through experimentation and
									innovation. Our labs pages expose new technologies in development to stimulate
									conversations and feedback from industry to ensure our solutions meet those needs.
								</p>
							</div>
						</div>

						<div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 g-4">
							<?php
							$count = 0; // Initialize counter
							foreach ($front_page_posts as $fp_post):
								if ($fp_post->post_status === "publish" && $fp_post->ID !== get_the_ID()):
									if ($count >= 3) { // Check if 3 cards have been displayed
										break; // Break the loop if 3 cards have been displayed
									}
									$fp_post_ID = $fp_post->ID;
									$status = get_field('status', $fp_post_ID);
									?>
									<div class="col">
										<div class="m-item-card h-100">
											<a href="<?php echo get_permalink($fp_post_ID); ?>" class="m-item-link"></a>
											<img src="<?php echo get_the_post_thumbnail_url($fp_post_ID); ?>">
											<div class="m-3">
												<h3 class="mb-0">
													<?php echo $fp_post->post_title; ?>
												</h3>
												<?php if (!empty($status)): ?>
													<span class="mb-1 mt-2 <?php echo strtolower($status); ?>_badge">
														<?php echo $status; ?>
													</span>
												<?php endif; ?>
												<div class="m-item-card-text">
													<p>
														<?php echo $fp_post->post_excerpt; ?>
													</p>
												</div>
											</div>
										</div>
									</div>
									<?php
									$count++; // Increment counter
								endif;
							endforeach;
							?>
						</div>
					<?php endif; ?>
				</div>
			</div>

		</div>
	</div>
</div>

<?php

// include get_template_directory_uri() . 'contact-form.php';
contact_form(get_the_title(), $campaign_id, $product_interest);

?>
</div><!-- .entry-footer -->