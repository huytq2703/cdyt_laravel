<script setup>
import InputTextComponent from "@/Components/InputTextComponent.vue";
import DropdownComponent from "@/Components/DropdownComponent.vue";
import CalendarComponent from "@/Components/CalendarComponent.vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { onMounted, ref, computed, watch } from "vue";
import { getDistrict, getProvinces, getWards } from "@/commons/apiCommon";
import { stringWithoutAccents } from "@/utils/utils";
import Button from "primevue/button";
import { Inertia } from "@inertiajs/inertia";
import InputTextAreaComponent from "@/Components/InputTextAreaComponent.vue";
import Badge from "primevue/badge";

const props = defineProps({
  details: {
    type: Object,
    required: false,
    default: null,
  },
  genderOptions: Array,
  levelOptions: Array,
  priorityOptions: Array,
  majorOptions: Array,
  rac_Admissions: String,
  rl_Admissions: String,
  rau_Admissions: String,
  rau_HandleAdmissions: String,
});

const page = usePage();
const provinceOptions = ref([]);
const districtOptions = ref([]);
const wardOptions = ref([]);

const admissionForm = useForm({
  id: props.details?.id ?? null,
  full_name: props.details?.full_name ?? "",
  gender: props.details?.gender ?? "",
  birthday: props.details?.birthday ?? null,
  phone_number: props.details?.phone_number ?? "",
  email: props.details?.email ?? "",
  religion: props.details?.religion ?? "",
  nation: props.details?.nation ?? "",
  level: props.details?.level ?? "",
  priority_object: props.details?.priority_object ?? "",
  majors_id: props.details?.majors_id ?? "",
  address: props.details?.address ?? "",
  province_id: props.details?.province_id ?? "",
  district_id: props.details?.district_id ?? "",
  ward_id: props.details?.ward_id ?? "",
  notes: props.details?.notes ?? "",
});

const isShowHandleBtn = computed(() => {
  return admissionForm.id && props?.details?.status === 0;
});

const onClickCreate = () => {
  admissionForm.post(route(props.rac_Admissions));
};

const onClickBack = () => {
  Inertia.get(route(props.rl_Admissions));
};

const onClickUpdate = () => {
  admissionForm.put(
    route(props.rau_Admissions, {
      id: admissionForm.id,
    })
  );
};

const onClickHandleAdmission = () => {
  Inertia.put(route(props.rau_HandleAdmissions, { id: admissionForm.id }));
};

watch(
  () => admissionForm.province_id,
  async (id) => {
    districtOptions.value = await getDistrict(id);
    wardOptions.value = [];
  }
);

watch(
  () => admissionForm.district_id,
  async (id) => {
    wardOptions.value = await getWards(id);
  }
);

onMounted(async () => {
  provinceOptions.value = await getProvinces();

  if (admissionForm.province_id)
    districtOptions.value = await getDistrict(admissionForm.province_id);

  if (admissionForm.district_id)
    wardOptions.value = await getWards(admissionForm.district_id);
});
</script>

<template>
  <AdminLayout>
    <div class="card">
      <div class="flex">
        <h5 class="font-bold flex align-items-center gap-3">
          <i
            class="pi pi-angle-left cursor-pointer"
            style="font-size: 1.5rem"
            @click="onClickBack"
          ></i>
          Thông tin tuyển sinh
          <Badge
            v-if="admissionForm?.id"
            :severity="`${details?.status == 0 ? 'warning' : 'success'}`"
            :value="`${details?.status == 0 ? 'Chưa xử lý' : 'Đã xử lý'}`"
          ></Badge>
        </h5>
      </div>
      <div class="grid">
        <div class="lg:col-4 col-12">
          <div class="flex flex-column gap-2">
            <div class="flex gap-2 w-full">
              <InputTextComponent
                v-model="admissionForm.full_name"
                :errorMessage="admissionForm.errors.full_name"
                :maxlength="100"
                class="flex-1"
                id="fullName"
                label="Họ và tên"
                placeholder="Nhập họ và tên"
              />
              <DropdownComponent
                v-model="admissionForm.gender"
                :errorMessage="admissionForm.errors.gender"
                class="w-7rem"
                id="gender"
                label="Giới tính"
                :options="genderOptions"
                optionLabel="name"
                optionValue="code"
                placeholder="Giới tính"
              />
            </div>

            <div class="flex gap-2">
              <CalendarComponent
                id="birthday"
                v-model="admissionForm.birthday"
                label="Ngày sinh"
                :errorMessage="admissionForm.errors.birthday"
                class="w-4"
                placeholder="Ngày sinh"
              />
              <InputTextComponent
                v-model="admissionForm.phone_number"
                :errorMessage="admissionForm.errors.phone_number"
                :maxlength="20"
                class="flex-1"
                id="phonNumber"
                label="Số điện thoại"
                placeholder="Nhập số điện thoại"
              />
            </div>

            <InputTextComponent
              v-model="admissionForm.email"
              :errorMessage="admissionForm.errors.email"
              class="flex-1"
              id="email"
              label="Email"
              placeholder="Nhập địa chỉ email"
            />

            <div class="flex flex-row gap-2">
              <InputTextComponent
                v-model="admissionForm.religion"
                :errorMessage="admissionForm.errors.religion"
                class="flex-1"
                id="religion"
                label="Tôn giáo"
                placeholder="Nhập tôn giáo"
              />
              <InputTextComponent
                v-model="admissionForm.nation"
                :errorMessage="admissionForm.errors.nation"
                update:modelValue
                class="flex-1"
                id="nation"
                label="Dân tộc"
                placeholder="Nhập dân tộc"
              />
            </div>

            <div class="flex gap-2 w-full">
              <DropdownComponent
                v-model="admissionForm.level"
                :errorMessage="admissionForm.errors.level"
                id="level"
                label="Trình độ"
                :options="levelOptions"
                optionLabel="code"
                optionValue="code"
                placeholder="Chọn trình độ"
              />
              <DropdownComponent
                v-model="admissionForm.priority_object"
                :errorMessage="admissionForm.errors.priority_object"
                id="priority"
                label="Đối tượng ưu tiên"
                :options="priorityOptions"
                optionLabel="name"
                optionValue="name"
                placeholder="Chọn đối tượng ưu tiên"
              />
            </div>

            <DropdownComponent
              v-model="admissionForm.majors_id"
              :errorMessage="admissionForm.errors.majors_id"
              id="major"
              label="Ngành học"
              :options="majorOptions"
              optionLabel="name"
              optionValue="id"
              placeholder="Chọn ngành học"
            />

            <InputTextComponent
              v-model="admissionForm.address"
              :errorMessage="admissionForm.errors.address"
              class="flex-1"
              id="address"
              label="Địa chỉ"
              placeholder="Nhập địa chỉ"
            />

            <DropdownComponent
              v-model="admissionForm.province_id"
              :errorMessage="admissionForm.errors.province_id"
              id="province"
              label="Tỉnh"
              :options="provinceOptions"
              :filter="true"
              :filterFields="['name', 'enName']"
              optionLabel="name"
              optionValue="id"
              placeholder="Chọn tỉnh"
            />
            <DropdownComponent
              v-model="admissionForm.district_id"
              :errorMessage="admissionForm.errors.district_id"
              id="district"
              label="TP, Quận, Huyện"
              optionLabel="name"
              optionValue="id"
              :filter="true"
              :filterFields="['name', 'enName']"
              :options="districtOptions"
              :disabled="districtOptions.length <= 0"
              placeholder="Chọn quận, huyện"
            />
            <DropdownComponent
              v-model="admissionForm.ward_id"
              :errorMessage="admissionForm.errors.ward_id"
              id="ward"
              label="Xã, Phường"
              optionLabel="name"
              optionValue="id"
              :filter="true"
              :filterFields="['name', 'enName']"
              :options="wardOptions"
              :disabled="wardOptions.length <= 0"
              placeholder="Chọn xã, phường"
            />
          </div>
        </div>

        <div class="lg:col-8 col-12">
          <InputTextAreaComponent v-model="admissionForm.notes" label="Ghi chú" />
        </div>
      </div>

      <div class="flex pt-2 justify-content-start gap-3">
        <Button v-if="!admissionForm.id" label="Lưu" @click="onClickCreate" />
        <Button v-else label="Cập nhật" @click="onClickUpdate" />
        <Button
          v-if="isShowHandleBtn"
          label="Xử lý"
          @click="onClickHandleAdmission"
          class="p-button-outlined"
        />
      </div>
      <!-- <h5>Thông tin đăng ký tuyển sinh</h5>
      <div class="flex flex-column">
        <span v-for="(value, index) in Object.keys(details)" :key="index" class="flex-1">
          {{ value }}: {{ details[value] }}
        </span>
      </div> -->
    </div>
  </AdminLayout>
</template>
