<?php
include "connection.php";

$resi = $_GET["resi"];
$packing = $_GET["packing"];
$date = date("Y-m-d h:i:s");

$sql = "SELECT * FROM resi WHERE resi = '$resi'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "error";
} else {
    $sql = "INSERT INTO resi (id_packing, resi, tanggal, status)
        VALUES ($packing, '$resi', '$date', 1)";

    $content = "";
    if ($conn->query($sql) === TRUE) {
        $sql = "SELECT r.*, p.nama FROM resi r JOIN packing p ON r.id_packing = p.id_packing WHERE r.status = 1";
        $result = $conn->query($sql);

        $i = 1;
        while ($row = $result->fetch_assoc()) {
            $content .= '<tr>
            <td>' . $i . '</td>
            <td>' . $row["resi"] . '</td>
            <td class="d-none"></td>
            <td>' . $row["nama"] . '</td>
            <td>' . $row["tanggal"] . '</td>
            <td class="d-none"></td>
            <td><a href="delete.php?id=' . $row["id"] . '" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>
        </tr>';
            $i++;
        }
        echo $content;
    } else {
        echo "error";
    }
}

$conn->close();
