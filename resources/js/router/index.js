import { createRouter, createWebHashHistory } from 'vue-router'
import Tasks from '../views/tasks/Tasks.vue'
import TaskEdit from '../views/tasks/TaskEdit.vue'

const routes = [
	{
		path: '/',
		name: 'tasks',
		component: Tasks
	},
	{
		path: '/tasks/:id/edit',
		name: 'task-edit',
		component: TaskEdit
	},
]

const router = createRouter({
	history: createWebHashHistory(),
	base: import.meta.env.VITE_APP_URL,
	routes
})

export default router


