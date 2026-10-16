<?php
/**
 * Page template — mendukung Elementor penuh (tanpa wrapper padding),
 * halaman biasa diberi padding konten.
 *
 * Fallback berlapis — homepage tidak pernah kosong:
 * 1. Halaman belum dibangun Elementor & belum ada konten → render landing page.
 * 2. Halaman Elementor tapi hasil render-nya kosong (mis. widget theme tidak
 *    teregistrasi oleh versi Elementor tertentu) → render landing page.
 *
 * @package CKDI
 */

get_header();

while ( have_posts() ) :
	the_post();

	$is_elementor = ckdi_is_elementor( get_the_ID() );
	$has_content  = '' !== trim( (string) get_post_field( 'post_content', get_the_ID() ) );

	// Fallback stage 1: halaman belum dibangun Elementor & belum ada konten
	// → render landing page langsung dari theme.
	$use_fallback  = ! $is_elementor && ! $has_content;
	$wrapper_class = ( $is_elementor || $use_fallback ) ? 'ckdi-el-page' : 'ckdi-page-pad';
	?>
	<div id="page-<?php the_ID(); ?>" <?php post_class( $wrapper_class ); ?>>
		<?php
		if ( $use_fallback ) :

			ckdi_landing_fallback( get_the_ID() );

		else :

			if ( ! $is_elementor ) :
				?>
				<h1 class="section-title" style="margin-bottom:2rem;"><?php the_title(); ?></h1>
				<?php
			endif;

			ob_start();
			the_content();
			wp_link_pages( array(
				'before' => '<div class="nav-links">',
				'after'  => '</div>',
			) );
			$rendered = ob_get_clean();

			// Fallback stage 2: hasil render kosong (widget Elementor tidak
			// dikenal / tidak dirender) → tampilkan landing page dari theme.
			if ( '' === trim( wp_strip_all_tags( $rendered ) ) && ckdi_landing_fallback( get_the_ID() ) ) {
				// Fallback berhasil dirender — tidak perlu echo $rendered.
			} else {
				echo $rendered; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

		endif;
		?>
	</div>
	<?php
	if ( ! $use_fallback && ! $is_elementor && ( comments_open() || get_comments_number() ) ) {
		echo '<div class="ckdi-page-pad" style="padding-top:0">';
		comments_template();
		echo '</div>';
	}
endwhile;

get_footer();
