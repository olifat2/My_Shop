<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tableau de bord admin - MyShop')</title>
    @vite(['resources/css/app1.css', 'resources/js/app.js'])
</head>

<body class="dash-admin">
    {{-- Barre latérale --}}
    @include('layouts.auth-admin.header')

    {{-- Contenu principal --}}
    <main class="container-dash-admin">
        @yield('content')
    </main>
</body>

</html>
