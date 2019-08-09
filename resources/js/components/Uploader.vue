<template>
  <div class="row">
    <div class="col mb-4">
      <vue-dropzone
        ref="myVueDropzone"
        id="dropzone"
        :options="dropzoneOptions"
        @vdropzone-success-multiple="uploaded"
      />
    </div>
  </div>
</template>

<script>
  import vue2Dropzone from 'vue2-dropzone'
  import 'vue2-dropzone/dist/vue2Dropzone.min.css'

  export default {
    components: {
      vueDropzone: vue2Dropzone
    },

    data() {
      return {
        dropzoneOptions: {
          url: '/photos',
          acceptedFiles: '.jpeg,.jpg,.png,.gif',
          uploadMultiple: true,
          paramName: 'image',
          sending (file, xhr, formData) {
            const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content

            formData.append('_token', csrfToken);
          }
        }
      }
    },

    methods: {
      uploaded(files, photos) {
        this.$emit('uploaded', photos)

        return this
      }
    }
  }
</script>




