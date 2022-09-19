<script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import FlashMessage from '@/Components/FlashMessage.vue';
  import { Head, Link } from '@inertiajs/inertia-vue3';
  import { onMounted, ref } from 'vue'
  import { Inertia } from '@inertiajs/inertia'

  import Pagination from '@/Components/Pagination.vue'
  
  const props = defineProps({
    'orders' : Object
  })

  // onMounted(() => { //ページが表示されたタイミングで実行
  //   console.log(props.customers)
  // })

  const search = ref('')
  // ref の値を取得するには .valueが必要
  const searchCustomers = () => {
    Inertia.get(route('customers.index', { search: search.value }))
  }
</script>
  
<template>
    <Head title="購買履歴" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              購買履歴
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                      <section class="text-gray-600 body-font">
                        <div class="container px-5 py-8 mx-auto">
                          <FlashMessage />
                          <div class="flex pl-4 my-4 lg:w-2/3 w-full mx-auto">
                            <div>
                              <input type="text" name="search" v-model="search">
                              <button class="bg-blue-300 text-white py-2 px-2" @click="searchCustomers">検索</button>
                            </div>
                          </div>
                          <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                              <thead>
                                <tr>
                                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">Id</th>
                                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">氏名</th>
                                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">合計金額</th>
                                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ステータス</th>
                                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">購入日</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr v-for="customer in props.orders.data" :key="customer.id">
                                  <td class="px-4 py-3">
                                    <Link 
                                      class="text-blue-400"
                                      :href="route('purchases.show', { purchase: customer.id })">{{ customer.id }}
                                    </Link>
                                  </td>
                                  <td class="px-4 py-3">{{ customer.customer_name }}</td>
                                  <td class="px-4 py-3">{{ customer.total }}</td>
                                  <td class="px-4 py-3">
                                    {{ customer.status }}
                                  </td>
                                  <td class="px-4 py-3">
                                    {{ customer.created_at }}
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <Pagination class="mt-6" :links="props.orders.links"></Pagination>
                      </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
  