<template>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    </head>

    <div>
        <header>
            <h1>Compra Exitosa</h1>
        </header>

        <main>
            <p>¡Gracias por tu compra! Tu pedido ha sido realizado exitosamente.</p>

            <a :href="cartLink">Volver al Carrito</a>

        </main>
    </div>
</template>

<script>
export default {
    props: {
        cartLink: {
            type: String,
            default: '/carrito'
        }
    }
};
</script>

<style scoped>
h1 {
    color: #4CAF50;
}
a {
    text-decoration: none;
    color: #007BFF;
}
a:hover {
    color: #0056b3;
}
</style>
