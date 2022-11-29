<template>
  <!-- Dashboard View -->
  <div class="dashboard-view dash-view">
    {{ hello }}, Welcome to Crazy Imagine Software! 
    <br>
    <div class="container-cards">
      <a :href="eventos.link" class="cards" v-for="eventos in cards" >
        
      
        <img class="hero-image" :src="eventos.Image" />
        <h2 class="titulo">{{eventos.title}}</h2>
        <div class="heart"><svg class="icon-heart" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M12 21.593c-5.63-5.539-11-10.297-11-14.402 0-3.791 3.068-5.191 5.281-5.191 1.312 0 4.151.501 5.719 4.457 1.59-3.968 4.464-4.447 5.726-4.447 2.54 0 5.274 1.621 5.274 5.181 0 4.069-5.136 8.625-11 14.402m5.726-20.583c-2.203 0-4.446 1.042-5.726 3.238-1.285-2.206-3.522-3.248-5.719-3.248-3.183 0-6.281 2.187-6.281 6.191 0 4.661 5.571 9.429 12 15.809 6.43-6.38 12-11.148 12-15.809 0-4.011-3.095-6.181-6.274-6.181"/></svg></div>
        
       
        <p class="content">{{eventos.content}}</p>
        <p class="date">{{eventos.date}}</p>
              </a>
              <br>

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
margin-left: 10px;
float: left;
}
.content{
  margin-left: 10px;
  float: left;
  width: 80%;
}
.titulo{
  margin-left: 10px;
  float: left;
  margin-top: 5px;
  width: 70%;
}
.hero-image{
  z-index: -1;
}
.icon-heart{
  margin-left: 8px;
  margin-top: 8px;
}
.icon-heart:hover{
 fill: red;

}

.heart{
  border-radius: 50%;
  height: 40px;
  width: 40px;
  margin-right: 10px;
  margin-top: 5px;
  float: right;
  background-color: white;
}
</style>
