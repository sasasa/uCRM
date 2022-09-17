<script setup>
  import InputLabel from '@/Components/InputLabel.vue'
  import TextInput from '@/Components/TextInput.vue'
  import GuestLayout from '@/Layouts/GuestLayout.vue'

  const emitTest = e => console.log(e)
</script> 

<template>
<GuestLayout>
  <InputLabel>タイトル</InputLabel>
  <TextInput
    @update:modelValue="emitTest"
    modelValue="初期値です"></TextInput>
</GuestLayout>
</template>