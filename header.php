<?php
/**
 * Header — Navbar (fixed, blur, dark/light logo, menu WP, toggle theme, CTA WA)
 *
 * @package CKDI
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="https://gmpg.org/xfn/11">
<script>
/* Set tema sebelum CSS render supaya tidak flash */
(function(){try{document.documentElement.setAttribute('data-theme',localStorage.getItem('ckdi-theme')||'dark');}catch(e){document.documentElement.setAttribute('data-theme','dark');}})();
</script>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#ckdi-main"><?php esc_html_e( 'Lewati ke konten', 'ckdi' ); ?></a>

<!-- ========================================
     ANIMATED BACKGROUND
     ======================================== -->
<div class="bg-animated" aria-hidden="true">
	<div class="orb orb-1"></div>
	<div class="orb orb-2"></div>
	<div class="orb orb-3"></div>
</div>

<!-- CUSTOM CURSOR -->
<div class="cursor-dot" id="cursorDot" aria-hidden="true"></div>
<div class="cursor-ring" id="cursorRing" aria-hidden="true"></div>

<!-- ========================================
     NAVBAR
     ======================================== -->
<nav class="navbar" id="navbar">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
		<?php
		$logo_dark  = ckdi_opt( 'logo_dark' ) ? ckdi_opt( 'logo_dark' ) : CKDI_URI . '/assets/img/Logo_CKDI_putih.png';
		$logo_light = ckdi_opt( 'logo_light' ) ? ckdi_opt( 'logo_light' ) : CKDI_URI . '/assets/img/Logo_CKDI_hitam.png';
		?>
		<img src="<?php echo esc_url( $logo_dark ); ?>" class="logo-dark" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
		<img src="<?php echo esc_url( $logo_light ); ?>" class="logo-light" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
	</a>

	<?php
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => false,
			'menu_class'     => 'nav-links',
			'menu_id'        => 'navLinks',
			'depth'          => 2,
		) );
	} else {
		ckdi_nav_fallback();
	}
	?>

	<div class="nav-actions">
		<button class="btn-theme" id="themeToggle" title="<?php esc_attr_e( 'Ganti Tema', 'ckdi' ); ?>" aria-label="<?php esc_attr_e( 'Ganti Tema', 'ckdi' ); ?>">
			<span id="themeIcon">🌙</span>
		</button>
		<a href="<?php echo esc_url( ckdi_wa_link() ); ?>" class="btn-cta-nav" target="_blank" rel="noopener"><?php esc_html_e( 'Hubungi Kami', 'ckdi' ); ?></a>
		<button class="hamburger" id="menuToggle" aria-label="<?php esc_attr_e( 'Menu', 'ckdi' ); ?>" aria-expanded="false">
			<span></span><span></span><span></span>
		</button>
	</div>
</nav>

<main id="ckdi-main" class="site-main">
