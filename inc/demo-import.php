<?php
/**
 * CKDI Demo Import
 *
 * Saat theme diaktifkan (dengan Elementor aktif), otomatis dibuat:
 * - Pages: Beranda, Layanan, Tentang Kami, Portofolio, Harga, Kontak (konten Elementor)
 * - Menu: Menu Utama (navbar) + menu footer
 * - Footer widgets: Brand (HTML) + Navigation Menu × 2
 * - Set Beranda sebagai homepage
 * - Import logo & gambar ke Media Library
 *
 * @package CKDI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ============================================================
   AUTO IMPORT saat theme diaktifkan
   ============================================================ */
add_action( 'after_switch_theme', function () {
	if ( class_exists( '\Elementor\Plugin' ) && ! get_option( 'ckdi_demo_imported' ) ) {
		ckdi_run_demo_import();
	}
} );

/* ============================================================
   AUTO IMPORT saat plugin Elementor diaktifkan BELAKANGAN
   (theme sudah aktif dulu → hook after_switch_theme tidak jalan)
   ============================================================ */
add_action( 'activated_plugin', function ( $plugin ) {
	if ( false !== stripos( $plugin, 'elementor' ) && ! get_option( 'ckdi_demo_imported' ) ) {
		ckdi_run_demo_import();
	}
} );

/* ============================================================
   SAFETY NET — Elementor aktif tapi demo belum pernah diimport
   (mis. plugin diunggah manual via FTP sehingga hook aktivasi tidak jalan)
   ============================================================ */
add_action( 'admin_init', function () {
	if (
		current_user_can( 'manage_options' )
		&& class_exists( '\Elementor\Plugin' )
		&& ! get_option( 'ckdi_demo_imported' )
	) {
		ckdi_run_demo_import();
	}
} );

/* ============================================================
   HELPER — kosongkan item menu (agar re-import tidak duplikat)
   ============================================================ */
function ckdi_clear_menu_items( $menu_id ) {
	if ( ! $menu_id ) {
		return;
	}
	$items = wp_get_nav_menu_items( $menu_id, array( 'post_status' => 'any', 'orderby' => 'none' ) );
	if ( $items ) {
		foreach ( $items as $item ) {
			wp_delete_post( $item->ID, true );
		}
	}
}

/* ============================================================
   ADMIN PAGE — tombol import manual (jika Elementor diaktifkan belakangan)
   ============================================================ */
add_action( 'admin_menu', function () {
	add_theme_page(
		__( 'CKDI Demo Import', 'ckdi' ),
		__( 'CKDI Demo Import', 'ckdi' ),
		'manage_options',
		'ckdi-demo',
		'ckdi_demo_page_html'
	);
} );

function ckdi_demo_page_html() {
	$imported = get_option( 'ckdi_demo_imported' );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'CKDI — Import Demo Landing Page', 'ckdi' ); ?></h1>
		<?php if ( ! class_exists( '\Elementor\Plugin' ) ) : ?>
			<div class="notice notice-error"><p>
				<strong><?php esc_html_e( 'Elementor belum aktif!', 'ckdi' ); ?></strong>
				<?php esc_html_e( 'Install & aktifkan plugin Elementor terlebih dahulu, lalu kembali ke halaman ini.', 'ckdi' ); ?>
			</p></div>
		<?php elseif ( $imported ) : ?>
			<div class="notice notice-success"><p><?php esc_html_e( 'Demo sudah diimport. Semua halaman dapat diedit via Pages → Edit with Elementor.', 'ckdi' ); ?></p></div>
		<?php endif; ?>

		<p><?php esc_html_e( 'Klik tombol di bawah untuk membuat otomatis: halaman Beranda (Elementor, sama persis dengan landing page), halaman Layanan, Tentang Kami, Portofolio, Harga, Kontak, menu navbar & footer, serta widget footer.', 'ckdi' ); ?></p>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="ckdi_import_demo">
			<?php wp_nonce_field( 'ckdi_import_demo' ); ?>
			<?php submit_button( __( 'Import Demo Sekarang', 'ckdi' ), 'primary large', 'submit', false, $imported ? array( 'onclick' => "return confirm('Import ulang? Halaman demo yang ada akan diperbarui.');" ) : array() ); ?>
		</form>
	</div>
	<?php
}

add_action( 'admin_post_ckdi_import_demo', function () {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Akses ditolak.' );
	}
	check_admin_referer( 'ckdi_import_demo' );

	if ( ! class_exists( '\Elementor\Plugin' ) ) {
		wp_safe_redirect( admin_url( 'themes.php?page=ckdi-demo' ) );
		exit;
	}

	ckdi_run_demo_import();
	set_transient( 'ckdi_import_notice', 1, 60 );
	wp_safe_redirect( admin_url( 'themes.php?page=ckdi-demo&imported=1' ) );
	exit;
} );

add_action( 'admin_notices', function () {
	if ( get_transient( 'ckdi_import_notice' ) ) {
		delete_transient( 'ckdi_import_notice' );
		echo '<div class="notice notice-success is-dismissible"><p><strong>CKDI:</strong> Demo berhasil diimport! Buka <a href="' . esc_url( admin_url( 'edit.php?post_type=page' ) ) . '">Pages</a> lalu "Edit with Elementor" untuk mengubah isi homepage.</p></div>';
	}
} );

/* ============================================================
   HELPER — import gambar lokal ke Media Library
   ============================================================ */
function ckdi_import_media( $file, $title ) {
	$path = CKDI_DIR . '/assets/img/' . $file;
	if ( ! file_exists( $path ) ) {
		return array( 'id' => 0, 'url' => CKDI_URI . '/assets/img/' . $file );
	}

	// Cek attachment yang sudah ada (biar tidak dobel saat re-import)
	$existing = get_posts( array(
		'post_type'   => 'attachment',
		'title'       => $title,
		'numberposts' => 1,
		'fields'      => 'ids',
	) );
	if ( $existing ) {
		return array( 'id' => $existing[0], 'url' => wp_get_attachment_url( $existing[0] ) );
	}

	$upload = wp_upload_bits( $file, null, file_get_contents( $path ) ); // phpcs:ignore
	if ( ! empty( $upload['error'] ) ) {
		return array( 'id' => 0, 'url' => CKDI_URI . '/assets/img/' . $file );
	}

	$filetype  = wp_check_filetype( $file, null );
	$attach_id = wp_insert_attachment( array(
		'post_mime_type' => $filetype['type'],
		'post_title'     => $title,
		'post_status'    => 'inherit',
	), $upload['file'] );

	require_once ABSPATH . 'wp-admin/includes/image.php';
	wp_update_attachment_metadata( $attach_id, wp_generate_attachment_metadata( $attach_id, $upload['file'] ) );

	return array( 'id' => $attach_id, 'url' => wp_get_attachment_url( $attach_id ) );
}

/* ============================================================
   HELPER — buat section Elementor (full width, tanpa padding)
   ============================================================ */
function ckdi_el_section( $widget_type, $settings = array() ) {
	$col_id  = substr( md5( uniqid( wp_rand(), true ) ), 0, 7 );
	$sec_id  = substr( md5( uniqid( wp_rand(), true ) ), 0, 7 );
	$wid_id  = substr( md5( uniqid( wp_rand(), true ) ), 0, 7 );

	return array(
		'id'       => $sec_id,
		'elType'   => 'section',
		'settings' => array(
			'layout'  => 'full_width',
			'gap'     => 'no',
			'padding' => array( 'unit' => 'px', 'top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0', 'isLinked' => true ),
		),
		'elements' => array(
			array(
				'id'       => $col_id,
				'elType'   => 'column',
				'settings' => array( '_column_size' => 100, '_inline_size' => null ),
				'elements' => array(
					array(
						'id'       => $wid_id,
						'elType'   => 'widget',
						'widgetType' => $widget_type,
						'settings' => $settings,
						'elements' => array(),
					),
				),
				'isInner'  => false,
			),
		),
		'isInner'  => false,
	);
}

/* ============================================================
   HELPER — buat/update page dengan data Elementor
   ============================================================ */
function ckdi_insert_elementor_page( $title, $slug, $elements ) {
	$existing = get_page_by_path( $slug );

	$postarr = array(
		'post_title'   => $title,
		'post_name'    => $slug,
		'post_status'  => 'publish',
		'post_type'    => 'page',
		'post_content' => '',
	);

	if ( $existing ) {
		$postarr['ID'] = $existing->ID;
		$page_id = wp_update_post( $postarr );
	} else {
		$page_id = wp_insert_post( $postarr );
	}

	if ( ! $page_id || is_wp_error( $page_id ) ) {
		return 0;
	}

	update_post_meta( $page_id, '_elementor_edit_mode', 'builder' );
	update_post_meta( $page_id, '_elementor_template_type', 'wp-page' );
	update_post_meta( $page_id, '_elementor_data', wp_slash( wp_json_encode( $elements ) ) );
	if ( defined( 'ELEMENTOR_VERSION' ) ) {
		update_post_meta( $page_id, '_elementor_version', ELEMENTOR_VERSION );
	}
	delete_post_meta( $page_id, '_elementor_css' );

	return $page_id;
}

/* ============================================================
   MAIN — jalankan import
   ============================================================ */
function ckdi_run_demo_import() {

	/* ---------- 1. Import gambar ke Media Library ---------- */
	$logo_putih = ckdi_import_media( 'Logo_CKDI_putih.png', 'Logo CKDI Putih' );
	$logo_hitam = ckdi_import_media( 'Logo_CKDI_hitam.png', 'Logo CKDI Hitam' );
	$thumb_hero = ckdi_import_media( 'Thumnail_2.png', 'CKDI Hero Thumbnail' );
	$thumb_why  = ckdi_import_media( 'thumnail_1.png', 'CKDI Why Us Thumbnail' );

	if ( $logo_putih['url'] ) {
		set_theme_mod( 'ckdi_logo_dark', $logo_putih['url'] );
	}
	if ( $logo_hitam['url'] ) {
		set_theme_mod( 'ckdi_logo_light', $logo_hitam['url'] );
	}

	$hero_img = array( 'url' => $thumb_hero['url'], 'id' => (string) $thumb_hero['id'], 'source' => 'library' );
	$why_img  = array( 'url' => $thumb_why['url'], 'id' => (string) $thumb_why['id'], 'source' => 'library' );

	/* ---------- 2. Buat pages ---------- */
	$home_id = ckdi_insert_elementor_page( 'Beranda', 'beranda', array(
		ckdi_el_section( 'ckdi_hero', array( 'image' => $hero_img ) ),
		ckdi_el_section( 'ckdi_services' ),
		ckdi_el_section( 'ckdi_why_us', array( 'image' => $why_img ) ),
		ckdi_el_section( 'ckdi_portfolio' ),
		ckdi_el_section( 'ckdi_pricing' ),
		ckdi_el_section( 'ckdi_contact' ),
	) );

	$layanan_id    = ckdi_insert_elementor_page( 'Layanan', 'layanan', array( ckdi_el_section( 'ckdi_services' ) ) );
	$tentang_id    = ckdi_insert_elementor_page( 'Tentang Kami', 'tentang-kami', array( ckdi_el_section( 'ckdi_why_us', array( 'image' => $why_img ) ) ) );
	$portofolio_id = ckdi_insert_elementor_page( 'Portofolio', 'portofolio', array( ckdi_el_section( 'ckdi_portfolio' ) ) );
	$harga_id      = ckdi_insert_elementor_page( 'Harga', 'harga', array( ckdi_el_section( 'ckdi_pricing' ) ) );
	$kontak_id     = ckdi_insert_elementor_page( 'Kontak', 'kontak', array( ckdi_el_section( 'ckdi_contact' ) ) );

	/* ---------- 3. Homepage statis ---------- */
	if ( $home_id ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_id );
		update_option( 'page_for_posts', 0 );
	}

	/* ---------- 4. Menu navbar ---------- */
	$menu_id = wp_create_nav_menu( 'Menu Utama' );
	if ( is_wp_error( $menu_id ) ) {
		// sudah ada → pakai yang ada
		$menus   = wp_get_nav_menus( array( 'slug' => 'menu-utama' ) );
		$menu_id = $menus ? $menus[0]->term_id : 0;
	} else {
		// bersihkan item lama (menu baru masih kosong, jadi tak perlu)
	}

	if ( $menu_id ) {
		ckdi_clear_menu_items( $menu_id );

		$nav_items = array(
			array( 'title' => 'Beranda',    'page' => $home_id ),
			array( 'title' => 'Layanan',    'page' => $layanan_id ),
			array( 'title' => 'Portofolio', 'page' => $portofolio_id ),
			array( 'title' => 'Harga',      'page' => $harga_id ),
			array( 'title' => 'Kontak',     'page' => $kontak_id ),
		);
		foreach ( $nav_items as $item ) {
			if ( $item['page'] ) {
				wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-title'     => $item['title'],
					'menu-item-object'    => 'page',
					'menu-item-object-id' => $item['page'],
					'menu-item-type'      => 'post_type',
					'menu-item-status'    => 'publish',
				) );
			}
		}
		set_theme_mod( 'nav_menu_locations', array(
			'primary' => $menu_id,
		) );
	}

	/* ---------- 5. Menu footer ---------- */
	$menu_layanan_id = wp_create_nav_menu( 'Footer — Layanan' );
	if ( is_wp_error( $menu_layanan_id ) ) {
		$menus           = wp_get_nav_menus( array( 'slug' => 'footer-layanan' ) );
		$menu_layanan_id = $menus ? $menus[0]->term_id : 0;
	}
	if ( $menu_layanan_id ) {
		ckdi_clear_menu_items( $menu_layanan_id );

		$layanan_links = array(
			'Web Development'   => $layanan_id ? get_permalink( $layanan_id ) . '#services' : '#services',
			'Mobile App'        => $layanan_id ? get_permalink( $layanan_id ) . '#services' : '#services',
			'UI/UX Design'      => $layanan_id ? get_permalink( $layanan_id ) . '#services' : '#services',
			'Digital Marketing' => $layanan_id ? get_permalink( $layanan_id ) . '#services' : '#services',
			'Solusi AI'         => $layanan_id ? get_permalink( $layanan_id ) . '#services' : '#services',
		);
		foreach ( $layanan_links as $title => $url ) {
			wp_update_nav_menu_item( $menu_layanan_id, 0, array(
				'menu-item-title'  => $title,
				'menu-item-url'    => $url,
				'menu-item-type'   => 'custom',
				'menu-item-status' => 'publish',
			) );
		}
	}

	$menu_kontak_id = wp_create_nav_menu( 'Footer — Kontak' );
	if ( is_wp_error( $menu_kontak_id ) ) {
		$menus          = wp_get_nav_menus( array( 'slug' => 'footer-kontak' ) );
		$menu_kontak_id = $menus ? $menus[0]->term_id : 0;
	}
	if ( $menu_kontak_id ) {
		ckdi_clear_menu_items( $menu_kontak_id );

		$kontak_links = array(
			'ciptakaryadigital.id' => array( ckdi_opt( 'website' ), true ),
			'info@ciptakaryadigital.id' => array( 'mailto:' . ckdi_opt( 'email' ), false ),
			'+62 812-4521-3848'    => array( 'https://wa.me/' . preg_replace( '/\D+/', '', ckdi_opt( 'wa_number' ) ), true ),
			'Tentang Kami'         => array( $tentang_id ? get_permalink( $tentang_id ) : '#about', false ),
			'Portofolio'           => array( $portofolio_id ? get_permalink( $portofolio_id ) : '#portfolio', false ),
		);
		foreach ( $kontak_links as $title => $link ) {
			wp_update_nav_menu_item( $menu_kontak_id, 0, array(
				'menu-item-title'  => $title,
				'menu-item-url'    => $link[0],
				'menu-item-type'   => 'custom',
				'menu-item-status' => 'publish',
			) );
		}
		set_theme_mod( 'nav_menu_locations', array(
			'primary'        => $menu_id,
			'footer_layanan' => $menu_layanan_id,
			'footer_kontak'  => $menu_kontak_id,
		) );
	}

	/* ---------- 6. Footer widgets ---------- */
	// Kolom 1: Custom HTML (brand)
	$custom_html = get_option( 'widget_custom_html', array() );
	$html_idx    = 2;
	foreach ( array_keys( $custom_html ) as $k ) {
		if ( is_int( $k ) && $k >= $html_idx ) {
			$html_idx = $k + 1;
		}
	}
	$brand_html = '<div class="footer-brand">'
		. '<img src="' . esc_url( $logo_putih['url'] ) . '" class="logo-dark" alt="CKDI">'
		. '<img src="' . esc_url( $logo_hitam['url'] ) . '" class="logo-light" alt="CKDI">'
		. '<p>Cipta Karya Digital Indonesia — mitra transformasi digital terpercaya. Kami membantu bisnis Anda tumbuh di era digital dengan solusi inovatif dan berteknologi tinggi.</p>'
		. '</div>';
	$custom_html[ $html_idx ] = array(
		'title'   => '',
		'content' => $brand_html,
	);
	update_option( 'widget_custom_html', $custom_html );

	// Kolom 2 & 3: Navigation Menu widget
	$nav_widget = get_option( 'widget_nav_menu', array() );
	$nav_idx    = 2;
	foreach ( array_keys( $nav_widget ) as $k ) {
		if ( is_int( $k ) && $k >= $nav_idx ) {
			$nav_idx = $k + 1;
		}
	}
	$nav_widget[ $nav_idx ] = array( 'title' => 'Layanan', 'nav_menu' => (int) $menu_layanan_id );
	$nav_widget[ $nav_idx + 1 ] = array( 'title' => 'Kontak', 'nav_menu' => (int) $menu_kontak_id );
	update_option( 'widget_nav_menu', $nav_widget );

	// Assign ke sidebar footer
	$sidebars            = get_option( 'sidebars_widgets', array() );
	$sidebars['footer-1'] = array( 'custom_html-' . $html_idx );
	$sidebars['footer-2'] = array( 'nav_menu-' . $nav_idx );
	$sidebars['footer-3'] = array( 'nav_menu-' . ( $nav_idx + 1 ) );
	update_option( 'sidebars_widgets', $sidebars );

	/* ---------- 7. Permalink ---------- */
	global $wp_rewrite;
	if ( ! get_option( 'permalink_structure' ) ) {
		$wp_rewrite->set_permalink_structure( '/%postname%/' );
		$wp_rewrite->flush_rules();
	}

	update_option( 'ckdi_demo_imported', time() );

	/* ---------- 8. Bersihkan cache CSS Elementor ---------- */
	if ( class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::$instance->files_manager ) ) {
		\Elementor\Plugin::$instance->files_manager->clear_cache();
	}
}
