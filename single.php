<?php
/**
 * Single post
 *
 * @package CKDI
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<section class="section">
		<div class="section-inner">
			<article <?php post_class( 'ckdi-single reveal' ); ?>>
				<div class="section-label"><?php echo esc_html( get_the_date() ); ?> · <?php the_category( ', ' ); ?></div>
				<h1 class="section-title" style="text-align:left;margin-bottom:1.5rem;"><?php the_title(); ?></h1>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="service-card-image" style="height:340px;margin-bottom:2rem;border-radius:var(--radius-lg);">
						<?php the_post_thumbnail( 'large' ); ?>
					</div>
				<?php endif; ?>

				<div class="entry-content">
					<?php
					the_content();
					wp_link_pages( array(
						'before' => '<div class="nav-links">',
						'after'  => '</div>',
					) );
					?>
				</div>

				<?php if ( has_tag() ) : ?>
					<div class="pricing-features" style="margin-top:2rem;">
						<?php the_tags( '<li><span>', '</span></li><li><span>', '</span></li>' ); ?>
					</div>
				<?php endif; ?>
			</article>

			<div class="nav-links">
				<?php
				previous_post_link( '%link', '← %title' );
				next_post_link( '%link', '%title →' );
				?>
			</div>

			<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			?>
		</div>
	</section>
	<?php
endwhile;

get_footer();
