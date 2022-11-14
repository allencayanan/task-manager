<template>
  <div>
    <div class="modal fade" tabindex="-1" id="delete-task-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Task</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="delete-task-form">
              <div class="mb-3">
                Are you sure you want to delete this task?
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" @click="deleteTask">Delete Task</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'delete-task-modal',
  props: [
    'task',
  ],
  methods: {
    deleteTask () {
      this.$http.delete('/api/tasks/'+ this.$route.params.id).then(response => {
        alert('Successfully deleted task!')
        this.$router.push({name: 'tasks'})
      })
    }
  }
};
</script>
