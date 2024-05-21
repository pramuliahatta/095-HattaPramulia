<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>2cing</title>
</head>

<body class="h-full">
    <!--
    This example requires updating your template:

    ```
    <html class="h-full bg-gray-100">
    <body class="h-full">
    ```
    -->
    <div class="min-h-full">

        <x-navbar></x-navbar>

        <x-header>{{ $title }}</x-header>

        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <!-- Your content -->
                {{ $slot }}
            </div>
        </main>

    </div>

</body>

</html>

