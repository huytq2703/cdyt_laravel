<script setup>
import { Head, useForm } from "@inertiajs/inertia-vue3";
import Button from "primevue/button";
import Dropdown from "primevue/dropdown";
import InputText from "primevue/inputtext";
import Calendar from "primevue/calendar";
import { onMounted, ref, computed, watch } from "vue";
import { getProvinces, getDistrict, getWards } from "../service";

const provinces = ref([]);
const districts = ref([]);
const wards = ref([]);
const props = defineProps({
  errors: Object,
  ra_SubmitFormRegister: String,
  majors: Array,
  levels: Array,
  genders: Array,
});
// const enrolmentForm = useForm({
//   full_name: "Tạ Quang Huy",
//   birthday: "27-03-1997",
//   gender: "nam",
//   religion: "123",
//   nation: "123",
//   level: "",
//   priority_object: "",
//   majors_id: "3",
//   email: "huytq270397@gmail.com",
//   phone_number: "0922299931",
//   address: "12232",
//   province_id: "1",
//   district_id: "1",
//   ward_id: "1",
// });

const enrolmentForm = useForm({
  full_name: "",
  birthday: "",
  gender: "",
  religion: "",
  nation: "",
  level: "",
  priority_object: "",
  majors_id: "",
  email: "",
  phone_number: "",
  address: "",
  province_id: "",
  district_id: "",
  ward_id: "",
});

watch(
  () => enrolmentForm.province_id,
  async (province_id) => {
    districts.value = null;
    enrolmentForm.district_id = "";
    if (province_id) districts.value = [...(await getDistrict(province_id))];
  }
);

watch(
  () => enrolmentForm.district_id,
  async (district_id) => {
    wards.value = null;
    enrolmentForm.ward_id = "";
    if (district_id) wards.value = [...(await getWards(district_id))];
  }
);

const onSubmitForm = () => {
  enrolmentForm.post(route(props.ra_SubmitFormRegister), {
    preserveScroll: true,
    onSuccess: () => {
      enrolmentForm.reset();
    },
  });
};

onMounted(async () => {
  provinces.value = await getProvinces();
  //   console.log(props.levels);
});
</script>

<template>
  <form @submit.prevent="onSubmitForm">
    <!-- Row -->
    <div class="flex flex-column md:flex-row w-full gap-0 md:gap-5">
      <div class="field flex-1 flex flex-column">
        <label for="full_name" class="font-bold"
          >Họ và tên <span class="text-red">*</span>
        </label>
        <InputText
          v-model="enrolmentForm.full_name"
          id="full_name"
          aria-describedby="full_name-help"
          :class="[enrolmentForm?.errors?.full_name && 'p-invalid']"
          placeholder="Nhập họ và tên"
        />
        <small
          v-if="enrolmentForm?.errors?.full_name"
          id="full_name-help"
          class="p-error"
          >{{ enrolmentForm?.errors.full_name }}</small
        >
      </div>

      <div class="field md:w-15rem w-full flex flex-column">
        <label for="birthDay" class="font-bold"
          >Ngày sinh <span class="text-red">*</span></label
        >
        <Calendar
          inputId="dateformat"
          v-model="enrolmentForm.birthday"
          dateFormat="mm-dd-yy"
          :class="[enrolmentForm?.errors?.birthday && 'p-invalid']"
        />
        <small
          v-if="enrolmentForm?.errors?.birthday"
          id="birthday-help"
          class="p-error"
          >{{ enrolmentForm?.errors?.birthday }}</small
        >
      </div>

      <div class="field flex flex-column md:w-10rem w-full">
        <label for="gender" class="font-bold"
          >Giới tính <span class="text-red">*</span></label
        >
        <Dropdown
          id="gender"
          v-model="enrolmentForm.gender"
          :options="genders"
          optionLabel="name"
          optionValue="id"
          placeholder="Giới tính"
          aria-describedby="gender-help"
          :class="[enrolmentForm?.errors?.gender && 'p-invalid']"
        />
        <small v-if="enrolmentForm?.errors?.gender" id="gender-help" class="p-error">{{
          enrolmentForm?.errors?.gender
        }}</small>
      </div>
    </div>

    <div class="flex md:flex-row flex-column flex-1 justify-content-between md:gap-3">
      <div class="field flex-1 flex flex-column">
        <label for="religion" class="font-bold">Tôn giáo</label>
        <InputText
          v-model="enrolmentForm.religion"
          id="religion"
          aria-describedby="religion-help"
          :class="[enrolmentForm?.errors?.religion && 'p-invalid']"
          placeholder="Tôn giáo"
        />
        <small
          v-if="enrolmentForm?.errors?.religion"
          id="religion-help"
          class="p-error"
          >{{ enrolmentForm?.errors?.religion }}</small
        >
      </div>

      <div class="field flex-1 flex flex-column">
        <label for="nation" class="font-bold"
          >Dân tộc <span class="text-red">*</span></label
        >
        <InputText
          v-model="enrolmentForm.nation"
          id="nation"
          aria-describedby="nation-help"
          :class="[enrolmentForm?.errors?.nation && 'p-invalid']"
          placeholder="Dân tộc"
        />
        <small v-if="enrolmentForm?.errors?.nation" id="nation-help" class="p-error">{{
          enrolmentForm?.errors?.nation
        }}</small>
      </div>

      <div class="field flex-1 flex flex-column">
        <label for="level" class="font-bold"
          >Trình độ <span class="text-red">*</span></label
        >
        <Dropdown
          id="level"
          v-model="enrolmentForm.level"
          :options="levels"
          placeholder=""
          aria-describedby="level-help"
          :class="[enrolmentForm?.errors?.level && 'p-invalid']"
        >
        </Dropdown>
        <small v-if="enrolmentForm?.errors?.level" id="level-help" class="p-error">{{
          enrolmentForm?.errors?.level
        }}</small>
      </div>

      <div class="field flex-1 flex flex-column">
        <label for="priority" class="font-bold">Đối tượng ưu tiên</label>
        <InputText
          v-model="enrolmentForm.priority_object"
          id="priority"
          aria-describedby="priority-help"
          :class="[enrolmentForm?.errors?.priority_object && 'p-invalid']"
          placeholder="Đối tượng ưu tiên"
        />
        <small
          v-if="enrolmentForm?.errors?.priority_object"
          id="priority-help"
          class="p-error"
          >{{ enrolmentForm?.errors?.priority_object }}</small
        >
      </div>
    </div>

    <!-- Row -->
    <div class="field flex-1 flex flex-column">
      <label for="Majors" class="font-bold"
        >Ngành học <span class="text-red">*</span></label
      >

      <Dropdown
        id="Majors"
        v-model="enrolmentForm.majors_id"
        :options="majors"
        optionLabel="name"
        optionValue="id"
        placeholder="Chọn ngành học"
        aria-describedby="Majors-help"
        :class="[enrolmentForm?.errors?.majors && 'p-invalid']"
        :filter="true"
        filterPlaceholder=""
      />
      <small v-if="enrolmentForm?.errors?.majors" id="Majors-help" class="p-error">{{
        enrolmentForm?.errors?.majors
      }}</small>
    </div>

    <div class="flex md:flex-row flex-column md:gap-3">
      <div class="field flex-1 flex flex-column">
        <label for="email" class="font-bold">Email <span class="text-red">*</span></label>
        <InputText
          v-model="enrolmentForm.email"
          id="email"
          aria-describedby="email-help"
          :class="[enrolmentForm?.errors?.email && 'p-invalid']"
          placeholder="Email"
        />
        <small v-if="enrolmentForm?.errors?.email" id="email-help" class="p-error">{{
          enrolmentForm?.errors?.email
        }}</small>
      </div>

      <div class="field flex-1 flex flex-column">
        <label for="phone_number" class="font-bold"
          >Số điện thoại <span class="text-red">*</span></label
        >
        <InputText
          v-model="enrolmentForm.phone_number"
          id="phone_number"
          aria-describedby="phone_number-help"
          :class="[enrolmentForm?.errors?.phone_number && 'p-invalid']"
          placeholder="Số điện thoại không để trống và nhập 10 chữ số"
        />
        <small
          v-if="enrolmentForm?.errors?.phone_number"
          id="phone_number-help"
          class="p-error"
          >{{ enrolmentForm?.errors?.phone_number }}</small
        >
      </div>
    </div>

    <!-- Row -->
    <div class="field flex-1 flex flex-column">
      <label for="address" class="font-bold"
        >Địa chỉ liên hệ <span class="text-red">*</span></label
      >
      <InputText
        v-model="enrolmentForm.address"
        id="address"
        aria-describedby="address-help"
        :class="[enrolmentForm?.errors?.address && 'p-invalid']"
        placeholder="Nhập số nhà ..."
      />
      <small v-if="enrolmentForm?.errors?.address" id="address-help" class="p-error">{{
        enrolmentForm?.errors?.address
      }}</small>
    </div>

    <div class="flex justify-content-between md:gap-3 md:flex-row flex-column">
      <div class="field flex-1 flex flex-column">
        <Dropdown
          id="province_id"
          v-model="enrolmentForm.province_id"
          :options="provinces"
          optionLabel="name"
          optionValue="id"
          placeholder="Tỉnh"
          aria-describedby="province_id-help"
          :class="[enrolmentForm?.errors?.province_id && 'p-invalid']"
          :filter="true"
          filterPlaceholder=""
        />
        <small
          v-if="enrolmentForm?.errors?.province_id"
          id="province_id-help"
          class="p-error"
          >{{ enrolmentForm?.errors?.province_id }}</small
        >
      </div>
      <div class="field flex-1 flex flex-column">
        <Dropdown
          id="district_id"
          v-model="enrolmentForm.district_id"
          :options="districts"
          optionLabel="name"
          optionValue="id"
          placeholder="TP, Quận, Huyện"
          aria-describedby="district_id-help"
          :class="[enrolmentForm?.errors?.district_id && 'p-invalid']"
          :filter="true"
          filterPlaceholder=""
          :disabled="!enrolmentForm.province_id"
        />
        <small
          v-if="enrolmentForm?.errors?.district_id"
          id="district_id-help"
          class="p-error"
          >{{ enrolmentForm?.errors?.district_id }}</small
        >
      </div>

      <div class="field flex-1 flex flex-column">
        <Dropdown
          id="ward_id"
          v-model="enrolmentForm.ward_id"
          :options="wards"
          optionLabel="name"
          optionValue="id"
          placeholder="Xã, Phường"
          aria-describedby="ward_id-help"
          :class="[enrolmentForm?.errors?.ward_id && 'p-invalid']"
          :filter="true"
          filterPlaceholder=""
          :disabled="!enrolmentForm.district_id"
        />
        <small v-if="enrolmentForm?.errors?.ward_id" id="ward_id-help" class="p-error">{{
          enrolmentForm?.errors?.ward_id
        }}</small>
      </div>
    </div>

    <!-- Row -->
    <div class="field flex-1 flex flex-column">
      <Button
        type="submit"
        class="flex text-center justify-content-center bg-default font-bold"
        >Đăng ký ngay</Button
      >
    </div>
  </form>
</template>
