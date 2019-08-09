<template>
  <vue-dropzone
    ref="myVueDropzone"
    id="dropzone"
    :options="dropzoneOptions"
    @vdropzone-success-multiple="uploaded"
    class="mb-4"
  />
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
          dictDefaultMessage: 'Drop images here, or click to select an image to upload.',
          sending (file, xhr, formData) {
            const csrfToken
              = document.head.querySelector('meta[name="csrf-token"]').content

            formData.append('_token', csrfToken)
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




