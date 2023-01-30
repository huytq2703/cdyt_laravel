<script setup>
import Button from "primevue/button";
import Dialog from "primevue/dialog";
import Editor from "primevue/editor";
import Textarea from "primevue/textarea";
import InputText from "primevue/inputtext";
import UploadImage from "@/Components/UploadImageComponent.vue";
import { ref, watch } from "vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
  modelValue: {
    type: Boolean,
    required: false,
    default: true,
  },
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
});

watch(display, (value) => {
  emits("update:modelValue", value);
});
watch(
  () => props.modelValue,
  (value) => {
    display.value = value;
  }
);
</script>

<template>
  <Dialog
    header="Header"
    v-model:visible="display"
    modal
    :draggable="false"
    class="xl:w-11 w-full"
    contentStyle="height: 90vh"
  >
    <template #header><h5 class="m-0">Thêm mới</h5></template>

    <div class="flex gap-3" style="min-height: 90%">
      <div class="flex-1 flex flex-column w-full">
        <label for="content">Nội dung</label>
        <Editor
          id="content"
          v-model="postInfo.content"
          class="w-full flex-1 mt-1"
          contentClass="p-invalid"
        />
      </div>

      <div class="w-25rem flex flex-column gap-2">
        <div class="flex flex-column gap-1">
          <label for="">Ảnh bìa</label>
          <UploadImage classes="h-12rem" :image="postInfo.coverImage" />
        </div>

        <div class="flex flex-column">
          <label for="title">Tiêu đề</label>
          <InputText
            id="title"
            v-model="postInfo.title"
            type="username"
            aria-describedby="title-help"
            class="p-invalid"
          />
          <small v-if="false" id="title-help" class="p-error"
            >Username is not available.</small
          >
        </div>

        <div class="flex flex-column">
          <label for="username2">Slug</label>
          <InputText
            id="username2"
            type="username"
            aria-describedby="username2-help"
            class="p-invalid"
          />
        </div>

        <div class="flex flex-column">
          <label for="username2">Tiêu đề meta</label>
          <InputText
            id="username2"
            type="username"
            aria-describedby="username2-help"
            class="p-invalid"
          />
          <small v-if="false" id="username2-help" class="p-error"
            >Username is not available.</small
          >
        </div>

        <div class="flex flex-column">
          <label for="username2">Tóm tắt</label>
          <Textarea
            id="username2"
            aria-describedby="username2-help"
            class="p-invalid"
            v-model="value2"
            :autoResize="true"
            rows="5"
            cols="30"
          />
          <small v-if="false" id="username2-help" class="p-error"
            >Username is not available.</small
          >
        </div>
      </div>
    </div>

    <template #footer>
      <div class="flex mt-3 justify-content-end">
        <Button>Thêm</Button>
      </div>
    </template>
  </Dialog>
</template>
