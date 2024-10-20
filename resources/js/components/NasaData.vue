use Illuminate\Support\Facades\Http;
<template>
  <div>
    <h2>Datos de la API de la NASA</h2>

    <!-- Mostrar error si lo hay -->
    <div v-if="error" class="alert alert-danger">{{ error }}</div>

    <!-- Mostrar spinner mientras se cargan los datos -->
    <div v-if="loading" class="spinner-border text-primary" role="status">
      <span class="sr-only">Cargando...</span>
    </div>

    <!-- Mostrar la lista de satélites cuando se cargan los datos -->
    <ul v-if="satellites.length > 0" class="list-group">
      <li v-for="satellite in satellites" :key="satellite.id" class="list-group-item">
        <strong>{{ satellite.satelliteId }}</strong> - {{ satellite.name }}
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      satellites: [],
      error: null,
      loading: false
    };
  },
  mounted() {
    this.fetchNasaData();
  },
  methods: {
    fetchNasaData() {
      this.loading = true;

      // Hacemos la solicitud a través del proxy de Laravel
      axios.get('/api/nasa-proxy')
          .then(response => {
            if (response.data && response.data.member) {
              this.satellites = response.data.member;  // Aquí almacenamos los datos de los satélites
            } else {
              this.error = 'Los datos recibidos no son válidos.';
              console.error('Datos recibidos:', response.data);  // Depuración de la respuesta
            }
          })
          .catch(error => {
            // Aquí mostramos detalles del error
            if (error.response) {
              // Errores con respuesta del servidor
              this.error = `Error ${error.response.status}: ${error.response.data.message || error.response.statusText}`;
              console.error('Error con respuesta:', error.response);
            } else if (error.request) {
              // Errores sin respuesta del servidor
              this.error = 'No se recibió una respuesta del servidor de la API de la NASA.';
              console.error('Error en la solicitud:', error.request);
            } else {
              // Otros errores
              this.error = `Error al cargar los datos: ${error.message}`;
              console.error('Error:', error.message);
            }
          })
          .finally(() => {
            this.loading = false;
          });
    }
  }
};
</script>

<style>
.spinner-border {
  display: block;
  margin: 20px auto;
}
</style>
