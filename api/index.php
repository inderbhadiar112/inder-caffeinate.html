<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inder Caffeinate – Specialty Coffee</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap"
    rel="stylesheet" />
  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0
    }

    :root {
      --espresso: #1A0A00;
      --roast: #3D1A00;
      --caramel: #C87941;
      --cream: #F9F3EC;
      --milk: #FDF8F3;
      --fog: #E8DDD3;
      --text: #2C1A0E;
      --muted: #8A6A55;
      --white: #FFFFFF;
    }

    html {
      scroll-behavior: smooth
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--milk);
      color: var(--text);
      overflow-x: hidden
    }

    /* NAV */
    nav {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 18px 5%;
      background: rgba(26, 10, 0, 0.92);
      backdrop-filter: blur(12px)
    }

    .nav-logo {
      font-family: 'Playfair Display', serif;
      font-size: 1.5rem;
      color: var(--caramel);
      letter-spacing: 0.04em;
      cursor: pointer
    }

    .nav-logo span {
      color: var(--white);
      font-style: italic
    }

    .nav-links {
      display: flex;
      gap: 28px;
      list-style: none
    }

    .nav-links a {
      color: #ccc;
      text-decoration: none;
      font-size: 0.88rem;
      font-weight: 500;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      transition: color 0.2s
    }

    .nav-links a:hover {
      color: var(--caramel)
    }

    .nav-cart {
      position: relative;
      cursor: pointer;
      background: var(--caramel);
      color: var(--white);
      border: none;
      border-radius: 50px;
      padding: 9px 20px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.85rem;
      font-weight: 600;
      transition: background 0.2s
    }

    .nav-cart:hover {
      background: #a8622e
    }

    .cart-count {
      position: absolute;
      top: -8px;
      right: -8px;
      background: #e63946;
      color: #fff;
      border-radius: 50%;
      width: 20px;
      height: 20px;
      font-size: 0.7rem;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      display: none
    }

    .hamburger {
      display: none;
      flex-direction: column;
      gap: 5px;
      cursor: pointer;
      background: none;
      border: none
    }

    .hamburger span {
      width: 24px;
      height: 2px;
      background: #ccc;
      display: block;
      transition: 0.3s
    }

    /* HERO */
    .hero {
      min-height: 100vh;
      display: flex;
      align-items: center;
      position: relative;
      overflow: hidden
    }

    .hero-bg {
      position: absolute;
      inset: 0;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .hero-img {
      display: none;
    }

    .hero-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(90deg, rgba(10, 4, 0, 0.88) 0%, rgba(26, 10, 0, 0.65) 60%, rgba(0, 0, 0, 0.3) 100%)
    }

    .hero-content {
      position: relative;
      z-index: 2;
      padding: 0 5%;
      max-width: 660px;
      animation: fadeUp 1s ease both
    }

    .hero-eyebrow {
      color: var(--caramel);
      font-size: 0.78rem;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      font-weight: 600;
      margin-bottom: 20px
    }

    .hero-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2.6rem, 5vw, 4.4rem);
      color: var(--white);
      line-height: 1.1;
      margin-bottom: 24px
    }

    .hero-title em {
      color: var(--caramel);
      font-style: italic
    }

    .hero-sub {
      color: #c8b4a5;
      font-size: 1.05rem;
      font-weight: 300;
      line-height: 1.7;
      margin-bottom: 40px;
      max-width: 440px
    }

    .btn-primary {
      display: inline-block;
      background: var(--caramel);
      color: var(--white);
      padding: 15px 36px;
      border-radius: 50px;
      font-weight: 600;
      font-size: 0.9rem;
      letter-spacing: 0.04em;
      text-decoration: none;
      border: none;
      cursor: pointer;
      transition: all 0.25s
    }

    .btn-primary:hover {
      background: #a8622e;
      transform: translateY(-2px);
      box-shadow: 0 8px 28px rgba(200, 121, 65, 0.4)
    }

    .btn-outline {
      display: inline-block;
      border: 2px solid rgba(255, 255, 255, 0.3);
      color: var(--white);
      padding: 13px 32px;
      border-radius: 50px;
      font-weight: 600;
      font-size: 0.9rem;
      letter-spacing: 0.04em;
      text-decoration: none;
      cursor: pointer;
      background: none;
      transition: all 0.25s;
      margin-left: 12px
    }

    .btn-outline:hover {
      border-color: var(--caramel);
      color: var(--caramel)
    }

    .hero-stats {
      display: flex;
      gap: 40px;
      margin-top: 52px
    }

    .stat-num {
      font-family: 'Playfair Display', serif;
      font-size: 2rem;
      color: var(--caramel);
      line-height: 1
    }

    .stat-label {
      font-size: 0.78rem;
      color: #8a7060;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      margin-top: 4px
    }

    /* SECTIONS */
    section {
      padding: 80px 5%
    }

    .section-eyebrow {
      color: var(--caramel);
      font-size: 0.78rem;
      letter-spacing: 0.16em;
      text-transform: uppercase;
      font-weight: 600;
      margin-bottom: 12px
    }

    .section-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.9rem, 3.5vw, 2.8rem);
      color: var(--espresso);
      line-height: 1.2;
      margin-bottom: 20px
    }

    .section-sub {
      color: var(--muted);
      font-size: 1rem;
      line-height: 1.7;
      max-width: 500px
    }

    /* STORY */
    .story {
      background: var(--cream);
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 60px;
      align-items: center
    }

    .story-imgs {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px
    }

    .story-imgs img {
      width: 100%;
      border-radius: 12px;
      object-fit: cover
    }

    .story-imgs img:first-child {
      grid-column: 1/-1;
      height: 220px
    }

    .story-imgs img:nth-child(2),
    .story-imgs img:nth-child(3) {
      height: 140px
    }

    .story-text p {
      color: var(--muted);
      line-height: 1.8;
      margin-bottom: 16px;
      font-size: 0.97rem
    }

    /* MENU */
    .menu-section {
      background: var(--milk)
    }

    .menu-tabs {
      display: flex;
      gap: 8px;
      margin: 32px 0 36px;
      flex-wrap: wrap
    }

    .tab-btn {
      padding: 9px 24px;
      border-radius: 50px;
      border: 2px solid var(--fog);
      background: transparent;
      color: var(--muted);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.85rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s
    }

    .tab-btn.active,
    .tab-btn:hover {
      background: var(--caramel);
      color: #fff;
      border-color: var(--caramel)
    }

    .menu-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
      gap: 24px
    }

    .menu-card {
      background: var(--white);
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 2px 16px rgba(61, 26, 0, 0.08);
      transition: all 0.28s;
      cursor: pointer
    }

    .menu-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 40px rgba(61, 26, 0, 0.16)
    }

    .menu-card-img {
      width: 100%;
      height: 190px;
      object-fit: cover
    }

    .menu-card-body {
      padding: 18px 20px 20px
    }

    .menu-card-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.1rem;
      color: var(--espresso);
      margin-bottom: 6px
    }

    .menu-card-desc {
      font-size: 0.82rem;
      color: var(--muted);
      line-height: 1.55;
      margin-bottom: 14px
    }

    .menu-card-footer {
      display: flex;
      align-items: center;
      justify-content: space-between
    }

    .price {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--caramel)
    }

    .add-btn {
      background: var(--espresso);
      color: #fff;
      border: none;
      border-radius: 50px;
      padding: 8px 18px;
      font-size: 0.8rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
      font-family: 'DM Sans', sans-serif
    }

    .add-btn:hover {
      background: var(--caramel)
    }

    .badge {
      display: inline-block;
      background: var(--cream);
      color: var(--caramel);
      font-size: 0.7rem;
      font-weight: 700;
      padding: 3px 10px;
      border-radius: 50px;
      margin-bottom: 10px;
      letter-spacing: 0.05em;
      text-transform: uppercase
    }

    /* PROCESS */
    .process {
      background: var(--espresso)
    }

    .process .section-title {
      color: var(--white)
    }

    .process .section-eyebrow {
      color: var(--caramel)
    }

    .process .section-sub {
      color: #a08870
    }

    .process-steps {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 32px;
      margin-top: 48px
    }

    .process-step {
      text-align: center
    }

    .step-icon {
      width: 64px;
      height: 64px;
      background: rgba(200, 121, 65, 0.15);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 18px;
      font-size: 1.6rem;
      border: 2px solid rgba(200, 121, 65, 0.3)
    }

    .step-num {
      font-size: 0.7rem;
      color: var(--caramel);
      font-weight: 700;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      margin-bottom: 8px
    }

    .step-title {
      font-family: 'Playfair Display', serif;
      color: var(--white);
      font-size: 1rem;
      margin-bottom: 8px
    }

    .step-desc {
      font-size: 0.82rem;
      color: #7a6050;
      line-height: 1.6
    }

    /* GALLERY */
    .gallery {
      padding: 0;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      grid-template-rows: 240px 240px
    }

    .gallery-item {
      overflow: hidden;
      position: relative;
      cursor: pointer
    }

    .gallery-item:first-child {
      grid-column: span 2;
      grid-row: span 2
    }

    .gallery-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s
    }

    .gallery-item:hover img {
      transform: scale(1.07)
    }

    .gallery-overlay {
      position: absolute;
      inset: 0;
      background: rgba(26, 10, 0, 0);
      transition: 0.3s;
      display: flex;
      align-items: center;
      justify-content: center
    }

    .gallery-item:hover .gallery-overlay {
      background: rgba(26, 10, 0, 0.4)
    }

    .gallery-label {
      color: #fff;
      font-family: 'Playfair Display', serif;
      font-size: 1.1rem;
      opacity: 0;
      transform: translateY(8px);
      transition: 0.3s
    }

    .gallery-item:hover .gallery-label {
      opacity: 1;
      transform: translateY(0)
    }

    /* TESTIMONIALS */
    .testimonials {
      background: var(--cream)
    }

    .testi-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
      margin-top: 44px
    }

    .testi-card {
      background: var(--white);
      padding: 28px;
      border-radius: 16px;
      box-shadow: 0 2px 16px rgba(61, 26, 0, 0.06)
    }

    .stars {
      color: var(--caramel);
      font-size: 1.1rem;
      margin-bottom: 14px
    }

    .testi-text {
      font-size: 0.9rem;
      color: var(--text);
      line-height: 1.7;
      font-style: italic;
      margin-bottom: 18px
    }

    .testi-author {
      display: flex;
      align-items: center;
      gap: 12px
    }

    .testi-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover
    }

    .testi-name {
      font-weight: 600;
      font-size: 0.85rem;
      color: var(--espresso)
    }

    .testi-since {
      font-size: 0.75rem;
      color: var(--muted)
    }

    /* CONTACT */
    .contact {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 60px;
      align-items: start
    }

    .contact-info h3 {
      font-family: 'Playfair Display', serif;
      font-size: 1.6rem;
      color: var(--espresso);
      margin-bottom: 16px
    }

    .contact-info p {
      color: var(--muted);
      line-height: 1.7;
      margin-bottom: 28px
    }

    .contact-detail {
      display: flex;
      align-items: flex-start;
      gap: 14px;
      margin-bottom: 20px
    }

    .contact-icon {
      width: 42px;
      height: 42px;
      background: var(--cream);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      flex-shrink: 0
    }

    .contact-detail h4 {
      font-size: 0.85rem;
      font-weight: 700;
      color: var(--espresso);
      margin-bottom: 3px
    }

    .contact-detail p {
      color: var(--muted);
      font-size: 0.85rem;
      margin: 0
    }

    .contact-form {
      background: var(--white);
      padding: 36px;
      border-radius: 20px;
      box-shadow: 0 4px 24px rgba(61, 26, 0, 0.08)
    }

    .form-group {
      margin-bottom: 18px
    }

    .form-group label {
      display: block;
      font-size: 0.82rem;
      font-weight: 600;
      color: var(--espresso);
      margin-bottom: 7px;
      letter-spacing: 0.04em
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
      width: 100%;
      padding: 12px 16px;
      border: 2px solid var(--fog);
      border-radius: 10px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.9rem;
      color: var(--text);
      background: var(--milk);
      outline: none;
      transition: border-color 0.2s;
      resize: none
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
      border-color: var(--caramel)
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 14px
    }

    .form-success {
      display: none;
      background: #d4edda;
      color: #155724;
      padding: 14px 18px;
      border-radius: 10px;
      font-size: 0.88rem;
      font-weight: 600;
      text-align: center;
      margin-top: 12px
    }

    /* CART SIDEBAR */
    .cart-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
      z-index: 2000;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.3s
    }

    .cart-overlay.open {
      opacity: 1;
      pointer-events: all
    }

    .cart-sidebar {
      position: fixed;
      right: -400px;
      top: 0;
      bottom: 0;
      width: 380px;
      background: var(--white);
      z-index: 2001;
      padding: 28px 24px;
      overflow-y: auto;
      transition: right 0.35s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: -8px 0 40px rgba(0, 0, 0, 0.15)
    }

    .cart-sidebar.open {
      right: 0
    }

    .cart-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 28px
    }

    .cart-header h2 {
      font-family: 'Playfair Display', serif;
      font-size: 1.4rem;
      color: var(--espresso)
    }

    .cart-close {
      background: none;
      border: none;
      font-size: 1.4rem;
      cursor: pointer;
      color: var(--muted)
    }

    .cart-items {
      flex: 1
    }

    .cart-item {
      display: flex;
      gap: 14px;
      align-items: center;
      padding: 16px 0;
      border-bottom: 1px solid var(--fog)
    }

    .cart-item-img {
      width: 58px;
      height: 58px;
      border-radius: 10px;
      object-fit: cover
    }

    .cart-item-info {
      flex: 1
    }

    .cart-item-name {
      font-weight: 600;
      font-size: 0.9rem;
      color: var(--espresso)
    }

    .cart-item-price {
      color: var(--caramel);
      font-size: 0.85rem;
      font-weight: 700;
      margin-top: 3px
    }

    .qty-controls {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-top: 8px
    }

    .qty-btn {
      width: 26px;
      height: 26px;
      border-radius: 50%;
      border: 2px solid var(--fog);
      background: none;
      cursor: pointer;
      font-size: 0.9rem;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
      color: var(--text)
    }

    .qty-btn:hover {
      background: var(--caramel);
      border-color: var(--caramel);
      color: #fff
    }

    .qty-num {
      font-weight: 700;
      font-size: 0.9rem;
      min-width: 20px;
      text-align: center
    }

    .remove-btn {
      background: none;
      border: none;
      color: #ccc;
      cursor: pointer;
      font-size: 1.1rem;
      transition: color 0.2s
    }

    .remove-btn:hover {
      color: #e63946
    }

    .cart-empty {
      text-align: center;
      padding: 40px 0;
      color: var(--muted);
      font-style: italic
    }

    .cart-empty span {
      font-size: 3rem;
      display: block;
      margin-bottom: 12px
    }

    .cart-total {
      margin-top: 24px;
      padding-top: 20px;
      border-top: 2px solid var(--fog)
    }

    .cart-total-row {
      display: flex;
      justify-content: space-between;
      font-size: 0.88rem;
      color: var(--muted);
      margin-bottom: 8px
    }

    .cart-total-final {
      display: flex;
      justify-content: space-between;
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--espresso);
      margin-top: 12px
    }

    .checkout-btn {
      display: block;
      width: 100%;
      background: var(--caramel);
      color: #fff;
      border: none;
      border-radius: 50px;
      padding: 15px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.95rem;
      font-weight: 700;
      cursor: pointer;
      margin-top: 18px;
      transition: background 0.2s;
      letter-spacing: 0.03em
    }

    .checkout-btn:hover {
      background: #a8622e
    }

    /* TOAST */
    .toast {
      position: fixed;
      bottom: 28px;
      left: 50%;
      transform: translateX(-50%) translateY(100px);
      background: var(--espresso);
      color: #fff;
      padding: 14px 28px;
      border-radius: 50px;
      font-size: 0.88rem;
      font-weight: 600;
      z-index: 9999;
      transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
      white-space: nowrap;
      box-shadow: 0 8px 28px rgba(0, 0, 0, 0.25)
    }

    .toast.show {
      transform: translateX(-50%) translateY(0)
    }

    /* FOOTER */
    footer {
      background: var(--espresso);
      color: #a08070;
      padding: 56px 5% 30px
    }

    .footer-grid {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr 1fr;
      gap: 44px;
      margin-bottom: 40px
    }

    .footer-brand .nav-logo {
      display: block;
      margin-bottom: 16px;
      font-size: 1.3rem
    }

    .footer-brand p {
      font-size: 0.85rem;
      line-height: 1.7;
      color: #7a5a4a
    }

    .footer-col h4 {
      color: var(--white);
      font-size: 0.85rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      margin-bottom: 16px
    }

    .footer-col ul {
      list-style: none
    }

    .footer-col li {
      margin-bottom: 10px
    }

    .footer-col a {
      color: #7a5a4a;
      text-decoration: none;
      font-size: 0.85rem;
      transition: color 0.2s
    }

    .footer-col a:hover {
      color: var(--caramel)
    }

    .footer-social {
      display: flex;
      gap: 12px;
      margin-top: 20px
    }

    .social-btn {
      width: 36px;
      height: 36px;
      background: rgba(255, 255, 255, 0.08);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #a08070;
      text-decoration: none;
      font-size: 0.9rem;
      transition: all 0.2s
    }

    .social-btn:hover {
      background: var(--caramel);
      color: #fff
    }

    .footer-bottom {
      border-top: 1px solid rgba(255, 255, 255, 0.07);
      padding-top: 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 12px
    }

    .footer-bottom p {
      font-size: 0.8rem;
      color: #5a3a2a
    }

    /* HOURS */
    .hours-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(200, 121, 65, 0.15);
      border: 1px solid rgba(200, 121, 65, 0.3);
      color: var(--caramel);
      padding: 8px 18px;
      border-radius: 50px;
      font-size: 0.82rem;
      font-weight: 600;
      margin-bottom: 32px
    }

    .dot {
      width: 8px;
      height: 8px;
      background: #4caf50;
      border-radius: 50%;
      animation: pulse 2s infinite
    }

    /* MODAL */
    .modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      z-index: 3000;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.3s
    }

    .modal-overlay.open {
      opacity: 1;
      pointer-events: all
    }

    .modal {
      background: var(--white);
      border-radius: 20px;
      width: 90%;
      max-width: 480px;
      overflow: hidden;
      transform: scale(0.9);
      transition: transform 0.3s
    }

    .modal-overlay.open .modal {
      transform: scale(1)
    }

    .modal-img {
      width: 100%;
      height: 220px;
      object-fit: cover
    }

    .modal-body {
      padding: 28px
    }

    .modal-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.5rem;
      color: var(--espresso);
      margin-bottom: 8px
    }

    .modal-desc {
      color: var(--muted);
      font-size: 0.9rem;
      line-height: 1.7;
      margin-bottom: 20px
    }

    .modal-footer {
      display: flex;
      align-items: center;
      justify-content: space-between
    }

    .modal-price {
      font-size: 1.4rem;
      font-weight: 700;
      color: var(--caramel)
    }

    .modal-close {
      position: absolute;
      top: 16px;
      right: 16px;
      background: rgba(0, 0, 0, 0.4);
      color: #fff;
      border: none;
      border-radius: 50%;
      width: 34px;
      height: 34px;
      font-size: 1rem;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center
    }

    .modal-wrap {
      position: relative
    }

    /* CUSTOM CURSOR */
    body {
      cursor: none;
      /* Hide default cursor */
    }

    .cursor-dot,
    .cursor-outline {
      position: fixed;
      top: 0;
      left: 0;
      transform: translate(-50%, -50%);
      border-radius: 50%;
      z-index: 9999;
      pointer-events: none;
    }

    .cursor-dot {
      width: 8px;
      height: 8px;
      background-color: var(--caramel);
      box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.18), 0 0 12px 2px rgba(200, 121, 65, 0.6);
    }

    .cursor-outline {
      width: 24px;
      height: 24px;
      border: none;
      background: rgba(200, 121, 65, 0.16);
      transition: transform 0.2s ease, background-color 0.2s ease;
    }

    .cursor-outline.hover {
      transform: translate(-50%, -50%) scale(1.15);
      background-color: rgba(200, 121, 65, 0.24);
    }

    /* 3D UI Upgrades */
    #magicCursor {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      pointer-events: none;
      z-index: 999;
    }

    .reveal-hidden {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.8s cubic-bezier(0.2, 0.8, 0.2, 1), transform 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .reveal-visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* Keep btn-primary transition fast for magnetic effect reset */
    .btn-primary,
    .nav-cart {
      transition: background 0.2s, color 0.2s, box-shadow 0.2s, transform 0.1s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(28px)
      }

      to {
        opacity: 1;
        transform: translateY(0)
      }
    }

    @keyframes pulse {

      0%,
      100% {
        opacity: 1
      }

      50% {
        opacity: 0.4
      }
    }

    /* === LARGE SCREENS (1440px+) === */
    @media (min-width: 1440px) {
      .hero-content {
        max-width: 780px
      }

      .menu-grid {
        grid-template-columns: repeat(4, 1fr)
      }
    }

    /* === LAPTOP / SMALL DESKTOP (1024px) === */
    @media (max-width: 1024px) {
      .hero-title {
        font-size: 3.5rem
      }

      .story {
        gap: 40px
      }

      .menu-grid {
        grid-template-columns: repeat(3, 1fr)
      }
    }

    /* === TABLET LANDSCAPE (900px) === */
    @media (max-width: 900px) {

      .story,
      .contact {
        grid-template-columns: 1fr
      }

      .process-steps {
        grid-template-columns: repeat(2, 1fr)
      }

      .testi-grid {
        grid-template-columns: 1fr 1fr
      }

      .gallery {
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(3, 180px)
      }

      .gallery-item:first-child {
        grid-column: span 2;
        grid-row: span 1
      }

      .footer-grid {
        grid-template-columns: 1fr 1fr
      }

      .nav-links,
      .nav-cart {
        display: none
      }

      .hamburger {
        display: flex
      }

      .hero-content {
        margin-top: 60px
      }

      /* Hero background: hide on tablet, show overlay full */
      #hero-vanta {
        background-size: 100% 100%, 90% !important;
        background-position: left top, center 30% !important;
      }
    }

    /* === TABLET PORTRAIT (768px) === */
    @media (max-width: 768px) {
      .hero-title {
        font-size: 2.8rem
      }

      .hero-sub {
        font-size: 0.95rem
      }

      .section-title {
        font-size: 1.8rem
      }

      .menu-grid {
        grid-template-columns: repeat(2, 1fr)
      }

      .process-steps {
        grid-template-columns: repeat(2, 1fr)
      }

      .footer-grid {
        grid-template-columns: 1fr 1fr
      }

      .contact-form {
        padding: 24px
      }

      /* Hero: background full width on tablet */
      #hero-vanta {
        background-image: none !important;
        background-color: #1A0A00 !important;
        filter: none !important;
      }
    }

    /* === MOBILE LARGE (580px) === */
    @media (max-width: 580px) {
      nav {
        padding: 14px 4%
      }

      .nav-logo {
        font-size: 1.2rem
      }

      .hero-title {
        font-size: 2.2rem
      }

      .hero-sub {
        font-size: 0.9rem;
        max-width: 100%
      }

      .hero-stats {
        gap: 20px;
        flex-wrap: wrap
      }

      .hero-content {
        padding: 0 4%
      }

      .btn-primary,
      .btn-outline {
        padding: 12px 24px;
        font-size: 0.85rem
      }

      .btn-outline {
        margin-left: 0;
        margin-top: 12px;
        display: block;
        text-align: center
      }

      .process-steps {
        grid-template-columns: 1fr
      }

      .testi-grid {
        grid-template-columns: 1fr
      }

      .form-row {
        grid-template-columns: 1fr
      }

      .footer-grid {
        grid-template-columns: 1fr
      }

      .gallery {
        grid-template-columns: 1fr;
        grid-template-rows: repeat(5, 180px)
      }

      .gallery-item:first-child {
        grid-column: span 1
      }

      .cart-sidebar {
        width: 100%;
        right: -100%
      }

      section {
        padding: 60px 4%
      }

      .menu-grid {
        grid-template-columns: 1fr 1fr;
        gap: 14px
      }

      .menu-card-img {
        height: 150px
      }

      .testi-card {
        padding: 20px
      }

      .contact {
        gap: 30px
      }

      /* Hero background: hidden on phones */
      #hero-vanta {
        background-image: none !important;
        background-color: #1A0A00 !important;
        filter: none !important;
      }
    }

    /* === MOBILE SMALL (400px) === */
    @media (max-width: 400px) {
      .hero-title {
        font-size: 1.9rem
      }

      .stat-num {
        font-size: 1.5rem
      }

      .menu-grid {
        grid-template-columns: 1fr
      }

      .footer-grid {
        grid-template-columns: 1fr
      }

      .hero-eyebrow {
        font-size: 0.7rem
      }
    }

    /* === TOUCH DEVICE OPTIMIZATION === */
    @media (hover: none) and (pointer: coarse) {
      .menu-card:hover {
        transform: none;
        box-shadow: 0 2px 16px rgba(61, 26, 0, 0.08)
      }

      .gallery-item:hover img {
        transform: none
      }

      .gallery-label {
        opacity: 1;
        transform: translateY(0)
      }

      .gallery-overlay {
        background: rgba(26, 10, 0, 0.35)
      }
    }
  </style>
</head>

<body>

  <!-- CUSTOM CURSOR -->
  <div class="cursor-dot" data-cursor-dot></div>
  <div class="cursor-outline" data-cursor-outline></div>

  <!-- NAV -->
  <nav id="navbar">
    <div class="nav-logo" onclick="scrollTo('#home')">Inder <span>Caffeinate</span></div>
    <ul class="nav-links">
      <li><a href="#home">Home</a></li>
      <li><a href="#story">Our Story</a></li>
      <li><a href="#menu">Menu</a></li>
      <li><a href="#gallery">Gallery</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
    <button class="nav-cart" onclick="openCart()">
      🛒 Cart
      <span class="cart-count" id="cartCount">0</span>
    </button>
    <button class="hamburger" onclick="toggleMobile()">
      <span></span><span></span><span></span>
    </button>
  </nav>

  <!-- HERO -->
  <section class="hero" id="home">
    <div class="hero-bg" id="hero-vanta"
      style="background-color: #a99990; background-image: linear-gradient(to right, #a99990 50%, transparent 55%), url('hero_bg.png'); background-size: 100% 100%, 52%; background-position: left top, right 45%; background-repeat: no-repeat; top: 70px; filter: brightness(1.5) saturate(1.2);">
    </div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <p class="hero-eyebrow">☕ Specialty Coffee · Since 2018</p>
      <h1 class="hero-title">Where Every Cup<br />Tells a <em>Story</em></h1>
      <p class="hero-sub">Hand-crafted brews, single-origin beans, and a warm space to call your own. At Inder
        Caffeinate, coffee is more than a drink — it's a ritual.</p>
      <a href="#menu" class="btn-primary">Explore Our Menu</a>
      <a href="#story" class="btn-outline">Our Story</a>
      <div class="hero-stats">
        <div>
          <div class="stat-num">18+</div>
          <div class="stat-label">Blends</div>
        </div>
        <div>
          <div class="stat-num">4.9★</div>
          <div class="stat-label">Rating</div>
        </div>
        <div>
          <div class="stat-num">12K</div>
          <div class="stat-label">Happy Guests</div>
        </div>
      </div>
    </div>
  </section>

  <!-- STORY -->
  <section class="story" id="story">
    <div class="story-imgs">
      <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=800&auto=format&fit=crop&q=80"
        alt="Coffee roasting" />
      <img
        src="https://substackcdn.com/image/fetch/$s_!DM5I!,w_1456,c_limit,f_webp,q_auto:good,fl_progressive:steep/https%3A%2F%2Fsubstack-post-media.s3.amazonaws.com%2Fpublic%2Fimages%2F13ba540c-1cf0-40a0-84a7-afed0300b5ab_1500x1000.png"
        alt="Barista" />
      <img
        src="https://dropinblog.net/cdn-cgi/image/fit=scale-down,format=auto,width=1200/34248816/files/featured/four_main_types_of_coffee_benas__1_.png"
        alt="Coffee beans" />
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZZCxaFzn_4Hnup0HLlUkseiQ4M2oBiuvzkeekhG1Fuw&s=10"
        alt="Coffee cup" />
    </div>
    <div class="story-text">
      <p class="section-eyebrow">Our Story</p>
      <h2 class="section-title">Brewed with<br />Love since 2018</h2>
      <p>Inder Caffeinate was born from a simple obsession: the perfect cup of coffee. Founded by Inder Singh in a cozy
        corner of the city, we set out to prove that great coffee doesn't need pretension — just passion, precision, and
        the finest beans on earth.</p>
      <p>We source directly from farmers in Ethiopia, Colombia, and Sumatra, roasting every batch in-house to unlock the
        true character of each origin. Every cup you hold was crafted by hands that genuinely care.</p>
      <a href="#menu" class="btn-primary" style="margin-top:12px">Browse the Menu</a>
    </div>
  </section>

  <!-- MENU -->
  <section class="menu-section" id="menu">
    <p class="section-eyebrow">What We Brew</p>
    <h2 class="section-title">Our Menu</h2>
    <div class="menu-tabs">
      <button class="tab-btn active" onclick="filterMenu('all',this)">All</button>
      <button class="tab-btn" onclick="filterMenu('espresso',this)">Espresso</button>
      <button class="tab-btn" onclick="filterMenu('cold',this)">Cold Brews</button>
      <button class="tab-btn" onclick="filterMenu('food',this)">Food</button>
      <button class="tab-btn" onclick="filterMenu('seasonal',this)">Seasonal</button>
    </div>
    <div class="menu-grid" id="menuGrid"></div>
  </section>

  <!-- PROCESS -->
  <section class="process">
    <p class="section-eyebrow">How We Do It</p>
    <h2 class="section-title">From Bean to Cup</h2>
    <p class="section-sub">Every step is intentional. We oversee the entire journey so your cup is never an accident.
    </p>
    <div class="process-steps">
      <div class="process-step">
        <div class="step-icon">🌱</div>
        <div class="step-num">01 · Source</div>
        <div class="step-title">Ethical Sourcing</div>
        <div class="step-desc">Direct trade with small farms in Ethiopia, Colombia & Sumatra at fair, above-market
          prices.</div>
      </div>
      <div class="process-step">
        <div class="step-icon">🔥</div>
        <div class="step-num">02 · Roast</div>
        <div class="step-title">Small-Batch Roasting</div>
        <div class="step-desc">Our in-house roaster profiles each origin to its peak, roasting fresh every 48 hours.
        </div>
      </div>
      <div class="process-step">
        <div class="step-icon">⚗️</div>
        <div class="step-num">03 · Brew</div>
        <div class="step-title">Precision Extraction</div>
        <div class="step-desc">Temperature, grind size, and pressure are calibrated daily by our certified Q Graders.
        </div>
      </div>
      <div class="process-step">
        <div class="step-icon">☕</div>
        <div class="step-num">04 · Serve</div>
        <div class="step-title">Crafted for You</div>
        <div class="step-desc">Each cup is poured to order, served with care, and made to match exactly what you love.
        </div>
      </div>
    </div>
  </section>

  <!-- GALLERY -->
  <div class="gallery" id="gallery">
    <div class="gallery-item"><img
        src="https://images.unsplash.com/photo-1511920170033-f8396924c348?w=800&auto=format&fit=crop&q=80"
        alt="Coffee art" />
      <div class="gallery-overlay"><span class="gallery-label">Latte Art</span></div>
    </div>
    <div class="gallery-item"><img
        src="https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=600&auto=format&fit=crop&q=80"
        alt="Cold brew" />
      <div class="gallery-overlay"><span class="gallery-label">Cold Brew</span></div>
    </div>
    <div class="gallery-item"><img
        src="https://images.unsplash.com/photo-1534040385115-33dcb3acba5b?w=600&auto=format&fit=crop&q=80"
        alt="Pastry" />
      <div class="gallery-overlay"><span class="gallery-label">Fresh Pastries</span></div>
    </div>
    <div class="gallery-item"><img
        src="https://images.unsplash.com/photo-1447933601403-0c6688de566e?w=600&auto=format&fit=crop&q=80"
        alt="Beans" />
      <div class="gallery-overlay"><span class="gallery-label">Single Origin</span></div>
    </div>
    <div class="gallery-item"><img
        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZZCxaFzn_4Hnup0HLlUkseiQ4M2oBiuvzkeekhG1Fuw&s=10"
        alt="Pour over" />
      <div class="gallery-overlay"><span class="gallery-label">Pour Over</span></div>
    </div>
  </div>

  <!-- TESTIMONIALS -->
  <section class="testimonials">
    <div style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:20px;">
      <div>
        <p class="section-eyebrow">What Guests Say</p>
        <h2 class="section-title">Loved by Coffee People</h2>
      </div>
      <button class="btn-outline" style="color:var(--espresso); border-color:var(--espresso)" onclick="document.getElementById('reviewModalOverlay').classList.add('open')">Leave a Review</button>
    </div>
    
    <div class="testi-grid" id="testiGrid">
      <p>Loading reviews...</p>
    </div>
  </section>

  <!-- CONTACT -->
  <section id="contact">
    <div class="contact">
      <div class="contact-info">
        <p class="section-eyebrow">Visit Us</p>
        <h2 class="section-title">Come in for a cup</h2>
        <div class="hours-badge">
          <div class="dot"></div> Open Now · Closes 9 PM
        </div>
        <div class="contact-detail">
          <div class="contact-icon">📍</div>
          <div>
            <h4>Address</h4>
            <p>Dasuya,opposite cambridge int. school,<br> Hoshiarpur District<br />Punjab, 144211</p>
          </div>
        </div>
        <div class="contact-detail">
          <div class="contact-icon">🕐</div>
          <div>
            <h4>Hours</h4>
            <p>Mon–Fri: 7 AM – 9 PM<br />Sat–Sun: 8 AM – 10 PM</p>
          </div>
        </div>
        <div class="contact-detail">
          <div class="contact-icon">📞</div>
          <div>
            <h4>Phone</h4>
            <p>+91 9915803181</p>
          </div>
        </div>
        <div class="contact-detail">
          <div class="contact-icon">✉️</div>
          <div>
            <h4>Email</h4>
            <p>inderbhadiar112@gmail.com</p>
          </div>
        </div>
      </div>
      <div>
        <div class="contact-form">
          <h3 style="font-family:'Playfair Display',serif;color:var(--espresso);margin-bottom:24px;font-size:1.3rem">
            Send us a message</h3>
          <div class="form-row">
            <div class="form-group"><label>First Name</label><input type="text" placeholder="Inder" id="fname" /></div>
            <div class="form-group"><label>Last Name</label><input type="text" placeholder="Singh" id="lname" /></div>
          </div>
          <div class="form-group"><label>Email Address</label><input type="email" placeholder="inder@email.com"
              id="femail" /></div>
          <div class="form-group">
            <label>Subject</label>
            <select id="fsubject">
              <option value="">Select a topic…</option>
              <option>Event Booking</option>
              <option>Catering Enquiry</option>
              <option>Wholesale Beans</option>
              <option>Feedback</option>
              <option>General Question</option>
            </select>
          </div>
          <div class="form-group"><label>Message</label><textarea rows="4" placeholder="Tell us anything…"
              id="fmessage"></textarea></div>
          <button class="btn-primary" style="width:100%;border:none;font-family:'DM Sans',sans-serif;font-size:0.95rem"
            onclick="submitForm()">Send Message ✉️</button>
          <div class="form-success" id="formSuccess">✅ Thanks! We'll reply within 24 hours.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="footer-grid">
      <div class="footer-brand">
        <div class="nav-logo">Inder <span>Caffeinate</span></div>
        <p>Specialty coffee crafted with obsession and served with soul. Where every cup tells a story worth sitting
          down for.</p>
        <div class="footer-social">
          <a class="social-btn" href="#">f</a>
          <a class="social-btn" href="#">in</a>
          <a class="social-btn" href="#">ig</a>
          <a class="social-btn" href="#">yt</a>
        </div>
      </div>
      <div class="footer-col">
        <h4>Menu</h4>
        <ul>
          <li><a href="#menu">Espresso Drinks</a></li>
          <li><a href="#menu">Cold Brews</a></li>
          <li><a href="#menu">Seasonal Specials</a></li>
          <li><a href="#menu">Food & Pastries</a></li>
          <li><a href="#menu">Whole Bean Bags</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Company</h4>
        <ul>
          <li><a href="#story">Our Story</a></li>
          <li><a href="#gallery">Gallery</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="#">Careers</a></li>
          <li><a href="#">Press</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Legal</h4>
        <ul>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Terms of Service</a></li>
          <li><a href="#">Cookie Policy</a></li>
          <li><a href="#">Allergen Info</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© 2024 Inder Caffeinate. All rights reserved.</p>
      <p>Made with ☕ & passion</p>
    </div>
  </footer>

  <!-- CART SIDEBAR -->
  <div class="cart-overlay" id="cartOverlay" onclick="closeCart()"></div>
  <div class="cart-sidebar" id="cartSidebar">
    <div class="cart-header">
      <h2>Your Order</h2>
      <button class="cart-close" onclick="closeCart()">✕</button>
    </div>
    <div id="cartItems"></div>
    <div class="cart-total" id="cartTotal" style="display:none">
      <div class="cart-total-row"><span>Subtotal</span><span id="subtotal">₹0</span></div>
      <div class="cart-total-row"><span>Tax (5%)</span><span id="taxAmt">₹0</span></div>
      <div class="cart-total-final"><span>Total</span><span id="totalAmt">₹0</span></div>
      <button class="checkout-btn" onclick="checkout()">Checkout →</button>
    </div>
  </div>

  <!-- ITEM MODAL -->
  <div class="modal-overlay" id="modalOverlay" onclick="closeModal(event)">
    <div class="modal-wrap">
      <button class="modal-close" onclick="closeModalBtn()">✕</button>
      <div class="modal">
        <img id="modalImg" src="" alt="" class="modal-img" />
        <div class="modal-body">
          <span class="badge" id="modalBadge"></span>
          <h2 class="modal-title" id="modalTitle"></h2>
          <p class="modal-desc" id="modalDesc"></p>
          <div class="modal-footer">
            <div class="modal-price" id="modalPrice"></div>
            <button class="btn-primary" onclick="addFromModal()">Add to Cart</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- REVIEW MODAL -->
  <div class="modal-overlay" id="reviewModalOverlay" onclick="if(event.target===this) this.classList.remove('open')">
    <div class="modal-wrap">
      <button class="modal-close" onclick="document.getElementById('reviewModalOverlay').classList.remove('open')">✕</button>
      <div class="modal" style="padding:30px; background:white;">
        <h2 style="font-family:'Playfair Display',serif; margin-bottom:20px; color:var(--espresso)">Leave a Review</h2>
        <div class="form-group" style="margin-bottom:15px">
          <label style="display:block; margin-bottom:5px; font-weight:600">Name</label>
          <input type="text" id="rAuthor" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
        </div>
        <div class="form-group" style="margin-bottom:15px">
          <label style="display:block; margin-bottom:5px; font-weight:600">Rating (1-5)</label>
          <input type="number" id="rStars" min="1" max="5" value="5" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
        </div>
        <div class="form-group" style="margin-bottom:20px">
          <label style="display:block; margin-bottom:5px; font-weight:600">Review</label>
          <textarea id="rText" rows="4" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; resize:none;"></textarea>
        </div>
        <button class="btn-primary" style="width:100%" onclick="submitRating()">Submit Review</button>
      </div>
    </div>
  </div>

  <!-- TOAST -->
  <div class="toast" id="toast"></div>

  <!-- LIBRARIES (Vanta background disabled to restore static hero image) -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.fog.min.js"></script> -->

  <script>
    let menuItems = [];
    let cart = [];
    let currentModal = null;
    let activeFilter = 'all';

    // Fetch menu from backend
    async function fetchMenu() {
      try {
        const response = await fetch('api.php?action=get_menu');
        const data = await response.json();
        if (data.status === 'success') {
          menuItems = data.data;
          renderMenu();
        } else {
          console.error('Failed to fetch menu:', data.message);
          showToast('Error loading menu items');
        }
      } catch (error) {
        console.error('Error fetching menu:', error);
        showToast('Network error while loading menu');
      }
    }

    async function loadRatings() {
      try {
        const res = await fetch('api.php?action=get_ratings');
        const data = await res.json();
        if(data.status === 'success' && data.data.length > 0) {
          document.getElementById('testiGrid').innerHTML = data.data.map(r => `
            <div class="testi-card">
              <div class="stars" style="color:var(--caramel); font-size:1.2rem; margin-bottom:10px;">${'★'.repeat(r.stars)}${'☆'.repeat(5-r.stars)}</div>
              <p class="testi-text" style="font-style:italic; margin-bottom:15px; color:#555;">"${r.review_text}"</p>
              <div class="testi-author" style="font-weight:600;">— ${r.author_name}</div>
            </div>
          `).join('');
        } else {
          document.getElementById('testiGrid').innerHTML = '<p>No reviews yet. Be the first!</p>';
        }
      } catch (err) {
        document.getElementById('testiGrid').innerHTML = '<p>Error loading reviews.</p>';
      }
    }

    async function submitRating() {
      const author = document.getElementById('rAuthor').value.trim();
      const stars = document.getElementById('rStars').value;
      const review = document.getElementById('rText').value.trim();

      if(!author || !review || stars < 1 || stars > 5) {
        showToast('⚠️ Please fill out all fields correctly.');
        return;
      }

      try {
        const res = await fetch('api.php?action=submit_rating', {
          method: 'POST',
          headers: {'Content-Type': 'application/json'},
          body: JSON.stringify({author, stars, review})
        });
        const data = await res.json();
        if(data.status === 'success') {
          showToast('🎉 Review submitted successfully!');
          document.getElementById('reviewModalOverlay').classList.remove('open');
          document.getElementById('rAuthor').value = '';
          document.getElementById('rText').value = '';
          loadRatings();
        } else {
          showToast('⚠️ Error submitting review.');
        }
      } catch(err) {
        showToast('⚠️ Network error.');
      }
    }

    function renderMenu(filter = 'all') {
      const grid = document.getElementById('menuGrid');
      const filtered = filter === 'all' ? menuItems : menuItems.filter(i => i.cat === filter || i.category === filter);
      grid.innerHTML = filtered.map(item => `
    <div class="menu-card" onclick="openModal(${item.id})">
      <img class="menu-card-img" src="${item.img}" alt="${item.name}" loading="lazy"/>
      <div class="menu-card-body">
        ${item.badge ? `<div class="badge">${item.badge}</div>` : ''}
        <div class="menu-card-title">${item.name}</div>
        <div class="menu-card-desc">${item.description || item.desc}</div>
        <div class="menu-card-footer">
          <div class="price">₹${item.price}</div>
          <button class="add-btn" onclick="event.stopPropagation();addToCart(${item.id})">+ Add</button>
        </div>
      </div>
    </div>
  `).join('');
    }

    function filterMenu(cat, btn) {
      activeFilter = cat;
      document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      renderMenu(cat);
    }

    function addToCart(id) {
      const item = menuItems.find(i => i.id === id);
      const existing = cart.find(c => c.id === id);
      if (existing) existing.qty++;
      else cart.push({ ...item, qty: 1 });
      updateCartUI();
      showToast(`${item.name} added to cart`);
    }

    function removeFromCart(id) {
      cart = cart.filter(c => c.id !== id);
      updateCartUI();
    }

    function updateQty(id, delta) {
      const item = cart.find(c => c.id === id);
      if (!item) return;
      item.qty += delta;
      if (item.qty <= 0) removeFromCart(id);
      else updateCartUI();
    }

    function updateCartUI() {
      const total = cart.reduce((s, c) => s + c.price * c.qty, 0);
      const count = cart.reduce((s, c) => s + c.qty, 0);
      const countEl = document.getElementById('cartCount');
      countEl.textContent = count;
      countEl.style.display = count > 0 ? 'flex' : 'none';

      const itemsEl = document.getElementById('cartItems');
      const totalEl = document.getElementById('cartTotal');
      if (cart.length === 0) {
        itemsEl.innerHTML = '<div class="cart-empty"><span>☕</span>Your cart is empty.<br/>Add something delicious!</div>';
        totalEl.style.display = 'none';
        return;
      }
      itemsEl.innerHTML = cart.map(c => `
    <div class="cart-item">
      <img class="cart-item-img" src="${c.img}" alt="${c.name}"/>
      <div class="cart-item-info">
        <div class="cart-item-name">${c.name}</div>
        <div class="cart-item-price">₹${c.price}</div>
        <div class="qty-controls">
          <button class="qty-btn" onclick="updateQty(${c.id},-1)">−</button>
          <span class="qty-num">${c.qty}</span>
          <button class="qty-btn" onclick="updateQty(${c.id},1)">+</button>
        </div>
      </div>
      <button class="remove-btn" onclick="removeFromCart(${c.id})">🗑</button>
    </div>
  `).join('');
      const tax = Math.round(total * 0.05);
      document.getElementById('subtotal').textContent = '₹' + total;
      document.getElementById('taxAmt').textContent = '₹' + tax;
      document.getElementById('totalAmt').textContent = '₹' + (total + tax);
      totalEl.style.display = 'block';
    }

    function openCart() {
      document.getElementById('cartOverlay').classList.add('open');
      document.getElementById('cartSidebar').classList.add('open');
    }
    function closeCart() {
      document.getElementById('cartOverlay').classList.remove('open');
      document.getElementById('cartSidebar').classList.remove('open');
    }

    async function checkout() {
      if (cart.length === 0) return;
      
      const btn = document.querySelector('.checkout-btn');
      const originalText = btn.innerHTML;
      btn.innerHTML = 'Processing...';
      btn.disabled = true;

      const total = cart.reduce((s,c)=>s+c.price*c.qty,0);
      const tax = Math.round(total*0.05);
      const grandTotal = total + tax;

      try {
        const response = await fetch('api.php?action=submit_order', {
          method: 'POST',
          headers: {'Content-Type': 'application/json'},
          body: JSON.stringify({ cart, total, tax, grandTotal })
        });
        
        const data = await response.json();
        if(data.status === 'success') {
          cart=[];
          updateCartUI();
          closeCart();
          showToast('🎉 Order placed! Thank you for choosing Inder Caffeinate.');
        } else {
          showToast('⚠️ Error placing order. Please try again.');
        }
      } catch (err) {
        showToast('⚠️ Network error. Please try again.');
      } finally {
        btn.innerHTML = originalText;
        btn.disabled = false;
      }
    }

    function openModal(id) {
      const item = menuItems.find(i => i.id === id);
      currentModal = item;
      document.getElementById('modalImg').src = item.img;
      document.getElementById('modalTitle').textContent = item.name;
      document.getElementById('modalDesc').textContent = (item.description || item.desc) + ' Sourced from sustainable farms and crafted to order by our certified baristas.';
      document.getElementById('modalPrice').textContent = '₹' + item.price;
      document.getElementById('modalBadge').textContent = item.badge || 'Menu';
      document.getElementById('modalOverlay').classList.add('open');
    }
    function closeModal(e) {
      if (e.target === document.getElementById('modalOverlay')) closeModalBtn();
    }
    function closeModalBtn() {
      document.getElementById('modalOverlay').classList.remove('open');
    }
    function addFromModal() {
      if (currentModal) addToCart(currentModal.id);
      closeModalBtn();
    }

    function showToast(msg) {
      const t = document.getElementById('toast');
      t.textContent = msg;
      t.classList.add('show');
      setTimeout(() => t.classList.remove('show'), 3000);
    }

    function scrollTo(hash) {
      document.querySelector(hash)?.scrollIntoView({ behavior: 'smooth' });
    }

    function submitForm() {
      const fname = document.getElementById('fname').value.trim();
      const lname = document.getElementById('lname').value.trim();
      const email = document.getElementById('femail').value.trim();
      const subject = document.getElementById('fsubject').value.trim();
      const msg = document.getElementById('fmessage').value.trim();

      if (!fname || !email || !msg) { showToast('⚠️ Please fill in all required fields'); return; }

      document.getElementById('formSuccess').style.display = 'block';
      showToast('Message sent! We\'ll be in touch soon.');

      // Clear form
      document.getElementById('fname').value = '';
      document.getElementById('lname').value = '';
      document.getElementById('femail').value = '';
      document.getElementById('fsubject').value = '';
      document.getElementById('fmessage').value = '';

      setTimeout(() => document.getElementById('formSuccess').style.display = 'none', 5000);
    }

    function toggleMobile() {
      const links = document.querySelector('.nav-links');
      const cartBtn = document.querySelector('.nav-cart');
      if (links.style.display === 'flex') {
        links.style.display = 'none';
        cartBtn.style.display = 'none';
      } else {
        links.style.cssText = 'display:flex;flex-direction:column;position:fixed;top:60px;left:0;right:0;background:rgba(26,10,0,0.97);padding:20px 5%;gap:18px;';
        cartBtn.style.display = 'block';
      }
    }

    // 3D Vanta Background disabled — using static hero image instead
    // If you want the animated background again, uncomment the script includes above
    // and re-enable the VANTA.FOG initialization below.
    /*
    window.addEventListener('DOMContentLoaded', () => {
      if (typeof VANTA !== 'undefined') {
        VANTA.FOG({
          el: "#hero-vanta",
          mouseControls: true,
          touchControls: true,
          gyroControls: false,
          minHeight: 200.00,
          minWidth: 200.00,
          highlightColor: 0xc87941,
          midtoneColor: 0x8a6a55,
          lowlightColor: 0x3d1a00,
          baseColor: 0x1a0a00,
          blurFactor: 0.65,
          speed: 1.5,
          zoom: 1.2
        });
      }
    });
    */

    // Magic Canvas Cursor Trail (Particle Effect)
    const magicCanvas = document.createElement('canvas');
    magicCanvas.id = 'magicCursor';
    document.body.appendChild(magicCanvas);
    const magicCtx = magicCanvas.getContext('2d');
    let magicParticles = [];

    function resizeMagicCanvas() {
      magicCanvas.width = window.innerWidth;
      magicCanvas.height = window.innerHeight;
    }
    window.addEventListener('resize', resizeMagicCanvas);
    resizeMagicCanvas();

    // Elegant coffee-themed colors for a professional look
    const magicColors = ['#C87941', '#8A6A55', '#E8DDD3', '#3D1A00'];

    class MagicParticle {
      constructor(x, y) {
        this.x = x + (Math.random() - 0.5) * 6; // Tighter, subtle spread
        this.y = y + (Math.random() - 0.5) * 6;
        this.size = Math.random() * 1.8 + 0.5; // Smaller, elegant size
        this.speedX = Math.random() * 0.8 - 0.4; // Gentle movement
        this.speedY = Math.random() * 0.8 - 0.4;
        this.color = magicColors[Math.floor(Math.random() * magicColors.length)];
        this.life = 1;
        this.decay = Math.random() * 0.03 + 0.015; // Smooth fade
      }
      update() {
        this.x += this.speedX;
        this.y += this.speedY;
        this.life -= this.decay;
        this.size *= 0.99;
      }
      draw() {
        magicCtx.globalAlpha = Math.max(0, this.life);
        magicCtx.fillStyle = this.color;
        // Simple, clean circles for a professional touch (fast enough without shadowBlur)
        magicCtx.beginPath();
        magicCtx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        magicCtx.fill();
      }
    }

    let lastMousePos = { x: null, y: null };
    window.addEventListener('mousemove', (e) => {
      const currentMouse = { x: e.clientX, y: e.clientY };

      if (lastMousePos.x !== null) {
        const dx = currentMouse.x - lastMousePos.x;
        const dy = currentMouse.y - lastMousePos.y;
        const distance = Math.sqrt(dx * dx + dy * dy);
        const steps = Math.max(1, Math.floor(distance / 6)); // Smooth trail spacing

        for (let i = 0; i < steps; i++) {
          const x = lastMousePos.x + (dx * i) / steps;
          const y = lastMousePos.y + (dy * i) / steps;
          for (let j = 0; j < 2; j++) {
            magicParticles.push(new MagicParticle(x, y));
          }
        }
      }

      lastMousePos = currentMouse;
    });

    function animateMagicParticles() {
      magicCtx.clearRect(0, 0, magicCanvas.width, magicCanvas.height);
      magicCtx.globalCompositeOperation = 'source-over'; // Natural blending, not artificial glow
      for (let i = 0; i < magicParticles.length; i++) {
        magicParticles[i].update();
        magicParticles[i].draw();
      }
      magicParticles = magicParticles.filter(p => p.life > 0 && p.size > 0.1);
      requestAnimationFrame(animateMagicParticles);
    }
    animateMagicParticles();

    // Scroll Reveal (Intersection Observer)
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('reveal-visible');
        }
      });
    }, { threshold: 0.1 });

    document.querySelectorAll('section, .menu-card, .gallery-item').forEach(el => {
      el.classList.add('reveal-hidden');
      observer.observe(el);
    });

    // Magnetic Buttons
    const magneticEls = document.querySelectorAll('.btn-primary, .nav-cart');
    magneticEls.forEach(el => {
      el.addEventListener('mousemove', (e) => {
        const rect = el.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top - rect.height / 2;
        el.style.transform = `translate(${x * 0.3}px, ${y * 0.3}px)`;
      });
      el.addEventListener('mouseleave', () => {
        el.style.transform = 'translate(0px, 0px)';
      });
    });

    // Init
    fetchMenu();
    loadRatings();
    updateCartUI();

    // Smooth nav highlight
    window.addEventListener('scroll', () => {
      const nav = document.getElementById('navbar');
      nav.style.boxShadow = window.scrollY > 50 ? '0 4px 20px rgba(0,0,0,0.3)' : 'none';
    });

    // Custom Reactive Cursor (Original Dot & Outline)
    const cursorDot = document.querySelector('[data-cursor-dot]');
    const cursorOutline = document.querySelector('[data-cursor-outline]');

    window.addEventListener('mousemove', function (e) {
      const posX = e.clientX;
      const posY = e.clientY;

      cursorDot.style.left = `${posX}px`;
      cursorDot.style.top = `${posY}px`;

      cursorOutline.animate({
        left: `${posX}px`,
        top: `${posY}px`
      }, { duration: 500, fill: "forwards" });
    });

    // Add hover effect to clickable elements
    const interactables = document.querySelectorAll('a, button, input, textarea, select, .menu-card, .gallery-item, .nav-logo');
    interactables.forEach(el => {
      el.addEventListener('mouseenter', () => {
        cursorOutline.classList.add('hover');
      });
      el.addEventListener('mouseleave', () => {
        cursorOutline.classList.remove('hover');
      });
    });
  </script>
</body>

</html>