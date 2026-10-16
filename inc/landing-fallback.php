<?php
/**
 * CKDI Landing Fallback
 *
 * Menampilkan konten landing page (1:1 dengan https://ciptakaryadigital.id/new/)
 * TANPA Elementor — dipakai otomatis kalau sebuah halaman belum dibangun
 * dengan Elementor dan belum punya konten, sehingga homepage / halaman lain
 * TIDAK PERNAH kosong sebelum demo import dijalankan.
 *
 * Begitu "CKDI Demo Import" dijalankan, halaman berisi widget Elementor
 * (bisa diedit via Pages → Edit with Elementor) dan fallback ini otomatis
 * tidak dipakai lagi.
 *
 * @package CKDI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ============================================================
   DATA DEFAULT (identik dengan widget Elementor & situs live)
   ============================================================ */

function ckdi_fallback_services_data() {
	return array(
		array(
			'icon'  => '🌐',
			'name'  => 'Web Development',
			'img'   => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=600&h=400&fit=crop',
			'desc'  => 'Website responsif & performa tinggi dengan teknologi modern. Dari landing page hingga platform e-commerce kompleks.',
			'tag'   => 'React · Next.js · Laravel',
			'modal' => 'Kami membangun website dan web application dengan standar enterprise. Setiap proyek dimulai dari riset mendalam, desain arsitektur yang solid, hingga implementasi kode berkualitas tinggi. Kami memastikan website Anda cepat, aman, dan scalable untuk mendukung pertumbuhan bisnis.',
			'feats' => array( 'Landing Page & Company Profile', 'E-Commerce & Marketplace', 'Sistem Manajemen (CMS/ERP/CRM)', 'Web Application Custom', 'API Development & Integration', 'Performance Optimization & SEO', 'Hosting & Maintenance' ),
		),
		array(
			'icon'  => '📱',
			'name'  => 'Mobile App',
			'img'   => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=600&h=400&fit=crop',
			'desc'  => 'Aplikasi mobile native & cross-platform untuk iOS dan Android dengan UI/UX yang memukau.',
			'tag'   => 'Flutter · React Native · Swift',
			'modal' => 'Dari ide hingga launch di App Store dan Google Play. Kami mengembangkan aplikasi mobile dengan performa tinggi dan pengalaman pengguna yang seamless. Baik native maupun cross-platform, kami memastikan aplikasi Anda siap bersaing di pasar.',
			'feats' => array( 'Aplikasi iOS & Android Native', 'Cross-Platform (Flutter/React Native)', 'UI/UX Mobile Design', 'Push Notification & Real-time Features', 'Integrasi Payment Gateway', 'Publishing ke App Store & Play Store', 'Maintenance & Update Berkala' ),
		),
		array(
			'icon'  => '🎨',
			'name'  => 'UI/UX Design',
			'img'   => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=600&h=400&fit=crop',
			'desc'  => 'Desain antarmuka yang intuitif dan pengalaman pengguna yang luar biasa untuk produk digital Anda.',
			'tag'   => 'Figma · Adobe XD · Prototyping',
			'modal' => 'Desain bukan hanya soal tampilan, tapi bagaimana pengguna berinteraksi dengan produk Anda. Tim desainer kami menggunakan pendekatan user-centered design untuk menciptakan pengalaman digital yang intuitif, menarik, dan meningkatkan konversi.',
			'feats' => array( 'User Research & Persona Development', 'Wireframing & Information Architecture', 'High-Fidelity UI Design', 'Interactive Prototyping', 'Usability Testing', 'Design System & Style Guide', 'Mobile-First Responsive Design' ),
		),
		array(
			'icon'  => '📊',
			'name'  => 'Digital Marketing',
			'img'   => 'https://images.unsplash.com/photo-1460925895917-90a1b58e7e9c?w=600&h=400&fit=crop',
			'desc'  => 'Strategi pemasaran digital terintegrasi untuk meningkatkan brand awareness dan konversi bisnis Anda.',
			'tag'   => 'SEO · SEM · Social Media',
			'modal' => 'Strategi pemasaran digital yang terukur dan berorientasi hasil. Kami membantu meningkatkan visibilitas online, menjangkau audience yang tepat, dan mengoptimalkan konversi untuk ROI yang maksimal.',
			'feats' => array( 'Search Engine Optimization (SEO)', 'Search Engine Marketing (SEM/Google Ads)', 'Social Media Marketing & Management', 'Content Marketing Strategy', 'Email Marketing & Automation', 'Analytics & Performance Reporting', 'Conversion Rate Optimization (CRO)' ),
		),
		array(
			'icon'  => '🎬',
			'name'  => 'Produksi Konten',
			'img'   => 'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?w=600&h=400&fit=crop',
			'desc'  => 'Video, foto, dan konten kreatif berkualitas tinggi yang merepresentasikan brand Anda secara profesional.',
			'tag'   => 'Video · Photography · Copywriting',
			'modal' => 'Konten berkualitas adalah kunci komunikasi brand yang efektif. Tim kreatif kami menghasilkan video, foto, dan copywriting yang profesional untuk memperkuat identitas brand dan engagement audiens Anda.',
			'feats' => array( 'Video Production (Corporate, Product, Tutorial)', 'Professional Photography', 'Motion Graphics & Animation', 'Copywriting & Content Strategy', 'Social Media Content Creation', 'Brand Storytelling', 'Podcast & Audio Production' ),
		),
		array(
			'icon'  => '🤖',
			'name'  => 'Solusi AI',
			'img'   => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=600&h=400&fit=crop',
			'desc'  => 'Implementasi kecerdasan buatan untuk otomasi bisnis, chatbot cerdas, dan analisis data prediktif.',
			'tag'   => 'ChatGPT · Machine Learning · NLP',
			'modal' => 'Manfaatkan kekuatan kecerdasan buatan untuk mengoptimalkan operasional bisnis Anda. Dari chatbot cerdas hingga analisis prediktif, kami membantu Anda memanfaatkan teknologi AI terkini untuk keunggulan kompetitif.',
			'feats' => array( 'AI Chatbot & Virtual Assistant', 'Machine Learning Model Development', 'Natural Language Processing (NLP)', 'Computer Vision Solutions', 'Predictive Analytics & Data Mining', 'Process Automation (RPA)', 'AI Integration to Existing Systems' ),
		),
	);
}

function ckdi_fallback_portfolio_data() {
	return array(
		array( 'icon' => '🏢', 'category' => 'Web Development', 'name' => 'Platform E-Commerce Premium' ),
		array( 'icon' => '📱', 'category' => 'Mobile App', 'name' => 'Aplikasi Manajemen Logistik' ),
		array( 'icon' => '🎨', 'category' => 'UI/UX & Branding', 'name' => 'Rebranding Perusahaan FMCG' ),
		array( 'icon' => '🤖', 'category' => 'AI Solution', 'name' => 'Chatbot Customer Service Bank' ),
		array( 'icon' => '📊', 'category' => 'Digital Marketing', 'name' => 'Kampanye Digital 500% ROI' ),
		array( 'icon' => '🎬', 'category' => 'Video Production', 'name' => 'Video Korporat Viral 10M Views' ),
	);
}

function ckdi_fallback_pricing_data() {
	return array(
		array(
			'name'     => 'Starter',
			'amount'   => 'Rp 3 Jt',
			'period'   => 'Mulai dari / proyek',
			'features' => array( 'Landing Page Profesional', 'Desain Responsif', 'WhatsApp Integration', '3 Bulan Support', 'Hosting Gratis 1 Tahun' ),
			'featured' => false,
			'badge'    => '',
			'btn'      => 'Pilih Paket',
			'wa'       => 'Halo CKDI, saya tertarik paket Starter',
		),
		array(
			'name'     => 'Professional',
			'amount'   => 'Rp 10 Jt',
			'period'   => 'Mulai dari / proyek',
			'features' => array( 'Website Multi-Halaman', 'CMS + Admin Panel', 'SEO Optimization', 'Integrasi Payment Gateway', '6 Bulan Support Premium', 'Custom Domain' ),
			'featured' => true,
			'badge'    => 'POPULER',
			'btn'      => 'Pilih Paket',
			'wa'       => 'Halo CKDI, saya tertarik paket Professional',
		),
		array(
			'name'     => 'Enterprise',
			'amount'   => 'Custom',
			'period'   => 'Sesuai kebutuhan',
			'features' => array( 'Solusi Enterprise Custom', 'Sistem ERP / CRM', 'Integrasi AI & Otomasi', 'Dedicated Team', '12 Bulan Support', 'SLA Guarantee' ),
			'featured' => false,
			'badge'    => '',
			'btn'      => 'Konsultasi Gratis',
			'wa'       => 'Halo CKDI, saya butuh konsultasi Enterprise',
		),
	);
}

/* ============================================================
   SECTION RENDERERS — markup sama persis dengan widget Elementor
   ============================================================ */

function ckdi_fallback_hero() {
	$floats = array(
		array( '🌐', 'Web Development' ),
		array( '📱', 'Mobile App' ),
		array( '🎨', 'UI/UX Design' ),
		array( '🤖', 'AI Solution' ),
		array( '📊', 'Digital Marketing' ),
		array( '🔐', 'Security' ),
	);
	?>
	<section class="hero" id="home">
		<div class="hero-video">
			<video id="heroVideo" autoplay muted loop playsinline>
				<source src="https://videos.pexels.com/video-files/7649698/7649698-uhd_2560_1440_24fps.mp4" type="video/mp4">
				<source src="https://videos.pexels.com/video-files/7053428/7053428-sd_960_540_24fps.mp4" type="video/mp4">
			</video>
			<div class="hero-video-overlay"></div>
		</div>
		<div class="hero-grid-texture" aria-hidden="true"></div>

		<div class="hero-inner">
			<div class="hero-content">
				<div class="hero-badge"><span class="dot"></span> Solusi Digital Terdepan di Indonesia</div>
				<h1 class="hero-title">
					Wujudkan<br>
					<span class="highlight">Transformasi Digital</span><br>
					Bisnis Anda
				</h1>
				<p class="hero-description">Kami menghadirkan solusi digital premium — mulai dari website profesional, aplikasi mobile, hingga strategi pemasaran digital untuk membawa bisnis Anda ke level berikutnya.</p>
				<div class="hero-actions">
					<a href="#contact" class="btn-primary">Mulai Proyek <span>→</span></a>
					<a href="#portfolio" class="btn-outline">Lihat Portofolio</a>
				</div>
				<div class="hero-stats">
					<div>
						<div class="hero-stat-value" data-count="200">200+</div>
						<div class="hero-stat-label">Proyek Selesai</div>
					</div>
					<div class="hero-stat-divider"></div>
					<div>
						<div class="hero-stat-value" data-count="150">150+</div>
						<div class="hero-stat-label">Klien Puas</div>
					</div>
					<div class="hero-stat-divider"></div>
					<div>
						<div class="hero-stat-value">5.0</div>
						<div class="hero-stat-label">Rating ★</div>
					</div>
				</div>
			</div>

			<div class="hero-visual">
				<div class="hero-thumbnail-wrap">
					<div class="thumbnail-glow"></div>
					<div class="thumbnail-ring"></div>
					<img src="<?php echo esc_url( CKDI_URI . '/assets/img/Thumnail_2.png' ); ?>" alt="Transformasi Digital" class="hero-thumbnail-img">
					<?php foreach ( $floats as $i => $fl ) : ?>
						<div class="float-element float-<?php echo esc_attr( $i + 1 ); ?>" title="<?php echo esc_attr( $fl[1] ); ?>"><?php echo esc_html( $fl[0] ); ?></div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
	<?php
}

function ckdi_fallback_services() {
	?>
	<section class="section section-alt" id="services">
		<div class="section-inner">
			<div class="section-header reveal">
				<div class="section-label">Layanan Kami</div>
				<h2 class="section-title">Solusi Digital untuk Setiap Kebutuhan</h2>
				<p class="section-subtitle">Dari konsep hingga eksekusi, kami siap menjadi partner digital terpercaya untuk bisnis Anda</p>
			</div>
			<div class="services-grid">
				<?php foreach ( ckdi_fallback_services_data() as $svc ) :
					$payload = array(
						'title'    => $svc['name'],
						'image'    => $svc['img'],
						'desc'     => $svc['modal'],
						'features' => $svc['feats'],
					);
					?>
					<div class="service-card reveal" data-service="<?php echo esc_attr( wp_json_encode( $payload ) ); ?>">
						<div class="service-card-image">
							<img src="<?php echo esc_url( $svc['img'] ); ?>" alt="<?php echo esc_attr( $svc['name'] ); ?>" loading="lazy">
							<span class="click-hint">Lihat Detail →</span>
						</div>
						<div class="service-icon"><?php echo esc_html( $svc['icon'] ); ?></div>
						<div class="service-name"><?php echo esc_html( $svc['name'] ); ?></div>
						<div class="service-detail"><?php echo esc_html( $svc['desc'] ); ?></div>
						<span class="service-tag"><?php echo esc_html( $svc['tag'] ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
}

function ckdi_fallback_why() {
	$items = array(
		array( '🏆', 'Tim Berpengalaman', 'Developer, designer, dan marketer berpengalaman dengan rekam jejak proyek nasional dan internasional.' ),
		array( '⚡', 'Delivery Tepat Waktu', 'Komitmen penuh pada timeline proyek dengan manajemen yang terstruktur dan transparan.' ),
		array( '🔒', 'Keamanan Terjamin', 'Standar keamanan tingkat enterprise untuk melindungi data dan aset digital bisnis Anda.' ),
		array( '🎯', 'Solusi Customized', 'Setiap proyek dirancang khusus sesuai kebutuhan unik bisnis Anda, bukan template standar.' ),
	);
	?>
	<section class="section" id="about">
		<div class="section-inner">
			<div class="why-grid">
				<div class="why-visual reveal" id="whyVisual">
					<div class="why-glow"></div>
					<div class="why-image-frame" id="whyFrame">
						<img src="<?php echo esc_url( CKDI_URI . '/assets/img/thumnail_1.png' ); ?>" alt="Kepercayaan yang Terbukti">
					</div>
					<div class="why-particles">
						<span class="why-particle"></span><span class="why-particle"></span><span class="why-particle"></span>
						<span class="why-particle"></span><span class="why-particle"></span><span class="why-particle"></span>
					</div>
				</div>
				<div>
					<div class="section-label">Mengapa Kami</div>
					<h2 class="section-title" style="text-align:left;margin-bottom:2rem;">Kepercayaan yang Terbukti</h2>
					<div class="why-items">
						<?php foreach ( $items as $item ) : ?>
							<div class="why-item reveal">
								<div class="why-icon"><?php echo esc_html( $item[0] ); ?></div>
								<div>
									<div class="why-item-title"><?php echo esc_html( $item[1] ); ?></div>
									<div class="why-item-desc"><?php echo esc_html( $item[2] ); ?></div>
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

function ckdi_fallback_portfolio() {
	?>
	<section class="section section-alt" id="portfolio">
		<div class="section-inner">
			<div class="section-header reveal">
				<div class="section-label">Portofolio</div>
				<h2 class="section-title">Karya Terbaik Kami</h2>
				<p class="section-subtitle">Beberapa proyek unggulan yang telah kami kerjakan untuk klien-klien terpercaya</p>
			</div>
			<div class="portfolio-grid">
				<?php foreach ( ckdi_fallback_portfolio_data() as $card ) : ?>
					<div class="portfolio-card reveal">
						<div class="portfolio-thumb"><?php echo esc_html( $card['icon'] ); ?></div>
						<div class="portfolio-info">
							<div class="portfolio-category"><?php echo esc_html( $card['category'] ); ?></div>
							<div class="portfolio-name"><?php echo esc_html( $card['name'] ); ?></div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
}

function ckdi_fallback_pricing() {
	?>
	<section class="section" id="pricing">
		<div class="section-inner">
			<div class="section-header reveal">
				<div class="section-label">Harga</div>
				<h2 class="section-title">Paket Sesuai Kebutuhan</h2>
				<p class="section-subtitle">Pilih paket yang paling sesuai dengan skala bisnis dan kebutuhan digital Anda</p>
			</div>
			<div class="pricing-grid">
				<?php foreach ( ckdi_fallback_pricing_data() as $card ) : ?>
					<div class="pricing-card reveal<?php echo $card['featured'] ? ' featured' : ''; ?>">
						<?php if ( $card['featured'] && $card['badge'] ) : ?>
							<div class="pricing-badge"><?php echo esc_html( $card['badge'] ); ?></div>
						<?php endif; ?>
						<div class="pricing-name"><?php echo esc_html( $card['name'] ); ?></div>
						<div class="pricing-amount"><?php echo esc_html( $card['amount'] ); ?></div>
						<div class="pricing-period"><?php echo esc_html( $card['period'] ); ?></div>
						<ul class="pricing-features">
							<?php foreach ( $card['features'] as $feature ) : ?>
								<li><?php echo esc_html( $feature ); ?></li>
							<?php endforeach; ?>
						</ul>
						<a href="<?php echo esc_url( ckdi_wa_link( $card['wa'] ) ); ?>" target="_blank" rel="noopener" class="pricing-btn <?php echo $card['featured'] ? 'pricing-btn-primary' : 'pricing-btn-outline'; ?>">
							<?php echo esc_html( $card['btn'] ); ?>
							<span class="wa-icon-inline"><?php echo ckdi_wa_svg( $card['featured'] ? '#fff' : '#25D366', 16 ); // phpcs:ignore ?></span>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
}

function ckdi_fallback_contact() {
	$infos = array(
		array( '🌐', 'Website', 'www.ciptakaryadigital.id', 'https://www.ciptakaryadigital.id', true ),
		array( '📧', 'Email', 'info@ciptakaryadigital.id', 'mailto:info@ciptakaryadigital.id', false ),
		array( '💬', 'WhatsApp', '+62 812-4521-3848', 'https://wa.me/6281245213848', true ),
		array( '📍', 'Lokasi', 'Indonesia', '', false ),
	);
	?>
	<section class="section section-alt" id="contact">
		<div class="section-inner">
			<div class="section-header reveal">
				<div class="section-label">Hubungi Kami</div>
				<h2 class="section-title">Mari Berkolaborasi</h2>
				<p class="section-subtitle">Ceritakan kebutuhan digital Anda dan kami siap memberikan solusi terbaik</p>
			</div>
			<div class="contact-grid">
				<div class="contact-info reveal">
					<?php foreach ( $infos as $info ) : ?>
						<div class="contact-item">
							<div class="contact-icon"><?php echo esc_html( $info[0] ); ?></div>
							<div>
								<div class="contact-item-label"><?php echo esc_html( $info[1] ); ?></div>
								<div class="contact-item-value">
									<?php if ( $info[3] ) : ?>
										<a href="<?php echo esc_url( $info[3] ); ?>"<?php echo $info[4] ? ' target="_blank" rel="noopener"' : ''; ?>><?php echo esc_html( $info[2] ); ?></a>
									<?php else : ?>
										<?php echo esc_html( $info[2] ); ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="contact-form reveal">
					<div class="form-group">
						<label>Nama Lengkap</label>
						<input type="text" placeholder="Masukkan nama Anda" class="ckdi-form-name">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" placeholder="email@bisnis.com" class="ckdi-form-email">
					</div>
					<div class="form-group">
						<label>Layanan yang Diminati</label>
						<select class="ckdi-form-service">
							<option value="">Pilih layanan...</option>
							<option>Web Development</option>
							<option>Mobile App</option>
							<option>UI/UX Design</option>
							<option>Digital Marketing</option>
							<option>Produksi Konten</option>
							<option>Solusi AI</option>
							<option>Konsultasi Enterprise</option>
						</select>
					</div>
					<div class="form-group">
						<label>Pesan</label>
						<textarea placeholder="Ceritakan kebutuhan digital Anda..." class="ckdi-form-message"></textarea>
					</div>
					<button class="btn-primary ckdi-form-submit" style="width:100%;justify-content:center;">Kirim Pesan →</button>
				</div>
			</div>
		</div>
	</section>
	<?php
}

/* ============================================================
   DISPATCHER — render fallback berdasarkan slug halaman
   Return true jika ada section yang dirender.
   ============================================================ */

function ckdi_landing_fallback( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$slug    = $post_id ? get_post_field( 'post_name', $post_id ) : '';

	// Homepage dalam mode "posts" (belum ada page statis) → semua section
	$is_posts_front = is_front_page() && ! get_option( 'page_on_front' );

	// Homepage (front page statis atau slug beranda/home) → semua section
	if ( $is_posts_front || in_array( $slug, array( 'beranda', 'home' ), true ) ) {
		ckdi_fallback_hero();
		ckdi_fallback_services();
		ckdi_fallback_why();
		ckdi_fallback_portfolio();
		ckdi_fallback_pricing();
		ckdi_fallback_contact();
		return true;
	}

	switch ( $slug ) {
		case 'layanan':
		case 'services':
			ckdi_fallback_services();
			return true;
		case 'tentang-kami':
		case 'about':
			ckdi_fallback_why();
			return true;
		case 'portofolio':
		case 'portfolio':
			ckdi_fallback_portfolio();
			return true;
		case 'harga':
		case 'pricing':
			ckdi_fallback_pricing();
			return true;
		case 'kontak':
		case 'contact':
			ckdi_fallback_contact();
			return true;
	}

	return false;
}
