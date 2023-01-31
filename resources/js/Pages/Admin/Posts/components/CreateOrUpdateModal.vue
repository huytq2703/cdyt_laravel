<script setup>
import Button from "primevue/button";
import Dialog from "primevue/dialog";
import Editor from "primevue/editor";
import Textarea from "primevue/textarea";
import InputText from "primevue/inputtext";
import MultiSelect from "primevue/multiselect";
import UploadImage from "@/Components/UploadImageComponent.vue";
import { slugify } from "@/utils/utils";
import { ref, watch, computed, onMounted } from "vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
  modelValue: {
    type: Boolean,
    required: false,
    default: true,
  },
  errors: Object,
  categories: Array,
  details: Object,
});
const emits = defineEmits(["update:modelValue"]);
const display = ref(props.modelValue);
const postInfo = useForm({
  id: null,
  title: "",
  slug: "",
  metaTitle: "",
  summary: "",
  content: "",
  coverImage: null,
  categoryIds: [],
});
const isUpdate = computed(() => !postInfo.id);

const onClickCreateNewPost = () => {
  postInfo.slug = slugGenerated.value;
  postInfo.post(route("admin.posts.create"), {
    onSuccess: () => {
      postInfo.reset();
      display.value = false;
    },
  });
};

const onClickUpdatePost = () => {
  postInfo.slug = slugGenerated.value;
  postInfo.post(route("admin.posts.update"), {
    onSuccess: () => {
      display.value = false;
    },
  });
};

const slugGenerated = computed(() => slugify(postInfo.title));

watch(display, (value) => {
  emits("update:modelValue", value);
});
watch(
  () => props.modelValue,
  (value) => {
    display.value = value;
  }
);

const onShow = () => {
  const post = props.details;

  if (!post.id) {
    postInfo.reset();
    return;
  }

  postInfo.id = post.id;
  postInfo.title = post.title;
  postInfo.slug = post.slug;
  postInfo.metaTitle = post.metaTitle;
  postInfo.summary = post.summary;
  postInfo.content = post.content;
  postInfo.coverImage = post.cover_image;
  postInfo.categoryIds = post?.categories?.map(({ id }) => id);
};

onMounted(() => {});
</script>

<template>
  <Dialog
    header="Header"
    v-model:visible="display"
    modal
    :draggable="false"
    class="xl:w-11 w-full"
    contentStyle="height: 90vh"
    @show="onShow"
  >
    <template #header><h5 class="m-0">Thêm mới</h5></template>

    <div
      class="flex flex-column md:flex-row flex-column-reverse gap-3"
      style="min-height: 90%"
    >
      <!-- Content -->
      <div class="flex-1 flex flex-column w-full">
        <label for="content">Nội dung</label>
        <small v-if="errors.content" id="title-help" class="p-error">{{
          errors.content
        }}</small>
        <Editor
          id="content"
          v-model="postInfo.content"
          :class="[
            'w-full flex-1 mt-1 md:h-auto h-30rem',
            errors.content && 'p-invalid-editor',
          ]"
          editorStyle="min-height: 400px"
        />
      </div>

      <div class="md:w-25rem w-full flex flex-column gap-2">
        <!-- Cover image -->
        <div class="flex flex-column gap-1">
          <label for="">Ảnh bìa</label>
          <UploadImage
            classes="h-12rem"
            v-model:image="postInfo.coverImage"
            :src="postInfo.coverImage"
            base64
          />
        </div>

        <!-- Category -->
        <div class="flex flex-column">
          <label for="title">Danh mục</label>
          <MultiSelect
            v-model="postInfo.categoryIds"
            :options="categories"
            optionLabel="title"
            optionValue="id"
            placeholder="Chọn danh mục"
            :class="errors.categoryIds && 'p-invalid'"
          />
          <small v-if="errors.categoryIds" id="title-help" class="p-error">{{
            errors.categoryIds
          }}</small>
        </div>

        <!-- Title -->
        <div class="flex flex-column">
          <label for="title">Tiêu đề</label>
          <InputText
            id="title"
            v-model="postInfo.title"
            aria-describedby="title-help"
            :class="errors.title && 'p-invalid'"
          />
          <small v-if="errors.title" id="title-help" class="p-error">{{
            errors.title
          }}</small>
        </div>

        <!-- Slug -->
        <div class="flex flex-column">
          <label for="slug">Slug</label>
          <InputText
            id="slug"
            :value="slugGenerated"
            aria-describedby="username2-help"
            class=""
            disabled
          />
        </div>

        <!-- Meta title -->
        <div class="flex flex-column">
          <label for="metaTitle">Tiêu đề meta</label>
          <InputText
            id="metaTitle"
            v-model="postInfo.metaTitle"
            aria-describedby="username2-help"
            :class="errors.metaTitle && 'p-invalid'"
          />
          <small v-if="errors?.metaTitle" id="username2-help" class="p-error">{{
            errors.metaTitle
          }}</small>
        </div>

        <!-- Summary -->
        <div class="flex flex-column">
          <label for="summary">Tóm tắt</label>
          <Textarea
            id="summary"
            aria-describedby="username2-help"
            :class="errors.summary && 'p-invalid'"
            v-model="postInfo.summary"
            :autoResize="true"
            rows="5"
            cols="30"
          />
          <small v-if="errors?.summary" id="username2-help" class="p-error">{{
            errors.summary
          }}</small>
        </div>
      </div>
    </div>

    <template #footer>
      <div class="flex mt-3 justify-content-end">
        <Button v-if="isUpdate" @click="onClickCreateNewPost">Thêm</Button>
        <Button v-if="!isUpdate" @click="onClickUpdatePost">Cập nhật</Button>
      </div>
    </template>
  </Dialog>
</template>
