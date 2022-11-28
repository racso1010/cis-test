<template>
  <!-- Dashboard View -->
  <div class="dashboard-view dash-view">
    {{ hello }}, Welcome to Crazy Imagine Software! 2
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
    axios.get('http://localhost/crazy/wp-json/luiscarreno/v1/eventos').then(response => { this.cards = response.data});
    console.log(this.cards);
  },
  created() {},
  methods: {},
};
</script>

<style scoped lang="sass"></style>
