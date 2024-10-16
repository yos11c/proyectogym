document.addEventListener('DOMContentLoaded', () => {
    // Datos de los productos
    const products = [
        { id: 1, name: "ISO PROTEINA", price: 250, image: "images/ISO.jpg" },
        { id: 2, name: "ANIMAL PAK", price: 300, image: "images/animalpak.jpg" },
        { id: 3, name: "MAQUINA ABDUCTOR", price: 330, image: "images/maquina3.jpg" },
        { id: 4, name: "CLEMBUTEROL", price: 80, image: "images/clembu.jpg" }
    ];

    const productList = document.getElementById('product-list');
    let cart = JSON.parse(localStorage.getItem('cart')) || [];  // Recuperar el carrito del almacenamiento local

    // Función para renderizar los productos
    function renderProducts(productsToRender) {
        productList.innerHTML = ''; // Limpiar la lista actual
        productsToRender.forEach(product => {
            const productElement = document.createElement('div');
            productElement.classList.add('product');

            productElement.innerHTML = `
                <img src="${product.image}" alt="${product.name}">
                <h3>${product.name}</h3>
                <p>$ ${product.price.toLocaleString('es-CO')}</p>
                <a href="/producto/${product.id}" class="view-details">Ver Producto</a>
            `;

            productList.appendChild(productElement);
        });
    }

    // Actualizar el contador del carrito
    function updateCartCount() {
        cart = JSON.parse(localStorage.getItem('cart')) || [];
        const cartCount = cart.reduce((total, item) => total + item.quantity, 0);
        document.getElementById('cart-count').textContent = cartCount;
    }

    // Inicial renderizado de productos
    renderProducts(products);

    // Función para filtrar productos
    const searchInput = document.getElementById('search-input');
    searchInput.addEventListener('input', () => {
        const query = searchInput.value.toLowerCase();
        const filteredProducts = products.filter(product =>
            product.name.toLowerCase().includes(query)
        );
        renderProducts(filteredProducts);
    });

    // Inicializar el contador del carrito
    updateCartCount();
});
