<script setup>
import { onMounted } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Accordion from "primevue/accordion";
import AccordionTab from "primevue/accordiontab";
import InputText from "primevue/inputtext";
import InputTextComponent from "@/Components/InputTextComponent.vue";
import Button from "primevue/button";
import InputTextAreaComponent from "@/Components/InputTextAreaComponent.vue";

const props = defineProps({
  ras_GeneralInfo: String,
  res_ToasterMessage: String,
  phone_number: {
    type: Object,
    required: false,
    default: null,
  },
  url: {
    type: Object,
    required: false,
    default: null,
  },
  address: {
    type: Object,
    required: false,
    default: null,
  },
  email: {
    type: Object,
    required: false,
    default: null,
  },
  toaster: {
    type: Object,
    required: false,
    default: "",
  },
});

const generalInfo = useForm({
  address: props.address?.value,
  phone_number: props.phone_number?.value,
  email: props.email?.value,
  url: props.url?.value,
});

const toaster = useForm({
  value: props.toaster?.value,
});

const onSubmitGeneralInfoForm = () => {
  generalInfo.post(route(props.ras_GeneralInfo));
};

const saveToasterMessage = () => {
  toaster.post(route(props.res_ToasterMessage));
};

onMounted(() => {});
</script>

<template>
  <AdminLayout>
    <div class="card">
      <Accordion>
        <AccordionTab header="Thông tin chung">
          <form @submit.prevent="onSubmitGeneralInfoForm">
            <div class="flex flex-column">
              <div class="grid">
                <!-- Address -->
                <div class="col-8">
                  <div class="flex flex-column">
                    <label for="title">Địa chỉ</label>
                    <InputText
                      id="title"
                      maxlength="255"
                      v-model="generalInfo.address"
                      aria-describedby="title-help"
                      :class="generalInfo?.errors?.address && 'p-invalid'"
                    />
                    <small
                      v-if="generalInfo?.errors?.address"
                      id="title-help"
                      class="p-error"
                      >{{ generalInfo?.errors?.address }}</small
                    >
                  </div>
                </div>

                <!-- Phone number -->
                <div class="col-4">
                  <div class="flex flex-column">
                    <label for="phoneNumber">Số điện thoại</label>
                    <InputText
                      id="phoneNumber"
                      maxlength="20"
                      v-model="generalInfo.phone_number"
                      aria-describedby="phoneNumber-help"
                      :class="generalInfo?.errors?.phone_number && 'p-invalid'"
                    />
                    <small
                      v-if="generalInfo?.errors?.phone_number"
                      id="phoneNumber-help"
                      class="p-error"
                      >{{ generalInfo?.errors?.phone_number }}</small
                    >
                  </div>
                </div>

                <!-- Email -->
                <div class="col-4">
                  <InputTextComponent
                    id="email"
                    v-model="generalInfo.email"
                    label="Email"
                  />
                </div>

                <!-- Url -->
                <div class="col-4">
                  <InputTextComponent id="url" v-model="generalInfo.url" label="Url" />
                </div>
              </div>
            </div>
            <div class="flex mt-3 justify-content-end">
              <Button label="Lưu" type="submit" />
            </div>
          </form>
        </AccordionTab>
        <AccordionTab header="Thông báo chạy">
          <InputTextAreaComponent label="Nội dung thông báo" v-model="toaster.value" />
          <div class="flex mt-3 justify-content-end">
            <Button label="Lưu" type="submit" @click="saveToasterMessage" />
          </div>
        </AccordionTab>
        <!-- <AccordionTab header="Header III"> Content </AccordionTab> -->
      </Accordion>
    </div>
  </AdminLayout>
</template>
