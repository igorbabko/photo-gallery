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
      :style="style(image)"
    >
      <a
        v-if="profile"
        :href="image"
        download
        @click.stop
        class="btn btn-success"
      >
        <i class="fas fa-download" />
      </a>
    </div>
  </div>
</template>

<script>
  import VueGallery from 'vue-gallery'

  export default {
    props: ['photos'],

    data() {
      return {
        profile: window.Gallery.profile,
        index: null
      }
    },

    components: {
      VueGallery
    },

    computed: {
      images() {
        return this.photos
          && this.photos.map(photo => window.Gallery.url + photo.path)
      },

      style() {
        return path => ({
          backgroundImage: `url(${path})`,
          width: '300px',
          height: '200px'
        })
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
    position: relative

  a[download]
    position: absolute
    right: 0
    bottom: 0
    margin: 5px
</style>
