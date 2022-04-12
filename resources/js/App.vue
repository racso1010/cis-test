<template>
    <!-- Dashboard View -->
    <div class="dashboard-view dash-view">
        <h1 class="title">Welcome to Crazy Imagine Software</h1>

        <div class="card-container">
        <Card v-for="event in events" 
        :key="event.id" 
        :title="event.post_title"
        :postContent="event.post_content"
        :permalink="event.permalink"
        :thumbnail="event.thumbnail"
        :postDate="event.post_date"
        />
        </div>
        

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

<style scoped lang="sass">
$white-color: #ffff

.title
    text-align: center
    margin-top: 1em

.card-container
    animation-duration: 3s
    animation-name: first-a
    border-radius: 10px 
    margin-top: 2em
    padding: 1.5em
    background-color: $white-color
    display: grid
    grid-template-columns: 1fr 1fr 1fr

// animation
@keyframes first-a
    from 
        transform: translateX(-100vw)
    
    to
        transform: translate(0vw)
    


// Responsive
@media screen and (max-width: 800px)
    .card-container
        grid-template-columns: 1fr 1fr
        

@media screen and (max-width: 500px)
    .card-container
        grid-template-columns: 1fr
        
</style>
