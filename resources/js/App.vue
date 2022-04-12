<template>
  <!-- Dashboard View -->
  <div class="dashboard-view dash-view">
    {{ hello }}, Welcome to Crazy Imagine Software!

    <Card v-for="event in events" :key="event.id" :title="event.post_title"/>

  </div>
</template>

<script>
import axios from "axios";
import Card from "../components/Card.vue"


export default {
  name: "App",
  components: {
    Card,
  },
  data() {
    return {
      hello: "Hello",
      events: []
    };
  },
  created() {

    this.getEvents();
  },
  methods: {
    async getEvents() {
      /** Find the events using the wordpress API */
      const response = await axios.get(`${process.env.WORDPRESS_BASE_URL}/wp-json/event/get`);

      this.events = response.data;

      console.log(this.events)
    }
  },
};
</script>

<style scoped lang="sass"></style>
