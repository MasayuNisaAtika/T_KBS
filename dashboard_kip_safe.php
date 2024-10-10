<?php

    include 'koneksi.php';
    include 'home.php';

    $form_kondisi = mysqli_query($koneksi,"SELECT * FROM t_form_kondisi");
    $kondisi_barang= mysqli_query($koneksi,"SELECT * FROM m_kondisi_barang");
 
// menghitung data barang
$jumlah_form_kondisi = mysqli_num_rows($form_kondisi);
$jumlah_kondisi_barang = mysqli_num_rows($kondisi_barang);

$sql = "SELECT no, nama_obat, jumlah_penggunaan FROM m_penggunaan_obat";
    $query = mysqli_query($koneksi, $sql); 

    if (isset($_GET['op'])) {
        $op = $_GET['op'];
    } else {
        $op = "";
    }
    
    if ($op == 'edit') {
        $id         = $_GET['id'];
        $sql       = "select * from m_penggunaan_obat where no = '$id'";
        $q1         = mysqli_query($koneksi, $sql);
        $r1         = mysqli_fetch_array($q1);
        $id        = $r1['no'];
        $nama       = $r1['nama_obat'];
        $no      = $row['no'];
        $nama    = $row['nama_obat'];
        $jumlah  = $row['jumlah_penggunaan'];
    
        if ($id == '') {
            $error = "Data tidak ditemukan";
        }
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Klinik KBS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 p-5">

    <div class="container mx-auto">

        <!-- Judul Dashboard -->
        <h1 class="text-2xl font-bold mb-6">Dashboard Klinik KBS</h1>

        <!-- Kondisi Alat -->
    <section class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Kondisi Alat</h2>
        <div id="equipmentStatus" aria-live="polite"></div>
        <div class="flex gap-4">
            <a href="hal_kondisi_baik.php" class="flex-1 p-4  border border-green-400 text-center rounded-lg shadow hover:bg-green-200 transition">
                <p class="text-5xl font-normal"><?php echo $jumlah_form_kondisi; ?></p>
                <h2 class="text-lg">Kondisi Baik</h2>
            </a>
            <a href="hal_kondisi_tidak_baik.php" class="flex-1 p-4  border border-red-400 text-center rounded-lg shadow hover:bg-red-200 transition">
                <p class="text-5xl font-normal"><?php echo $jumlah_kondisi_barang; ?></p>
                <h2 class="text-lg">Kondisi Tidak Baik</h2>
            </a>
        </div>
    </section>

        <!-- Grafik Kunjungan Pasien -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Kunjungan Pasien ke Klinik</h2>
            <canvas id="patientVisitsChart"></canvas>
        </div>

        <section class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Penggunaan Obat</h2>
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-200 border-b-2 border-gray-300">
                        <th class="py-2 px-4 text-left">No</th>
                        <th class="py-2 px-4 text-left">Nama Obat</th>
                        <th class="py-2 px-4 text-left">Jumlah Penggunaan</th>
                        <th class="py-2 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
    
                <tbody id="medicationUsageTable">
                <?php 
                    $sql   = "select * from m_penggunaan_obat order by no desc";
                    $q2     = mysqli_query($koneksi, $sql);
                    $urut   = 1;
                    while($row = mysqli_fetch_assoc($query)) {
                        $no      = $row['no'];
                        $nama    = $row['nama_obat'];
                        $jumlah  = $row['jumlah_penggunaan'];
                    ?>
                        
                        <tr>  
                        <td><?php echo $row['no']?></td>
                        <td><?php echo $row['nama_obat']?></td>
                        <td><?php echo $row['jumlah_penggunaan']?></td>
                        <td class="py-2 px-4 text-left">
                            <a href="hal_edit.php" class="text-blue-500 hover:underline">Edit</a>
                            <button class="text-red-500 hover:underline" onclick="confirmDelete(1)">Hapus</button>
                        </td>
                        </tr>  
                    <?php 
                    }
                    ?> 
                </tbody>
            </table>
        </section>
    <script>
        // Ambil data kondisi alat dari backend
        fetch('api/equipment_status.php') // Ganti dengan endpoint yang sesuai
            .then(response => response.json())
            .then(data => {
                const equipmentStatusDiv = document.getElementById('equipmentStatus');
                let html = '<ul>';
                data.forEach(item => {
                    html += `
                        <li class="flex justify-between border-b py-2">
                            <span>${item.name}</span>
                            <span class="${item.condition === 'Baik' ? 'text-green-500' : item.condition === 'Perlu Perawatan' ? 'text-yellow-500' : 'text-red-500'}">${item.condition}</span>
                        </li>
                    `;
                });
                html += '</ul>';
                equipmentStatusDiv.innerHTML = html;
            })
            .catch(error => {
                console.error('Error fetching equipment status:', error);
            });

        // Grafik Kunjungan Pasien
        const ctx1 = document.getElementById('patientVisitsChart').getContext('2d');
        const patientVisitsChart = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt','Nov','Des'],
                datasets: [{
                    label: 'Kunjungan Pasien',
                    data: [2,4,3,6,4,8,8.5,7,5,6,3,8],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    function confirmDelete(id) {
        const confirmation = confirm("Apakah Anda yakin ingin menghapus data ini?");
        if (confirmation) {
            // Logika untuk menghapus data obat
            alert(`Data obat dengan ID: ${id} telah dihapus.`);
            // Di sini, tambahkan kode untuk menghapus dari database atau array data
            // Misalnya, hapus baris dari tabel
            // document.getElementById('medicationUsageTable').deleteRow(rowIndex);
        }
    }
        
    </script>

</body>
</html>