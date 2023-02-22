<script setup>
import { ref, watch } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Button from "primevue/button";
import Calendar from "primevue/calendar";
import InputText from "primevue/inputtext";
import Listbox from "primevue/listbox";
import { dateTimeToTime, timeToDateTime, stringDateTimeByFormat } from "@/utils/utils";
import { onMounted } from "vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { Inertia } from "@inertiajs/inertia";
import TabView from "primevue/tabview";
import TabPanel from "primevue/tabpanel";

const props = defineProps({
  rac_TimeSlot: String,
  timeSlots: Array,
  careerDirectionRegistered: Array,
  rs_CareerDirection: String,
  rl_CareerDirection: String,
});
const activeIndex = ref(0);

const timeSlotForm = useForm({
  id: null,
  from_time: null,
  to_time: null,
});

const onSubmitSaveTimeSlot = () => {
  timeSlotForm.post(route(props.rac_TimeSlot), {
    onSuccess: () => {
      timeSlotForm.reset();
    },
  });
};

const onShowTimeToUpdate = (time) => {
  const from = timeToDateTime(time.from_time);
  const to = timeToDateTime(time.to_time);

  timeSlotForm.id = time.id;
  timeSlotForm.from_time = new Date(from);
  timeSlotForm.to_time = new Date(to);
};

const refreshForm = () => {
  timeSlotForm.reset();
};

const showDetails = (data) => {
  Inertia.get(route(props.rs_CareerDirection, { id: data.id }));
};

watch(activeIndex, (tab) => {
  Inertia.get(
    route(props.rl_CareerDirection, { status: tab }),
    {},
    {
      preserveState: true,
    }
  );
});

onMounted(async () => {
  console.log(props.careerDirectionRegistered);
});
</script>
<template>
  <AdminLayout>
    <div class="grid">
      <div class="lg:col-4 col-12">
        <div class="card">
          <h5 class="font-bold">Thêm mới thời gian</h5>

          <div class="grid">
            <div class="col-6">
              <Listbox
                :options="timeSlots"
                optionLabel="from_time"
                listStyle="max-height:250px"
              >
                <template #option="slotProps">
                  <div
                    class="flex align-items-center country-item"
                    @click="onShowTimeToUpdate(slotProps.option)"
                  >
                    <div>
                      {{ dateTimeToTime(slotProps.option.from_time) }} -
                      {{ dateTimeToTime(slotProps.option.to_time) }}
                    </div>
                  </div>
                </template>
              </Listbox>
            </div>

            <div class="col-6">
              <div class="flex flex-column align-content-between h-full">
                <div class="flex flex-column flex-1 gap-2">
                  <div class="flex flex-column">
                    <label for="fromTime">Thời gian bắt đầu</label>
                    <Calendar
                      inputId="fromTime"
                      v-model:model-value="timeSlotForm.from_time"
                      :timeOnly="true"
                      hourFormat="12"
                      :stepMinute="5"
                      :showSeconds="false"
                      :manualInput="false"
                      dateFormat="dd.mm.yy"
                    />
                    <small
                      v-if="timeSlotForm?.errors?.from_time"
                      id="title-help"
                      class="p-error"
                      >{{ timeSlotForm?.errors?.from_time }}</small
                    >
                  </div>
                  <div class="flex flex-column">
                    <label for="toTime">Thời gian kết thúc</label>
                    <Calendar
                      inputId="toTime"
                      v-model="timeSlotForm.to_time"
                      :stepMinute="5"
                      :timeOnly="true"
                      :showSeconds="false"
                      hourFormat="12"
                    />
                    <small
                      v-if="timeSlotForm?.errors?.to_time"
                      id="title-help"
                      class="p-error"
                      >{{ timeSlotForm?.errors?.to_time }}</small
                    >
                  </div>
                </div>

                <div class="flex mt-3 justify-content-end gap-2">
                  <Button
                    v-show="timeSlotForm?.id"
                    icon="pi pi-times"
                    label="Huỷ"
                    class="p-button-outlined"
                    @click="refreshForm"
                  />
                  <Button
                    :label="`${!timeSlotForm.id ? 'Thêm mới' : 'Cập nhật'}`"
                    @click="onSubmitSaveTimeSlot"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="lg:col-8 col-12">
        <div class="card">
          <h5 class="font-bold">Danh sách đăng ký tư vấn</h5>
          <TabView v-model:activeIndex="activeIndex">
            <TabPanel header="Chưa xử lý"></TabPanel>
            <TabPanel header="Đã xử lý"></TabPanel>
          </TabView>
          <DataTable
            :value="careerDirectionRegistered"
            :sortField="null"
            :sortOrder="null"
            dataKey="id"
            :rowHover="true"
            :autoLayout="true"
            responsiveLayout="scroll"
          >
            <template #empty>
              <p class="text-center">Không tìm thấy dữ liệu</p>
            </template>
            <Column field="id" header="id" :sortable="true" class="w-3rem"></Column>
            <Column field="full_name" header="Họ tên" :sortable="true"></Column>
            <Column field="phone_number" header="Số điện thoại" :sortable="true"></Column>
            <Column field="address" header="Địa chỉ" :sortable="true"></Column>
            <Column header="Ngày tư vấn" :sortable="true">
              <template #body="slotProps">
                {{ stringDateTimeByFormat(slotProps.data.free_date, "DD/MM/YYYY") }}
              </template>
            </Column>
            <Column header="Ngày tư vấn" :sortable="true">
              <template #body="slotProps">
                {{ dateTimeToTime(slotProps.data.time.from_time) }} -
                {{ dateTimeToTime(slotProps.data.time.to_time) }}
              </template>
            </Column>

            <Column header="Chức năng" class="w-10rem">
              <template #body="slotProps">
                <Button
                  icon="pi pi-file-edit"
                  class="p-button-rounded p-button-text"
                  @click="showDetails(slotProps.data)"
                />

                <!-- <Button
                  icon="pi pi-trash"
                  class="p-button-rounded p-button-text p-button-danger"
                  @click="deleteCategory(slotProps.data)"
                /> -->
              </template>
            </Column>
          </DataTable>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
