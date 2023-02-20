<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import Button from "primevue/button";
import Dialog from "primevue/dialog";
import InputText from "primevue/inputtext";
import Textarea from "primevue/textarea";
import { ref, watch } from "vue";
import { slugify } from "@/utils/utils";

const props = defineProps({
  rac_Category: String,
});
const display = ref(false);
const category = useForm({
  title: "",
  metaTile: "",
  slug: "",
  content: "",
});

const onClickShowModal = () => {
  display.value = true;
};

watch(
  () => category.title,
  (title) => {
    category.slug = slugify(title);
  }
);

const onSubmitSaveCategory = () => {
  category.post(route(props.rac_Category), {
    onSuccess: () => {
      category.reset();
      display.value = false;
    },
  });
};
</script>

<template>
  <Button icon="pi pi-plus" @click="onClickShowModal"></Button>
  <Dialog
    header="Header"
    v-model:visible="display"
    modal
    :draggable="false"
    content-style="width: 25rem"
  >
    <template #header><h5 class="m-0">Thêm mới</h5></template>

    <div class="flex flex-column gap-2">
      <!-- Title -->
      <div class="flex flex-column">
        <label for="title">Tiêu đề</label>
        <InputText
          id="title"
          v-model="category.title"
          aria-describedby="title-help"
          :class="category.errors.title && 'p-invalid'"
        />
        <small v-if="category.errors.title" id="title-help" class="p-error">{{
          category.errors.title
        }}</small>
      </div>

      <!-- Meta title -->
      <div class="flex flex-column">
        <label for="metaTile">Tiêu đề meta</label>
        <InputText
          id="metaTile"
          v-model="category.metaTile"
          aria-describedby="metaTile-help"
          :class="category.errors.metaTile && 'p-invalid'"
        />
        <small v-if="category.errors.metaTile" id="metaTile-help" class="p-error">{{
          category.errors.metaTile
        }}</small>
      </div>

      <!-- Slug -->
      <div class="flex flex-column">
        <label for="slug">Tên đường dẫn</label>
        <InputText
          id="slug"
          v-model="category.slug"
          aria-describedby="slug-help"
          :class="category.errors.slug && 'p-invalid'"
          :disabled="true"
        />
        <small v-if="category.errors.slug" id="metaTile-help" class="p-error">{{
          category.errors.slug
        }}</small>
      </div>

      <!-- Content -->
      <div class="flex flex-column">
        <label for="content">Nội dung</label>
        <Textarea
          id="content"
          aria-describedby="username2-help"
          :class="category.errors.content && 'p-invalid'"
          v-model="category.content"
          :autoResize="true"
          rows="5"
          cols="30"
        />
        <small v-if="category?.errors?.content" id="username2-help" class="p-error">{{
          category?.errors?.content
        }}</small>
      </div>
    </div>
    <template #footer>
      <div class="flex mt-3 justify-content-end">
        <Button @click="onSubmitSaveCategory">Thêm</Button>
        <!-- <Button v-if="!isUpdate" @click="onClickUpdatePost">Cập nhật</Button> -->
      </div>
    </template>
  </Dialog>
</template>
