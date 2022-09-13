<script setup>
  import { reactive } from 'vue'
  import { Inertia } from '@inertiajs/inertia'
  
  defineProps({
    errors: Object
  }) 
  const form = reactive({
    title: null,
    content: null,
  })
  const submitFunction = () => {
    // Inertia.post('/inertia', form)
    Inertia.post(route('inertia.store'), form)
  }
</script>

<template>
  <form @submit.prevent="submitFunction">
    <div v-if="errors.title">{{ errors.title }}</div>
    <div>
      <input type="text" name="title" v-model="form.title">
    </div>
    <div v-if="errors.content">{{ errors.content }}</div>
    <div>
      <input type="text" name="content" v-model="form.content">
    </div>
    <div>
      <button>送信</button>
    </div>
  </form>
</template>