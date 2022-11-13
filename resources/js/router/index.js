import { createRouter, createWebHashHistory } from 'vue-router'
import Tasks from '../views/Tasks.vue'

const routes = [
	{
		path: '/',
		name: 'Tasks',
		component: Tasks
	},
]

const router = createRouter({
	history: createWebHashHistory(),
	base: import.meta.env.VITE_APP_URL,
	routes
})

export default router


