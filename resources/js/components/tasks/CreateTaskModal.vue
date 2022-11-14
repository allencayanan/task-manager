<template>
  <div>
    <div class="modal fade" tabindex="-1" id="create-task-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Create Task</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="create-task-form">
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
            </form>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" @click="saveTask">Save Task</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'create-task-modal',
  data: () => ({
    task: {
      title: '',
      content: '',
      status: '',
      tags: []
    },
    tags: []
  }),
  created() {
		this.fetchTags()
	},
  methods: {
    async fetchTags() {
      this.$http.get('/api/tags').then(response => {
        this.tags = response.data.data
      })
    },
    saveTask() {
      this.$http.post('/api/tasks', this.task)
        .then(response => {
          alert('Successfully saved task!')
          this.$emit('fetchTasks')
        })
    }
  }
};
</script>
