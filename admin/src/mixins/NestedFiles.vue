<script>
  export default {
    methods: {
      async getAllNestedFiles (filesAndFolders) {
        let files = []

        for (let i = 0; i < filesAndFolders.length; i++) {
          if (filesAndFolders[i].type === 'folder') {
            try {
              const { data } = await this.$http.post('staff/media/get-files', {
                path: filesAndFolders[i].storage_path,
              }, {
                baseURL: '/',
              })

              files = files.concat(await this.getAllNestedFiles(data.files.items.data))
            } catch (e) {
              this.$emit('error')
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
