<script>
  /* global EventHub */

  export default {
    created () {
      EventHub.listen('MediaManager-create-new-item', (images) => this.createItemFromImages(images))
    },

    beforeDestroy () {
      EventHub.removeListenersFrom('MediaManager-create-new-item')
    },

    methods: {
      async createItemFromImages (filesAndFolders) {
        const payload = {
          item: {
            parent_id: this.id || null,
          },
          images: await this.getAllNestedFiles(filesAndFolders),
        }

        try {
          const { data } = await this.$http.post('/api/items?project=catalogue', payload)

          window.location.href = `/staff/items/${data.id}`
        } catch (e) {
          this.showSnackbarError()
        }
      },

      async getAllNestedFiles (filesAndFolders) {
        let files = []

        for (let i = 0; i < filesAndFolders.length; i++) {
          if (filesAndFolders[i].type === 'folder') {
            try {
              const { data } = await this.$http.post('/staff/media/get-files', {
                path: filesAndFolders[i].storage_path,
              })

              files = files.concat(await this.getAllNestedFiles(data.files.items.data))
            } catch (e) {
              this.showSnackbarError()
              throw e
            }
          } else {
            files.push(filesAndFolders[i])
          }
        }

        return files
      },
    },
  }
</script>
