<template>
    <div class="container mt-5">
        <h2>Gestión de Productos</h2>
        <form @submit.prevent="guardarProducto" class="custom-form">
            <div class="form-group mb-3">
                <label for="nombre">Nombre</label>
                <input type="text" v-model="nuevoProducto.nombre" class="form-control" id="nombre" placeholder="Nombre del producto" required>
            </div>
            <div class="form-group mb-3">
                <label for="descripcion">Descripción</label>
                <input type="text" v-model="nuevoProducto.descripcion" class="form-control" id="descripcion" placeholder="Descripción del producto">
            </div>
            <div class="form-group mb-3">
                <label for="precio">Precio</label>
                <input type="number" v-model="nuevoProducto.precio" class="form-control" id="precio" placeholder="Precio del producto" required>
            </div>
            <div class="form-group mb-3">
                <label for="stock">Stock</label>
                <input type="number" v-model="nuevoProducto.stock" class="form-control" id="stock" placeholder="Cantidad en stock" required>
            </div>
            <div class="form-group mb-3">
                <label for="imagen">Imagen (URL)</label>
                <input type="text" v-model="nuevoProducto.imagen" class="form-control" id="imagen" placeholder="URL de la imagen">
            </div>
            <button type="submit" class="btn-custom">Guardar</button>
        </form>

        <br><br><br><br><br>

        <h1>Lista de Productos</h1>
        <div v-if="productos.length" class="product-grid">
            <div v-for="producto in productos" :key="producto.id" class="product-card">
                <img :src="producto.imagen" alt="Imagen de {{ producto.nombre }}" class="product-image" />
                <h2 class="product-name">{{ producto.nombre }}</h2>
                <p class="product-price">{{ producto.precio }} $</p>
                <button class="btn eliminar" @click="eliminarProducto(producto.id)">Eliminar</button>
                <button class="btn editar" @click="editarProducto(producto)">Editar</button>
            </div>
        </div>

        <div v-if="productoEditando" class="edit-form">
            <h2>Editar Producto</h2>
            <form @submit.prevent="actualizarProducto">
                <div class="form-group">
                    <label>Nombre:</label>
                    <input v-model="productoEditando.nombre" required />
                </div>
                <div class="form-group">
                    <label>Precio:</label>
                    <input type="number" v-model="productoEditando.precio" required />
                </div>
                <div class="form-group">
                    <label>Descripción:</label>
                    <input v-model="productoEditando.descripcion" />
                </div>
                <div class="form-group">
                    <label>Imagen:</label>
                    <input v-model="productoEditando.imagen" />
                </div>
                <button type="submit" class="btn actualizar">Actualizar Producto</button>
                <button type="button" class="btn cancelar" @click="productoEditando = null">Cancelar</button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Toastify from 'toastify-js';
import 'toastify-js/src/toastify.css'; // Asegúrate de que la CSS esté importada

export default {
    data() {
        return {
            productos: [],
            nuevoProducto: {
                nombre: '',
                descripcion: '',
                precio: 0,
                imagen: '',
                en_stock: true,
            },
            productoEditando: null,
        };
    },
    mounted() {
        this.obtenerProductos();
    },
    methods: {
        async obtenerProductos() {
            try {
                const response = await axios.get('/api/productos');
                this.productos = response.data.map(producto => {
                    return {
                        ...producto,
                        imagen: `/images/${producto.imagen}`
                    };
                });
            } catch (error) {
                console.error("Error al obtener productos:", error);
                Toastify({
                    text: "Error al cargar productos",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: 'right',
                    backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                }).showToast();
            }
        },
        async guardarProducto() {
            try {
                const response = await axios.post('/api/productos', this.nuevoProducto);
                this.productos.push(response.data);
                this.nuevoProducto = { nombre: '', descripcion: '', precio: 0, imagen: '', en_stock: true };

                console.log("Producto guardado:", response.data);
                Toastify({
                    text: "¡Producto guardado exitosamente!",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: 'right',
                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                }).showToast();
            } catch (error) {
                console.error("Error guardando producto:", error);
                Toastify({
                    text: "Error al guardar el producto: " + (error.response.data.message || 'Error desconocido'),
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: 'right',
                    backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                }).showToast();
            }
        },

        async eliminarProducto(id) {
            try {
                await axios.delete(`/api/productos/${id}`);
                this.productos = this.productos.filter(producto => producto.id !== id);
                Toastify({
                    text: "Producto eliminado con éxito",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: 'right',
                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                }).showToast();
            } catch (error) {
                console.error("Error al eliminar producto:", error);
                Toastify({
                    text: "Error al eliminar producto: " + (error.response.data.message || 'Error desconocido'),
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: 'right',
                    backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                }).showToast();
            }
        },

        editarProducto(producto) {
            this.productoEditando = {...producto};
        },

        async actualizarProducto() {
            try {
                const response = await axios.put(`/api/productos/${this.productoEditando.id}`, {
                    nombre: this.productoEditando.nombre,
                    precio: this.productoEditando.precio,
                    descripcion: this.productoEditando.descripcion,
                    imagen: this.productoEditando.imagen,
                    en_stock: this.productoEditando.en_stock // Agregar esto si es necesario
                });

                this.actualizarLista(response.data);
                Toastify({
                    text: "Producto actualizado con éxito",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: 'right',
                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                }).showToast();
                this.productoEditando = null;
            } catch (error) {
                console.error("Error al actualizar producto:", error.response ? error.response.data : error);
                Toastify({
                    text: "Error al actualizar producto: " + (error.response ? error.response.data.message : 'Error desconocido'),
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: 'right',
                    backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                }).showToast();
            }
        },

        actualizarLista(productoActualizado) {
            const index = this.productos.findIndex(p => p.id === productoActualizado.id);
            if (index !== -1) {
                this.productos.splice(index, 1, productoActualizado);
                console.log("Producto actualizado en la lista:", productoActualizado);
            } else {
                console.error("Producto no encontrado en la lista para actualizar:", productoActualizado.id);
            }
        }
    }
};
</script>

<style scoped>
.container {
    max-width: 600px;
    margin: auto;
}

.custom-form {
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f8f9fa;
}

.form-group {
    margin-bottom: 15px;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
}

.btn-custom {
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-custom:hover {
    background-color: #0056b3;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 columnas en dispositivos grandes */
    gap: 20px;
}

/* Media query para dispositivos más pequeños */
@media (max-width: 768px) {
    .product-grid {
        grid-template-columns: repeat(2, 1fr); /* 2 columnas en dispositivos más pequeños */
    }
}

.product-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    background-color: #fff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
}

.product-card:hover {
    transform: scale(1.05);
}

.product-image {
    width: 100%;
    height: auto;
    border-radius: 4px;
}

.product-name {
    font-size: 1.2em;
    margin: 10px 0;
}

.product-price {
    font-size: 1.1em;
    color: #27ae60;
}

.btn {
    padding: 8px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.eliminar {
    background-color: #e74c3c;
    color: white;
}

.eliminar:hover {
    background-color: #c0392b;
}

.editar {
    background-color: #3498db;
    color: white;
}

.editar:hover {
    background-color: #2980b9;
}

.edit-form {
    margin-top: 20px;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
    display: block; /* Asegúrate de que sea visible */
    visibility: visible; /* Asegúrate de que sea visible */
    opacity: 1; /* Asegúrate de que no esté oculto */
}

.form-group {
    margin-bottom: 15px;
}

input[type="text"],
input[type="number"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

input[type="text"]:focus,
input[type="number"]:focus {
    border-color: #3498db;
    outline: none;
}
</style>
