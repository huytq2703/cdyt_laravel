<script setup>
// import Carousel from 'primevue/carousel';

import { ref } from "vue";
import { MDBCarousel } from "mdb-vue-ui-kit";

const items1 = [
  {
    src: "storage/images/banner/Photo-06.jpg",
    alt: "",
    label: "",
    caption: "",
  },
  {
    src: "storage/images/banner/Photo-05.jpg",
    alt: "",
    label: "",
    caption: "",
  },
  {
    src: "storage/images/banner/Photo-05 (1).jpg",
    alt: "",
    label: "",
    caption: "",
  },
  {
    src: "storage/images/banner/Photo-05 (2).jpg",
    alt: "",
    label: "",
    caption: "",
  },
  {
    src: "storage/images/banner/Photo-05 (3).jpg",
    alt: "",
    label: "",
    caption: "",
  },
  {
    src: "storage/images/banner/Photo-05 (4).jpg",
    alt: "",
    label: "",
    caption: "",
  },
];
const carousel1 = ref(0);
</script>

<template>
  <MDBCarousel
    v-model="carousel1"
    :items="items1"
    :indicators="false"
    :controls="false"
    :interval="5000"
    fade
  />
</template>

<style lang="scss" scoped></style>
