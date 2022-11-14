<template>
	<div class="dashboard container" v-if="task">
    {{ task }}
	</div>
</template>

<script>

export default {
	name: 'Tasks',
  data: () => ({
    task: null
  }),
	created() {
    console.log(task)
		this.getTask(this.$route.params.id)
    console.log(task)
	},
  methods: {
    async getTask(id) {
      this.$http.get('/api/tasks/' + id, {
      }).then(response => {
        this.task = response.data.data
      })
    }
  }
}
</script>
