<?php
include '../db_connect.php'; // Koneksi database

// Hapus Data Message
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM messages WHERE id=$id";
    if ($conn->query($sql)) {
        header("Location: index.php?page=data_messages"); // Redirect ke halaman data_messages
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Query untuk mengambil semua data messages
$sql_messages = "SELECT * FROM messages";
$result_messages = $conn->query($sql_messages);
?>

<h2>Data Messages</h2>

<!-- Tabel Data Messages -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Sent At</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result_messages->num_rows > 0):
            while ($row = $result_messages->fetch_assoc()):
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['message']; ?></td>
            <td><?php echo $row['sent_at']; ?></td>
            <td>
                <a href="data_messages.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
        <?php else: ?>
        <tr>
            <td colspan="6">Tidak ada data messages</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php $conn->close(); // Tutup koneksi ?>
