<?php
/**
 * Footer — widget areas (footer-1/2/3), copyright + socials,
 * Service Modal, tombol WhatsApp, dan Chatbot AI.
 *
 * @package CKDI
 */
?>
</main><!-- #ckdi-main -->

<!-- ========================================
     FOOTER — dikelola via Widgets & Menus
     ======================================== -->
<footer class="footer">
	<div class="footer-inner">
		<div class="footer-grid">
			<div class="footer-col-brand">
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<?php dynamic_sidebar( 'footer-1' ); ?>
				<?php else : ?>
					<div class="footer-brand">
						<?php
						$logo_dark  = ckdi_opt( 'logo_dark' ) ? ckdi_opt( 'logo_dark' ) : CKDI_URI . '/assets/img/Logo_CKDI_putih.png';
						$logo_light = ckdi_opt( 'logo_light' ) ? ckdi_opt( 'logo_light' ) : CKDI_URI . '/assets/img/Logo_CKDI_hitam.png';
						?>
						<img src="<?php echo esc_url( $logo_dark ); ?>" class="logo-dark" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
						<img src="<?php echo esc_url( $logo_light ); ?>" class="logo-light" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
						<p><?php echo esc_html( get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : 'Cipta Karya Digital Indonesia — mitra transformasi digital terpercaya.' ); ?></p>
					</div>
				<?php endif; ?>
			</div>

			<div class="footer-col">
				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
					<?php dynamic_sidebar( 'footer-2' ); ?>
				<?php elseif ( has_nav_menu( 'footer_layanan' ) ) : ?>
					<h4 class="footer-col-title"><?php esc_html_e( 'Layanan', 'ckdi' ); ?></h4>
					<?php wp_nav_menu( array( 'theme_location' => 'footer_layanan', 'container' => false, 'depth' => 1, 'fallback_cb' => false ) ); ?>
				<?php endif; ?>
			</div>

			<div class="footer-col">
				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
					<?php dynamic_sidebar( 'footer-3' ); ?>
				<?php elseif ( has_nav_menu( 'footer_kontak' ) ) : ?>
					<h4 class="footer-col-title"><?php esc_html_e( 'Kontak', 'ckdi' ); ?></h4>
					<?php wp_nav_menu( array( 'theme_location' => 'footer_kontak', 'container' => false, 'depth' => 1, 'fallback_cb' => false ) ); ?>
				<?php endif; ?>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="footer-copy"><?php echo esc_html( ckdi_opt( 'footer_copy' ) ); ?></div>
			<div class="footer-socials">
				<?php
				$socials = array(
					'social_facebook'  => array( '📘', 'Facebook', 'https://facebook.com' ),
					'social_instagram' => array( '📸', 'Instagram', 'https://instagram.com' ),
					'social_linkedin'  => array( '💼', 'LinkedIn', 'https://linkedin.com' ),
					'social_twitter'   => array( '🐦', 'X / Twitter', 'https://x.com' ),
					'social_tiktok'    => array( '🎵', 'TikTok', 'https://tiktok.com' ),
					'social_youtube'   => array( '▶️', 'YouTube', 'https://youtube.com' ),
				);
				foreach ( $socials as $key => $soc ) {
					$url = ckdi_opt( $key );
					if ( $url ) :
						?>
						<a href="<?php echo esc_url( $url ); ?>" class="social-link" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( $soc[1] ); ?>" title="<?php echo esc_attr( $soc[1] ); ?>"><?php echo esc_html( $soc[0] ); ?></a>
						<?php
					endif;
				}
				?>
			</div>
		</div>
	</div>
</footer>

<!-- SERVICE MODAL (global — dipicu dari widget CKDI Services) -->
<div class="service-modal-overlay" id="serviceModal">
	<div class="service-modal">
		<button class="service-modal-close" data-close-modal aria-label="<?php esc_attr_e( 'Tutup', 'ckdi' ); ?>">✕</button>
		<img class="service-modal-image" id="modalImage" src="" alt="">
		<div class="service-modal-content">
			<h3 class="service-modal-title" id="modalTitle"></h3>
			<p class="service-modal-desc" id="modalDesc"></p>
			<ul class="service-modal-features" id="modalFeatures"></ul>
			<div class="service-modal-actions">
				<a href="<?php echo esc_url( ckdi_wa_link( 'Halo CKDI, saya ingin konsultasi layanan' ) ); ?>" class="service-modal-btn service-modal-btn-primary" target="_blank" rel="noopener">
					<?php echo ckdi_wa_svg( '#fff', 18 ); // phpcs:ignore ?>
					<?php esc_html_e( 'Hubungi via WhatsApp', 'ckdi' ); ?>
				</a>
				<button class="service-modal-btn service-modal-btn-outline" data-close-modal><?php esc_html_e( 'Tutup', 'ckdi' ); ?></button>
			</div>
		</div>
	</div>
</div>

<?php if ( ckdi_opt( 'show_wa' ) ) : ?>
<!-- WHATSAPP FLOAT -->
<a href="<?php echo esc_url( ckdi_wa_link() ); ?>" class="wa-btn" target="_blank" rel="noopener" title="Chat WhatsApp" aria-label="Chat WhatsApp">
	<?php echo ckdi_wa_svg( 'white', 26 ); // phpcs:ignore ?>
</a>
<?php endif; ?>

<?php if ( ckdi_opt( 'chat_enabled' ) ) : ?>
<!-- CHATBOT -->
<button class="chatbot-trigger" id="chatTrigger" aria-label="<?php esc_attr_e( 'Buka Chat AI', 'ckdi' ); ?>">🤖</button>
<div class="chatbot-panel" id="chatPanel">
	<div class="chatbot-header">
		<div class="chatbot-avatar">🤖</div>
		<div>
			<div class="chatbot-header-title">CKDI Assistant</div>
			<div class="chatbot-header-sub"><?php echo esc_html( ckdi_opt( 'chat_header_sub' ) ); ?></div>
		</div>
		<button class="chatbot-close" data-chat-toggle aria-label="<?php esc_attr_e( 'Tutup chat', 'ckdi' ); ?>">✕</button>
	</div>
	<div class="chatbot-body" id="chatBody">
		<div class="chatbot-bubble bot"><?php echo wp_kses( ckdi_opt( 'chat_welcome' ), array( 'br' => array(), 'a' => array( 'href' => array(), 'target' => array() ) ) ); ?></div>
	</div>
	<div class="chatbot-footer">
		<input class="chatbot-input" id="chatInput" placeholder="<?php esc_attr_e( 'Ketik pesan...', 'ckdi' ); ?>" aria-label="<?php esc_attr_e( 'Pesan', 'ckdi' ); ?>">
		<button class="chatbot-send" id="chatSend" aria-label="<?php esc_attr_e( 'Kirim', 'ckdi' ); ?>">➤</button>
	</div>
</div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
