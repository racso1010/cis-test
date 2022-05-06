<template>
  <a v-bind:href="permalink" class="card">
    <div class="card__image">
      <img v-bind:src="image" v-bind:alt="name">
    </div>
    <h1 class="card__title">{{name}}</h1>
    <p class="card__date">{{date}}</p>
  </a>
</template>

<script>
export default {
  name: 'EventCard',
  props: {
    name: String,
    content: String,
    image: String,
    permalink: String,
    date: String
  }
}
</script>

<style scoped lang="sass">

.card{
  --image-height: 200px;
  --title-size: 1.25rem;
  --date-size: 1rem;

  background-color: #fff;
  padding-bottom: .5rem;
  box-shadow: 0 4px 8px -4px #ccc;
  display: grid;
  grid-template-columns: 1fr;
  grid-template-rows: var(--image-height) 70px 35px;
  align-items: start;
  border-radius: .4rem;
  overflow: hidden;
  
  transition: all .25s ease-in-out;

  &:hover{
    transition: transform .25s ease-in-out;
    box-shadow: 0 7px 8px -3px #ccc;
    transform: translate3d(0, -5px,0);
  }

  &__image{
    height: var(--image-height);
    width: 100%;

    & img{
      width: 100%;
      height: 100%;
    }
  }

  &__title{
    padding: .75rem .5rem;
    font-size: var(--title-size);
    color: #000;
  }

  &__date{
    padding: .5rem;
    font-size: var(--date-size);
    color: rgba(#0f2a56, .75);
  }
}

@media screen and (max-width: 1000px) {
  .card{
    --image-height: 160px;
    --date-size: .75rem;
  }
}

@media screen and (max-width: 620px) {
  .card{
    --image-height: 200px;
    --title-size: 1.25rem;
    grid-template-rows: var(--image-height) 50px 30px;
  }
}
</style>