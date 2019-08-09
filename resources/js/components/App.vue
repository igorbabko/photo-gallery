<template>
    <div class="container">
      <div class="row">
        <div class="col">
          <uploader @uploaded="updateGallery" />
        </div>
      </div>
      <div class="row">
        <div class="col">
          <gallery :photos="photos" />
        </div>
      </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      profile: window.Gallery.profile,
      photos: []
    }
  },

  created() {
    axios.get('/photos').then(response => {
      this.photos = response.data
    })
  },

  methods: {
    updateGallery(photos) {
      this.photos = photos.concat(this.photos)

      return this
    }
  }
}
</script>
