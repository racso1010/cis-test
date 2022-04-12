<template>
  <!-- Dashboard View -->
  <div class="dashboard-view dash-view">
    <div class="contenedor-eventos">
      <a :href="`eventos/${evento.post_name}`" class="evento" v-for="evento in eventos" v-bind:key="evento.id" v-bind:value="evento">
        <img class="imagen-post" :src="evento.thumbnail" />
        <h1 class="titulo-post">{{evento.post_title}}</h1>
        <p class="parrafo-post">{{evento.post_content}}</p>
        <div class="heart-post">
          <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.999519 3.99902C1.39952 7.59902 5.83285 11.1657 7.99952 12.499C10.333 10.6657 14 8.49825 15 3.99902C16 -0.500207 7.99952 -0.500977 7.99952 3.99902C7.99952 -0.500977 0.499519 -0.500977 0.999519 3.99902Z" stroke="black"/>
          </svg>
        </div>
      </a>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'
  export default {
    name: "App",
    data() {
      return {
        eventos: []
      };
    },

    created() {
      //cargar de informacion

      this.loadEvents();
    },
    methods: {

      // funcion para la consulta de los eventos cargados en el nuevo CPT

      async loadEvents(){

        //consulta con axios

        let eventosRequest = await axios({
          url: `http://localhost:80/wordpress-api/wordpress/wp-json/cistest/v1/eventos`,
          method: 'GET',
          headers: {'Content-Type': 'application/json; charset=UTF-8'},
        })

        //iterador de los eventos consultados de la API-REST de wordpress

        this.eventos = [...eventosRequest.data[0]]
      }
    },
  };
</script>

<style scoped>
  *{
    margin:0px;
    padding:0px;
  }
  .dashboard-view{
    width: 100%;
    height: auto;
    display:flex;
    justify-content: center;
    background:rgb(233, 233, 233);
  }
  .contenedor-eventos{
    width:1000px;
    height:auto;
    background:white;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.25);
    display:flex;
    align-items: center;
    flex-direction:row;
    flex-wrap: wrap;
    margin-top:40px;
    margin-bottom:100px;
  }
  .evento{
    height:500px;
    margin-top:40px;
    width:28%;
    margin-left:4%;
    padding:10px;
    margin-bottom:40px;
    position:relative;
  }
  .evento:hover{
    background:rgb(233, 233, 233);
  }
  .imagen-post{
    width:100%;
    height:200px;
  }
  .titulo-post{
    font-size:26px;
    margin-top:20px;
    margin-bottom:10px;
  }
  .parrafo-post,.parrafo-post:link{
    font-size:15px;
    color:black;
  }
  .heart-post{
    position:absolute;
    width:40px;
    height:40px;
    border-radius:100%;
    top:180px;
    right:0px;
    background:white;
    box-shadow: 0 5px 5px rgba(0, 0, 0, 0.25);
    display:flex;
    align-items: center;
    justify-content: center;
  }
  @media (max-width: 900px) { 
    .evento{
      width:42.5%;
      margin-left:5.5%;
    }
  }
  @media (max-width: 600px) { 
    .evento{
      width:90%;
      margin-left:5.5%;
    }
  }

</style>
