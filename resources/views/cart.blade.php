<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantalla de Pago</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- Agregar estilos personalizados -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 0 20px; /* Ajusta el padding para que el contenido no toque los bordes */
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #ffffff;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .header .btn-secondary {
            text-decoration: none;
            color: #000000; /* Color negro */
            font-size: 28px; /* Tamaño de fuente más grande */
            font-weight: bold; /* Negrita para mayor énfasis */
        }
        .header a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #007bff;
        }
        .header img {
            width: 40px; /* Ajusta el tamaño de la imagen según sea necesario */
            height: 40px; /* Ajusta el tamaño de la imagen según sea necesario */
            margin-left: auto; /* Alinea la imagen a la derecha */
            object-fit: contain; /* Asegura que la imagen se ajuste al tamaño sin distorsionarse */
        }
        .header .btn-secondary {
            margin-right: auto; /* Alinea el texto a la izquierda */
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
        }
        main {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .form-check {
            margin-bottom: 15px;
        }
        .form-check-input {
            margin-right: 10px;
        }
        .btn-primary {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <a href="{{ route('shop') }}" class="btn-secondary">Tienda</a>
        <a href="{{ route('cart.show') }}">
            <img src="{{ asset('images/bolsa.jpg') }}" alt="Volver a la tienda">
        </a>
    </div>

    <main>
        <h1>Pantalla de Pago</h1>
        <form id="checkout-form" method="POST" action="{{ route('payment.process') }}">
            @csrf

            <h2>Contacto</h2>
            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <h2>Entrega</h2>
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Dirección:</label>
                <input type="text" id="address" name="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="city">Ciudad:</label>
                <input type="text" id="city" name="city" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="region">Región:</label>
                <input type="text" id="region" name="region" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="postal_code">Código Postal:</label>
                <input type="text" id="postal_code" name="postal_code" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone">Teléfono:</label>
                <input type="text" id="phone" name="phone" class="form-control" required>
            </div>

            <h2>Métodos de envío</h2>
            <div class="form-check">
                <input type="radio" id="envio_exterior" name="envio" value="exterior" class="form-check-input" checked>
                <label for="envio_exterior" class="form-check-label">En el Exterior (Gratis)</label>
            </div>
            <div class="form-check">
                <input type="radio" id="envio_local" name="envio" value="local" class="form-check-input">
                <label for="envio_local" class="form-check-label">Envío Local (Gratis)</label>
            </div>

            <h2>Pago</h2>
            <div class="form-group">
                <label for="metodo_pago">Método de pago:</label>
                <select id="metodo_pago" name="metodo_pago" class="form-control" required>
                    <option value="efectivo">Pago en efectivo al recibir mi pedido</option>
                    <option value="tarjeta">Tarjeta de crédito/débito</option>
                </select>
            </div>

            <button type="submit" class="btn-primary">Completar Compra</button>
        </form>
    </main>
</div>
</body>
</html>
