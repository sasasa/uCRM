<script setup>
  import { Link } from '@inertiajs/inertia-vue3';
  import { ref } from 'vue' // リアクティブ
  
  const newTitle = ref('')
  const newContent = ref('')
</script>


<template>
  Inertiaテストです。<br>
  <a href="/">aタグでWelcomeに移動</a><br>
  <Link href="/">LinkでWelcomeに移動</Link><br>
  <Link :href="route('inertia.index')">名前付きルートの確認ziggyライブラリで移動</Link><br>
  <Link :href="route('inertia.show', { id: 1 })">ルートパラメーターのテストです</Link><br>
  <Link :href="route('inertia.create')">フォームのページです</Link><br>

  <div class="mb-8">
    <input type="text" name="newTitle" v-model="newTitle">{{ newTitle }}<br>
    <input type="text" name="newContent" v-model="newContent">{{ newContent }}<br>
    <Link as="button" method="post" :href="route('inertia.store')" :data="{ title: newTitle, content: newContent }">保存テスト</Link>
  </div>
</template>