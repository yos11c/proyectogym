<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda GYMSHARK ENTRE RIOS</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @vite(['resources/js/app.js'])
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


    <style>
        .banner img {
            width: 100%;
            max-width: 1000px;
            height: 170px;
            margin: 0 auto;
        }
        .logo img {
            width: 60px;
            height: auto;
        }
        .cart img {
            width: 24px;
            height: 24px;
        }
        .cart span {
            font-size: 16px;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: space-around;
            background-color: #f8f8f8;
            margin: 0;
        }
        nav ul li {
            display: inline;
        }
        nav ul li a {
            text-decoration: none;
            color: #333;
            padding: 10px 20px;
            display: inline-block;
            cursor: pointer;
        }
        nav ul li a:hover {
            background-color: #ddd;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        section {
            display: none; /* Ocultar todas las secciones por defecto */
        }
        section.active {
            display: block; /* Mostrar la sección activa */
        }
        .products {
            margin-top: 30px;
        }
        .product {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
        }
        .product img {
            width: 100%; /* Asegura que la imagen se ajuste al ancho del contenedor */
            height: auto; /* Mantiene la proporción de la imagen */
            max-width: 250px; /* Ajusta el tamaño máximo de la imagen */
            max-height: 250px; /* Ajusta la altura máxima de la imagen */
        }
        .product h3 {
            font-size: 18px;
            margin: 10px 0;
        }
        .product p {
            font-size: 16px;
            color: #333;
        }
        .product .view-details {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .product .view-details:hover {
            background-color: #0056b3;
        }
        .carousel {
            position: relative;
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            overflow: hidden;
            margin-bottom: 110px; /* Espacio debajo del carrusel */
        }
        .carousel img {
            width: 100%;
            height: auto;
        }
        .carousel .slides {
            display: flex;
            transition: transform 0.5s ease;
        }
        .carousel .slide {
            min-width: 100%;
        }
        .carousel .prev, .carousel .next {
            position: absolute;
            top: 50%;
            width: 30px;
            height: 30px;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: none;
            cursor: pointer;
            transform: translateY(-50%);
        }
        .carousel .prev {
            left: 10px;
        }
        .carousel .next {
            right: 10px;
        }
        .product-description {
            display: flex;
            align-items: center;
            margin-top: 30px;
            max-width: 1000px;
            margin: 0 auto;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .product-description img {
            width: 40%;
            height: auto;
            margin-right: 20px; /* Espacio entre la imagen y el texto */
        }

        .product-description .description {
            width: 60%;
        }

        .product-description .description h3 {
            margin: 0 0 10px 0;
            font-size: 28px; /* Ajusta el tamaño del encabezado */

        }

        .product-description .description p {
            font-size: 18px; /* Ajusta el tamaño del párrafo */
        }

        .product-description.reverse img {
            margin-right: 0;
            margin-left: 0; /* Espacio entre la imagen y el texto cuando está a la derecha */
        }

        .product-description + .product-description {
            margin-top: 120px; /* Espacio entre las descripciones de productos */
        }

    </style>
</head>
<body>

<div id="app">
<header>

        <!-- Aquí van tus componentes Vue -->

    <div class="logo">
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo">
    </div>
    <nav>
        <ul>
            <li><a href="#" data-section="inicio">Inicio</a></li>
            <li><a href="#" data-section="productos">Productos</a></li>
            <li><a href="#" data-section="contacto">Contacto</a></li>
            <!-- Nueva sección Administrar Productos -->
            <li><a href="#" data-section="administrar">Administrar Productos</a></li>
        </ul>
    </nav>
    <div class="cart">
        <a href="{{ route('cart.show') }}" style="display: flex; align-items: center;">
            <img src="{{ asset('images/carrito.png') }}" alt="Carrito">
            <span id="cart-count"></span>
        </a>
    </div>
</header>

<main>
    <section id="inicio" class="active">
        <h2>Bienvenido a nuestra tienda de gym</h2>
        <p>Aquí puedes encontrar suplementos y accesorios para gym.</p>
        <!-- Carrusel de imágenes -->
        <div class="carousel">
            <button class="prev">&#10094;</button>
            <button class="next">&#10095;</button>
            <div class="slides">
                <div class="slide">
                    <img src="{{ asset('images/carrusel1.jpeg') }}" alt="Imagen 1">
                </div>
                <div class="slide">
                    <img src="{{ asset('images/carrusel2.jpg') }}" alt="Imagen 2">
                </div>
                <div class="slide">
                    <img src="{{ asset('images/carrusel3.jpg') }}" alt="Imagen 3">
                </div>
            </div>
        </div>
        <!-- Descripción del producto -->
        <div class="product-description">
            <img src="{{ asset('images/logo.jpg') }}" alt="Armaf Club de Nuit Oud">
            <div class="description">
                <h3>Fitness Plus Puerto Barrios</h3>
                <p>El mejor gym de la region, aparte de ofrecer nuestros excelentes servicios también contamos con productos de alta calidad y certificados.</p>
                <p><strong>También nuestro gym FITNESS PLUS ENTRE RIOS</strong> <!--- Asssss</p>-->
            </div>
        </div>

        <div class="product-description reverse">
            <div class="description">
                <h3>TU SEGUNDA CASA</h3>
                <p> Cualquier persona es bienvenida.</p>
                <p>Los mejores entrenadores.</p>
                <p><strong>Direccion</strong> - PCP3+CP4, 9a Avenida, Puerto Barrios</p>
            </div>
            <img src="{{ asset('images/gym.jpg') }}" alt="Jean Paul Gaultier Le Male Elixir">
        </div>
    </section>



    <section id="productos">
        <h2>Descubre nuestros productos</h2>
        <input type="text" id="search-input" placeholder="Buscar productos...">
        <div class="product-list" id="product-list">
            <!-- Los productos se agregarán aquí dinámicamente -->
        </div>
    </section>

    <section id="contacto">
        <h2>Contacto</h2>
        <p>Para más información, contáctanos en info@fitnessplusgym.com.</p>
    </section>

    <!-- Sección Administrar Productos -->

    <section id="administrar">
        <h2>Administrar Productos</h2>
        <p>Desde aquí puedes agregar, editar o eliminar productos.</p>
        <!-- Único contenedor #app -->
        <br><br>
        <div id="app">
            <Carte></Carte>
        </div>
    </section>

</main>

<footer>
    <p>&copy; 2024 gymshark entre rios</p>
</footer>
</div>

<script>


    document.addEventListener('DOMContentLoaded', () => {
        // Datos de los productos
        const products = [
            { id: 1, name: "ISO PROTEINA", price: 250, image: "images/ISO.jpg" },
            { id: 2, name: "ANIMAL PAK", price: 300, image: "images/animalpak.jpg" },
            { id: 3, name: "MAQUINA ABDUCTOR", price: 3500, image: "images/maquina3.jpg" },
            { id: 4, name: "CLEMBUTEROL", price: 700, image: "images/clembu.jpg" }
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


        // Mostrar la sección seleccionada
        function showSection(sectionId) {
            // Ocultar todas las secciones
            const sections = document.querySelectorAll('section');
            sections.forEach(section => section.classList.remove('active'));

            // Mostrar la sección seleccionada
            const activeSection = document.getElementById(sectionId);
            activeSection.classList.add('active');

            // Si se selecciona la sección "Productos", renderizar los productos
            if (sectionId === 'productos') {
                renderProducts(products);
            }
        }

        // Asignar evento de clic a los enlaces de navegación
        const navLinks = document.querySelectorAll('nav ul li a');
        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const sectionId = link.getAttribute('data-section');
                showSection(sectionId);
            });
        });

        // Mostrar la primera sección al cargar la página
        showSection('inicio');

        // Carrusel de imágenes
        const slides = document.querySelector('.carousel .slides');
        const prevButton = document.querySelector('.carousel .prev');
        const nextButton = document.querySelector('.carousel .next');
        let currentIndex = 0;

        function showSlide(index) {
            const totalSlides = document.querySelectorAll('.carousel .slide').length;
            if (index >= totalSlides) index = 0;
            if (index < 0) index = totalSlides - 1;
            slides.style.transform = `translateX(-${index * 100}%)`;
            currentIndex = index;
        }

        prevButton.addEventListener('click', () => showSlide(currentIndex - 1));
        nextButton.addEventListener('click', () => showSlide(currentIndex + 1));

        // Iniciar el carrusel
        setInterval(() => showSlide(currentIndex + 1), 3000); // Cambia de imagen cada 3 segundos
    });
</script>
</body>
</html>
