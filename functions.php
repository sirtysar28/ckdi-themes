<?php
/**
 * CKDI Theme — functions & definitions
 *
 * @package CKDI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CKDI_VERSION', '1.1.0' );
define( 'CKDI_DIR', get_template_directory() );
define( 'CKDI_URI', get_template_directory_uri() );

/* ============================================================
   DEFAULT OPTIONS
   ============================================================ */
function ckdi_defaults() {
	return array(
		'wa_number'       => '6281245213848',
		'wa_message'      => 'Halo CKDI, saya ingin konsultasi layanan digital',
		'email'           => 'info@ciptakaryadigital.id',
		'website'         => 'https://www.ciptakaryadigital.id',
		'location'        => 'Indonesia',
		'logo_dark'       => '',
		'logo_light'      => '',
		'footer_copy'     => '© 2025 Cipta Karya Digital Indonesia. All rights reserved.',
		'social_facebook' => '',
		'social_instagram' => '',
		'social_linkedin' => '',
		'social_twitter'  => '',
		'social_tiktok'   => '',
		'social_youtube'  => '',
		'show_wa'         => true,
		'chat_enabled'    => true,
		'chat_welcome'    => 'Halo! Saya AI Assistant Cipta Karya Digital Indonesia. 👋<br>Ada yang bisa saya bantu mengenai layanan kami?',
		'chat_header_sub' => 'Powered by Groq',
		'groq_api_key'    => '',
		'groq_model'      => 'llama-3.3-70b-versatile',
		'groq_prompt'     => "Kamu adalah AI assistant Cipta Karya Digital Indonesia (CKDI), sebuah perusahaan digital di Indonesia. \nTugasmu adalah membantu calon klien dengan informasi tentang layanan kami (Web Development, Mobile App, UI/UX Design, Digital Marketing, Produksi Konten, Solusi AI), \nmenjawab pertanyaan seputar harga, proses kerja, dan portofolio. Gunakan bahasa Indonesia yang ramah dan profesional. \nSelalu dorong untuk menghubungi kami via WhatsApp: +6281245213848 atau email: info@ciptakaryadigital.id. \nWebsite: www.ciptakaryadigital.id. Jika ditanya hal teknis yang tidak terkait CKDI, arahkan kembali ke layanan kami.",
	);
}

function ckdi_opt( $key ) {
	$defaults = ckdi_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	return get_theme_mod( 'ckdi_' . $key, $default );
}

/** Link WhatsApp helper */
function ckdi_wa_link( $message = '' ) {
	$number = preg_replace( '/\D+/', '', ckdi_opt( 'wa_number' ) );
	$msg    = $message ? $message : ckdi_opt( 'wa_message' );
	return 'https://wa.me/' . $number . '?text=' . rawurlencode( $msg );
}

/** WhatsApp SVG icon helper */
function ckdi_wa_svg( $fill = '#fff', $size = 16 ) {
	return '<svg viewBox="0 0 24 24" width="' . esc_attr( $size ) . '" height="' . esc_attr( $size ) . '" fill="' . esc_attr( $fill ) . '" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>';
}

/* ============================================================
   THEME SETUP
   ============================================================ */
function ckdi_setup() {
	load_theme_textdomain( 'ckdi', CKDI_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 220,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );

	register_nav_menus( array(
		'primary'        => __( 'Menu Utama (Navbar)', 'ckdi' ),
		'footer_layanan' => __( 'Menu Footer — Layanan', 'ckdi' ),
		'footer_kontak'  => __( 'Menu Footer — Kontak', 'ckdi' ),
	) );

	add_image_size( 'ckdi-card', 600, 400, true );
}
add_action( 'after_setup_theme', 'ckdi_setup' );

function ckdi_content_width() {
	$GLOBALS['content_width'] = 1200;
}
add_action( 'after_setup_theme', 'ckdi_content_width', 0 );

/* ============================================================
   WIDGET AREAS (Footer dikelola dari sini)
   ============================================================ */
function ckdi_widgets_init() {
	$common = array(
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="footer-col-title">',
		'after_title'   => '</h4>',
	);
	register_sidebar( array_merge( $common, array(
		'name'        => __( 'Footer — Kolom 1 (Brand)', 'ckdi' ),
		'id'          => 'footer-1',
		'description' => __( 'Widget brand/logo footer. Default: Custom HTML.', 'ckdi' ),
	) ) );
	register_sidebar( array_merge( $common, array(
		'name'        => __( 'Footer — Kolom 2 (Layanan)', 'ckdi' ),
		'id'          => 'footer-2',
		'description' => __( 'Gunakan widget "Navigation Menu" → menu Footer Layanan.', 'ckdi' ),
	) ) );
	register_sidebar( array_merge( $common, array(
		'name'        => __( 'Footer — Kolom 3 (Kontak)', 'ckdi' ),
		'id'          => 'footer-3',
		'description' => __( 'Gunakan widget "Navigation Menu" → menu Footer Kontak.', 'ckdi' ),
	) ) );
}
add_action( 'widgets_init', 'ckdi_widgets_init' );

/* ============================================================
   SCRIPTS & STYLES
   ============================================================ */
function ckdi_scripts() {
	// Google Fonts (Sora + Inter) — sama persis dengan landing page
	wp_enqueue_style(
		'ckdi-fonts',
		'https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'ckdi-main', CKDI_URI . '/assets/css/main.css', array( 'ckdi-fonts' ), CKDI_VERSION );
	wp_enqueue_style( 'ckdi-style', get_stylesheet_uri(), array( 'ckdi-main' ), CKDI_VERSION );

	wp_enqueue_script( 'ckdi-main', CKDI_URI . '/assets/js/main.js', array(), CKDI_VERSION, true );

	wp_localize_script( 'ckdi-main', 'ckdiData', array(
		'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
		'nonce'      => wp_create_nonce( 'ckdi_chat_nonce' ),
		'chatOn'     => (bool) ckdi_opt( 'chat_enabled' ) && '' !== ckdi_opt( 'groq_api_key' ),
		'waNumber'   => preg_replace( '/\D+/', '', ckdi_opt( 'wa_number' ) ),
		'waMessage'  => ckdi_opt( 'wa_message' ),
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ckdi_scripts' );

/* ============================================================
   BODY CLASSES
   ============================================================ */
function ckdi_body_classes( $classes ) {
	$classes[] = 'ckdi';
	if ( is_singular() && ckdi_is_elementor( get_the_ID() ) ) {
		$classes[] = 'ckdi-elementor-page';
	}
	return $classes;
}
add_filter( 'body_class', 'ckdi_body_classes' );

/** Cek apakah halaman dibuat dengan Elementor */
function ckdi_is_elementor( $post_id ) {
	if ( ! class_exists( '\Elementor\Plugin' ) || ! $post_id ) {
		return false;
	}
	$document = \Elementor\Plugin::$instance->documents->get( $post_id );
	return $document ? $document->is_built_with_elementor() : false;
}

/* ============================================================
   EXCERPT
   ============================================================ */
function ckdi_excerpt_length( $length ) {
	return 24;
}
add_filter( 'excerpt_length', 'ckdi_excerpt_length' );

function ckdi_excerpt_more( $more ) {
	return '…';
}
add_filter( 'excerpt_more', 'ckdi_excerpt_more' );

/* ============================================================
   ELEMENTOR SUPPORT
   ============================================================ */
// Daftarkan lokasi Theme Builder Elementor (header/footer/single/archive)
add_action( 'elementor/theme/register_locations', function ( $manager ) {
	$manager->register_all_core();
} );

/* ============================================================
   CHATBOT — AJAX PROXY ke Groq (API key tetap di server)
   ============================================================ */
function ckdi_ajax_chat() {
	check_ajax_referer( 'ckdi_chat_nonce', 'nonce' );

	if ( ! ckdi_opt( 'chat_enabled' ) || '' === ckdi_opt( 'groq_api_key' ) ) {
		wp_send_json_error( array( 'reply' => 'Maaf, layanan AI sementara tidak tersedia. Silakan hubungi kami via WhatsApp.' ) );
	}

	$messages = array();
	if ( ! empty( $_POST['history'] ) && is_string( $_POST['history'] ) ) {
		$history = json_decode( wp_unslash( $_POST['history'] ), true );
		if ( is_array( $history ) ) {
			foreach ( $history as $m ) {
				if ( isset( $m['role'], $m['content'] ) && in_array( $m['role'], array( 'user', 'assistant' ), true ) ) {
					$messages[] = array(
						'role'    => $m['role'],
						'content' => sanitize_textarea_field( (string) $m['content'] ),
					);
				}
			}
		}
	}
	// Ambil 10 pesan terakhir saja
	$messages = array_slice( $messages, -10 );

	$body = array(
		'model'       => ckdi_opt( 'groq_model' ),
		'messages'    => array_merge(
			array( array( 'role' => 'system', 'content' => ckdi_opt( 'groq_prompt' ) ) ),
			$messages
		),
		'max_tokens'  => 400,
		'temperature' => 0.7,
	);

	$response = wp_remote_post( 'https://api.groq.com/openai/v1/chat/completions', array(
		'timeout' => 30,
		'headers' => array(
			'Content-Type'  => 'application/json',
			'Authorization' => 'Bearer ' . ckdi_opt( 'groq_api_key' ),
		),
		'body'    => wp_json_encode( $body ),
	) );

	if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
		wp_send_json_error( array( 'reply' => 'Maaf, layanan AI sementara tidak tersedia. Hubungi kami via WhatsApp.' ) );
	}

	$data  = json_decode( wp_remote_retrieve_body( $response ), true );
	$reply = isset( $data['choices'][0]['message']['content'] ) ? $data['choices'][0]['message']['content'] : '';

	if ( '' === $reply ) {
		wp_send_json_error( array( 'reply' => 'Maaf, ada gangguan. Silakan hubungi kami via WhatsApp.' ) );
	}

	$allowed = array(
		'a'      => array( 'href' => array(), 'target' => array(), 'rel' => array() ),
		'br'     => array(),
		'strong' => array(),
		'em'     => array(),
		'code'   => array(),
	);

	wp_send_json_success( array( 'reply' => wp_kses( $reply, $allowed ) ) );
}
add_action( 'wp_ajax_ckdi_chat', 'ckdi_ajax_chat' );
add_action( 'wp_ajax_nopriv_ckdi_chat', 'ckdi_ajax_chat' );

/* ============================================================
   NAV FALLBACK (jika belum ada menu)
   ============================================================ */
function ckdi_nav_fallback() {
	echo '<ul class="nav-links" id="navLinks">';
	wp_list_pages( array( 'title_li' => '', 'depth' => 1 ) );
	echo '</ul>';
}

/* ============================================================
   INCLUDES
   ============================================================ */
require CKDI_DIR . '/inc/customizer.php';
require CKDI_DIR . '/inc/elementor-widgets.php';
require CKDI_DIR . '/inc/demo-import.php';
require CKDI_DIR . '/inc/landing-fallback.php';
