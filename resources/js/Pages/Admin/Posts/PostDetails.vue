<script setup>
import Button from "primevue/button";
import Dialog from "primevue/dialog";
import Editor from "primevue/editor";
import Textarea from "primevue/textarea";
import InputText from "primevue/inputtext";
import MultiSelect from "primevue/multiselect";
import UploadImage from "@/Components/UploadImageComponent.vue";
import CreateCategoriesModal from "./components/CreateCategoriesModal.vue";
import { slugify } from "@/utils/utils";
import { ref, watch, computed, onMounted } from "vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
  categories: Array,
  post: {
    type: Object,
    required: false,
    default: null,
  },
  rac_Category: String,
  rac_Post: String,
  rl_Post: String,
  rau_Post: String,
});
const update = ref(false);
const isUpdate = computed(() => (props?.post ? true : false));
const postInfo = useForm({
  id: null,
  title: "",
  slug: "",
  meta_title: "",
  summary: "",
  content: "",
  coverImage: null,
  categoryIds: [],
});

watch(
  () => postInfo.title,
  () => {
    if (props.post) return;
    postInfo.slug = slugify(postInfo.title);
    postInfo.meta_title = postInfo.title;
  }
);

const onClickBack = () => {
  Inertia.get(route(props.rl_Post));
};

const onSubmitPostDetails = () => {
  if (isUpdate.value) {
    postInfo.put(route(props.rau_Post), {
      onSuccess: () => {
        update.value = !update.value;
      },
    });
  } else {
    postInfo.post(route(props.rac_Post), {
      onSuccess: () => {
        Inertia.get(route(props.rl_Post));
      },
    });
  }
};

onMounted(() => {
  const post = props.post;
  if (post) {
    postInfo.id = post.id;
    postInfo.title = post.title;
    postInfo.slug = post.slug;
    postInfo.meta_title = post.meta_title;
    postInfo.summary = post.summary;
    postInfo.content = post.content;
    postInfo.coverImage = post.cover_image;
    postInfo.categoryIds = post?.categories?.map(({ id }) => id);
  }
});
</script>

<template>
  <AdminLayout>
    <Head title="Thông tin bài viết" />
    <div class="card">
      <h5 class="font-bold flex align-items-center flex-wrap gap-2">
        <i
          class="pi pi-angle-left cursor-pointer"
          style="font-size: 1.5rem"
          @click="onClickBack"
        ></i
        >Chi tiết bài viết
        <span v-if="isUpdate" class="text-primary ml-2 text-justify">
          - {{ post?.title }}</span
        >
      </h5>

      <div class="grid">
        <div class="lg:col-3 col-12 flex flex-column gap-2">
          <!-- Category -->
          <div class="flex flex-column">
            <label for="title">Danh mục</label>
            <div class="flex-1 flex flex-row max-w-full justify-content-between">
              <MultiSelect
                v-model="postInfo.categoryIds"
                :options="categories"
                optionLabel="title"
                optionValue="id"
                placeholder="Chọn danh mục"
                :class="(postInfo?.errors?.categoryIds && 'p-invalid', 'w-full')"
                style="max-width: 300px"
              />
              <CreateCategoriesModal :rac_Category="rac_Category" />
            </div>
            <small v-if="postInfo?.errors?.categoryIds" id="title-help" class="p-error">{{
              postInfo?.errors?.categoryIds
            }}</small>
          </div>

          <!-- Title -->
          <div class="flex flex-column">
            <label for="title">Tiêu đề</label>
            <InputText
              id="title"
              maxlength="180"
              v-model="postInfo.title"
              aria-describedby="title-help"
              :class="postInfo?.errors?.title && 'p-invalid'"
            />
            <small v-if="postInfo?.errors?.title" id="title-help" class="p-error">{{
              postInfo?.errors?.title
            }}</small>
          </div>

          <!-- Slug -->
          <div class="flex flex-column">
            <label for="slug">Slug</label>
            <InputText
              id="slug"
              maxlength="200"
              v-model="postInfo.slug"
              aria-describedby="username2-help"
              class=""
            />
          </div>

          <!-- Meta title -->
          <div class="flex flex-column">
            <label for="meta_title">Tiêu đề meta</label>
            <InputText
              id="meta_title"
              maxlength="200"
              v-model="postInfo.meta_title"
              aria-describedby="username2-help"
              :class="postInfo?.errors?.meta_title && 'p-invalid'"
            />
            <small
              v-if="postInfo?.errors?.meta_title"
              id="username2-help"
              class="p-error"
              >{{ postInfo?.errors?.meta_title }}</small
            >
          </div>

          <!-- Summary -->
          <div class="flex flex-column">
            <label for="summary">Tóm tắt</label>
            <Textarea
              id="summary"
              maxlength="500"
              aria-describedby="username2-help"
              :class="postInfo?.errors?.summary && 'p-invalid'"
              v-model="postInfo.summary"
              :autoResize="true"
              rows="5"
              cols="30"
            />
            <small v-if="postInfo?.errors?.summary" id="username2-help" class="p-error">{{
              postInfo?.errors?.summary
            }}</small>
          </div>

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
        </div>

        <div class="lg:col-9 col-12">
          <!-- Content -->
          <div class="flex-1 flex flex-column w-full">
            <label for="content">Nội dung</label>
            <small v-if="postInfo?.errors?.content" id="title-help" class="p-error">{{
              postInfo?.errors?.content
            }}</small>
            <Editor
              :key="update"
              id="content"
              v-model="postInfo.content"
              :class="[
                'w-full flex-1 mt-1 md:h-auto h-30rem',
                postInfo?.errors?.content && 'p-invalid-editor',
              ]"
              editorStyle="min-height: 500px"
            />
          </div>
        </div>

        <div class="col-12 pb-0 flex justify-content-end">
          <Button v-if="!isUpdate" @click="onSubmitPostDetails">Thêm</Button>
          <Button v-else @click="onSubmitPostDetails">Cập nhật</Button>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
