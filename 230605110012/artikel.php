<?php
require 'functions.php';
$articles = getAllArticles();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi Wisata di Indonesia</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Rekomendasi Wisata di Indonesia</h1>
        <p>Jelajahi pesona Indonesia! Temukan tempat-tempat wisata terbaik yang wajib kamu kunjungi untuk liburan tak terlupakan!</p>
    </header>

    <div class="blog-container">
        <?php if (!empty($articles)): ?>
            <?php foreach ($articles as $article): ?>
                <div class="article-card">
                    <h2 class="title"><?= htmlspecialchars($article['title']) ?></h2>
                    <p class="meta">
                        Dipublikasikan: <?= date("d F Y", strtotime($article['date'])) ?> |
                        Penulis: <?= htmlspecialchars($article['author']) ?> |
                        Kategori: <?= htmlspecialchars($article['category']) ?>
                    </p>

                    <?php if (!empty($article['picture'])): ?>
                        <img src="<?= 'img/' . rawurlencode(trim($article['picture'])) ?>" class="article-image"
                            alt="<?= htmlspecialchars($article['title']) ?>">
                    <?php endif; ?>

                    <div class="content">
                        <p><?= substr(strip_tags($article['content']), 0, 200) ?>...</p>
                        <button onclick="showArticle(<?= $article['id'] ?>)">Selengkapnya</button>
                    </div>
                </div>

                <!-- Fullscreen Artikel -->
                <div id="fullscreen-<?= $article['id'] ?>" class="fullscreen-article">
                    <div class="fullscreen-content">
                        <h2><?= htmlspecialchars($article['title']) ?></h2>
                        <p class="meta">
                            Dipublikasikan: <?= date("d F Y", strtotime($article['date'])) ?> |
                            Penulis: <?= htmlspecialchars($article['author']) ?> |
                            Kategori: <?= htmlspecialchars($article['category']) ?>
                        </p>
                        <div>
                            <?= $article['content'] ?>
                        </div>
                        <button onclick="hideArticle(<?= $article['id'] ?>)">Tutup</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <main>
                <div style="text-align: center; padding: 50px;">
                    <h1>Maaf</h1>
                    <p>Saat ini belum ada artikel yang tersedia.</p>
                    <p><a href="index.php">Kembali ke Halaman Utama</a></p>
                </div>
            </main>
        <?php endif; ?>
    </div>

    <footer>
        <p>© 2025 Jelajah Nusantara | Dari tugas kuliah jadi inspirasi jalan-jalan!</p>
    </footer>

    <script>
        function showArticle(id) {
            document.getElementById('fullscreen-' + id).style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function hideArticle(id) {
            document.getElementById('fullscreen-' + id).style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    </script>
</body>

</html>