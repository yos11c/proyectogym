<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM ENTRE RIOS</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @vite(['resources/js/app.js'])
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<h1>GYM con la NASA</h1>
<input type="text" id="search-input" placeholder="Buscar productos...">
<div id="product-list"></div>
<div id="app">
    <nasadata></nasadata>
</div>
</body>
</html>
