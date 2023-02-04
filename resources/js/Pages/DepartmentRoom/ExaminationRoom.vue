<script setup>
import App from "@/Layouts/App.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Listbox from "primevue/listbox";
import { Link } from "@inertiajs/inertia-vue3";
import MenuSideBar from "./Components/MenuSideBar.vue";
</script>

<template>
    <Head title="Phòng khảo thí" />
    <App>
        <div class="container mx-auto">
            <div class="grid py-4">
                <div class="col-12 xl:col-9 pr-3">
                    <h3
                        class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
                    >
                        PHÒNG KHẢO THÍ
                    </h3>
                    <!-- Here content -->
                    <div>Nội dung đang được cập nhật</div>
                </div>
                <div class="col-12 xl:col-3">
                    <MenuSideBar />
                </div>
            </div>
        </div>
    </App>
</template>

<style lang="scss">
.side-menu {
    height: calc(100vh - 130px);
}
.bg-category {
    background-color: #2a8b6c;
}
.text-category {
    color: white;
}
</style>
