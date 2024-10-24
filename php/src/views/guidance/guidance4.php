<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/public/styles/guidance/guidance.css">
    </head>
    <body>
        <div class="navbar">
            <?php include __DIR__ . '/../navbar/navbar.php'; ?>
        </div>

        <nav class="navigation-bar">
            <div class="hamburger-menu" id="hamburger-menu">
                <i class="fas fa-bars"></i>
            </div>
            <ul class="nav-links" id="nav-links">
                <li>
                    <div class="search-bar">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Title, skill or company">
                    </div>
                </li>
                <li>
                    <div class="nav-item">
                        <i class="fas fa-home"></i>
                        <a href="/home">Home</a>
                    </div>
                </li>
                <li>
                    <div class="nav-item">
                        <a href="/jobhistory">
                            <i class="fas fa-address-card"></i>
                            <span class="nav-text">History</span>
                        </a>
                    </div>
                </li>
                <li>
                    <a href="/signout" class="nav-item-link">
                        <div class="nav-item">
                            <i class='fas fa-sign-out-alt'></i>
                            <span>Sign Out</span>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="main-container">
            <div class="container">
                <div class="guidance">
                    <h1> I need job search tips</h1>
                    <div class="tip">
                        <h4>1. Tentukan Tujuan Karir yang Jelas</h4>
                        <p>Sebelum memulai pencarian, pastikan Anda tahu jenis pekerjaan yang Anda inginkan dan bidang yang sesuai dengan keterampilan serta minat Anda. Fokuskan pencarian Anda pada pekerjaan yang sesuai dengan keahlian, pengalaman, dan tujuan karir Anda untuk meningkatkan peluang keberhasilan.</p>
                    </div>
                    <div class="tip">
                        <h4>2. Luaskan Jaringan Anda</h4>
                        <p>Koneksi seringkali menjadi kunci dalam menemukan pekerjaan yang tidak diiklankan secara publik. Berinteraksi dengan profesional lain dalam bidang yang Anda minati, baik melalui LinkedIn, acara networking, atau komunitas industri. Jaringan yang kuat dapat membuka peluang kerja yang lebih luas.</p>
                    </div>
                    <div class="tip">
                        <h4>3. Manfaatkan Portal Pencari Kerja</h4>
                        <p>Gunakan berbagai platform pencari kerja seperti LinkedIn, Indeed, Glassdoor, dan platform lokal lainnya. Buat pemberitahuan otomatis agar Anda mendapatkan update pekerjaan yang sesuai dengan kualifikasi Anda. Ini membantu Anda merespons lowongan lebih cepat.</p>
                    </div>
                    <div class="tip">
                        <h4>4. Pantau Perkembangan Industri</h4>
                        <p>Tetap up-to-date dengan tren terbaru dalam industri yang Anda lamar. Ikuti berita industri, sertifikasi baru, atau keterampilan yang sedang diminati. Ini tidak hanya membantu saat wawancara, tetapi juga menunjukkan bahwa Anda tetap relevan dan siap beradaptasi dengan perubahan industri.</p>
                    </div>
                    <div class="tip">
                        <h4>5. Tetap Positif dan Konsisten</h4>
                        <p>Mencari pekerjaan bisa menjadi proses yang panjang dan menantang. Tetaplah berpikir positif dan konsisten dalam upaya Anda. Jangan menyerah jika Anda tidak langsung mendapatkan pekerjaan yang diinginkan, dan terus perbarui pendekatan Anda jika diperlukan.</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="/public/scripts/navbar/navbar-responsive.js"></script>
</html>
