<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- Agregar Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Carrito de Compras</h1>
    <form id="cart-form">
        @csrf
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Acción</th>
            </tr>
            </thead>
            <tbody>
            @forelse($cart as $id => $item)
                <tr>
                    <td>
                        <img src="{{ isset($item['image']) && file_exists(public_path('images/' . $item['image'])) ? asset('images/' . $item['image']) : asset('images/default-image.jpg') }}" alt="{{ $item['name'] }}" class="img-thumbnail" style="width: 100px;">
                    </td>
                    <td>{{ $item['name'] }}</td>
                    <td>${{ number_format($item['price'], 2) }}</td>
                    <td>
                        <input type="number" name="cart[{{ $id }}][quantity]" value="{{ $item['quantity'] }}" min="1" class="form-control" style="width: 80px;">
                    </td>
                    <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    <td>
                        <button type="button" class="btn btn-primary update-cart" data-id="{{ $id }}">Actualizar</button>
                        <button type="button" class="btn btn-danger remove-cart" data-id="{{ $id }}">Eliminar</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">El carrito está vacío.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Total: ${{ number_format($total, 2) }}</h3>
            <a href="{{ route('cart') }}" class="btn btn-success">Proceder al Pago</a>
        </div>
    </form>
    <a href="{{ route('shop') }}" class="btn btn-secondary">Volver a la tienda</a>
</div>

<!-- Agregar Bootstrap JS y dependencias -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="{{ asset('js/script.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('cart-form');

        // Actualizar cantidad
        form.addEventListener('click', function(event) {
            if (event.target.classList.contains('update-cart')) {
                event.preventDefault();

                const button = event.target;
                const id = button.getAttribute('data-id');
                const quantity = button.closest('tr').querySelector(`input[name="cart[${id}][quantity]"]`).value;

                fetch('{{ route('cart.update') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        cart: {
                            [id]: { quantity: quantity }
                        }
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload(); // Recargar la página para mostrar el carrito actualizado
                        } else {
                            alert('Hubo un error al actualizar el carrito.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            // Eliminar producto
            if (event.target.classList.contains('remove-cart')) {
                event.preventDefault();

                const button = event.target;
                const id = button.getAttribute('data-id');

                fetch('{{ route('cart.remove') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        product_id: id
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload(); // Recargar la página para mostrar el carrito actualizado
                        } else {
                            alert('Hubo un error al eliminar el producto.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        });
    });
</script>
</body>
</html>
