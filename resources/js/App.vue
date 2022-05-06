
<template>
  <div class="dashboard-view dash-view">
    <section class="events-container">
      <div v-if="loading" class="loading">
        <Loader />
      </div>
      <ul v-else class="events__list">
        <li v-for="event in events" :key="event.id" class="events__item" >
          <EventCard
            :name="event.name"
            :image="event.image"
            :permalink="event.permalink"
            :date="event.date"
          />
        </li>
      </ul>
    </section>
  </div>
</template>

<script>
import EventCard from './components/EventCard.vue'
import Loader from './components/Loader.vue'
const URL_REST_API = `${location.href}/wp-json/cis/v1/events`

export default {
  name: "App",
  components: {
    EventCard,
    Loader
  },
  data() {
    return {
      events: [],
      loading: true
    };
  },
  mounted(){
    this.loading = true
    this.getAllEvents(URL_REST_API)
    .then(data => {
      this.events = data
      this.loading = false
    })
  },
  methods: {
    async getAllEvents(url) {
      const data = await fetch(url)

      if (data.status !== 200) {
        console.error('Error consuming API')
        return []
      }
      return await data.json()
    }
  }
};
</script>

<style scoped lang="sass">
$main-color: #0f2a56;

.loading{
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 1rem;
  min-height: 400px;

  &  svg{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100px;
    height: 100px;
  }
}

.events-container{
  padding: 1rem;
}

.events__list{
  list-style: none;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1rem;

  opacity: 0;
  transform: translate3d(0,25px,0);

  animation: intro 1s ease-out .25s forwards;

  @keyframes intro {
    to{
      opacity: 1;
      transform: translate3d(0,0,0);
    }
  }
}

@media screen and (max-width: 1000px) {
  .events__list{
    grid-template-columns: repeat(auto-fill, minmax(260px, auto));
  }
}

</style>
