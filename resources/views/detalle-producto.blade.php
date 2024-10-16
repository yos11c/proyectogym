<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $producto->nombre }}</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        main {
            max-width: 800px;
            margin: 20px;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            transition: box-shadow 0.3s ease;
        }

        main:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        img {
            max-width: 100%;
            height: 400px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 15px;
            color: #333;
        }

        p {
            font-size: 18px;
            margin: 10px 0;
            color: #555;
        }

        .price {
            font-size: 22px;
            font-weight: bold;
            color: #e74c3c;
            margin: 20px 0;
        }

        form {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="number"] {
            width: 80px;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
<main>
    <h1>{{ $producto->nombre }}</h1>
    <img src="{{ asset('images/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
    <p>{{ $producto->descripcion }}</p>
    <p class="price">$ {{ number_format($producto->precio, 2) }}</p>

    <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $producto->id }}">
        <input type="number" name="quantity" value="1" min="1">
        <button type="submit">Agregar al carrito</button>
    </form>
</main>

<footer>
    <p>&copy; 2024 gymshark entre rios</p>
</footer>
</body>
</html>
