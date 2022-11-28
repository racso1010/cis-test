<template>
  <!-- Dashboard View -->
  <div class="dashboard-view dash-view">
    {{ hello }}, Welcome to Crazy Imagine Software!
  </div>
</template>

<script>
import axios from 'axios';
export default {
  name: "App",

  data() {
    return {
      hello: "Hello, luis carreno",
      cards: [],
    };
  },
  mounted() {
    axios.get('http://localhost.com/wp-json/luiscarreno/v1/eventos').then(response => { this.cards = response.data});
    console.log(this.cards);
  },
  created() {},
  methods: {},
};
</script>

<style scoped lang="sass"></style>
