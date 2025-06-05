<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    @vite([])
</head>
<body class="bg-gray-100">

    <div class="container-fluid flex justify-center items-center h-screen">
        <div class="form w-full max-w-md p-10">
            <h1 class="text-2xl mb-5 font-bold">Daftar Akun Di Apotek Berkah Jaya</h1>
            @include('components.register_form')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>