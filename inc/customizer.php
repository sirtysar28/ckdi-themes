<?php
/**
 * CKDI Theme Customizer
 * Pengaturan: Branding (logo), Kontak & WhatsApp, Footer, Chatbot Groq
 *
 * @package CKDI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ckdi_customize_register( $wp_customize ) {

	/* ============================================================
	   PANEL UTAMA
	   ============================================================ */
	$wp_customize->add_panel( 'ckdi_panel', array(
		'title'       => __( 'Pengaturan CKDI', 'ckdi' ),
		'description' => __( 'Pengaturan tema Cipta Karya Digital Indonesia', 'ckdi' ),
		'priority'    => 10,
	) );

	/* ============================================================
	   SECTION: BRANDING (LOGO)
	   ============================================================ */
	$wp_customize->add_section( 'ckdi_branding', array(
		'title' => __( 'Branding / Logo', 'ckdi' ),
		'panel' => 'ckdi_panel',
	) );

	$wp_customize->add_setting( 'ckdi_logo_dark', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ckdi_logo_dark', array(
		'label'       => __( 'Logo — Mode Gelap (putih)', 'ckdi' ),
		'description' => __( 'Logo yang tampil saat tema gelap. Default: bawaan theme.', 'ckdi' ),
		'section'     => 'ckdi_branding',
	) ) );

	$wp_customize->add_setting( 'ckdi_logo_light', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ckdi_logo_light', array(
		'label'       => __( 'Logo — Mode Terang (hitam)', 'ckdi' ),
		'section'     => 'ckdi_branding',
	) ) );

	/* ============================================================
	   SECTION: KONTAK & WHATSAPP
	   ============================================================ */
	$wp_customize->add_section( 'ckdi_contact', array(
		'title' => __( 'Kontak & WhatsApp', 'ckdi' ),
		'panel' => 'ckdi_panel',
	) );

	$ckdi_fields = array(
		'wa_number'  => array( __( 'Nomor WhatsApp (format internasional tanpa +)', 'ckdi' ), '6281245213848', 'sanitize_text_field' ),
		'wa_message' => array( __( 'Pesan WhatsApp default', 'ckdi' ), 'Halo CKDI, saya ingin konsultasi layanan digital', 'sanitize_text_field' ),
		'email'      => array( __( 'Email', 'ckdi' ), 'info@ciptakaryadigital.id', 'sanitize_email' ),
		'website'    => array( __( 'Website', 'ckdi' ), 'https://www.ciptakaryadigital.id', 'esc_url_raw' ),
		'location'   => array( __( 'Lokasi', 'ckdi' ), 'Indonesia', 'sanitize_text_field' ),
	);

	foreach ( $ckdi_fields as $key => $field ) {
		$wp_customize->add_setting( 'ckdi_' . $key, array(
			'default'           => $field[1],
			'sanitize_callback' => $field[2],
		) );
		$wp_customize->add_control( 'ckdi_' . $key, array(
			'label'   => $field[0],
			'section' => 'ckdi_contact',
			'type'    => 'text',
		) );
	}

	$wp_customize->add_setting( 'ckdi_show_wa', array(
		'default'           => true,
		'sanitize_callback' => 'wp_validate_boolean',
	) );
	$wp_customize->add_control( 'ckdi_show_wa', array(
		'label'   => __( 'Tampilkan tombol WhatsApp mengambang', 'ckdi' ),
		'section' => 'ckdi_contact',
		'type'    => 'checkbox',
	) );

	/* ============================================================
	   SECTION: FOOTER
	   ============================================================ */
	$wp_customize->add_section( 'ckdi_footer', array(
		'title'       => __( 'Footer', 'ckdi' ),
		'description' => __( 'Kolom footer dikelola via Appearance → Widgets. Social media & copyright di sini.', 'ckdi' ),
		'panel'       => 'ckdi_panel',
	) );

	$wp_customize->add_setting( 'ckdi_footer_copy', array(
		'default'           => '© 2025 Cipta Karya Digital Indonesia. All rights reserved.',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'ckdi_footer_copy', array(
		'label'   => __( 'Teks Copyright', 'ckdi' ),
		'section' => 'ckdi_footer',
		'type'    => 'text',
	) );

	$ckdi_socials = array(
		'social_facebook'  => __( 'URL Facebook', 'ckdi' ),
		'social_instagram' => __( 'URL Instagram', 'ckdi' ),
		'social_linkedin'  => __( 'URL LinkedIn', 'ckdi' ),
		'social_twitter'   => __( 'URL X / Twitter', 'ckdi' ),
		'social_tiktok'    => __( 'URL TikTok', 'ckdi' ),
		'social_youtube'   => __( 'URL YouTube', 'ckdi' ),
	);
	foreach ( $ckdi_socials as $key => $label ) {
		$wp_customize->add_setting( 'ckdi_' . $key, array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'ckdi_' . $key, array(
			'label'   => $label,
			'section' => 'ckdi_footer',
			'type'    => 'url',
		) );
	}

	/* ============================================================
	   SECTION: CHATBOT (GROQ)
	   ============================================================ */
	$wp_customize->add_section( 'ckdi_chatbot', array(
		'title'       => __( 'Chatbot AI (Groq)', 'ckdi' ),
		'description' => __( 'API key Groq hanya digunakan di server (admin-ajax) — tidak terekspos ke pengunjung.', 'ckdi' ),
		'panel'       => 'ckdi_panel',
	) );

	$wp_customize->add_setting( 'ckdi_chat_enabled', array(
		'default'           => true,
		'sanitize_callback' => 'wp_validate_boolean',
	) );
	$wp_customize->add_control( 'ckdi_chat_enabled', array(
		'label'   => __( 'Aktifkan chatbot AI', 'ckdi' ),
		'section' => 'ckdi_chatbot',
		'type'    => 'checkbox',
	) );

	$wp_customize->add_setting( 'ckdi_groq_api_key', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'ckdi_groq_api_key', array(
		'label'       => __( 'Groq API Key', 'ckdi' ),
		'description' => __( 'Ambil gratis di console.groq.com. Wajib diisi agar chatbot berfungsi.', 'ckdi' ),
		'section'     => 'ckdi_chatbot',
		'type'        => 'password',
	) );

	$wp_customize->add_setting( 'ckdi_groq_model', array(
		'default'           => 'llama-3.3-70b-versatile',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'ckdi_groq_model', array(
		'label'   => __( 'Model Groq', 'ckdi' ),
		'section' => 'ckdi_chatbot',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'ckdi_chat_header_sub', array(
		'default'           => 'Powered by Groq',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'ckdi_chat_header_sub', array(
		'label'   => __( 'Subjudul header chatbot', 'ckdi' ),
		'section' => 'ckdi_chatbot',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'ckdi_chat_welcome', array(
		'default'           => 'Halo! Saya AI Assistant Cipta Karya Digital Indonesia. 👋<br>Ada yang bisa saya bantu mengenai layanan kami?',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'ckdi_chat_welcome', array(
		'label'   => __( 'Pesan sambutan chatbot', 'ckdi' ),
		'section' => 'ckdi_chatbot',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'ckdi_groq_prompt', array(
		'default'           => ckdi_defaults()['groq_prompt'],
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'ckdi_groq_prompt', array(
		'label'   => __( 'System prompt AI', 'ckdi' ),
		'section' => 'ckdi_chatbot',
		'type'    => 'textarea',
	) );
}
add_action( 'customize_register', 'ckdi_customize_register' );
