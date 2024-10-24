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
                    <h1>I want to improve my resume</h1>
                    <div class="tip">
                        <h4>1. Mulailah dengan Ringkasan Profil yang Menarik</h4>
                        <p>Tulis ringkasan singkat tentang diri Anda yang menonjolkan pengalaman, keterampilan utama, dan apa yang membuat Anda berbeda dari kandidat lain. Ini memberikan gambaran awal kepada perekrut tentang siapa Anda secara profesional.</p>
                    </div>
                    <div class="tip">
                        <h4>2. Gunakan Format yang Jelas dan Mudah Dibaca</h4>
                        <p>Pilih format yang bersih dan profesional, seperti menggunakan font standar (Arial, Calibri), ukuran font 10-12, dan spasi yang cukup. Pastikan bagian-bagian seperti "Pendidikan", "Pengalaman Kerja", dan "Keterampilan" terorganisir dengan baik.</p>
                    </div>
                    <div class="tip">
                        <h4>3. Tulis Pengalaman yang Relevan dengan Pekerjaan yang Dilamar</h4>
                        <p>Sesuaikan pengalaman kerja dan pencapaian Anda dengan posisi yang Anda inginkan. Fokuskan pada pengalaman yang relevan dengan deskripsi pekerjaan yang dituju untuk meningkatkan daya tarik resume Anda.</p>
                    </div>
                    <div class="tip">
                        <h4>4. Jangan Melebihi 1-2 Halaman</h4>
                        <p>Usahakan resume tetap singkat, padat, dan fokus pada pengalaman yang paling relevan. Perekrut biasanya hanya meluangkan waktu beberapa detik untuk memindai resume, jadi buatlah informasi Anda langsung menonjol.</p>
                    </div>
                    <div class="tip">
                        <h4>5. Periksa Kembali untuk Kesalahan</h4>
                        <p>Sebelum mengirimkan resume Anda, pastikan tidak ada kesalahan pengetikan, tata bahasa, atau format. Resume yang bebas dari kesalahan menunjukkan perhatian Anda terhadap detail dan keseriusan dalam melamar pekerjaan.</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="/public/views/navbar/navbar-responsive.js"></script>
</html>
