<template>
  <form class="rounded shadow-lg p-4 bg-slate-100">
    <div class="text-center uppercase font-bold">Add Project</div>
    <div class="py-5">
      <label for="">Project Name</label>
      <input
        type="text"
        class="mt-2 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
        placeholder="Enter project name"
        v-model="projectName"
      >
      <div>

      </div>
    </div>
    <button class="border text-white py-2 px-4 rounded bg-[#11b981]" @click.prevent="saveProject">Add Project</button>
  </form>
</template>
<script lang="ts">
import { defineComponent, reactive, toRefs } from 'vue'
import axios from 'axios'
interface State {
  projectName: string,
  isLoading: boolean,
  errors: any
}

export default defineComponent({
  name: 'dashboard',
  setup() {
    const states: State = reactive({
      projectName: '',
      isLoading: false,
      errors: []
    })

    const saveProject = async() => {
      states.isLoading = true;
      const data = new FormData()

      data.append('project_name', states.projectName)

      await axios.post('/api/v1/project', data, {
        headers: {
          "content-type": "multipart/form-data"
        }
      })
      .then((data) => {
        console.log("data", data);

      })
      .catch(err => {
        states.isLoading = false;
        states.errors = Object.values(err.response.data.errors.message).reduce(
          (errors, message: any) => states.errors.concat(message)
          ,
          []
        )
        console.log("states.errors", states.errors);

      });
    }
    return {
      ...toRefs(states),
      saveProject
    }
  },
})
</script>
