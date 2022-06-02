<template>
  <!-- Dashboard View -->
  <div>
    <div class="dash-title"><h1>Events</h1></div>
    <admin-events :app="this"></admin-events>
  </div>
</template>

<script>
window.axios = require('axios');
//import component events
import AdminEvents from "./Events";
export default {
  name: "App",
  components:{
    AdminEvents,
  },
  data() {
    //return data events
    return {
    };
  },
  mounted(){
    
  },
  methods: {
    
  },
};
</script>
<style scoped>
.dash-title{
  padding: 20px 20px 20px 20px;
  margin: 20px 0px 0px 0px;
}
.dash-title h1{
color: #39364f;
font-weight: bold;
}
</style>
