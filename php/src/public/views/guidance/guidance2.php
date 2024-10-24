<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/public/views/guidance/guidance.css">
    </head>
    <body>
        <div class="navbar">
            <?php include __DIR__ . '/../navbar/navbarjs.php'; ?>
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
                    <h1> I want to grow my network</h1>
                    <div class="tip">
                        <h4>1. Manfaatkan Media Sosial Profesional (Seperti LinkedIn)</h4>
                        <p>Buat dan optimalkan profil LinkedIn Anda dengan informasi yang lengkap, termasuk riwayat pekerjaan, keterampilan, dan prestasi. Bagikan konten relevan secara berkala, berinteraksi dengan konten orang lain, dan aktif dalam diskusi industri untuk menarik perhatian profesional lain.</p>
                    </div>
                    <div class="tip">
                        <h4>2. Berpartisipasi dalam Acara Networking</h4>
                        <p>Hadir di acara networking, seperti seminar, konferensi, atau meet-up industri, baik secara fisik maupun virtual. Ini memberi Anda kesempatan untuk bertemu langsung dengan orang-orang yang bekerja di bidang yang sama dan memperluas jaringan Anda secara langsung.</p>
                    </div>
                    <div class="tip">
                        <h4>3. Bergabung dengan Komunitas atau Asosiasi Profesional</h4>
                        <p>Temukan komunitas online atau offline yang relevan dengan bidang pekerjaan atau minat Anda. Asosiasi profesional sering mengadakan acara, diskusi, dan kesempatan kolaborasi, yang dapat membantu Anda membangun koneksi baru.</p>
                    </div>
                    <div class="tip">
                        <h4>4. Ikut Serta dalam Proyek Kolaboratif</h4>
                        <p>Bekerja sama dengan orang lain dalam proyek atau inisiatif dapat membantu memperluas jaringan Anda. Proyek ini bisa berupa kerja sukarela, open-source, atau kolaborasi profesional yang memberi Anda kesempatan untuk mengenal orang-orang dengan keterampilan dan bidang yang berbeda.</p>
                    </div>
                    <div class="tip">
                        <h4>5. Bersikap Proaktif, Bukan Pasif</h4>
                        <p>Jangan takut untuk memulai percakapan dengan profesional baru atau mengirimkan pesan kepada seseorang yang ingin Anda kenal lebih lanjut. Pendekatan langsung dan ramah menunjukkan ketertarikan Anda untuk membangun koneksi dan bisa membuka banyak pintu.</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="/public/views/navbar/navbar-responsive.js"></script>
</html>
