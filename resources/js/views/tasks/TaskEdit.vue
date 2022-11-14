<template>
	<div class="dashboard container" v-if="task">
    <div class="card mt-3">
      <div class="card-header d-flex justify-content-between">
        Edit Task
        <button class="float-right btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-task-modal">Delete</button>
      </div>
      <div class="card-body">

        <form id="edit-task-form">
          <div class="mb-3">
            <label for="title" class="col-form-label">Title:</label>
            <input type="text" class="form-control" v-model="task.title">
          </div>
          <div class="mb-3">
            <label for="content" class="col-form-label" >Content:</label>
            <textarea class="form-control" v-model="task.content" rows="5"></textarea>
          </div>
          <div class="mb-3">
            <label for="status" class="col-form-label" >Status:</label>
            <select class="form-control" v-model="task.status" rows="5">
              <option value="Draft">Draft</option>
              <option value="To do">To do</option>
              <option value="Ongoing">Ongoing</option>
              <option value="Done">Done</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="tags" class="col-form-label" >Tags:</label>
            <select class="form-select" multiple aria-label="multiple select" v-model="task.tags">
              <option
                v-for="tag in tags"
                :key="tag.id"
                :value="tag"
                >{{ tag.name }}
              </option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary" @click="updateTask">Update Task</button>
        </form>
      </div>
    </div>

    <delete-task-modal
      ref="deleteTaskModal"
      :task="task"
      @get-task="getTask(this.$route.params.id)"
    ></delete-task-modal>
	</div>
</template>

<script>
import DeleteTaskModal from '../../components/tasks/DeleteTaskModal.vue'

export default {
	name: 'Tasks',
  components: {
    DeleteTaskModal,
  },
  data: () => ({
    task: {},
    tags: []
  }),
	created() {
		this.fetchTags()
		this.getTask(this.$route.params.id)
	},
  methods: {
    async getTask(id) {
      this.$http.get('/api/tasks/' + id, {
      }).then(response => {
        this.task = response.data.data
      }).catch(e => {
        this.$router.push({name: 'tasks'})
      })
    },
    async fetchTags() {
      this.$http.get('/api/tags').then(response => {
        this.tags = response.data.data
      })
    },
    updateTask() {
      this.$http.put('/api/tasks/' + this.$route.params.id, this.task)
        .then(response => {
          alert('Successfully updated task!')
		      this.getTask(this.$route.params.id)
        })
    }
  }
}
</script>
