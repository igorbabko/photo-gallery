<template>
  <div class="d-flex justify-content-center flex-wrap">
    <vue-gallery
      :images="images"
      :index="index"
      @close="index = null"
    />
    <div
      class="image"
      v-for="(image, imageIndex) in images"
      :key="imageIndex"
      @click="index = imageIndex"
      :style="style"
    ></div>
  </div>
</template>

<script>
  import VueGallery from 'vue-gallery'

  export default {
    props: ['photos'],

    data() {
      return {
        index: null
      }
    },

    components: {
      VueGallery
    },

    computed: {
      images() {
        return this.photos && this.photos.map(photo => photo.path).slice(0, 10)
      },

      style(image) {
        return {
          backgroundImage: 'url(' + image + ')',
          width: '300px',
          height: '200px'
        }
      }
    }
  }
</script>

<style lang="sass" scoped>
  .image
    float: left
    background-size: cover
    background-repeat: no-repeat
    background-position: center center
    border: 1px solid #ebebeb
    margin: 5px
</style>
