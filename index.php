<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIP SAFE</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body class="bg-gray-100">

    <div class="bg-blue-600 p-4 text-white flex justify-between items-center">
        <h1 class="text-2xl font-bold">KIP SAFE</h1>
        <ul class="flex space-x-4">
            <li><a href="home.php" onclick="loadHome()" class="hover:underline">Home</a></li>
            <li><a href="dashboard_kip_safe.php" onclick="loadDashboard()" class="hover:underline">Dashboard</a></li>
            <li><a href="about.php" class="hover:underline">About</a></li>
            <li><a href="contact.php" class="hover:underline">Contact</a></li>
        </ul>
    </div>

    <script>
        function loadHome() {
            const contentArea = document.getElementById('contentArea');
            contentArea.innerHTML = `
                <h1 class="text-2xl font-bold mb-6">Selamat Datang di KIP SAFE</h1>
                <p>Silakan pilih menu di atas untuk mulai.</p>
            `;
        }
    </script>
</head>
</body>
</html>