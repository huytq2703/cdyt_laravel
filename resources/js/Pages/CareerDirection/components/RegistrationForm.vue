<script setup>
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { onMounted, ref, watch } from "vue";
import InputText from "primevue/inputtext";
import Dropdown from "primevue/dropdown";
import { getProvinces, getDistrict, getWards, getTimeSlots } from "../service";
import { dateTimeToTime, stringDateTimeByFormat } from "@/utils/utils";
import Calendar from "primevue/calendar";
import Button from "primevue/button";

const provinces = ref([]);
const districts = ref([]);
const wards = ref([]);
const timeSlots = ref([]);

const infoForm = useForm({
  full_name: "",
  phone_number: "",
  address: "",
  province_id: "",
  district_id: "",
  ward_id: "",
  time_slot_id: null,
  free_date: null,
});

const onRegister = () => {
  infoForm.free_date = stringDateTimeByFormat(infoForm.free_date, "YYYY/MM/DD");

  infoForm.post(route("career_direction.register"), {
    preserveScroll: true,
    onSuccess: () => {
      infoForm.reset();
    },
  });
};

watch(
  () => infoForm.province_id,
  async (province_id) => {
    districts.value = null;
    infoForm.district_id = "";
    if (province_id) districts.value = [...(await getDistrict(province_id))];
  }
);

watch(
  () => infoForm.district_id,
  async (district_id) => {
    wards.value = null;
    infoForm.ward_id = "";
    if (district_id) wards.value = [...(await getWards(district_id))];
  }
);

onMounted(async () => {
  provinces.value = await getProvinces();
  timeSlots.value = await getTimeSlots();

  timeSlots.value = timeSlots.value?.map((time) => ({
    label: `${dateTimeToTime(time.from_time)} - ${dateTimeToTime(time.to_time)}`,
    id: time.id,
  }));
});
</script>
<template>
  <!-- Full name -->
  <div class="field flex-1 flex flex-column">
    <label for="fullName" class="font-bold">Họ và tên</label>
    <InputText
      v-model="infoForm.full_name"
      id="fullName"
      aria-describedby="fullName-help"
      :class="[infoForm.errors.full_name && 'p-invalid']"
      placeholder="Nhập họ và tên..."
    />
    <small v-if="infoForm.errors?.full_name" id="fullName-help" class="p-text-white">{{
      infoForm.errors.full_name
    }}</small>
  </div>

  <!-- Phone number -->
  <div class="field flex-1 flex flex-column">
    <label for="phoneNumber" class="font-bold">Số điện thoại</label>
    <InputText
      v-model="infoForm.phone_number"
      id="phoneNumber"
      aria-describedby="phoneNumber-help"
      :class="[infoForm.errors.phone_number && 'p-invalid']"
      placeholder="Số điện thoại..."
    />
    <small
      v-if="infoForm.errors?.phone_number"
      id="phoneNumber-help"
      class="p-text-white"
      >{{ infoForm.errors.phone_number }}</small
    >
  </div>

  <!-- Phone number -->
  <div class="field flex-1 flex flex-column">
    <label for="address" class="font-bold">Địa chỉ thường trú</label>
    <InputText
      v-model="infoForm.address"
      id="address"
      aria-describedby="address-help"
      :class="[infoForm.errors.address && 'p-invalid']"
      placeholder="Nhập địa chỉ"
    />
    <small v-if="infoForm.errors?.address" id="address-help" class="p-text-white">{{
      infoForm.errors.address
    }}</small>
  </div>

  <!-- Province -->
  <div class="field flex-1 flex flex-column">
    <label for="province_id">Tỉnh</label>
    <Dropdown
      id="province_id"
      v-model="infoForm.province_id"
      :options="provinces"
      optionLabel="name"
      optionValue="id"
      placeholder="Tỉnh"
      aria-describedby="province_id-help"
      :class="[infoForm?.errors?.province_id && 'p-invalid']"
      :filter="true"
      filterPlaceholder=""
    />
    <small
      v-if="infoForm?.errors?.province_id"
      id="province_id-help"
      class="p-text-white"
      >{{ infoForm?.errors?.province_id }}</small
    >
  </div>

  <!-- District -->
  <div class="field flex-1 flex flex-column">
    <label for="district_id">Quận/Huyện</label>
    <Dropdown
      id="district_id"
      v-model="infoForm.district_id"
      :options="districts"
      optionLabel="name"
      optionValue="id"
      placeholder="TP, Quận, Huyện"
      aria-describedby="district_id-help"
      :class="[infoForm?.errors?.district_id && 'p-invalid']"
      :filter="true"
      filterPlaceholder=""
      :disabled="!infoForm.province_id"
    />
    <small
      v-if="infoForm?.errors?.district_id"
      id="district_id-help"
      class="p-text-white"
      >{{ infoForm?.errors?.district_id }}</small
    >
  </div>

  <!-- Ward -->
  <div class="field flex-1 flex flex-column">
    <label for="ward_id">Xã/Phường</label>
    <Dropdown
      id="ward_id"
      v-model="infoForm.ward_id"
      :options="wards"
      optionLabel="name"
      optionValue="id"
      placeholder="Xã, Phường"
      aria-describedby="ward_id-help"
      :class="[infoForm?.errors?.ward_id && 'p-invalid']"
      :filter="true"
      filterPlaceholder=""
      :disabled="!infoForm.district_id"
    />
    <small v-if="infoForm?.errors?.ward_id" id="ward_id-help" class="p-text-white">{{
      infoForm?.errors?.ward_id
    }}</small>
  </div>

  <div class="mb-3">
    <div class="formgrid grid">
      <div class="field col-4">
        <label for="thoi_gian_tu_van">Thời gian tư vấn</label>
        <Calendar
          inputId="toTime"
          v-model="infoForm.free_date"
          hourFormat="12"
          :class="[infoForm?.errors?.free_date && 'p-invalid']"
        />
        <small
          v-if="infoForm?.errors?.free_date"
          id="ward_id-help"
          class="p-text-white"
          >{{ infoForm?.errors?.free_date }}</small
        >
      </div>
      <div class="field flex-1 flex flex-column">
        <label for="time_slot_id">Khung giờ tư vấn</label>
        <Dropdown
          id="time_slot_id"
          v-model="infoForm.time_slot_id"
          :options="timeSlots"
          optionLabel="label"
          optionValue="id"
          placeholder="Chọn khung giờ"
          aria-describedby="time_slot_id-help"
          :class="[infoForm?.errors?.time_slot_id && 'p-invalid']"
          filterPlaceholder=""
        ></Dropdown>
        <small
          v-if="infoForm?.errors?.time_slot_id"
          id="time_slot_id-help"
          class="p-text-white"
          >{{ infoForm?.errors?.time_slot_id }}</small
        >
      </div>
    </div>
  </div>
  <Button class="btn btn-info d-block w-100 text-xl text-black" @click="onRegister">
    ĐĂNG KÝ HƯỚNG NGHIỆP
  </Button>
</template>
