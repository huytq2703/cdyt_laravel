<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { Inertia } from "@inertiajs/inertia";
// import ColumnGroup from "primevue/columngroup"; //optional for column grouping
// import Row from "primevue/row";
import { Head, useForm, usePage } from "@inertiajs/inertia-vue3";
import { onMounted, ref, computed, reactive } from "vue";
import Button from "primevue/button";
import InputText from "primevue/inputtext";

const user = computed(() => usePage().props.test);
const page = usePage();
const props = defineProps({
    provinces: {
        type: Array,
        required: false,
        default: [],
    },
    params: {
        type: Object,
        required: false,
        default: null,
    },
    errors: Object,
    categories: Array,
    pagination: Object,
    sort: Object,
});
const filtersForm = useForm({
    search: props?.params?.search,
});

const onSearch = () => {
    filtersForm.get(route("admin.locations.provinces"), {
        preserveState: true,
        replace: true,
    });
};

const onPageChange = ({ page }) => {
    Inertia.get(route("admin.locations.provinces"), {
        page: page + 1,
        search: props?.params?.search,
    });
};

const onSort = ({ sortField, sortOrder }) => {
    console.log(sortField, sortOrder);
    Inertia.get(route("admin.locations.provinces"), {
        search: props?.params?.search,
        sortField: sortField,
        sortOrder: sortOrder,
    });
};

const refreshPage = () => {
    Inertia.get(route("admin.locations.provinces"));
};
onMounted(() => {});
</script>

<template>
    <AdminLayout>
        <Head title="Quản lý tỉnh" />
        <div class="card">
            <h5 class="font-bold">Danh sách tỉnh</h5>
            <div class="flex justify-content-between mb-4 flex-wrap gap-3">
                <div class="flex gap-2 flex-wrap">
                    <Button
                        icon="pi pi-refresh"
                        label="Làm mới"
                        class="p-button-outlined"
                        @click="refreshPage"
                    />
                </div>

                <span class="p-input-icon-left w-20rem">
                    <i class="pi pi-search" />
                    <InputText
                        v-model="filtersForm.search"
                        type="text"
                        class="w-full"
                        placeholder="Tìm kiếm"
                        @keyup.enter="onSearch"
                    />
                </span>
            </div>
            <DataTable
                :value="provinces"
                :paginator="true"
                :rows="pagination.perPage"
                :totalRecords="pagination.totalRecords"
                :first="pagination.first"
                :sortField="params?.sortField"
                :sortOrder="Number(params?.sortOrder)"
                dataKey="id"
                :rowHover="true"
                :lazy="true"
                :autoLayout="true"
                responsiveLayout="scroll"
                @page="onPageChange"
                @sort="onSort"
            >
                <Column
                    field="id"
                    header="id"
                    :sortable="true"
                    class="w-3rem"
                ></Column>
                <Column
                    field="name"
                    header="Tên tỉnh"
                    :sortable="true"
                ></Column>
                <Column
                    field="gso_id"
                    header="Mã tỉnh"
                    :sortable="true"
                ></Column>
            </DataTable>
        </div>
    </AdminLayout>
</template>
