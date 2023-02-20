<script setup>
import { Inertia } from "@inertiajs/inertia";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { slugify } from "@/utils/utils";
import { onMounted, computed, watch } from "vue";
import Button from "primevue/button";
import Editor from "primevue/editor";
import InputText from "primevue/inputtext";

const props = defineProps({
  notification: Object,
  rau_Notice: String,
  rac_Notice: String,
  rl_Notice: String,
});

const notify = useForm({
  title: "",
  slug: "",
  content: "",
  meta_title: "",
  id: null,
});

watch(
  () => notify.title,
  (title) => {
    if (notify.id) return;
    notify.slug = slugify(title);
    notify.meta_title = title;
  }
);

const onClickBack = () => {
  Inertia.get(route(props.rl_Notice));
};

const isUpdate = computed(() => (props.notification ? true : false));

const onSubmitDetails = () => {
  if (isUpdate.value) {
    notify.put(route(props.rau_Notice));
  } else {
    notify.post(route(props.rac_Notice), {
      onSuccess: () => {
        notify.reset();
      },
    });
  }
};

onMounted(() => {
  if (props.notification) {
    notify.content = props.notification?.content;
    notify.slug = props.notification?.slug;
    notify.title = props.notification?.title;
    notify.id = props.notification?.id;
  }
});
</script>

<template>
  <AdminLayout>
    <Head title="Chi tiết nội dung thông báo" />
    <div class="card">
      <h5 class="font-bold flex align-items-center flex-wrap gap-2">
        <i
          class="pi pi-angle-left cursor-pointer"
          style="font-size: 1.5rem"
          @click="onClickBack"
        ></i
        >Chi tiết thông báo
        <span v-if="isUpdate" class="text-primary ml-2 text-justify">
          - {{ notification?.title }}</span
        >
      </h5>

      <form @submit.prevent="onSubmitDetails">
        <div class="grid">
          <div class="lg:col-3 col-12">
            <!-- Title -->
            <div class="flex flex-column gap-1">
              <label for="title">Tiêu đề</label>
              <InputText
                id="title"
                maxlength="200"
                v-model="notify.title"
                aria-describedby="title-help"
                :class="notify?.errors.title && 'p-invalid'"
              />
              <small v-if="notify?.errors.title" id="title-help" class="p-error">{{
                notify?.errors.title
              }}</small>
            </div>

            <!-- Slug -->
            <div class="flex flex-column gap-1 mt-2">
              <label for="title">Slug</label>
              <InputText
                id="title"
                maxlength="255"
                v-model="notify.slug"
                aria-describedby="title-help"
                :class="notify?.errors.slug && 'p-invalid'"
              />
              <small v-if="notify?.errors?.slug" id="title-help" class="p-error">{{
                notify?.errors?.slug
              }}</small>
            </div>

            <!-- Meta title -->
            <div class="flex flex-column gap-1 mt-2">
              <label for="meta_title">Tiêu đề meta</label>
              <InputText
                id="meta_title"
                maxlength="255"
                v-model="notify.meta_title"
                aria-describedby="title-help"
                :class="notify?.errors.meta_title && 'p-invalid'"
              />
              <small v-if="notify?.errors?.meta_title" id="title-help" class="p-error">{{
                notify?.errors?.meta_title
              }}</small>
            </div>
          </div>

          <div class="lg:col-9 col-12">
            <div class="flex-1 flex flex-column w-full">
              <label for="content">Nội dung</label>
              <Editor
                id="content"
                v-model="notify.content"
                :class="[
                  'w-full flex-1 mt-1 md:h-auto h-30rem',
                  notify?.errors?.content && 'p-invalid-editor',
                ]"
                editorStyle="min-height: 400px"
              />
              <small v-if="notify?.errors?.content" id="title-help" class="p-error">{{
                notify.errors.content
              }}</small>
            </div>
          </div>
        </div>
        <div class="flex justify-content-end pt-2">
          <Button v-if="!isUpdate" type="submit">Tạo</Button>
          <Button v-else type="submit">Cập nhật</Button>
        </div>
      </form>
    </div>
  </AdminLayout>
</template>
