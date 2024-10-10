<?php
    include 'home.php';
    include 'koneksi.php';

    $sql = "SELECT id, nama, created_at FROM m_kondisi_barang";
    $query = mysqli_query($koneksi, $sql); 
?>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-2xl font-bold mb-4 text-center">-- Kondisi Tidak Baik --</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-2 px-4 border-b text-left">Id Kondisi Barang</th>
                            <th class="py-2 px-4 border-b text-left">Nama Kondisi</th>
                            <th class="py-2 px-4 border-b text-left">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($query)) : ?>
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 px-4 border-b"><?php echo $row['id']; ?></td>
                                <td class="py-2 px-4 border-b"><?php echo $row['nama']; ?></td>
                                <td class="py-2 px-4 border-b"><?php echo $row['created_at']; ?></td>
                            </tr>
                        <?php endwhile; ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
