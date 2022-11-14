<template>
  <div class="col-lg-3 col-md-6 col-sm-12">

    <div class="card">
      <div class="card-header fw-bold">
        {{ title }}
      </div>
      <div class="card-body">
        <h6 class="card-subtitle mb-2 text-muted">{{ status }}</h6>
        <p class="card-text">{{ content }}</p>
        <span
          class="badge rounded-pill bg-secondary me-2"
          v-for="tag in tags"
          :key="tag.id"
          >{{ tag.name }}
        </span>
      </div>
      <div class="card-footer">
        <router-link :to="'/tasks/' + id + '/edit/'" class="btn btn-info text-white">Edit</router-link>
      </div>
    </div>
  </div>
</template>

<script>
import CreateTaskModalVue from './CreateTaskModal.vue'

export default {
  name: 'task',
  components: [
    CreateTaskModalVue,
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
