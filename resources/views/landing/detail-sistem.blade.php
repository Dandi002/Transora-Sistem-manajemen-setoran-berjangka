<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Sistem</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- CSS kamu -->
    <link rel="stylesheet" href="css/landing.css">

    <style>
        /* Kalau belum ada di landing.css */
        .organic-blob {
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-white font-sans antialiased overflow-x-hidden">

    <!-- BACKGROUND -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10">
        <div class="absolute top-10 right-20 w-96 h-96 bg-green-300/20 organic-blob animate-float"></div>
        <div class="absolute bottom-20 left-10 w-80 h-80 bg-emerald-400/20 organic-blob animate-float" style="animation-delay: 3s;"></div>
        <div class="absolute top-1/3 left-1/4 w-64 h-64 bg-teal-300/20 organic-blob animate-float" style="animation-delay: 5s;"></div>
    </div>

    <!-- CONTENT -->
    <div class="min-h-screen flex items-center justify-center">
        <h1 class="text-4xl font-bold text-gray-800">
            Detail Sistem
        </h1>
    </div>

</body>
</html>