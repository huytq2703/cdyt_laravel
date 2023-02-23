<script setup>
import AutoComplete from "primevue/autocomplete";
import { AxiosInstance } from "@/libs/axios";
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

const listFiltered = ref([]);
const selectedItem = ref("");
const baseUrl = route("home");

const callApi = (search) => {
  AxiosInstance({
    method: "GET",
    url: "v1/search-all-pages",
    params: {
      search: search,
    },
  })
    .then((response) => response)
    .then((res) => {
      listFiltered.value = res.data?.data;
    });
};

const onSearch = (event) => {
  setTimeout(() => {
    if (!event.query.trim().length) {
      //   filteredCountries.value = [...countries.value];
    } else {
      //   console.log(event.query.toLowerCase());
      callApi(event.query.toLowerCase());
      //   filteredCountries.value = countries.value.filter((country) => {
      //     return country.name.toLowerCase().startsWith(event.query.toLowerCase());
      //   });
    }
  }, 250);
};

const onSelectedItem = (event) => {
  const item = event.value;
  Inertia.get(
    `${baseUrl}/${selectedItem.value.slug}`,
    {},
    {
      preserveState: true,
    }
  );
};
</script>

<template>
  <span class="p-input-icon-right p-fluid w-20rem">
    <i class="pi pi-search z-1 mr-2" />
    <AutoComplete
      v-model="selectedItem"
      :suggestions="listFiltered"
      @complete="onSearch"
      optionLabel="title"
      forceSelection
      scrollHeight="300px"
      inputClass="border-round-3xl px-3"
      inputStyle="padding-left: 20px!important; padding-right: 35px!important"
      placeholder="Tìm kiếm ..."
      @item-select="onSelectedItem"
    >
      <template #item="slotProps">
        <div class="flex flex-column">
          <span class="font-bold">{{ slotProps.item.title }}</span>
          <small class="ml-2">{{ slotProps.item.slug }}</small>
        </div>
      </template>
    </AutoComplete>
  </span>
</template>
