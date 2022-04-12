<template>
    <div class="card">
        
    </div>
</template>

<script>
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
        post_content: {
            type: String,
            default: ""
        },
        permalink: {
            type: String,
            default: ""
        }
    },
}
</script>

<style scoped lang="sass">

</style>