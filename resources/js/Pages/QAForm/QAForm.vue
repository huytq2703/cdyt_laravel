<script setup>
import App from "@/Layouts/App.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Accordion from "primevue/accordion";
import AccordionTab from "primevue/accordiontab";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import Textarea from "primevue/textarea";

const props = defineProps({
  errors: Object,
});

const questionForm = useForm({
  fullName: "",
  phoneNumber: "",
  email: "",
  content: "",
});

const onClickSendQuestion = () => {
  questionForm.post(route("qaform.createQuestion"));
};
</script>
<template>
  <App>
    <template #header>
      <div class="relative">
        <img src="/storage/images/banner/Photo-03.jpg" alt="" class="header-image" />

        <div
          class="absolute top-0 flex w-full justify-content-center align-items-center h-full"
        >
          <div class="text-center p-4 bg-overlay">
            <h1 class="font-bold">NHỮNG CÂU HỎI THƯỜNG GẶP</h1>
            <h3>Đây là những câu hỏi & trả lời được nhiều bạn thắc mắc nhất</h3>
          </div>
        </div>
      </div>
    </template>

    <div class="container mx-auto">
      <div class="grid py-4">
        <div class="col-12 xl:col-8">
          <h3
            class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
          >
            DANH SÁCH CÂU HỎI
          </h3>
          <Accordion>
            <AccordionTab
              header="CÂU 1: Chính sách học bổng của trường như thế nào?"
              headerClass="accordionTab-custom header-icon-right"
            >
              <p>
                Để động viên và khuyến khích tinh thần học tập của tân sinh viên, hằng năm
                Cao đẳng Y tế Đắk Lắk đều có học bổng dành cho tân sinh viên. Năm 2021,
                trường dành 10 suất học bổng 20 triệu đồng cho ngành Y khoa,15 triệu đồng
                cho ngành Dược học, 10 triệu đồng cho ngành Điều dưỡng và 10 triệu đồng
                cho ngành Y tế công cộng.
              </p>
            </AccordionTab>
            <AccordionTab
              header="CÂU 2: Cơ hội việc làm của ngành Dược sau khi tốt nghiệp như thế nào?"
              headerClass="accordionTab-custom header-icon-right"
            >
              <p>
                Làm việc tại hệ thống bệnh viện, trung tâm y tế. Dược sĩ lâm sàng chịu
                trách nhiệm cung ứng đảm bảo lượng thuốc về số lượng và chất lượng, cảnh
                bảo tương tác và hướng dẫn sử dụng thuốc… Làm việc tại những cơ sở sản
                xuất, công ty dược phẩm với nhiệm vụ nghiên cứu quy trình sản xuất, công
                thức, dạng bào chế, đảm bảo thuốc sản xuất ra đạt chết lượng..Bên cạnh đó,
                bạn cũng có thể làm việc tại Viện hay những Trung tâm kiểm nghiệm hay mở
                cơ sở kinh doanh dược phẩm như Nhà thuốc, Công ty phân phối hay Công ty
                nhập khẩu thuốc… Sinh viên cũng có thể làm việc tại những trường y dược,
                đảm nhận công tác giảng dạy hay kỹ thuật viên. Ngoài ra, bạn cũng có thể
                đảm nhận nhiều vị trí khác như nhân viên tư vấn dược phẩm, trình dược
                viên…
              </p>
            </AccordionTab>
            <AccordionTab
              header="CÂU 3: Cơ hội việc làm của ngành Y khoa sau khi tốt nghiệp như thế nào?"
              headerClass="accordionTab-custom header-icon-right"
            >
              <p>
                Các bác sĩ đa khoa được đào tạo toàn diện; có nhiệm vụ khám chữa bệnh tại
                các sơ sở y tế, điều trị và hướng dẫn chăm sóc bệnh nhân tại nhà, thực
                hiện công tác phòng bệnh, giáo dục sức khỏe, tổ chức và quản lý các dịch
                vụ chăm sóc sức khỏe tại cộng đồng, tham gia công tác đào tạo và nghiên
                cứu khoa học…
              </p>
            </AccordionTab>
            <AccordionTab
              header="CÂU 4: Em chuẩn bị tham gia kì thi THPT quốc gia để xét tuyển vào đại học, em có thể đăng kí xét tuyển vào cả 4 ngành của trường được không?"
              headerClass="accordionTab-custom header-icon-right"
            >
              <p>
                Để tăng khả năng trúng tuyển vào trường, thí sinh có thể đăng ký nhiều
                nguyện vọng để xét tuyển vào một trường. Tuy nhiên, phải lưu ý nên đặt tổ
                hợp gồm các môn thi mà thí sinh có ưu thế và ngành có nguyện vọng học ở
                thứ tự ưu tiên cao hơn.
              </p>
            </AccordionTab>

            <AccordionTab
              header="CÂU 6: Trường có xét học bạ không? Nếu có thì thời gian nhận xét tuyển từ khi nào và học sinh cần nộp những giấy tờ gì ?"
              headerClass="accordionTab-custom header-icon-right"
            >
              <p>
                - Nhà trường có sử dụng phương thức xét tuyển bằng học bạ THPT, là 1 trong
                các phương thức xét tuyển bằng học bạ THPT.- Thời gian xét tuyển: Tạo điều
                kiện cho thí sinh. Nhà trường chia thành nhiều đợt xét tuyển trong năm kéo
                dài từ tháng 20/02 đến cuối tháng 8 năm 2021 (06 đợt). - Về Hồ sơ thí sinh
                có thể liên hệ nộp trực tiếp tại Trường, gửi qua bưu điện hoặc nộp trực
                tuyến trên website tuyển sinh của Trường: tuyensinh.bmtu.edu.vn
              </p>
            </AccordionTab>

            <AccordionTab
              header="CÂU 7: Trường Cao đẳng y tế Đắk Lắk có xét tuyển học bạ ngành Y khoa không?"
              headerClass="accordionTab-custom header-icon-right"
            >
              <p>
                Năm 2021, theo đề án tuyển sinh riêng của trường, trường có ưu tiên xét
                tuyển 5% chỉ tiêu ngành Y khoa cho thí sinh đạt học lực loại Giỏi năm lớp
                12.
              </p>
            </AccordionTab>
          </Accordion>
        </div>
        <div class="col-12 xl:col-4 surface-400 border-round-lg">
          <h3
            class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
          >
            ĐẶT CÂU HỎI
          </h3>

          <div class="flex flex-column">
            <div class="field flex-1 flex flex-column">
              <label for="fullName" class="font-bold">Họ và tên</label>
              <InputText
                v-model="questionForm.fullName"
                id="fullName"
                aria-describedby="fullName-help"
                :class="[errors.fullName && 'p-invalid']"
                placeholder="Nhập họ và tên..."
              />
              <small v-if="errors.fullName" id="fullName-help" class="p-error">{{
                errors.fullName
              }}</small>
            </div>

            <div class="field flex-1 flex flex-column">
              <label for="phoneNumber" class="font-bold">Số điện thoại</label>
              <InputText
                v-model="questionForm.phoneNumber"
                id="phoneNumber"
                type="username"
                aria-describedby="phoneNumber-help"
                :class="[errors.phoneNumber && 'p-invalid']"
                placeholder="Nhập số điện thoại..."
              />
              <small v-if="errors.phoneNumber" id="phoneNumber-help" class="p-error">{{
                errors.phoneNumber
              }}</small>
            </div>

            <div class="field flex-1 flex flex-column">
              <label for="email" class="font-bold">Email</label>
              <InputText
                v-model="questionForm.email"
                id="email"
                type="username"
                aria-describedby="email-help"
                :class="[errors.email && 'p-invalid']"
                placeholder="Nhập email..."
              />
              <small v-if="errors.email" id="email-help" class="p-error">{{
                errors.email
              }}</small>
            </div>

            <div class="field flex-1 flex flex-column">
              <label for="question" class="font-bold">Câu hỏi</label>
              <Textarea
                v-model="questionForm.content"
                rows="5"
                cols="30"
                :class="[errors.content && 'p-invalid']"
                aria-describedby="question-help"
                placeholder="Nhập nội dung câu hỏi"
              />
              <small v-if="errors.content" id="question-help" class="p-error">{{
                errors.content
              }}</small>
            </div>

            <div class="field flex-1 flex flex-column">
              <Button
                class="p-button-web font-bold flex justify-content-center"
                @click="onClickSendQuestion"
                >GỬI CÂU HỎI</Button
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </App>
</template>

<style lang="scss" scoped>
.header-image {
  width: 100%;
  object-fit: cover;
}

.bg-overlay {
  background-color: rgba(40, 40, 40, 0.57);
  color: white;
}
</style>
