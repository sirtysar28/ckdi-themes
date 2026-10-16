<?php
/**
 * Main template — daftar blog
 *
 * @package CKDI
 */

get_header();

/* Homepage dalam mode "Your latest posts" (belum ada page statis yang VALID)
   → render landing page langsung supaya homepage tidak pernah kosong.
   Catatan: cek show_on_front, karena page_on_front bisa saja masih menyimpan
   ID lama walau setting sudah dikembalikan ke mode posts. */
if ( is_front_page() && ! ( 'page' === get_option( 'show_on_front' ) && (int) get_option( 'page_on_front' ) > 0 ) ) {
	ckdi_landing_fallback();
	get_footer();
	return;
}
?>

<section class="section">
	<div class="section-inner">
		<div class="section-header reveal">
			<div class="section-label"><?php esc_html_e( 'Blog', 'ckdi' ); ?></div>
			<h2 class="section-title"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h2>
			<p class="section-subtitle"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
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
				<?php
				the_posts_pagination( array(
					'mid_size'  => 2,
					'prev_text' => '←',
					'next_text' => '→',
				) );
				?>
			</div>
		<?php else : ?>
			<div class="section-header">
				<p class="section-subtitle"><?php esc_html_e( 'Belum ada konten.', 'ckdi' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
