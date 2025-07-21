<?php
include ("koneksi.php");
$sql = "select * from reviews";
$result = mysqli_query($koneksi, $sql);

if ($result) {
    echo "<table border='1'>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Ulasan</th>
        <th>Rating</th>
    </tr>";
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nama'] . "</td>";
        echo "<td>" . $row['ulasan'] . "</td>";
        echo "<td>" . $row['Rating'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>