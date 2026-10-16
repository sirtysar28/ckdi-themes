<?php
/**
 * Custom Elementor Widgets — CKDI Elements
 * Hero, Services, Why Us, Portfolio, Pricing, Contact.
 * Semua default mengikuti landing page ckdi_landing_page.html (sama persis).
 *
 * @package CKDI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
	return;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

/* ============================================================
   KATEGORI WIDGET
   ============================================================ */
add_action( 'elementor/elements/categories_registered', function ( $elements_manager ) {
	$elements_manager->add_category( 'ckdi', array(
		'title' => __( 'CKDI Elements', 'ckdi' ),
		'icon'  => 'eicon-plug',
	) );
} );

/* ============================================================
   HELPER: default gambar dari folder theme
   ============================================================ */
function ckdi_img_default( $file ) {
	return array( 'url' => CKDI_URI . '/assets/img/' . $file, 'id' => '' );
}

/* ============================================================
   1) WIDGET: HERO
   ============================================================ */
class CKDI_Widget_Hero extends Widget_Base {

	public function get_name() {
		return 'ckdi_hero';
	}
	public function get_title() {
		return __( 'CKDI — Hero', 'ckdi' );
	}
	public function get_icon() {
		return 'eicon-banner';
	}
	public function get_categories() {
		return array( 'ckdi' );
	}
	public function get_keywords() {
		return array( 'hero', 'ckdi', 'banner', 'utama' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'sec_badge', array( 'label' => __( 'Badge & Judul', 'ckdi' ) ) );

		$this->add_control( 'badge_text', array(
			'label'   => __( 'Teks Badge', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Solusi Digital Terdepan di Indonesia',
		) );
		$this->add_control( 'title_line1', array(
			'label'   => __( 'Judul — Baris 1', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Wujudkan',
		) );
		$this->add_control( 'title_highlight', array(
			'label'   => __( 'Judul — Highlight (biru)', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Transformasi Digital',
		) );
		$this->add_control( 'title_line2', array(
			'label'   => __( 'Judul — Baris 2', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Bisnis Anda',
		) );
		$this->add_control( 'description', array(
			'label'   => __( 'Deskripsi', 'ckdi' ),
			'type'    => Controls_Manager::TEXTAREA,
			'default' => 'Kami menghadirkan solusi digital premium — mulai dari website profesional, aplikasi mobile, hingga strategi pemasaran digital untuk membawa bisnis Anda ke level berikutnya.',
		) );

		$this->end_controls_section();

		$this->start_controls_section( 'sec_buttons', array( 'label' => __( 'Tombol', 'ckdi' ) ) );

		$this->add_control( 'btn1_text', array(
			'label'   => __( 'Tombol Utama — Teks', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Mulai Proyek',
		) );
		$this->add_control( 'btn1_link', array(
			'label'       => __( 'Tombol Utama — Link', 'ckdi' ),
			'type'        => Controls_Manager::URL,
			'default'     => array( 'url' => '#contact' ),
			'placeholder' => 'https://',
		) );
		$this->add_control( 'btn2_text', array(
			'label'   => __( 'Tombol Sekunder — Teks', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Lihat Portofolio',
		) );
		$this->add_control( 'btn2_link', array(
			'label'       => __( 'Tombol Sekunder — Link', 'ckdi' ),
			'type'        => Controls_Manager::URL,
			'default'     => array( 'url' => '#portfolio' ),
			'placeholder' => 'https://',
		) );

		$this->end_controls_section();

		$this->start_controls_section( 'sec_stats', array( 'label' => __( 'Statistik', 'ckdi' ) ) );

		$stats = new Repeater();
		$stats->add_control( 'value', array(
			'label'   => __( 'Nilai', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '200',
		) );
		$stats->add_control( 'suffix', array(
			'label'   => __( 'Suffix', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '+',
		) );
		$stats->add_control( 'label', array(
			'label'   => __( 'Label', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Proyek Selesai',
		) );
		$stats->add_control( 'animate', array(
			'label'        => __( 'Animasi hitung angka', 'ckdi' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'return_value' => 'yes',
		) );

		$this->add_control( 'stats', array(
			'label'       => __( 'Item Statistik', 'ckdi' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $stats->get_controls(),
			'title_field' => '{{{ label }}}',
			'default'     => array(
				array( 'value' => '200', 'suffix' => '+', 'label' => 'Proyek Selesai', 'animate' => 'yes' ),
				array( 'value' => '150', 'suffix' => '+', 'label' => 'Klien Puas', 'animate' => 'yes' ),
				array( 'value' => '5.0', 'suffix' => '', 'label' => 'Rating ★', 'animate' => '' ),
			),
		) );

		$this->end_controls_section();

		$this->start_controls_section( 'sec_media', array( 'label' => __( 'Video & Gambar', 'ckdi' ) ) );

		$this->add_control( 'video_url', array(
			'label'       => __( 'Video Background (MP4) — sumber utama', 'ckdi' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => 'https://videos.pexels.com/video-files/7649698/7649698-uhd_2560_1440_24fps.mp4',
			'label_block' => true,
		) );
		$this->add_control( 'video_url2', array(
			'label'       => __( 'Video Background (MP4) — fallback', 'ckdi' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => 'https://videos.pexels.com/video-files/7053428/7053428-sd_960_540_24fps.mp4',
			'label_block' => true,
		) );
		$this->add_control( 'image', array(
			'label'   => __( 'Gambar Utama', 'ckdi' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => ckdi_img_default( 'Thumnail_2.png' ),
		) );

		$floats = new Repeater();
		$floats->add_control( 'icon', array(
			'label'   => __( 'Ikon (emoji)', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '🌐',
		) );
		$floats->add_control( 'title', array(
			'label'   => __( 'Tooltip', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Web Development',
		) );
		$this->add_control( 'floats', array(
			'label'       => __( 'Elemen Mengambang (maks 6)', 'ckdi' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $floats->get_controls(),
			'title_field' => '{{{ title }}}',
			'default'     => array(
				array( 'icon' => '🌐', 'title' => 'Web Development' ),
				array( 'icon' => '📱', 'title' => 'Mobile App' ),
				array( 'icon' => '🎨', 'title' => 'UI/UX Design' ),
				array( 'icon' => '🤖', 'title' => 'AI Solution' ),
				array( 'icon' => '📊', 'title' => 'Digital Marketing' ),
				array( 'icon' => '🔐', 'title' => 'Security' ),
			),
		) );

		$this->end_controls_section();
	}

	protected function render() {
		$s   = $this->get_settings_for_display();
		$img = ! empty( $s['image']['url'] ) ? $s['image']['url'] : '';
		?>
		<section class="hero" id="home">
			<div class="hero-video">
				<video id="heroVideo" autoplay muted loop playsinline>
					<?php if ( ! empty( $s['video_url'] ) ) : ?>
						<source src="<?php echo esc_url( $s['video_url'] ); ?>" type="video/mp4">
					<?php endif; ?>
					<?php if ( ! empty( $s['video_url2'] ) ) : ?>
						<source src="<?php echo esc_url( $s['video_url2'] ); ?>" type="video/mp4">
					<?php endif; ?>
				</video>
				<div class="hero-video-overlay"></div>
			</div>
			<div class="hero-grid-texture" aria-hidden="true"></div>

			<div class="hero-inner">
				<div class="hero-content">
					<?php if ( ! empty( $s['badge_text'] ) ) : ?>
						<div class="hero-badge">
							<span class="dot"></span>
							<?php echo esc_html( $s['badge_text'] ); ?>
						</div>
					<?php endif; ?>

					<h1 class="hero-title">
						<?php echo esc_html( $s['title_line1'] ); ?><br>
						<span class="highlight"><?php echo esc_html( $s['title_highlight'] ); ?></span><br>
						<?php echo esc_html( $s['title_line2'] ); ?>
					</h1>

					<p class="hero-description"><?php echo esc_html( $s['description'] ); ?></p>

					<div class="hero-actions">
						<?php
						$this->add_link_attributes( 'btn1', $s['btn1_link'] );
						$this->add_link_attributes( 'btn2', $s['btn2_link'] );
						?>
						<a <?php echo $this->get_render_attribute_string( 'btn1' ); // phpcs:ignore ?> class="btn-primary"><?php echo esc_html( $s['btn1_text'] ); ?> <span>→</span></a>
						<a <?php echo $this->get_render_attribute_string( 'btn2' ); // phpcs:ignore ?> class="btn-outline"><?php echo esc_html( $s['btn2_text'] ); ?></a>
					</div>

					<?php if ( ! empty( $s['stats'] ) ) : ?>
						<div class="hero-stats">
							<?php foreach ( $s['stats'] as $i => $stat ) : ?>
								<?php if ( $i > 0 ) : ?><div class="hero-stat-divider"></div><?php endif; ?>
								<div>
									<div class="hero-stat-value" <?php echo ( 'yes' === $stat['animate'] && is_numeric( $stat['value'] ) ) ? 'data-count="' . esc_attr( $stat['value'] ) . '"' : ''; ?>>
										<?php echo esc_html( $stat['value'] . $stat['suffix'] ); ?>
									</div>
									<div class="hero-stat-label"><?php echo esc_html( $stat['label'] ); ?></div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="hero-visual">
					<div class="hero-thumbnail-wrap">
						<div class="thumbnail-glow"></div>
						<div class="thumbnail-ring"></div>
						<?php if ( $img ) : ?>
							<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $s['title_highlight'] ); ?>" class="hero-thumbnail-img">
						<?php endif; ?>
						<?php foreach ( array_slice( (array) $s['floats'], 0, 6 ) as $i => $fl ) : ?>
							<div class="float-element float-<?php echo esc_attr( $i + 1 ); ?>" title="<?php echo esc_attr( $fl['title'] ); ?>"><?php echo esc_html( $fl['icon'] ); ?></div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}

/* ============================================================
   2) WIDGET: SERVICES
   ============================================================ */
class CKDI_Widget_Services extends Widget_Base {

	public function get_name() {
		return 'ckdi_services';
	}
	public function get_title() {
		return __( 'CKDI — Layanan', 'ckdi' );
	}
	public function get_icon() {
		return 'eicon-gallery-grid';
	}
	public function get_categories() {
		return array( 'ckdi' );
	}
	public function get_keywords() {
		return array( 'layanan', 'services', 'ckdi' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'sec_header', array( 'label' => __( 'Header Section', 'ckdi' ) ) );

		$this->add_control( 'label', array(
			'label'   => __( 'Label', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Layanan Kami',
		) );
		$this->add_control( 'title', array(
			'label'   => __( 'Judul', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Solusi Digital untuk Setiap Kebutuhan',
		) );
		$this->add_control( 'subtitle', array(
			'label'   => __( 'Subjudul', 'ckdi' ),
			'type'    => Controls_Manager::TEXTAREA,
			'default' => 'Dari konsep hingga eksekusi, kami siap menjadi partner digital terpercaya untuk bisnis Anda',
		) );

		$this->end_controls_section();

		$this->start_controls_section( 'sec_cards', array( 'label' => __( 'Kartu Layanan', 'ckdi' ) ) );

		$cards = new Repeater();
		$cards->add_control( 'image', array(
			'label'   => __( 'Gambar Kartu', 'ckdi' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => array( 'url' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=600&h=400&fit=crop', 'id' => '' ),
		) );
		$cards->add_control( 'icon', array(
			'label'   => __( 'Ikon (emoji)', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '🌐',
		) );
		$cards->add_control( 'name', array(
			'label'   => __( 'Nama Layanan', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Web Development',
		) );
		$cards->add_control( 'detail', array(
			'label'   => __( 'Deskripsi Singkat', 'ckdi' ),
			'type'    => Controls_Manager::TEXTAREA,
			'default' => 'Website responsif & performa tinggi dengan teknologi modern. Dari landing page hingga platform e-commerce kompleks.',
		) );
		$cards->add_control( 'tag', array(
			'label'   => __( 'Tag Teknologi', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'React · Next.js · Laravel',
		) );
		$cards->add_control( 'modal_desc', array(
			'label'       => __( 'Deskripsi Detail (Modal)', 'ckdi' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => '',
			'label_block' => true,
		) );
		$cards->add_control( 'modal_features', array(
			'label'       => __( 'Fitur Modal (satu per baris)', 'ckdi' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => '',
			'label_block' => true,
		) );

		$this->add_control( 'cards', array(
			'label'       => __( 'Item Layanan', 'ckdi' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $cards->get_controls(),
			'title_field' => '{{{ name }}}',
			'default'     => array(
				array(
					'image'         => array( 'url' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=600&h=400&fit=crop' ),
					'icon'          => '🌐',
					'name'          => 'Web Development',
					'detail'        => 'Website responsif & performa tinggi dengan teknologi modern. Dari landing page hingga platform e-commerce kompleks.',
					'tag'           => 'React · Next.js · Laravel',
					'modal_desc'    => 'Kami membangun website dan web application dengan standar enterprise. Setiap proyek dimulai dari riset mendalam, desain arsitektur yang solid, hingga implementasi kode berkualitas tinggi. Kami memastikan website Anda cepat, aman, dan scalable untuk mendukung pertumbuhan bisnis.',
					'modal_features' => "Landing Page & Company Profile\nE-Commerce & Marketplace\nSistem Manajemen (CMS/ERP/CRM)\nWeb Application Custom\nAPI Development & Integration\nPerformance Optimization & SEO\nHosting & Maintenance",
				),
				array(
					'image'         => array( 'url' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=600&h=400&fit=crop' ),
					'icon'          => '📱',
					'name'          => 'Mobile App',
					'detail'        => 'Aplikasi mobile native & cross-platform untuk iOS dan Android dengan UI/UX yang memukau.',
					'tag'           => 'Flutter · React Native · Swift',
					'modal_desc'    => 'Dari ide hingga launch di App Store dan Google Play. Kami mengembangkan aplikasi mobile dengan performa tinggi dan pengalaman pengguna yang seamless. Baik native maupun cross-platform, kami memastikan aplikasi Anda siap bersaing di pasar.',
					'modal_features' => "Aplikasi iOS & Android Native\nCross-Platform (Flutter/React Native)\nUI/UX Mobile Design\nPush Notification & Real-time Features\nIntegrasi Payment Gateway\nPublishing ke App Store & Play Store\nMaintenance & Update Berkala",
				),
				array(
					'image'         => array( 'url' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=600&h=400&fit=crop' ),
					'icon'          => '🎨',
					'name'          => 'UI/UX Design',
					'detail'        => 'Desain antarmuka yang intuitif dan pengalaman pengguna yang luar biasa untuk produk digital Anda.',
					'tag'           => 'Figma · Adobe XD · Prototyping',
					'modal_desc'    => 'Desain bukan hanya soal tampilan, tapi bagaimana pengguna berinteraksi dengan produk Anda. Tim desainer kami menggunakan pendekatan user-centered design untuk menciptakan pengalaman digital yang intuitif, menarik, dan meningkatkan konversi.',
					'modal_features' => "User Research & Persona Development\nWireframing & Information Architecture\nHigh-Fidelity UI Design\nInteractive Prototyping\nUsability Testing\nDesign System & Style Guide\nMobile-First Responsive Design",
				),
				array(
					'image'         => array( 'url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop' ),
					'icon'          => '📊',
					'name'          => 'Digital Marketing',
					'detail'        => 'Strategi pemasaran digital terintegrasi untuk meningkatkan brand awareness dan konversi bisnis Anda.',
					'tag'           => 'SEO · SEM · Social Media',
					'modal_desc'    => 'Strategi pemasaran digital yang terukur dan berorientasi hasil. Kami membantu meningkatkan visibilitas online, menjangkau audience yang tepat, dan mengoptimalkan konversi untuk ROI yang maksimal.',
					'modal_features' => "Search Engine Optimization (SEO)\nSearch Engine Marketing (SEM/Google Ads)\nSocial Media Marketing & Management\nContent Marketing Strategy\nEmail Marketing & Automation\nAnalytics & Performance Reporting\nConversion Rate Optimization (CRO)",
				),
				array(
					'image'         => array( 'url' => 'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?w=600&h=400&fit=crop' ),
					'icon'          => '🎬',
					'name'          => 'Produksi Konten',
					'detail'        => 'Video, foto, dan konten kreatif berkualitas tinggi yang merepresentasikan brand Anda secara profesional.',
					'tag'           => 'Video · Photography · Copywriting',
					'modal_desc'    => 'Konten berkualitas adalah kunci komunikasi brand yang efektif. Tim kreatif kami menghasilkan video, foto, dan copywriting yang profesional untuk memperkuat identitas brand dan engagement audiens Anda.',
					'modal_features' => "Video Production (Corporate, Product, Tutorial)\nProfessional Photography\nMotion Graphics & Animation\nCopywriting & Content Strategy\nSocial Media Content Creation\nBrand Storytelling\nPodcast & Audio Production",
				),
				array(
					'image'         => array( 'url' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=600&h=400&fit=crop' ),
					'icon'          => '🤖',
					'name'          => 'Solusi AI',
					'detail'        => 'Implementasi kecerdasan buatan untuk otomasi bisnis, chatbot cerdas, dan analisis data prediktif.',
					'tag'           => 'ChatGPT · Machine Learning · NLP',
					'modal_desc'    => 'Manfaatkan kekuatan kecerdasan buatan untuk mengoptimalkan operasional bisnis Anda. Dari chatbot cerdas hingga analisis prediktif, kami membantu Anda memanfaatkan teknologi AI terkini untuk keunggulan kompetitif.',
					'modal_features' => "AI Chatbot & Virtual Assistant\nMachine Learning Model Development\nNatural Language Processing (NLP)\nComputer Vision Solutions\nPredictive Analytics & Data Mining\nProcess Automation (RPA)\nAI Integration to Existing Systems",
				),
			),
		) );

		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		?>
		<section class="section section-alt" id="services">
			<div class="section-inner">
				<div class="section-header reveal">
					<div class="section-label"><?php echo esc_html( $s['label'] ); ?></div>
					<h2 class="section-title"><?php echo esc_html( $s['title'] ); ?></h2>
					<p class="section-subtitle"><?php echo esc_html( $s['subtitle'] ); ?></p>
				</div>
				<div class="services-grid">
					<?php foreach ( (array) $s['cards'] as $card ) :
						$img     = ! empty( $card['image']['url'] ) ? $card['image']['url'] : '';
						$payload = array(
							'title'    => $card['name'],
							'image'    => $img,
							'desc'     => $card['modal_desc'],
							'features' => array_filter( array_map( 'trim', explode( "\n", (string) $card['modal_features'] ) ) ),
						);
						?>
						<div class="service-card reveal" data-service="<?php echo esc_attr( wp_json_encode( $payload ) ); ?>">
							<?php if ( $img ) : ?>
								<div class="service-card-image">
									<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $card['name'] ); ?>" loading="lazy">
									<span class="click-hint">Lihat Detail →</span>
								</div>
							<?php endif; ?>
							<div class="service-icon"><?php echo esc_html( $card['icon'] ); ?></div>
							<div class="service-name"><?php echo esc_html( $card['name'] ); ?></div>
							<div class="service-detail"><?php echo esc_html( $card['detail'] ); ?></div>
							<span class="service-tag"><?php echo esc_html( $card['tag'] ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}

/* ============================================================
   3) WIDGET: WHY US
   ============================================================ */
class CKDI_Widget_WhyUs extends Widget_Base {

	public function get_name() {
		return 'ckdi_why_us';
	}
	public function get_title() {
		return __( 'CKDI — Mengapa Kami', 'ckdi' );
	}
	public function get_icon() {
		return 'eicon-favorite';
	}
	public function get_categories() {
		return array( 'ckdi' );
	}
	public function get_keywords() {
		return array( 'why', 'tentang', 'about', 'ckdi' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'sec_content', array( 'label' => __( 'Konten', 'ckdi' ) ) );

		$this->add_control( 'label', array(
			'label'   => __( 'Label', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Mengapa Kami',
		) );
		$this->add_control( 'title', array(
			'label'   => __( 'Judul', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Kepercayaan yang Terbukti',
		) );
		$this->add_control( 'image', array(
			'label'   => __( 'Gambar', 'ckdi' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => ckdi_img_default( 'thumnail_1.png' ),
		) );

		$items = new Repeater();
		$items->add_control( 'icon', array(
			'label'   => __( 'Ikon (emoji)', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '🏆',
		) );
		$items->add_control( 'title', array(
			'label'   => __( 'Judul', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Tim Berpengalaman',
		) );
		$items->add_control( 'desc', array(
			'label'   => __( 'Deskripsi', 'ckdi' ),
			'type'    => Controls_Manager::TEXTAREA,
			'default' => '',
		) );

		$this->add_control( 'items', array(
			'label'       => __( 'Item Keunggulan', 'ckdi' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $items->get_controls(),
			'title_field' => '{{{ title }}}',
			'default'     => array(
				array( 'icon' => '🏆', 'title' => 'Tim Berpengalaman', 'desc' => 'Developer, designer, dan marketer berpengalaman dengan rekam jejak proyek nasional dan internasional.' ),
				array( 'icon' => '⚡', 'title' => 'Delivery Tepat Waktu', 'desc' => 'Komitmen penuh pada timeline proyek dengan manajemen yang terstruktur dan transparan.' ),
				array( 'icon' => '🔒', 'title' => 'Keamanan Terjamin', 'desc' => 'Standar keamanan tingkat enterprise untuk melindungi data dan aset digital bisnis Anda.' ),
				array( 'icon' => '🎯', 'title' => 'Solusi Customized', 'desc' => 'Setiap proyek dirancang khusus sesuai kebutuhan unik bisnis Anda, bukan template standar.' ),
			),
		) );

		$this->end_controls_section();
	}

	protected function render() {
		$s   = $this->get_settings_for_display();
		$img = ! empty( $s['image']['url'] ) ? $s['image']['url'] : '';
		?>
		<section class="section" id="about">
			<div class="section-inner">
				<div class="why-grid">
					<div class="why-visual reveal" id="whyVisual">
						<div class="why-glow"></div>
						<?php if ( $img ) : ?>
							<div class="why-image-frame" id="whyFrame">
								<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $s['title'] ); ?>">
							</div>
						<?php endif; ?>
						<div class="why-particles">
							<span class="why-particle"></span><span class="why-particle"></span><span class="why-particle"></span>
							<span class="why-particle"></span><span class="why-particle"></span><span class="why-particle"></span>
						</div>
					</div>
					<div>
						<div class="section-label"><?php echo esc_html( $s['label'] ); ?></div>
						<h2 class="section-title" style="text-align:left;margin-bottom:2rem;"><?php echo esc_html( $s['title'] ); ?></h2>
						<div class="why-items">
							<?php foreach ( (array) $s['items'] as $item ) : ?>
								<div class="why-item reveal">
									<div class="why-icon"><?php echo esc_html( $item['icon'] ); ?></div>
									<div>
										<div class="why-item-title"><?php echo esc_html( $item['title'] ); ?></div>
										<div class="why-item-desc"><?php echo esc_html( $item['desc'] ); ?></div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}

/* ============================================================
   4) WIDGET: PORTFOLIO
   ============================================================ */
class CKDI_Widget_Portfolio extends Widget_Base {

	public function get_name() {
		return 'ckdi_portfolio';
	}
	public function get_title() {
		return __( 'CKDI — Portofolio', 'ckdi' );
	}
	public function get_icon() {
		return 'eicon-gallery-justified';
	}
	public function get_categories() {
		return array( 'ckdi' );
	}
	public function get_keywords() {
		return array( 'portofolio', 'portfolio', 'ckdi' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'sec_header', array( 'label' => __( 'Header Section', 'ckdi' ) ) );

		$this->add_control( 'label', array(
			'label'   => __( 'Label', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Portofolio',
		) );
		$this->add_control( 'title', array(
			'label'   => __( 'Judul', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Karya Terbaik Kami',
		) );
		$this->add_control( 'subtitle', array(
			'label'   => __( 'Subjudul', 'ckdi' ),
			'type'    => Controls_Manager::TEXTAREA,
			'default' => 'Beberapa proyek unggulan yang telah kami kerjakan untuk klien-klien terpercaya',
		) );

		$this->end_controls_section();

		$this->start_controls_section( 'sec_cards', array( 'label' => __( 'Kartu Portofolio', 'ckdi' ) ) );

		$cards = new Repeater();
		$cards->add_control( 'icon', array(
			'label'   => __( 'Ikon (emoji)', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '🏢',
		) );
		$cards->add_control( 'category', array(
			'label'   => __( 'Kategori', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Web Development',
		) );
		$cards->add_control( 'name', array(
			'label'   => __( 'Nama Proyek', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Platform E-Commerce Premium',
		) );
		$cards->add_control( 'link', array(
			'label'   => __( 'Link (opsional)', 'ckdi' ),
			'type'    => Controls_Manager::URL,
			'default' => array( 'url' => '' ),
		) );

		$this->add_control( 'cards', array(
			'label'       => __( 'Item Portofolio', 'ckdi' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $cards->get_controls(),
			'title_field' => '{{{ name }}}',
			'default'     => array(
				array( 'icon' => '🏢', 'category' => 'Web Development', 'name' => 'Platform E-Commerce Premium' ),
				array( 'icon' => '📱', 'category' => 'Mobile App', 'name' => 'Aplikasi Manajemen Logistik' ),
				array( 'icon' => '🎨', 'category' => 'UI/UX & Branding', 'name' => 'Rebranding Perusahaan FMCG' ),
				array( 'icon' => '🤖', 'category' => 'AI Solution', 'name' => 'Chatbot Customer Service Bank' ),
				array( 'icon' => '📊', 'category' => 'Digital Marketing', 'name' => 'Kampanye Digital 500% ROI' ),
				array( 'icon' => '🎬', 'category' => 'Video Production', 'name' => 'Video Korporat Viral 10M Views' ),
			),
		) );

		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		?>
		<section class="section section-alt" id="portfolio">
			<div class="section-inner">
				<div class="section-header reveal">
					<div class="section-label"><?php echo esc_html( $s['label'] ); ?></div>
					<h2 class="section-title"><?php echo esc_html( $s['title'] ); ?></h2>
					<p class="section-subtitle"><?php echo esc_html( $s['subtitle'] ); ?></p>
				</div>
				<div class="portfolio-grid">
					<?php foreach ( (array) $s['cards'] as $card ) :
						$has_link = ! empty( $card['link']['url'] );
						$target   = ! empty( $card['link']['is_external'] ) ? ' target="_blank" rel="noopener"' : '';
						?>
						<div class="portfolio-card reveal">
							<?php if ( $has_link ) : ?>
								<a href="<?php echo esc_url( $card['link']['url'] ); ?>"<?php echo $target; // phpcs:ignore ?> style="display:block;color:inherit;">
							<?php endif; ?>
							<div class="portfolio-thumb"><?php echo esc_html( $card['icon'] ); ?></div>
							<div class="portfolio-info">
								<div class="portfolio-category"><?php echo esc_html( $card['category'] ); ?></div>
								<div class="portfolio-name"><?php echo esc_html( $card['name'] ); ?></div>
							</div>
							<?php if ( $has_link ) : ?></a><?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}

/* ============================================================
   5) WIDGET: PRICING
   ============================================================ */
class CKDI_Widget_Pricing extends Widget_Base {

	public function get_name() {
		return 'ckdi_pricing';
	}
	public function get_title() {
		return __( 'CKDI — Paket Harga', 'ckdi' );
	}
	public function get_icon() {
		return 'eicon-price-table';
	}
	public function get_categories() {
		return array( 'ckdi' );
	}
	public function get_keywords() {
		return array( 'harga', 'pricing', 'paket', 'ckdi' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'sec_header', array( 'label' => __( 'Header Section', 'ckdi' ) ) );

		$this->add_control( 'label', array(
			'label'   => __( 'Label', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Harga',
		) );
		$this->add_control( 'title', array(
			'label'   => __( 'Judul', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Paket Sesuai Kebutuhan',
		) );
		$this->add_control( 'subtitle', array(
			'label'   => __( 'Subjudul', 'ckdi' ),
			'type'    => Controls_Manager::TEXTAREA,
			'default' => 'Pilih paket yang paling sesuai dengan skala bisnis dan kebutuhan digital Anda',
		) );

		$this->end_controls_section();

		$this->start_controls_section( 'sec_cards', array( 'label' => __( 'Kartu Paket', 'ckdi' ) ) );

		$cards = new Repeater();
		$cards->add_control( 'name', array(
			'label'   => __( 'Nama Paket', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Starter',
		) );
		$cards->add_control( 'amount', array(
			'label'   => __( 'Harga', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Rp 3 Jt',
		) );
		$cards->add_control( 'period', array(
			'label'   => __( 'Keterangan Periode', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Mulai dari / proyek',
		) );
		$cards->add_control( 'features', array(
			'label'       => __( 'Fitur (satu per baris)', 'ckdi' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => '',
			'label_block' => true,
		) );
		$cards->add_control( 'featured', array(
			'label'        => __( 'Paket Populer (highlight)', 'ckdi' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => '',
		) );
		$cards->add_control( 'badge', array(
			'label'     => __( 'Teks Badge (mis. POPULER)', 'ckdi' ),
			'type'      => Controls_Manager::TEXT,
			'default'   => 'POPULER',
			'condition' => array( 'featured' => 'yes' ),
		) );
		$cards->add_control( 'btn_text', array(
			'label'   => __( 'Teks Tombol', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Pilih Paket',
		) );
		$cards->add_control( 'btn_link', array(
			'label'   => __( 'Link Tombol', 'ckdi' ),
			'type'    => Controls_Manager::URL,
			'default' => array( 'url' => '' ),
		) );

		$this->add_control( 'cards', array(
			'label'       => __( 'Item Paket', 'ckdi' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $cards->get_controls(),
			'title_field' => '{{{ name }}}',
			'default'     => array(
				array(
					'name'     => 'Starter',
					'amount'   => 'Rp 3 Jt',
					'period'   => 'Mulai dari / proyek',
					'features' => "Landing Page Profesional\nDesain Responsif\nWhatsApp Integration\n3 Bulan Support\nHosting Gratis 1 Tahun",
					'featured' => '',
					'btn_text' => 'Pilih Paket',
					'btn_link' => array( 'url' => ckdi_wa_link( 'Halo CKDI, saya tertarik paket Starter' ), 'is_external' => 'yes' ),
				),
				array(
					'name'     => 'Professional',
					'amount'   => 'Rp 10 Jt',
					'period'   => 'Mulai dari / proyek',
					'features' => "Website Multi-Halaman\nCMS + Admin Panel\nSEO Optimization\nIntegrasi Payment Gateway\n6 Bulan Support Premium\nCustom Domain",
					'featured' => 'yes',
					'badge'    => 'POPULER',
					'btn_text' => 'Pilih Paket',
					'btn_link' => array( 'url' => ckdi_wa_link( 'Halo CKDI, saya tertarik paket Professional' ), 'is_external' => 'yes' ),
				),
				array(
					'name'     => 'Enterprise',
					'amount'   => 'Custom',
					'period'   => 'Sesuai kebutuhan',
					'features' => "Solusi Enterprise Custom\nSistem ERP / CRM\nIntegrasi AI & Otomasi\nDedicated Team\n12 Bulan Support\nSLA Guarantee",
					'featured' => '',
					'btn_text' => 'Konsultasi Gratis',
					'btn_link' => array( 'url' => ckdi_wa_link( 'Halo CKDI, saya butuh konsultasi Enterprise' ), 'is_external' => 'yes' ),
				),
			),
		) );

		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		?>
		<section class="section" id="pricing">
			<div class="section-inner">
				<div class="section-header reveal">
					<div class="section-label"><?php echo esc_html( $s['label'] ); ?></div>
					<h2 class="section-title"><?php echo esc_html( $s['title'] ); ?></h2>
					<p class="section-subtitle"><?php echo esc_html( $s['subtitle'] ); ?></p>
				</div>
				<div class="pricing-grid">
					<?php foreach ( (array) $s['cards'] as $card ) :
						$featured = 'yes' === $card['featured'];
						$btn_url  = ! empty( $card['btn_link']['url'] ) ? $card['btn_link']['url'] : ckdi_wa_link( 'Halo CKDI, saya tertarik paket ' . $card['name'] );
						$target   = ! empty( $card['btn_link']['is_external'] ) ? ' target="_blank" rel="noopener"' : ' target="_blank" rel="noopener"';
						?>
						<div class="pricing-card reveal<?php echo $featured ? ' featured' : ''; ?>">
							<?php if ( $featured && ! empty( $card['badge'] ) ) : ?>
								<div class="pricing-badge"><?php echo esc_html( $card['badge'] ); ?></div>
							<?php endif; ?>
							<div class="pricing-name"><?php echo esc_html( $card['name'] ); ?></div>
							<div class="pricing-amount"><?php echo esc_html( $card['amount'] ); ?></div>
							<div class="pricing-period"><?php echo esc_html( $card['period'] ); ?></div>
							<ul class="pricing-features">
								<?php foreach ( array_filter( array_map( 'trim', explode( "\n", (string) $card['features'] ) ) ) as $feature ) : ?>
									<li><?php echo esc_html( $feature ); ?></li>
								<?php endforeach; ?>
							</ul>
							<a href="<?php echo esc_url( $btn_url ); ?>"<?php echo $target; // phpcs:ignore ?> class="pricing-btn <?php echo $featured ? 'pricing-btn-primary' : 'pricing-btn-outline'; ?>">
								<?php echo esc_html( $card['btn_text'] ); ?>
								<span class="wa-icon-inline"><?php echo ckdi_wa_svg( $featured ? '#fff' : '#25D366', 16 ); // phpcs:ignore ?></span>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}

/* ============================================================
   6) WIDGET: CONTACT
   ============================================================ */
class CKDI_Widget_Contact extends Widget_Base {

	public function get_name() {
		return 'ckdi_contact';
	}
	public function get_title() {
		return __( 'CKDI — Kontak & Form', 'ckdi' );
	}
	public function get_icon() {
		return 'eicon-form-horizontal';
	}
	public function get_categories() {
		return array( 'ckdi' );
	}
	public function get_keywords() {
		return array( 'kontak', 'contact', 'form', 'ckdi' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'sec_header', array( 'label' => __( 'Header Section', 'ckdi' ) ) );

		$this->add_control( 'label', array(
			'label'   => __( 'Label', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Hubungi Kami',
		) );
		$this->add_control( 'title', array(
			'label'   => __( 'Judul', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Mari Berkolaborasi',
		) );
		$this->add_control( 'subtitle', array(
			'label'   => __( 'Subjudul', 'ckdi' ),
			'type'    => Controls_Manager::TEXTAREA,
			'default' => 'Ceritakan kebutuhan digital Anda dan kami siap memberikan solusi terbaik',
		) );

		$this->end_controls_section();

		$this->start_controls_section( 'sec_info', array( 'label' => __( 'Info Kontak', 'ckdi' ) ) );

		$infos = new Repeater();
		$infos->add_control( 'icon', array(
			'label'   => __( 'Ikon (emoji)', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '🌐',
		) );
		$infos->add_control( 'label', array(
			'label'   => __( 'Label', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Website',
		) );
		$infos->add_control( 'value', array(
			'label'   => __( 'Nilai', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'www.ciptakaryadigital.id',
		) );
		$infos->add_control( 'link', array(
			'label'   => __( 'Link (opsional)', 'ckdi' ),
			'type'    => Controls_Manager::URL,
			'default' => array( 'url' => '' ),
		) );

		$this->add_control( 'infos', array(
			'label'       => __( 'Item Info', 'ckdi' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $infos->get_controls(),
			'title_field' => '{{{ label }}}',
			'default'     => array(
				array( 'icon' => '🌐', 'label' => 'Website', 'value' => 'www.ciptakaryadigital.id', 'link' => array( 'url' => 'https://www.ciptakaryadigital.id', 'is_external' => 'yes' ) ),
				array( 'icon' => '📧', 'label' => 'Email', 'value' => 'info@ciptakaryadigital.id', 'link' => array( 'url' => 'mailto:info@ciptakaryadigital.id' ) ),
				array( 'icon' => '💬', 'label' => 'WhatsApp', 'value' => '+62 812-4521-3848', 'link' => array( 'url' => 'https://wa.me/6281245213848', 'is_external' => 'yes' ) ),
				array( 'icon' => '📍', 'label' => 'Lokasi', 'value' => 'Indonesia', 'link' => array( 'url' => '' ) ),
			),
		) );

		$this->end_controls_section();

		$this->start_controls_section( 'sec_form', array( 'label' => __( 'Formulir', 'ckdi' ) ) );

		$this->add_control( 'label_name', array(
			'label'   => __( 'Label — Nama', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Nama Lengkap',
		) );
		$this->add_control( 'label_email', array(
			'label'   => __( 'Label — Email', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Email',
		) );
		$this->add_control( 'label_service', array(
			'label'   => __( 'Label — Layanan', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Layanan yang Diminati',
		) );
		$this->add_control( 'label_message', array(
			'label'   => __( 'Label — Pesan', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Pesan',
		) );
		$this->add_control( 'services_list', array(
			'label'       => __( 'Opsi Layanan (satu per baris)', 'ckdi' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => "Web Development\nMobile App\nUI/UX Design\nDigital Marketing\nProduksi Konten\nSolusi AI\nKonsultasi Enterprise",
			'label_block' => true,
		) );
		$this->add_control( 'btn_text', array(
			'label'   => __( 'Teks Tombol Kirim', 'ckdi' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Kirim Pesan →',
		) );

		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		?>
		<section class="section section-alt" id="contact">
			<div class="section-inner">
				<div class="section-header reveal">
					<div class="section-label"><?php echo esc_html( $s['label'] ); ?></div>
					<h2 class="section-title"><?php echo esc_html( $s['title'] ); ?></h2>
					<p class="section-subtitle"><?php echo esc_html( $s['subtitle'] ); ?></p>
				</div>
				<div class="contact-grid">
					<div class="contact-info reveal">
						<?php foreach ( (array) $s['infos'] as $info ) :
							$has_link = ! empty( $info['link']['url'] );
							$target   = ! empty( $info['link']['is_external'] ) ? ' target="_blank" rel="noopener"' : '';
							?>
							<div class="contact-item">
								<div class="contact-icon"><?php echo esc_html( $info['icon'] ); ?></div>
								<div>
									<div class="contact-item-label"><?php echo esc_html( $info['label'] ); ?></div>
									<div class="contact-item-value">
										<?php if ( $has_link ) : ?>
											<a href="<?php echo esc_url( $info['link']['url'] ); ?>"<?php echo $target; // phpcs:ignore ?>><?php echo esc_html( $info['value'] ); ?></a>
										<?php else : ?>
											<?php echo esc_html( $info['value'] ); ?>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="contact-form reveal">
						<div class="form-group">
							<label><?php echo esc_html( $s['label_name'] ); ?></label>
							<input type="text" placeholder="Masukkan nama Anda" class="ckdi-form-name">
						</div>
						<div class="form-group">
							<label><?php echo esc_html( $s['label_email'] ); ?></label>
							<input type="email" placeholder="email@bisnis.com" class="ckdi-form-email">
						</div>
						<div class="form-group">
							<label><?php echo esc_html( $s['label_service'] ); ?></label>
							<select class="ckdi-form-service">
								<option value=""><?php esc_html_e( 'Pilih layanan...', 'ckdi' ); ?></option>
								<?php foreach ( array_filter( array_map( 'trim', explode( "\n", (string) $s['services_list'] ) ) ) as $opt ) : ?>
									<option><?php echo esc_html( $opt ); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label><?php echo esc_html( $s['label_message'] ); ?></label>
							<textarea placeholder="Ceritakan kebutuhan digital Anda..." class="ckdi-form-message"></textarea>
						</div>
						<button class="btn-primary ckdi-form-submit" style="width:100%;justify-content:center;"><?php echo esc_html( $s['btn_text'] ); ?></button>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}

/* ============================================================
   REGISTRASI WIDGET
   Kompatibel Elementor 3.x & 4.x: hook baru `elementor/widgets/register`
   + hook legacy `elementor/widgets/widgets_registered`, dengan guard
   anti dobel-registrasi dan fallback method register_widget_type()
   untuk Elementor lama. Aman di PHP 8.3.
   ============================================================ */
function ckdi_register_elementor_widgets( $widgets_manager ) {
	static $registered = false;
	if ( $registered ) {
		return;
	}
	$registered = true;

	$widgets = array(
		new CKDI_Widget_Hero(),
		new CKDI_Widget_Services(),
		new CKDI_Widget_WhyUs(),
		new CKDI_Widget_Portfolio(),
		new CKDI_Widget_Pricing(),
		new CKDI_Widget_Contact(),
	);

	foreach ( $widgets as $widget ) {
		if ( method_exists( $widgets_manager, 'register' ) ) {
			$widgets_manager->register( $widget );
		} elseif ( method_exists( $widgets_manager, 'register_widget_type' ) ) {
			$widgets_manager->register_widget_type( $widget );
		}
	}
}

add_action( 'elementor/widgets/register', 'ckdi_register_elementor_widgets' );
add_action( 'elementor/widgets/widgets_registered', 'ckdi_register_elementor_widgets' );
