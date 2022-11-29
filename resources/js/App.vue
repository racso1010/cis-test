<template>
  <!-- Dashboard View -->
  <div class="dashboard-view dash-view">
    {{ hello }}, Welcome to Crazy Imagine Software! 
    <br></br>
    <div class="container-cards">
      <a :href="eventos.link" class="cards" v-for="eventos in cards" >
        
      
        <img class="hero-image" :src="eventos.Image" />
        <h2 class="titulo">{{eventos.title}}</h2>
        <p class="content">{{eventos.content}}</p>
        <p class="date">{{eventos.date}}</p>
      </a>

    </div>  
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "App",

  data() {
    return {
      hello: "Hello, luis carreno",
      cards: [],
    };
  },
  mounted() {
    
    
  },
  created() {
    axios.get('/crazy/wp-json/luiscarreno/v1/eventos').then(response => { this.cards = response.data});
    console.log(this.cards);
  },
  methods: {},
};
</script>

<style scoped>
.container-cards {

display: grid;
grid-template-columns: repeat(auto-fill, minmax(min(100%, 25rem), 1fr));
gap: 1rem;
align-content: center;
text-decoration: none;
grid-auto-flow: dense;
height: 100%;

color: black;
}
.container-cards a:hover{
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}
.container-cards a{color: rgba(0, 0, 0, 0.747);
background-color: rgb(243, 243, 243);
border-radius: 20px;
}
.date{
color: rgb(255, 115, 0);
font-weight: 600;
}
</style>
