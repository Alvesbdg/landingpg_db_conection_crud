<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - AlveFood</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="logo.png" alt="Logo" class="logo-image">
            <div class="logo-text">AlveFood</div>
        </div>
        <nav>
            <ul>
               <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="service.php">Service</a></li>
                <li><a href="contact.php">Contact</a></li>

            </ul>
        </nav>
    </header>

 <?php
 include 'db_connect.php'; // Koneksi database 
// Query untuk mengambil data dari tabel articles
$sql = "SELECT title, content FROM articles";
$result = $conn->query($sql);
?>
    <!-- About/Services -->
     <section class="hero animate-fade-in">
     <section id="about" class="about">
        <div class="container">
            <h2>Our Service</h2>
            <div class="grid">
                    <?php
                    if ($result->num_rows > 0):
                        while ($row = $result->fetch_assoc()):
                    ?>
                    <div class="item">
                        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p><?php echo htmlspecialchars($row['content']); ?></p>
                    </div>
                    <?php endwhile; ?>
                    <?php else: ?>
                    <div class="item">
                        <p>Tidak ada artikel untuk ditampilkan.</p>
                    </div>
                    <?php endif; ?>
            </div>
        </div>
    </section>
  </section>

    
    <!-- <section class="hero animate-fade-in">
        <h1>Welcome to Alve Food</h1>
        <p>Kami dengan bangga memperkenalkan produk makanan terbaru dari Alve Food, yang terinspirasi dari keanekaragaman cita rasa Nusantara. Di Alve Food, kami menggabungkan bahan-bahan alami terbaik dengan resep turun-temurun untuk menghadirkan pengalaman kuliner yang autentik dan lezat.</p>
        <p>Mari bergabung dengan kami dan cicipi kelezatan yang tidak hanya memuaskan rasa lapar, tetapi juga menyehatkan tubuh. Alve Food adalah pilihan yang tepat untuk Anda yang mencari makanan berkualitas tinggi dengan rasa yang tak tertandingi</p>
        <a href="services.php" class="cta">Layanan Kami</a>
    </section> -->

    <footer>
        <p>@2024 By Ariantonius Sagala. All rights reserved.</p>
    </footer>
</body>
</html>
