<template>
    <div class="container">
      <div v-if="profile" class="row">
        <div class="col">
          <uploader @uploaded="updateGallery" />
        </div>
      </div>
      <div class="row">
        <div class="col">
          <gallery
            :photos="photos"
            v-infinite-scroll="loadMore"
          />
        </div>
      </div>
    </div>
</template>

<script>
import infiniteScroll from 'vue-infinite-scroll'

export default {
  directives: { infiniteScroll },

  data() {
    return {
      profile: window.Gallery.profile,
      photos: [],
      limit: 6,
      page: 0
    }
  },

  created() {
    this.loadImages()
  },

  methods: {
    loadImages() {
      const params = {
        offset: this.page * this.limit,
        limit: this.limit
      }
      this.page++

      axios.get('/photos', { params }).then(response => {
        this.photos = this.photos.concat(response.data)
      })

      return this
    },

    updateGallery(photos) {
      this.photos = photos.concat(this.photos)

      return this
    },

    loadMore() {
      return this.loadImages()
    }
  }
}
</script>
