<?php
include '../db_connect.php'; // Koneksi database

// Inisialisasi variabel
$username = $password = $email = "";
$update = false;
$id = 0;

// Tambah Data User
if (isset($_POST['save'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $email = $_POST['email'];

    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    if ($conn->query($sql)) {
        header("Location: index.php?page=data_users"); // Redirect ke halaman data_users
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Edit Data User
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $email = $row['email'];
    }
}

// Update Data User
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password baru
        $sql = "UPDATE users SET username='$username', password='$password', email='$email' WHERE id=$id";
    } else {
        $sql = "UPDATE users SET username='$username', email='$email' WHERE id=$id";
    }

    if ($conn->query($sql)) {
        header("Location: index.php?page=data_users"); // Redirect ke halaman data_users
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Hapus Data User
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM users WHERE id=$id";
    if ($conn->query($sql)) {
        header("Location: index.php?page=data_users"); // Redirect ke halaman data_users
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<h2>Data Users</h2>

<!-- Form Input Data User -->
<form action="data_users.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" <?php echo $update ? '' : 'required'; ?>>
        <?php if ($update): ?>
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password</small>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
    </div>
    <?php if ($update): ?>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
    <?php else: ?>
        <button type="submit" name="save" class="btn btn-success">Simpan</button>
    <?php endif; ?>
</form>

<hr>

<!-- Tabel Data Users -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Query untuk mengambil semua data users
        $sql_users = "SELECT * FROM users";
        $result_users = $conn->query($sql_users);
        if ($result_users->num_rows > 0):
            while ($row = $result_users->fetch_assoc()):
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
                <a href="index.php?page=data_users&edit=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="data_users.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
        <?php else: ?>
        <tr>
            <td colspan="4">Tidak ada data users</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php $conn->close(); // Tutup koneksi ?>
