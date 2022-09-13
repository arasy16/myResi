<?php
session_start();
include "connection.php";

if (!isset($_SESSION["email"])) {
    echo "
    
    <script>
        alert('Mohon login terlebih dahulu');
        window.location.replace('../');
    </script>
    
    ";
}


if (isset($_POST["save"])) {
    $packing = $_POST["packing"];
    $resi = $_POST["resi"];
    $date = date("Y-m-d h:i:s");

    $sql = "SELECT resi FROM resi WHERE resi = '$resi'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<script>alert('Data gagal disimpan. Resi Sudah ditambahkan');</script>";
    } else {
        $sql = "INSERT INTO resi (id_packing, resi, tanggal, status)
        VALUES ($packing, '$resi', '$date', 1)";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Data berhasil disimpan');</script>";
        } else {
            echo "<script>alert('Data gagal disimpan');</script>";
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
    echo "<script>window.location = './'</script>";
}
?>

<!DOCTYPE html>
<html lang="id-ID">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Resi Pengiriman</title>
</head>

<body>
    <div class="container">
        <div class="row g-0">
            <div class="col-12" style="margin-bottom:-20px">
                <div class="alert alert-dark alert-dismissible fade show fs-6 text-center" role="alert">
                    <strong>Perhatian!</strong> Pilih staf packing terlebih dahulu sebelum menambahkan resi pengiriman.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="card bg-dark text-light border rounded-3">
                    <div class="card-header">
                        <h2 class="h2 text-center mb-3 text-light">Resi Pengiriman</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label fs-5">Staf Packing:</label>
                            <select class="form-select form-select-lg bg-dark text-light fs-5" id="packing" name="packing">
                                <?php

                                $sql = "SELECT * FROM packing";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row["id_packing"] . '">' . $row["nama"] . '</option>';
                                    }
                                } else {
                                    echo "0 results";
                                }

                                $sql = "SELECT r.*, p.nama FROM resi r JOIN packing p ON r.id_packing = p.id_packing WHERE r.status = 1";
                                $result = $conn->query($sql);
                                $total = $result->num_rows;

                                ?>

                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control form-control-lg fs-5 bg-dark text-light" id="resi" name="resi" placeholder="Nomer Resi" autofocus>
                        </div>
                        <div class="row">
                            <div class="d-grid gap-3 col-12 mx-auto">
                                <button class="btn btn-lg btn-outline-light" type="button" onclick="add();">
                                    <i class="bi bi-save me-2"></i>Simpan</button>
                                <button type="button" class="btn btn-lg btn-md btn-outline-light" onclick="window.location='./'">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Reset</button>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group mb-3 ms-0 mt-3">
                                        <span class="input-group-text">Total paket</span>
                                        <span class="input-group-text" id="totalPacket"><?php echo $total; ?></span>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <a type="button" class="btn btn-md btn-outline-light mt-3" href="../logout.php">Log out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-light text-center">
                        2 days ago
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="card bg-dark text-light table-responsive">
                    <table class="table table-dark table-striped table-hover" id="tabelku">
                        <thead>
                            <tr>
                                <th>Nomer</th>
                                <th>Nomer Resi</th>
                                <th class="d-none">Kurir</th>
                                <th>Packing</th>
                                <th>Tanggal</th>
                                <th class="d-none">Admin</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody id="tabel" class="fs-6">
                            <?php

                            //$sql = "SELECT * FROM resi WHERE status = 1";

                            if ($result->num_rows > 0) {
                                // output data of each row

                                $i = 1;
                                while ($row = $result->fetch_assoc()) {

                                    echo '<tr>
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
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row g-0">

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function add() {
            var resi = input_resi = document.getElementById("resi").value;
            var packing = document.getElementById("packing").value;
            if (resi == 1) {
                document.getElementById("packing").value = 1;
                document.getElementById("resi").value = '';
                document.getElementById("resi").focus();
            } else if (resi == 2) {
                document.getElementById("packing").value = 2;
                document.getElementById("resi").value = '';
                document.getElementById("resi").focus();
            } else if (resi == 3) {
                document.getElementById("packing").value = 3;
                document.getElementById("resi").value = '';
                document.getElementById("resi").focus();
            } else {
                if (resi.length == 0) {
                    alert("Data tidak boleh kosong");
                    document.getElementById("resi").focus();
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var data = this.responseText;
                            if (data == "error") {
                                alert("Resi sudah discan!");
                            } else {
                                document.getElementById("tabel").innerHTML = data;
                                document.getElementById("resi").value = "";
                                countTable();
                            }
                        }
                    };
                    xmlhttp.open("GET", "add-ajax.php?resi=" + resi + '&packing=' + packing, true);
                    xmlhttp.send();
                }
            }
        }

        function countTable() {
            var cnt = document.getElementById("tabelku").rows.length;
            document.getElementById("totalPacket").innerHTML = cnt - 1;
        }


        // input_resi.addEventListener("keyup", function(event) {
        //     // Number 13 is the "Enter" key on the keyboard
        //     if (event.keyCode === 13) {
        //         // Cancel the default action, if needed
        //         event.preventDefault();
        //         // Trigger the button element with a click
        //         add();
        //     }
        // });
    </script>
</body>

</html>