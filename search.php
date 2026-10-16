<?php
/**
 * Search results
 *
 * @package CKDI
 */

get_header();
?>

<section class="section">
	<div class="section-inner">
		<div class="section-header reveal">
			<div class="section-label"><?php esc_html_e( 'Hasil Pencarian', 'ckdi' ); ?></div>
			<h2 class="section-title">"<?php echo esc_html( get_search_query() ); ?>"</h2>
			<div class="ckdi-searchform-wrap">
				<?php get_search_form(); ?>
			</div>
		</div>

		<?php if ( have_posts() ) : ?>
			<div class="services-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article <?php post_class( 'service-card reveal' ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="service-card-image">
								<?php the_post_thumbnail( 'ckdi-card' ); ?>
							</div>
						<?php endif; ?>
						<div class="service-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
						<div class="service-detail"><?php echo esc_html( get_the_excerpt() ); ?></div>
					</article>
					<?php
				endwhile;
				?>
			</div>

			<div class="nav-links">
				<?php the_posts_pagination( array( 'mid_size' => 2, 'prev_text' => '←', 'next_text' => '→' ) ); ?>
			</div>
		<?php else : ?>
			<div class="section-header">
				<p class="section-subtitle"><?php esc_html_e( 'Tidak ada hasil. Coba kata kunci lain.', 'ckdi' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
