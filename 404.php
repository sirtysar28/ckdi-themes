<?php
/**
 * 404 template
 *
 * @package CKDI
 */

get_header();
?>

<section class="section">
	<div class="section-inner">
		<div class="section-header reveal">
			<div class="section-label"><?php esc_html_e( 'Error 404', 'ckdi' ); ?></div>
			<h2 class="section-title" style="font-size:clamp(2.5rem,6vw,4.5rem);">404</h2>
			<p class="section-subtitle"><?php esc_html_e( 'Halaman yang Anda cari tidak ditemukan atau sudah dipindahkan.', 'ckdi' ); ?></p>
			<div style="display:flex;gap:1rem;justify-content:center;margin-top:2rem;flex-wrap:wrap;">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary">← <?php esc_html_e( 'Kembali ke Beranda', 'ckdi' ); ?></a>
				<a href="<?php echo esc_url( ckdi_wa_link() ); ?>" class="btn-outline" target="_blank" rel="noopener"><?php esc_html_e( 'Hubungi Kami', 'ckdi' ); ?></a>
			</div>
			<div class="ckdi-searchform-wrap" style="margin-top:2rem;">
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
