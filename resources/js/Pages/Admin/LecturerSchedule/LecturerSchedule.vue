<script setup>
import { watch, onMounted, ref } from "vue";
import InputTextComponent from "@/Components/InputTextComponent.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Editor from "primevue/editor";
import Button from "primevue/button";

const props = defineProps({
  post: {
    type: Object,
    required: false,
    default: null,
  },
  rau_LecturerSchedule: String,
});

const form = useForm({
  title: "",
  meta_title: "",
  content: "",
});
const updateEditor = ref(false);

const onSubmitForm = () => {
  form.put(route(props.rau_LecturerSchedule));
};

watch(
  () => form.title,
  (title) => {
    form.meta_title = title;
  }
);

onMounted(() => {
  const post = props?.post;

  if (post) {
    form.title = post.title;
    form.meta_title = post.meta_title;
    form.content = post.content;
  }
});
</script>

<template>
  <AdminLayout>
    <div class="card">
      <h5 class="font-bold">Lịch giảng viên</h5>

      <form @submit.prevent="onSubmitForm" class="grid">
        <div class="lg:col-8 col-12">
          <div class="flex w-full gap-3">
            <InputTextComponent v-model="form.title" label="Tiêu đề" class="flex-1" />
            <InputTextComponent
              v-model="form.meta_title"
              label="Tiêu đề nâng cao"
              class="flex-1"
            />
          </div>

          <div class="flex-1 flex flex-column w-full mt-3">
            <label for="content">Nội dung</label>
            <small v-if="form?.errors?.content" id="title-help" class="p-error">{{
              form?.errors?.content
            }}</small>
            <Editor
              :key="updateEditor"
              id="content"
              v-model="form.content"
              :class="[
                'w-full flex-1 mt-1 md:h-auto h-30rem',
                form?.errors?.content && 'p-invalid-editor',
              ]"
              editorStyle="min-height: 500px"
            />
          </div>

          <div class="flex mt-3">
            <Button label="Cập nhât" type="submit" />
          </div>
        </div>
      </form>
    </div>
  </AdminLayout>
</template>
