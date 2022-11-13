<template>
	<div class="dashboard container">
    <div class="row g-4 py-3">
      <div class="col-md-6 col-sm-12">
        <div class="input-group mb-3">
          <input type="text" class="form-control" v-model="query" placeholder="Search" aria-label="Search" aria-describedby="search-query">
          <button class="btn btn-outline-secondary" type="button" @click="search()">Search</button>
        </div>
      </div>
      <div class="col-md-6 col-sm-12">
        <button type="button" class="btn btn-primary">+ Add Task</button>
      </div>
    </div>

		<div class="row g-4 py-3">
      <TaskCard
				v-for="task in tasks"
        :id="task.id"
        :title="task.title"
        :content="task.content"
        :status="task.status"
        :tags="task.tags"
      />
		</div>
	</div>
</template>

<script>
import TaskCard from '../components/tasks/TaskCard.vue'

export default {
	name: 'Tasks',
  data: () => ({
    tasks: null,
    query: ''
  }),
	components: {
		TaskCard,
	},
	created() {
		this.fetchTasks()
	},
  methods: {
    async fetchTasks() {
      axios.get('/api/tasks', {
        params: {
          query: this.query
        }
      }).then(response => {
        this.tasks = response.data.data
      })
    },
    search() {
      this.fetchTasks()
    }
  }
}
</script>
