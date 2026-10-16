<?php
/**
 * Archive template
 *
 * @package CKDI
 */

get_header();
?>

<section class="section">
	<div class="section-inner">
		<div class="section-header reveal">
			<div class="section-label"><?php esc_html_e( 'Arsip', 'ckdi' ); ?></div>
			<?php the_archive_title( '<h2 class="section-title">', '</h2>' ); ?>
			<?php the_archive_description( '<p class="section-subtitle">', '</p>' ); ?>
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
						<span class="service-tag"><?php echo esc_html( get_the_date() ); ?></span>
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
				<p class="section-subtitle"><?php esc_html_e( 'Belum ada konten di arsip ini.', 'ckdi' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
