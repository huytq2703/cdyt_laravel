<script setup>
import Button from "primevue/button";
import { ref, computed, watch } from "vue";
import NProgress from "nprogress";
const emits = defineEmits(["update:image", "update:base64"]);
const props = defineProps({
  image: {
    type: [Object, String],
    required: false,
    default: null,
  },
  base64: {
    type: Boolean,
    required: false,
    default: false,
  },
  classes: {
    type: String,
    required: false,
    default: "",
  },
  id: {
    type: String,
    required: false,
    default: "uploadImage",
  },
  disabled: {
    type: Boolean,
    required: false,
    default: false,
  },
  src: {
    type: String,
    required: false,
    default: "",
  },
});

const previewPath = ref(props.src);
const reader = new FileReader();

const onPreviewImage = (e) => {
  const file = e.target?.files?.[0];
  NProgress.start();
  if (file) {
    let rawImg;
    reader.onloadend = () => {
      rawImg = reader.result;
      previewPath.value = rawImg;
      if (props.base64) emits("update:image", rawImg);
      NProgress.done();
    };
    reader.readAsDataURL(file);
  }
  if (!props.base64) emits("update:image", file);
};

const onClickRemoveImage = () => {
  previewPath.value = "";
  emits("update:image", null);
};

watch(
  () => props.src,
  (src) => {
    previewPath.value = src;
  }
);

const isUploadImage = computed(() => {
  if (props.disabled) return false;
  if (previewPath.value) return false;

  return true;
});
</script>

<template>
  <div v-show="isUploadImage" :class="classes">
    <label
      :for="id"
      class="border-round border-dashed surface-border border-1 border-round-md flex justify-content-center align-items-center flex-column gap-1 cursor-pointer"
      :class="classes"
    >
      <i class="pi pi-camera" style="font-size: 1.5rem"></i>
      <input @change="onPreviewImage" :id="id" type="file" accept="image/*" hidden />
      Thêm ảnh
    </label>
  </div>

  <div
    v-show="!isUploadImage"
    :class="[classes, !isUploadImage && 'flex justify-content-center align-items-center']"
  >
    <div
      :class="`relative flex justify-content-center align-items-center ${
        !disabled && 'image-hover'
      }`"
    >
      <Button
        v-if="!disabled"
        id="btnRemove"
        label="Primary"
        icon="pi pi-times"
        class="p-button p-component p-button-icon-only p-button-rounded p-button-danger p-button-text absolute hidden"
        @click="onClickRemoveImage"
      />
      <img :src="previewPath" class="w-full" />
    </div>
  </div>
</template>

<style lang="scss" scoped>
img {
  object-fit: cover;
  height: 100%;
}
.image-hover {
  position: relative;
  cursor: pointer;
  width: 100%;
  height: 100%;
  &::before {
    content: "";
    position: absolute;
    display: block;
    width: 100%;
    height: 100%;
    background: black;
    top: 0;
    opacity: 0;
    transition: all 0.3s ease;
  }
  &:hover {
    &::before {
      opacity: 0.5;
    }
    #btnRemove {
      display: block !important;
    }
  }
}
</style>
