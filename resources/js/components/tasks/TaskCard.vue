<template>
  <div class="col-lg-3 col-md-6 col-sm-12">

    <div class="card">
      <div class="card-header fw-bold">
        {{ title }}
      </div>
      <div class="card-body">
        <p class="card-text">{{ content }}</p>
        <span
          class="badge rounded-pill bg-secondary"
          v-for="tag in tags"
          >{{ tag.name }}
        </span>
      </div>
      <div class="card-footer">

        <a href="#" class="btn btn-primary me-2">Update</a>
        <a href="#" class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</template>

<script>
import CreateTaskModalVue from './CreateTaskModal.vue'
import UpdateTaskModalVue from './UpdateTaskModal.vue'

export default {
  name: 'task',
  components: [
    CreateTaskModalVue,
    UpdateTaskModalVue,
  ],
  props: [
    'id',
    'title',
    'content',
    'status',
    'tags'
  ],
  methods: {
  },
};
</script>
