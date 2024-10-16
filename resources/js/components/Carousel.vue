<template>
    <div>
        <h1 class="titulo-color">Artículos que podrían interesarte</h1>
    </div>
    <div class="carousel-wrapper">
        <div class="carousel">
            <button @click="prev" class="arrow left-arrow">←</button>
            <div class="carousel-track" :style="{ transform: `translateX(-${currentSlide * 100}%)` }">
                <div class="carousel-item" v-for="(item, index) in items" :key="index">
                    <img :src="item.image" :alt="item.name" class="carousel-image">
                    <a :href="'/producto/' + item.id" class="view-button">Ver Producto</a>
                </div>
            </div>
            <button @click="next" class="arrow right-arrow">→</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            currentSlide: 0,
            items: [
                { id: 1, image: 'images/ISO.jpg', name: 'Producto 1' },
                { id: 2, image: 'images/animalpak.jpg', name: 'Producto 2' },
                { id: 3, image: 'images/maquina3.jpg', name: 'Producto 3' }
            ]
        };
    },
    methods: {
        next() {
            this.currentSlide = (this.currentSlide + 1) % this.items.length;
        },
        prev() {
            this.currentSlide = (this.currentSlide - 1 + this.items.length) % this.items.length;
        }
    }
};
</script>

<style scoped>
.carousel-wrapper {
    position: relative;
    width: 40%;
    max-width: 300px;
    margin: 0 auto;
    overflow: hidden;
}

.carousel {
    display: flex;
    align-items: center;
    position: relative;
}

.carousel-track {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.carousel-item {
    min-width: 100%;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}

.carousel-image {
    width: 100%;
    height: auto;
    object-fit: cover; /* Ajusta la imagen para que no se distorsione */
    display: block;
}

.view-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgba(0, 123, 255, 0.8);
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 18px;
    z-index: 2;
}

.view-button:hover {
    background-color: rgba(0, 123, 255, 1);
}

.arrow {
    position: absolute;
    top: 50%;
    background: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    z-index: 3;
    transform: translateY(-50%);
}

.left-arrow {
    left: 10px;
}

.right-arrow {
    right: 10px;
}

.titulo-color {
    color: red; /* Cambia 'red' por el color que desees */
    font-size: 24px; /* Opcional: Cambia el tamaño del texto */
}
</style>
