<?php
// index.php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halo Dentist | Klinik Gigi Ceria</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fff8fc;
      color: #333;
      line-height: 1.6;
    }

    header {
      background: linear-gradient(135deg, #ffb6d9, #ffcce7);
      padding: 40px 20px;
      text-align: center;
      color: #8a054b;
    }

    header h1 {
      font-size: 2.5rem;
    }

    header p {
      font-style: italic;
      margin-top: 10px;
      font-size: 1.1rem;
    }

    nav {
      display: flex;
      justify-content: center;
      gap: 20px;
      background-color: #fff0f5;
      padding: 15px 0;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    nav a {
      text-decoration: none;
      font-weight: 600;
      color: #d63384;
      padding: 8px 18px;
      border-radius: 20px;
      transition: background 0.3s;
    }

    nav a:hover {
      background-color: #ffd6e9;
    }

    .hero-promo {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
      padding: 60px 20px;
      background: linear-gradient(135deg, #ffe6ef, #fff0f5);
      color: #5b0a42;
    }

    .hero-promo-text {
      flex: 1;
      max-width: 600px;
    }

    .hero-promo-text h1 {
      font-size: 2.2rem;
      color: #c2185b;
    }

    .hero-promo-text h2 {
      font-size: 1.5rem;
      margin-top: 10px;
      color: #8a054b;
    }

    .hero-promo-text p {
      margin-top: 15px;
      font-size: 1rem;
      color: #555;
    }

    .hero-promo-text ul {
      margin: 15px 0;
      padding-left: 20px;
      color: #333;
    }

    .hero-promo-text ul li {
      margin-bottom: 8px;
    }

    .btn-cta {
      display: inline-block;
      margin-top: 15px;
      background-color: #ff69b4;
      color: #fff;
      padding: 12px 24px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
      transition: background 0.3s;
    }

    .btn-cta:hover {
      background-color: #e351a0;
    }

    .hero-promo-image {
      flex: 1;
      text-align: center;
    }

    .hero-promo-image img {
      max-width: 100%;
      height: auto;
      border-radius: 16px;
    }

    .note {
      font-size: 0.8rem;
      color: #999;
      margin-top: 10px;
    }

    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
      padding: 40px 20px;
      max-width: 1100px;
      margin: auto;
    }

    .card {
      background: #fff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      transition: all 0.4s ease;
      color: #333;
    }

    .card:hover {
      transform: scale(1.02);
    }

    .card h3 {
      color: #c2185b;
      margin-bottom: 15px;
    }

    .card a {
      display: inline-block;
      margin-top: 10px;
      background-color: #ff69b4;
      color: #fff;
      padding: 10px 16px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    .card a:hover {
      background-color: #ff4081;
    }

    footer {
      text-align: center;
      padding: 20px;
      background: linear-gradient(135deg, #ffdce9, #ffe6f1);
      color: #b3005e;
      margin-top: 40px;
      font-weight: 600;
    }

    iframe {
      border-radius: 12px;
      width: 100%;
    }

    @media (max-width: 768px) {
      .hero-promo {
        flex-direction: column;
        text-align: center;
      }

      .hero-promo-text {
        margin-bottom: 30px;
      }
    }
  </style>
</head>
<body>
  <header>
    <h1>🦷 Halo Dentist</h1>
    <p>Meet your Personal Dentist!</p>
  </header>

  <nav>
    <a href="#login"><i class="fas fa-sign-in-alt"></i> Login</a>
    <a href="#tentang"><i class="fas fa-info-circle"></i> Tentang</a>
    <a href="#jadwal"><i class="fas fa-calendar-alt"></i> Jadwal</a>
    <a href="#kontak"><i class="fas fa-phone"></i> Kontak</a>
  </nav>

  <section class="hero-promo">
    <div class="hero-promo-text">
      <h1>🎉 Happy 2nd Anniversary Promo</h1>
      <h2>Braces Treatment by Profesional</h2>
      <p>Diskon hingga <strong>Rp2.499.000</strong> + Free Pencetakan</p>
      <ul>
        <li>✔ Scaling (Weekdays) Rp 199.ooo</li>
        <li>✔ Whitening (inc.Scaling) Rp 799.000</li>
        <li>✔ All Treatment Disc 10%!</li>
      </ul>
      <a href="#kontak" class="btn-cta">Daftar Sekarang</a>
      <p class="note">*S&K berlaku | Berlaku di cabang tertentu</p>
    </div>
    <div class="hero-promo-image">
      <img src="dics halo dentist.jpg" alt="Promo Gigi" />
    </div>
  </section>

  <section class="cards" id="login">
  <div class="card">
    <h3>👨‍💼 Admin</h3>
    <a href="auth/login.php">Login Admin</a>
  </div>
  <div class="card">
    <h3>👤 Pasien</h3>
    <a href="patient/login_patient.php">Login Pasien</a><br>
    <a href="patient/register_patient.php">Daftar di sini</a>
  </div>
  <div class="card">
    <h3>👨‍⚕️ Dokter</h3>
    <a href="doctor/login_doctor.php">Login Dokter</a><br>
    <a href="doctor/register_doctor.php">Daftar di sini</a>
  </div>
</section>


  <section class="cards" id="tentang">
    <div class="card">
      <h3>✨ Tentang Kami</h3>
      <p>Halo Dentist telah dipercaya melayani pasien di Indonesia dengan layanan profesional dan dokter berpengalaman. Kami hadir di berbagai lokasi untuk kenyamanan dan senyum sehat Anda.</p>
    </div>
  </section>

  <section class="cards" id="jadwal">
    <div class="card">
      <h3>🗓 Jadwal Dokter</h3>
      <p>
        - drg. Puti: Selasa & Rabu (10.00–15.30), Sabtu (15.00–20.00)<br>
        - drg. Rahmah: Selasa (15.30–20.00), Kamis (10.00–15.00), Jumat & Minggu (10.00–20.00)<br>
        - drg. Miya: Rabu & Kamis (15.30–20.00), Sabtu (10.00–15.00)<br>
        - drg. Najla (Sp. BM): By Appointment
      </p>
    </div>
  </section>

  <section class="cards" id="kontak">
    <div class="card">
      <h3><i class="fas fa-map-marker-alt"></i> Kontak & Lokasi</h3>
      <p>
        Alamat: Jl. Duta Boulevard Barat No.6 Blok F, Harapan Baru, Bekasi Utara, 17123<br>
        Telp: 0858-3446-4821<br>
        Email: halodentist1@gmail.com
      </p>
      <div style="margin-top:15px;">
        <iframe
          src="https://www.google.com/maps/embed?..."
          height="250" style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 Halo Dentist · Senyum Ceria untuk Semua 🦷</p>
  </footer>
</body>
</html>
