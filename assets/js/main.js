/* ============================================================
   CKDI THEME — Main JavaScript
   Porting dari landing page + integrasi WordPress (chatbot via admin-ajax)
   ============================================================ */
(function () {
	'use strict';

	var ckdiInitDone = false;
	var scanRevealsFn = function () {}; // diisi oleh initCKDI

	function initCKDI() {
		if (ckdiInitDone) { return; }
		ckdiInitDone = true;

		var html = document.documentElement;

		/* ── Theme Toggle ── */
		var themeToggle = document.getElementById('themeToggle');
		var themeIcon = document.getElementById('themeIcon');
		var savedTheme = 'dark';
		try { savedTheme = localStorage.getItem('ckdi-theme') || 'dark'; } catch (e) {}
		html.setAttribute('data-theme', savedTheme);
		updateThemeIcon(savedTheme);

		if (themeToggle) {
			themeToggle.addEventListener('click', function () {
				var next = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
				html.setAttribute('data-theme', next);
				try { localStorage.setItem('ckdi-theme', next); } catch (e) {}
				updateThemeIcon(next);
			});
		}

		function updateThemeIcon(theme) {
			if (themeIcon) { themeIcon.textContent = theme === 'dark' ? '🌙' : '☀️'; }
		}

		/* ── Mobile Menu ── */
		var menuToggle = document.getElementById('menuToggle');
		var navLinks = document.getElementById('navLinks');
		if (menuToggle && navLinks) {
			menuToggle.addEventListener('click', function () {
				var open = navLinks.classList.toggle('open');
				menuToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
			});
		}

		/* ── Navbar Scroll ── */
		var navbar = document.getElementById('navbar');
		var ticking = false;
		window.addEventListener('scroll', function () {
			if (!ticking) {
				requestAnimationFrame(function () {
					if (navbar) { navbar.classList.toggle('scrolled', window.scrollY > 60); }
					ticking = false;
				});
				ticking = true;
			}
		}, { passive: true });

		/* ── Smooth Scroll (anchor di halaman yang sama saja) ── */
		document.addEventListener('click', function (e) {
			var a = e.target.closest('a[href^="#"]');
			if (!a) { return; }
			var href = a.getAttribute('href');
			if (!href || href === '#' || href.length < 2) { return; }
			var target = document.querySelector(href);
			if (target) {
				e.preventDefault();
				target.scrollIntoView({ behavior: 'smooth', block: 'start' });
				if (navLinks) { navLinks.classList.remove('open'); }
			}
		});

		/* ── Scroll Reveal (idempotent — aman untuk Elementor re-render) ── */
		var revealObserver = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('visible');
					revealObserver.unobserve(entry.target);
				}
			});
		}, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

		function scanReveals() {
			document.querySelectorAll('.reveal:not(.visible)').forEach(function (el) {
				revealObserver.observe(el);
			});
		}
		scanReveals();
		scanRevealsFn = scanReveals;
		window.CKDIscanReveals = scanReveals;

		/* ── Custom Cursor ── */
		var dot = document.getElementById('cursorDot');
		var ring = document.getElementById('cursorRing');
		var mx = 0, my = 0, rx = 0, ry = 0, cursorVisible = false;

		document.addEventListener('mousemove', function (e) {
			mx = e.clientX; my = e.clientY;
			if (dot) { dot.style.left = mx + 'px'; dot.style.top = my + 'px'; }
			if (ring && !cursorVisible) { ring.classList.add('visible'); cursorVisible = true; }
		});

		(function animCursor() {
			if (ring) {
				rx += (mx - rx) * 0.12;
				ry += (my - ry) * 0.12;
				ring.style.left = rx + 'px';
				ring.style.top = ry + 'px';
			}
			requestAnimationFrame(animCursor);
		})();

		document.addEventListener('mouseover', function (e) {
			if (!ring) { return; }
			if (e.target.closest('a, button, .service-card, .portfolio-card, input, textarea, select')) {
				ring.classList.add('hovering');
			} else {
				ring.classList.remove('hovering');
			}
		});

		/* ── Why Us Parallax ── */
		var whySection = document.getElementById('about');
		if (whySection) {
			var whyFrame = document.getElementById('whyFrame');
			var whyParticles = whySection.querySelectorAll('.why-particle');
			var whyTicking = false;
			whySection.addEventListener('mousemove', function (e) {
				if (whyTicking) { return; }
				whyTicking = true;
				requestAnimationFrame(function () {
					var rect = whySection.getBoundingClientRect();
					var x = (e.clientX - rect.left) / rect.width - 0.5;
					var y = (e.clientY - rect.top) / rect.height - 0.5;
					if (whyFrame) {
						whyFrame.style.transform = 'translateY(-20px) translateX(' + (x * 20) + 'px) rotate(' + (x * 3) + 'deg)';
					}
					whyParticles.forEach(function (p, i) {
						var sp = (i + 1) * 8;
						p.style.transform = 'translate(' + (x * sp) + 'px, ' + (y * sp) + 'px)';
					});
					whyTicking = false;
				});
			});
			whySection.addEventListener('mouseleave', function () {
				if (whyFrame) { whyFrame.style.transform = ''; }
				whyParticles.forEach(function (p) { p.style.transform = ''; });
			});
		}

		/* ── Hero Parallax ── */
		var heroEl = document.getElementById('home');
		if (heroEl) {
			var heroTicking = false;
			heroEl.addEventListener('mousemove', function (e) {
				if (heroTicking) { return; }
				heroTicking = true;
				requestAnimationFrame(function () {
					var rect = heroEl.getBoundingClientRect();
					var x = (e.clientX - rect.left) / rect.width - 0.5;
					var y = (e.clientY - rect.top) / rect.height - 0.5;
					var thumb = heroEl.querySelector('.hero-thumbnail-img');
					var floats = heroEl.querySelectorAll('.float-element');
					if (thumb) {
						thumb.style.transform = 'translateY(-22px) translateX(' + (x * 15) + 'px) rotate(' + (x * 2) + 'deg)';
					}
					floats.forEach(function (el, i) {
						var sp = (i + 1) * 5;
						el.style.transform = 'translate(' + (x * sp) + 'px, ' + (y * sp) + 'px) rotate(' + (x * 8) + 'deg)';
					});
					heroTicking = false;
				});
			});
		}

		/* ── Counter Animation ── */
		function animateCounters() {
			document.querySelectorAll('[data-count]').forEach(function (el) {
				if (el.dataset.counted) { return; }
				el.dataset.counted = '1';
				var target = parseInt(el.dataset.count, 10);
				var current = 0;
				var step = Math.ceil(target / 50);
				var timer = setInterval(function () {
					current += step;
					if (current >= target) { current = target; clearInterval(timer); }
					el.textContent = current + '+';
				}, 30);
			});
		}
		setTimeout(animateCounters, 1200);

		/* ── Video Background ── */
		var heroVideo = document.getElementById('heroVideo');
		if (heroVideo) {
			heroVideo.playbackRate = 0.7;
			var videoObserver = new IntersectionObserver(function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						heroVideo.play().catch(function () {});
					} else {
						heroVideo.pause();
					}
				});
			}, { threshold: 0.1 });
			videoObserver.observe(heroVideo);
		}

		/* ── Service Modal (delegated — data dari atribut kartu) ── */
		var modal = document.getElementById('serviceModal');
		if (modal) {
			document.addEventListener('click', function (e) {
				var card = e.target.closest('.service-card[data-service]');
				if (card) {
					try {
						var data = JSON.parse(card.getAttribute('data-service'));
						var mImage = document.getElementById('modalImage');
						var mTitle = document.getElementById('modalTitle');
						var mDesc = document.getElementById('modalDesc');
						var mFeatures = document.getElementById('modalFeatures');
						if (mImage) { mImage.src = data.image || ''; mImage.alt = data.title || ''; }
						if (mTitle) { mTitle.textContent = data.title || ''; }
						if (mDesc) { mDesc.textContent = data.desc || ''; }
						if (mFeatures) {
							mFeatures.innerHTML = '';
							(data.features || []).forEach(function (f) {
								var li = document.createElement('li');
								li.textContent = f;
								mFeatures.appendChild(li);
							});
						}
						modal.classList.add('open');
						document.body.style.overflow = 'hidden';
					} catch (err) { /* data tidak valid */ }
					return;
				}
				if (e.target.closest('[data-close-modal]') || e.target === modal) {
					closeModal();
				}
			});
			document.addEventListener('keydown', function (e) {
				if (e.key === 'Escape') { closeModal(); }
			});
		}

		function closeModal() {
			if (modal) { modal.classList.remove('open'); }
			document.body.style.overflow = '';
		}

		/* ── Chatbot (via admin-ajax proxy → Groq) ── */
		var chatTrigger = document.getElementById('chatTrigger');
		var chatPanel = document.getElementById('chatPanel');
		var chatInput = document.getElementById('chatInput');
		var chatSend = document.getElementById('chatSend');
		var chatBody = document.getElementById('chatBody');
		var chatOpen = false;

		function toggleChat() {
			chatOpen = !chatOpen;
			if (chatPanel) { chatPanel.classList.toggle('open', chatOpen); }
			if (chatOpen && chatInput) { chatInput.focus(); }
		}

		if (chatTrigger) {
			chatTrigger.addEventListener('click', toggleChat);
			document.querySelectorAll('[data-chat-toggle]').forEach(function (btn) {
				btn.addEventListener('click', toggleChat);
			});
		}

		function sendChat() {
			if (!chatInput || !chatBody) { return; }
			var msg = chatInput.value.trim();
			if (!msg) { return; }
			chatInput.value = '';

			var userBubble = document.createElement('div');
			userBubble.className = 'chatbot-bubble user';
			userBubble.textContent = msg;
			chatBody.appendChild(userBubble);

			var typingDiv = document.createElement('div');
			typingDiv.className = 'chatbot-bubble bot';
			typingDiv.innerHTML = '<div class="typing-indicator"><span></span><span></span><span></span></div>';
			chatBody.appendChild(typingDiv);
			chatBody.scrollTop = chatBody.scrollHeight;

			var history = [];
			chatBody.querySelectorAll('.chatbot-bubble').forEach(function (b) {
				if (b === typingDiv) { return; }
				history.push({
					role: b.classList.contains('bot') ? 'assistant' : 'user',
					content: b.textContent
				});
			});

			var formData = new FormData();
			formData.append('action', 'ckdi_chat');
			formData.append('nonce', window.ckdiData ? window.ckdiData.nonce : '');
			formData.append('history', JSON.stringify(history));

			fetch((window.ckdiData ? window.ckdiData.ajaxUrl : '/wp-admin/admin-ajax.php'), {
				method: 'POST',
				body: formData
			})
				.then(function (res) { return res.json(); })
				.then(function (json) {
					typingDiv.innerHTML = (json && json.data && json.data.reply)
						? json.data.reply
						: 'Maaf, ada gangguan. Silakan hubungi kami via WhatsApp.';
					chatBody.scrollTop = chatBody.scrollHeight;
				})
				.catch(function () {
					typingDiv.innerHTML = 'Maaf, layanan AI sementara tidak tersedia. Hubungi kami via WhatsApp.';
					chatBody.scrollTop = chatBody.scrollHeight;
				});
		}

		if (chatSend) { chatSend.addEventListener('click', sendChat); }
		if (chatInput) {
			chatInput.addEventListener('keydown', function (e) {
				if (e.key === 'Enter') { sendChat(); }
			});
		}

		/* ── Contact Form → WhatsApp ── */
		document.addEventListener('click', function (e) {
			var btn = e.target.closest('.ckdi-form-submit');
			if (!btn) { return; }
			var wrap = btn.closest('.contact-form');
			if (!wrap) { return; }

			var name = wrap.querySelector('.ckdi-form-name') ? wrap.querySelector('.ckdi-form-name').value : '';
			var email = wrap.querySelector('.ckdi-form-email') ? wrap.querySelector('.ckdi-form-email').value : '';
			var service = wrap.querySelector('.ckdi-form-service') ? wrap.querySelector('.ckdi-form-service').value : '';
			var message = wrap.querySelector('.ckdi-form-message') ? wrap.querySelector('.ckdi-form-message').value : '';

			if (!name || !email) { alert('Mohon isi nama dan email Anda.'); return; }

			var wa = 'Halo CKDI! 👋\n\nNama: ' + name + '\nEmail: ' + email + '\nLayanan: ' + (service || 'Belum dipilih') + '\nPesan: ' + (message || 'Ingin konsultasi');
			var number = window.ckdiData && window.ckdiData.waNumber ? window.ckdiData.waNumber : '6281245213848';
			window.open('https://wa.me/' + number + '?text=' + encodeURIComponent(wa), '_blank');
		});
	}

	/* Elementor editor preview: re-scan reveal saat widget dirender ulang */
	function watchElementor() {
		if (window.elementorFrontend && window.elementorFrontend.hooks) {
			window.elementorFrontend.hooks.addAction('frontend/element_ready/global', function () {
				scanRevealsFn();
			});
		}
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', function () { initCKDI(); watchElementor(); });
	} else {
		initCKDI();
		watchElementor();
	}
})();
