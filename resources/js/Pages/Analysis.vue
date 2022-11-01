<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { reactive, onMounted } from 'vue'
import { getToday, getOneYearAgo } from '@/common'

import Chart from '@/Components/Chart.vue'
import ResultTable from '@/Components/ResultTable.vue'

const form = useForm({
    startDate: null, 
    endDate: null,
    type: 'perDay',
    rfmPrms: [
            28, 60, 90, 120,
            6, 5, 4, 3,
            300000, 200000, 100000, 30000
    ],
    axis: 'rf',
});
onMounted(() => {
    form.startDate = getOneYearAgo()
    form.endDate = getToday()
})
const data = reactive({})
const getData = async () => {
    try{
        await axios.get(route('api.analysis'), {
            params: {
                startDate: form.startDate,
                endDate: form.endDate,
                type: form.type,
                rfmPrms: form.rfmPrms,
                axis: form.axis,
            }
        })
        .then( res => {
            // data.value = res.data
            // console.log(res)
            data.data = res.data.data
            data.totals = res.data.totals
            data.type = res.data.type
            if(res.data.labels) {
                data.labels = res.data.labels
            }
            if(res.data.eachCount) {
                data.eachCount = res.data.eachCount
            }
            if(res.data.axis) {
                data.axis = res.data.axis
            }
        })
    } catch (e){
        console.log(e.message)
    }
}

</script>

<template>
    <Head title="データ分析" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                データ分析
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="getData">
                            分析方法<br>
                            <label for=""><input type="radio" v-model="form.type" value="perDay"><span class="mr-4">日別</span></label>
                            <label for=""><input type="radio" v-model="form.type" value="perMonth"><span class="mr-4">月別</span></label>
                            <label for=""><input type="radio" v-model="form.type" value="perYear"><span class="mr-4">年別</span></label>
                            <label for=""><input type="radio" v-model="form.type" value="decile"><span class="mr-4">デシル分析</span></label>
                            <label for=""><input type="radio" v-model="form.type" value="rfm"><span class="mr-4">RFM分析</span></label>
                            <br>

                            From: <input type="date" v-model="form.startDate">
                            To: <input type="date" v-model="form.endDate">
                            <br>

                            <div v-if="form.type === 'rfm'">
                                <select v-model="form.axis">
                                    <option value="rf">RF軸</option>
                                    <option value="rm">RM軸</option>
                                    <option value="fm">FM軸</option>
                                </select><br>
                                <table class="mx-auto">
                                    <thead>
                                        <tr>
                                            <th>ランク</th>
                                            <th>R (○日以内)</th>
                                            <th>F (○回以上)</th>
                                            <th>M (○円以上)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>5</td>
                                            <td><input type="number" v-model="form.rfmPrms[0]"></td>
                                            <td><input type="number" v-model="form.rfmPrms[4]"></td>
                                            <td><input type="number" v-model="form.rfmPrms[8]"></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td><input type="number" v-model="form.rfmPrms[1]"></td>
                                            <td><input type="number" v-model="form.rfmPrms[5]"></td>
                                            <td><input type="number" v-model="form.rfmPrms[9]"></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td><input type="number" v-model="form.rfmPrms[2]"></td>
                                            <td><input type="number" v-model="form.rfmPrms[6]"></td>
                                            <td><input type="number" v-model="form.rfmPrms[10]"></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><input type="number" v-model="form.rfmPrms[3]"></td>
                                            <td><input type="number" v-model="form.rfmPrms[7]"></td>
                                            <td><input type="number" v-model="form.rfmPrms[11]"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            
                            <button class="mt-4 flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">分析する
                            </button>
                        </form><br>

                        <div v-show="data.data" class="lg:w-2/3 w-full mx-auto overflow-auto">
                            <div v-if="data.type != 'rfm'">
                                <Chart :data="data" />
                            </div>
                        </div>

                        <ResultTable :data="data"></ResultTable>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
