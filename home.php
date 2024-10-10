<?php
    include 'index.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('image/bg.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh; /* Mengatur tinggi body agar penuh */
            margin: 0; /* Menghilangkan margin default */
        }
    </style>
</head>
<body class="flex items-center justify-center">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-4xl font-bold text-center text-black-600 mb-6">Selamat Datang di KIP SAFE</h1>
            <h2 class="text-lg text-center text-gray-700 mb-4">
                Silakan pilih menu di atas untuk mulai.
            </h2>
        </div>
    </div>  
</body>
</html>

