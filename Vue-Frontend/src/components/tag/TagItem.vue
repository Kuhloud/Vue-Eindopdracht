<template>
    <section class="badge rounded-pill d-inline">
        {{tag.tag_name}} 
    </section>
</template>
<script>

export default {
name: 'TagItem',
props: {
    tag: Object
},
}
</script>
<style scoped>
.badge {
    background-color: #E30380;
    color: white;
    margin-right: 0.5em;
}
</style>