<?php
include '../db_connect.php'; // Koneksi database

// Inisialisasi variabel
$title = $content = $author_id = $category = "";
$update = false;
$id = 0;

// Tambah Data Article
if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author_id = $_POST['author_id'];
    $category = $_POST['category'];

    $sql = "INSERT INTO articles (title, content, author_id, category) VALUES ('$title', '$content', '$author_id', '$category')";
    if ($conn->query($sql)) {
        header("Location: index.php?page=data_articles"); // Redirect ke halaman data_articles
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Edit Data Article
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $conn->query("SELECT * FROM articles WHERE id=$id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $content = $row['content'];
        $author_id = $row['author_id'];
        $category = $row['category'];
    }
}

// Update Data Article
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author_id = $_POST['author_id'];
    $category = $_POST['category'];

    $sql = "UPDATE articles SET title='$title', content='$content', author_id='$author_id', category='$category' WHERE id=$id";
    if ($conn->query($sql)) {
        header("Location: index.php?page=data_articles"); // Redirect ke halaman data_articles
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Hapus Data Article
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM articles WHERE id=$id";
    if ($conn->query($sql)) {
        header("Location: index.php?page=data_articles"); // Redirect ke halaman data_articles
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Ambil Data Users untuk Author ID
$sql_users = "SELECT id, username FROM users";
$result_users = $conn->query($sql_users);
?>

<h2>Data Articles</h2>

<!-- Form Input Data Article -->
<form action="data_articles.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>" required>
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" name="content" rows="4" required><?php echo $content; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="author_id" class="form-label">Author</label>
        <select class="form-select" id="author_id" name="author_id" required>
            <option value="">Pilih Author</option>
            <?php while ($user = $result_users->fetch_assoc()): ?>
                <option value="<?php echo $user['id']; ?>" <?php echo ($author_id == $user['id']) ? 'selected' : ''; ?>>
                    <?php echo $user['username']; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <input type="text" class="form-control" id="category" name="category" value="<?php echo $category; ?>" required>
    </div>
    <?php if ($update): ?>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
    <?php else: ?>
        <button type="submit" name="save" class="btn btn-success">Simpan</button>
    <?php endif; ?>
</form>

<hr>

<!-- Tabel Data Articles -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Author</th>
            <th>Category</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Query untuk mengambil semua data articles
        $sql_articles = "SELECT articles.id, articles.title, articles.content, articles.category, users.username as author
                         FROM articles
                         JOIN users ON articles.author_id = users.id";
        $result_articles = $conn->query($sql_articles);
        if ($result_articles->num_rows > 0):
            while ($row = $result_articles->fetch_assoc()):
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['content']; ?></td>
            <td><?php echo $row['author']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td>
                <a href="index.php?page=data_articles&edit=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="data_articles.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
        <?php else: ?>
        <tr>
            <td colspan="6">Tidak ada data articles</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php $conn->close(); // Tutup koneksi ?>
