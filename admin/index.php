<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 20px;
        }
        header {
            padding: 20px 0;
            background-color: #007bff; /* Background biru */
            color: white;
        }
        header img {
            width: 100px;
            height: 100px;
            border-radius: 50%; /* Bentuk logo lingkaran */
        }
        footer {
            padding: 10px;
            background-color: #007bff; /* Background biru */
            color: white;
            text-align: center;
        }
        .header-title {
            display: flex;
            align-items: center;
            justify-content: flex-start; /* Rata kiri */
            padding-left: 20px;
        }
        .header-title h1 {
            margin-left: 20px; /* Jarak antara logo dan judul */
        }
    </style>
</head>
<body>
    <header class="container-fluid">
        <div class="row">
            <div class="col-md-2 header-title">
                <img src="../logo.png" alt="Logo"> <!-- Logo bentuk lingkaran -->
            </div>
            <div class="col-md-10 d-flex align-items-center">
                <h1>Admin Dashboard</h1> <!-- Tulisan pada header rata kiri -->
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=data_users">Data User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=data_messages">Data Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=data_articles">Data Articles</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php
        // Menampilkan halaman berdasarkan link navigasi
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            switch ($page) {
                case 'data_users':
                    include 'data_users.php';
                    break;
                case 'data_messages':
                    include 'data_messages.php';
                    break;
                case 'data_articles':
                    include 'data_articles.php';
                    break;
                default:
                    echo "<h2>Welcome to the Admin Dashboard</h2>";
            }
        } else {
            echo "<h2>Welcome to the Admin Dashboard</h2>";
        }
        ?>
    </div>

    <footer>
        <p>&copy; 2024 Admin Dashboard</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
