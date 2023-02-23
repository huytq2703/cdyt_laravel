<script setup>
import App from "@/Layouts/App.vue";
import InputText from "primevue/inputtext";
import Dropdown from "primevue/dropdown";
import Textarea from "primevue/textarea";
import Button from "primevue/button";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
  errors: Object,
  departments: Array,
});
const contactForm = useForm({
  full_name: "",
  phone_number: "",
  email: "",
  department_id: "",
  content: "",
});

const onClickSendInfo = () => {
  contactForm.post(route("contact.create"), {
    onSuccess: () => {
      contactForm.reset();
    },
  });
};
</script>

<template>
  <Head title="Liên hệ" />
  <App>
    <div class="container mx-auto py-3">
      <h3
        class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1 mb-0"
      >
        NHẬP THÔNG TIN LIÊN HỆ
      </h3>
      <p class="font-bold">
        Bạn vui lòng điền đầy đủ thông tin cá nhân và chọn Khoa, phòng ban liên hệ công
        tác. Chúng tôi sẽ liên hệ lại bạn trong thời gian ngắn nhất.
      </p>
      <!-- Here content -->
      <div class="grid">
        <div class="xl:col-8 col-12">
          <div class="border flex flex-column p-5">
            <!-- Row -->
            <div class="flex flex-row w-full gap-5">
              <div class="field flex-1 flex flex-column">
                <label for="full_name" class="font-bold">Họ và tên</label>
                <InputText
                  v-model="contactForm.full_name"
                  id="full_name"
                  aria-describedby="full_name-help"
                  :class="[errors.full_name && 'p-invalid']"
                  placeholder="Nhập họ và tên"
                />
                <small v-if="errors?.full_name" id="full_name-help" class="p-error">{{
                  errors.full_name
                }}</small>
              </div>

              <div class="field flex-1 flex flex-column">
                <label for="phone_number" class="font-bold">Số điện thoại</label>
                <InputText
                  v-model="contactForm.phone_number"
                  id="phone_number"
                  aria-describedby="phone_number-help"
                  :class="[errors.phone_number && 'p-invalid']"
                  placeholder="Nhập số điện thoại"
                />
                <small
                  v-if="errors.phone_number"
                  id="phone_number-help"
                  class="p-error"
                  >{{ errors.phone_number }}</small
                >
              </div>
            </div>

            <!-- Row -->
            <div class="field flex-1 flex flex-column">
              <label for="email" class="font-bold">Email</label>
              <InputText
                v-model="contactForm.email"
                id="email"
                type="email"
                aria-describedby="username2-help"
                :class="[errors.email && 'p-invalid']"
                placeholder="Nhập email..."
              />
              <small v-if="errors.email" id="username2-help" class="p-error">{{
                errors.email
              }}</small>
            </div>

            <!-- Row -->
            <div class="field flex-1 flex flex-column">
              <label for="department_id" class="font-bold">Đơn vị liên hệ công tác</label>

              <Dropdown
                id="department_id"
                v-model="contactForm.department_id"
                :options="departments"
                optionLabel="name"
                optionValue="id"
                placeholder="Phòng tổ chức - hành chính"
                aria-describedby="department_id-help"
                :class="[contactForm.errors.department_id && 'p-invalid']"
                :filter="true"
                filterPlaceholder=""
              />
              <small
                v-if="contactForm.errors.department_id"
                id="department_id-help"
                class="p-error"
                >{{ contactForm.errors.department_id }}</small
              >
            </div>

            <!-- Row -->
            <div class="field flex-1 flex flex-column">
              <label for="content" class="font-bold">Nội dung liên hệ</label>
              <Textarea
                id="content"
                v-model="contactForm.content"
                rows="5"
                cols="30"
                aria-describedby="content-help"
                :class="[errors.content && 'p-invalid']"
              />
              <small v-if="errors.content" id="content-help" class="p-error">{{
                errors.content
              }}</small>
            </div>

            <!-- Row -->
            <div class="field flex-1 flex flex-column">
              <Button
                class="flex text-center justify-content-center bg-default font-bold"
                @click="onClickSendInfo"
                >Gửi thông tin</Button
              >
            </div>
          </div>
        </div>

        <div class="xl:col-4 col-12">
          <img
            src="/storage/images/sinhvien.jpg"
            alt="SINH VIEN"
            class="card-img"
            style="width: 100%; height: 100%; object-fit: cover"
          />
        </div>
      </div>
    </div>
  </App>
</template>
