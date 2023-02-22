<script setup>
import { dateTimeToTime, timeToDateTime, stringDateTimeByFormat } from "@/utils/utils";
import Button from "primevue/button";
import Badge from "primevue/badge";
import { Inertia } from "@inertiajs/inertia";
import TabView from "primevue/tabview";
import TabPanel from "primevue/tabpanel";

const props = defineProps({
  details: {
    type: Object,
    required: false,
    default: null,
  },

  rl_CareerDirection: String,
  rau_CareerDirection: String,
});

const onClickBack = () => {
  Inertia.get(route(props.rl_CareerDirection));
};

const onClickProcess = () => {
  Inertia.put(route(props.rau_CareerDirection, { id: props.details.id }), { status: 1 });
};
</script>

<template>
  <AdminLayout>
    <div class="card">
      <h5 class="font-bold">
        <i
          class="pi pi-angle-left cursor-pointer"
          style="font-size: 1.5rem"
          @click="onClickBack"
        ></i>
        Thông tin đăng ký hướng nghiệp
        <Badge
          :severity="`${details.status == 0 ? 'warning' : 'success'}`"
          :value="`${details.status == 0 ? 'Chưa xử lý' : 'Đã xử lý'}`"
        ></Badge>
      </h5>

      <div class="flex flex-column gap-2 text-lg">
        <div class="flex flex-row">
          <span class="w-10rem">Họ tên :</span
          ><span class="font-bold">{{ details.full_name }}</span>
        </div>

        <div class="flex flex-row">
          <span class="w-10rem">Số điện thoại :</span
          ><span class="font-bold">{{ details.phone_number }}</span>
        </div>

        <div class="flex flex-row">
          <span class="w-10rem">Địa chỉ :</span
          ><span>{{
            `${details.address}, ${details.ward.name}, ${details.district.name}, ${details.province.name}`
          }}</span>
        </div>

        <div class="flex flex-row">
          <span class="w-10rem">Khung giờ tư vấn</span
          ><span class="font-bold"
            >{{ details.free_date }} ({{
              `${dateTimeToTime(details.time.from_time)} - ${dateTimeToTime(
                details.time.to_time
              )}`
            }})</span
          >
        </div>
      </div>

      <div class="flex flex-row pt-3">
        <Button v-if="details.status == 0" icon="pi pi-check" label="Đã xử lý" @click="onClickProcess" />
      </div>
    </div>
  </AdminLayout>
</template>
