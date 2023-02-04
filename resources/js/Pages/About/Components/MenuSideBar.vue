<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

const menuSidebar = ref([
    { name: "Giới thiệu chung", url: "general_info" },
    { name: "Chức năng nhiệm vụ", url: "task_function" },
    { name: "Cơ cấu tổ chức", url: "organizational_structure" },
    { name: "Công khai chất lượng", url: "public_quality" },
]);
</script>

<template>
    <div class="row">
        <div class="col-sm-12 bg-category border-round-lg mb-5">
            <h3
                class="bg-title bg-title-right text-2xl font-bold text-category py-2 border-bottom-1"
            >
                DANH MỤC
            </h3>
            <ul style="list-style-type: none" class="side-menu">
                <li
                    v-for="menu in menuSidebar"
                    :key="menu.name"
                    style="padding: 10px"
                    class="text-white list-item"
                >
                    <Link
                        class="nav-link"
                        :key="menu.name"
                        :href="route(menu.url)"
                    >
                        <i class="pi pi-caret-right"></i>
                        {{ menu.name }}
                    </Link>
                </li>
            </ul>
        </div>
        <div class="col-sm-12">
            <img
                src="/storage/images/sinhvien.jpg"
                alt="SINH VIEN"
                class="card-img"
                style="width: 100%; height: 100%"
            />
        </div>
    </div>
</template>
