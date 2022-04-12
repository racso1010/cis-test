<template>
    <a :href="permalink" class="card">
        <div class="card__image">
            <img :src="thumbnail" :alt="title">
        </div>

        <h3>{{title}}</h3>
        <p>{{postDate}}</p>
    </a>
</template>

<script>
import moment from "moment";

export default {
    name: "Card",
    data() {
        return {
            key: 12
        }
    },
    props: {
        title: {
            type: String,
            default: ""
        },
        postContent: {
            type: String,
            default: ""
        },
        permalink: {
            type: String,
            default: ""
        },
        thumbnail: {
            type: String,
            default: ""
        },
        postDate: {
            type: String,
            default: ""
        }
    },

    mounted () {
        /** Change the date format */
        const date = moment(this.postDate);

        this.postDate = date.format("MMM Do YY");
    },
}
</script>

<style scoped lang="sass">

$image-height: 200px
$card-height: 250px

$black-color: black

.card 
    text-decoration: none
    color: $black-color
    margin: .5em .5em 1.5em .5em
    display: flex
    flex-direction: column
    max-height: $card-height
    
    &__image
        //overflow: hidden
        height: $image-height

        & img
            height: $image-height
            transition-duration: 1s
            width: 100%
            background-position: center
            background-size: cover

            &:hover
                transform: translateY(-15px)
                transition-duration: 1s
                filter: brightness(70%)


</style>