<?php
include ("koneksi.php");
$sql = "select * from buku_tamu";
$result = mysqli_query($koneksi, $sql);

if ($result) {
    echo "<table border='1'>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>No Telp</th>
        <th>Komentar</th>
    </tr>";
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nama'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['notelp'] . "</td>";
        echo "<td>" . $row['komentar'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>