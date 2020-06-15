<template>
<data-table
    :columns="columns"
    url="http://example.test/example">
  </data-table>
</template>

<script>
export default {
  data() {
    return {
      columns: [
        {
          label: 'ID',
          name: 'id',
          orderable: true,
        },
        {
          label: 'Name',
          name: 'name',
          orderable: true,
        },
        {
          label: 'Email',
          name: 'email',
          orderable: true,
        },
      ]
    }
  },
}
</script>
