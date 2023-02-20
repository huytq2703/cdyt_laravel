<script setup>
import { ref, onMounted, computed, watch } from "vue";
import OrderList from "primevue/orderlist";
import Button from "primevue/button";
import { useForm } from "@inertiajs/inertia-vue3";
import InputText from "primevue/inputtext";
import RadioButton from "primevue/radiobutton";
import Dropdown from "primevue/dropdown";
import MultiSelect from "primevue/multiselect";
import Dialog from "primevue/dialog";
import PickList from "primevue/picklist";
import { Inertia } from "@inertiajs/inertia";
import { slugify } from "@/utils/utils";

const props = defineProps({
  // ///////
  currentMenu: {
    type: Array,
    required: false,
    default: () => [],
  },
  allCats: {
    type: Array,
    required: false,
    default: () => [],
  },
  listSubMenu: {
    type: Array,
    required: false,
    default: () => [],
  },
});
const visibleModelAddSubmenu = ref(false);
const menuFocused = ref({});
const onClickAddSubMenu = (menu) => {
  menuFocused.value = menu;
  visibleModelAddSubmenu.value = true;
};

const curMenu = ref([]);
const pickMenu = ref([[], []]);
const pickSubMenu = ref([[], []]);
const newMenu = useForm({
  id: null,
  title: "",
  slug: "",
});
const currentItemSelected = ref(null);
const menuSelection = ref([[], []]);

const onChangeMenu = () => {
  const listId = pickMenu.value[1]?.map(({ id }) => id);
  let listMenu = pickMenu.value[1];
  if (listMenu.length > 0)
    listMenu = listMenu.map((data, index) => {
      const item = {
        ...data,
        order_number: index,
      };

      return item;
    });

  Inertia.post(route("system.menu.update"), { listCat: listMenu, listId });
};

const onChangeSubMenu = () => {
  //   const parentMenu = curMenu.value.find((menu) => menu.slug === menuFocused.value.slug);

  const list = pickSubMenu.value[1].map((data, index) => ({
    ...data,
    order_number: index,
  }));

  const listPostSubMenu = list.filter((data) => !data.hasOwnProperty("menu_type"));
  const listCategorySubMenu = list.filter((data) => data.hasOwnProperty("menu_type"));

  Inertia.post(route("system.submenu.update"), {
    categoryId: menuFocused.value.id,
    listSubMenu: pickSubMenu.value[1],
    listPostSubMenu: listPostSubMenu,
    listCategorySubMenu: listCategorySubMenu,
    ids: pickSubMenu.value[1]?.map(({ id }) => id),
  });
};

const findSubMenuBySlug = (slug) => {
  return curMenu.value.find((menu) => menu.slug === slug);
};

const onAddNewMenu = () => {
  newMenu.post(route("system.menu.create"), {
    onSuccess: () => {
      newMenu.reset();
      currentItemSelected.value = null;
    },
  });
};

const onSelectMenu = (item) => {
  currentItemSelected.value = item;
};

watch(currentItemSelected, (value) => {
  newMenu.slug = value?.slug ?? "";
  newMenu.title = value?.title ?? "";
  newMenu.id = value?.id ?? null;
});

watch(
  () => newMenu.title,
  (value) => {
    newMenu.slug = slugify(value);
  }
);

watch(menuFocused, (menu) => {
  const listCurrentSubMenu = findSubMenuBySlug(menu.slug)?.sub?.map(
    ({ category, post }) => category?.slug ?? post?.slug
  );
  pickSubMenu.value = [[], []];
  props.listSubMenu?.forEach((cat) => {
    if (listCurrentSubMenu.includes(cat.slug)) {
      pickSubMenu.value[1].push(cat);
      return;
    }

    pickSubMenu.value[0].push(cat);
  });
});

onMounted(() => {
  curMenu.value = props.currentMenu?.map((m) => {
    const type = m?.category ? "cat" : "page";
    const menu = type == "cat" ? m.category : m.post;

    return {
      id: m.id,
      title: menu.title,
      slug: menu.slug,
      orderNumber: m.order_number,
      sub: m?.sub_menus,
    };
  });
  // menu
  const allCurrentSlugs = curMenu.value.map(({ slug }) => slug);
  props.allCats?.forEach((cat) => {
    if (allCurrentSlugs.includes(cat.slug)) {
      const menu = curMenu.value?.find((menu) => menu.slug === cat.slug);
      pickMenu.value[1].push({
        ...cat,
        order_number: menu.orderNumber,
      });
      return;
    }

    pickMenu.value[0].push(cat);
  });
  pickMenu.value[1].sort((a, b) => a.order_number - b.order_number);

  props.listSubMenu?.forEach((cat) => {
    pickSubMenu.value[0].push(cat);
  });
});
</script>

<template>
  <AdminLayout>
    <div class="card">
      <div class="flex flex-row gap-2">
        <!-- Title -->
        <div class="flex flex-column">
          <label for="title">Tiêu đề</label>
          <InputText
            id="title"
            maxlength="180"
            v-model="newMenu.title"
            aria-describedby="title-help"
            :class="newMenu?.errors?.title && 'p-invalid'"
          />
          <small v-if="newMenu?.errors?.title" id="title-help" class="p-error">{{
            newMenu?.errors?.title
          }}</small>
        </div>

        <!-- Slug -->
        <div class="flex flex-column">
          <label for="slug">Slug</label>
          <InputText
            id="slug"
            maxlength="200"
            v-model="newMenu.slug"
            aria-describedby="username2-help"
            class=""
          />
        </div>

        <!-- Slug -->
        <div class="flex align-items-end">
          <Button
            v-show="!currentItemSelected"
            label="Thêm mới"
            icon="pi pi-check"
            autofocus
            @click="onAddNewMenu"
          />
          <div class="flex gap-2">
            <Button
              v-show="currentItemSelected"
              label="Cập nhật"
              icon="pi pi-check"
              autofocus
              @click="onAddNewMenu"
            />
            <Button
              v-show="currentItemSelected"
              icon="pi pi-times"
              class="p-button-rounded p-button-text"
              @click="
                () => {
                  currentItemSelected = null;
                }
              "
            />
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="grid">
        <div class="col-12">
          <PickList
            v-model="pickMenu"
            listStyle="height: 100vh"
            dataKey="id"
            :moveAllToTargetProps="{ style: { display: 'none' } }"
            :moveAllToSourceProps="{ style: { display: 'none' } }"
            v-model:selection="menuSelection"
            @move-to-target="onChangeMenu"
            @move-to-source="onChangeMenu"
            @move-all-to-source="onChangeMenu"
            @move-all-to-target="onChangeMenu"
            @reorder="onChangeMenu"
          >
            <template #sourceheader> Danh cách chọn </template>
            <template #targetheader> Đã chọn </template>
            <template #item="slotProps">
              <div class="product-item w-full py-2 flex flex-row justify-content-between">
                <div class="flex flex-column">
                  <h6 class="m-0">{{ slotProps.item.title }}</h6>
                  <small>{{ slotProps.item.slug }}</small>
                </div>

                <div class="flex justify-content-end">
                  <Button
                    icon="pi pi-file-edit"
                    class="p-button-rounded p-button-text"
                    @click="onSelectMenu(slotProps.item)"
                  />
                </div>
              </div>
            </template>
          </PickList>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="flex flex-row gap-2 overflow-x-auto">
        <div
          v-for="(menuItem, index) in pickMenu[1]"
          :key="index"
          class="border-2 rounded p-3 flex flex-column justify-content-between cursor-pointer"
          @click="onClickAddSubMenu(menuItem)"
        >
          <h5 class="font-bold white-space-nowrap">{{ menuItem.title }}</h5>
          <div class="flex flex-column justify-content-start h-full">
            <span
              v-for="(sub, i) in findSubMenuBySlug(menuItem.slug)?.sub"
              :key="i"
              class="white-space-nowrap"
            >
              - {{ sub?.category?.title ?? sub?.post?.title }}
            </span>
          </div>
        </div>
      </div>
      <div class="flex flex-column"></div>
    </div>

    <!-- Dialog add -->
    <Dialog v-model:visible="visibleModelAddSubmenu" class="w-9">
      <template #header>
        <h5 class="m-0">Menu chính: {{ menuFocused.title }}</h5>
      </template>

      <PickList
        v-model="pickSubMenu"
        listStyle="height: 100vh"
        dataKey="id"
        :moveAllToTargetProps="{ style: { display: 'none' } }"
        :moveAllToSourceProps="{ style: { display: 'none' } }"
        @move-to-target="onChangeSubMenu"
        @move-to-source="onChangeSubMenu"
        @move-all-to-source="onChangeSubMenu"
        @move-all-to-target="onChangeSubMenu"
        @reorder="onChangeSubMenu"
      >
        <template #sourceheader> Danh cách chọn </template>
        <template #targetheader> Đã chọn </template>
        <template #item="slotProps">
          <div class="product-item w-20rem py-2">
            <h6 class="m-0">{{ slotProps.item.title }}</h6>
            <small>{{ slotProps.item.slug }}</small>
          </div>
        </template>
      </PickList>

      <template #footer>
        <Button label="No" icon="pi pi-times" class="p-button-text" />
        <Button label="Yes" icon="pi pi-check" autofocus @click="onSaveSubMenu" />
      </template>
    </Dialog>
  </AdminLayout>
</template>

<style lang="scss" scoped>
.custom-hover {
  position: relative;
  &::before {
    content: " ";
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    background-color: black;
  }
}
</style>
