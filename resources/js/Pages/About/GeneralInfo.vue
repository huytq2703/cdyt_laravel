<script setup>
import App from "@/Layouts/App.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Listbox from 'primevue/listbox';

const cities = [
    {name: 'New York', code: 'NY'},
    {name: 'Rome', code: 'RM'},
    {name: 'London', code: 'LDN'},
    {name: 'Istanbul', code: 'IST'},
    {name: 'Paris', code: 'PRS'}
];
</script>

<template>
  <Head title="Thông tin chung" />
  <App>
      <div class="container mx-auto">
          <div class="grid py-4">
                <div class="col-12 xl:col-9">
                    <h3
                        class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
                    >
                        GIỚI THIỆU CHUNG
                    </h3>
                </div>
                <div class="col-12 xl:col-3 bg-category">
                    <h3
                        class="border-top bg-title bg-title-right text-2xl font-bold text-category py-2 border-bottom-1"
                    >
                        DANH MỤC
                    </h3>
                    <Listbox v-model="selectedCity" :options="cities" optionLabel="name" />
                </div>
          </div>
      </div>
  </App>
</template>

<style lang="scss">
.bg-category {
    background-color: #2a8b6c;
}
.text-category {
    color: white;
}
</style>
