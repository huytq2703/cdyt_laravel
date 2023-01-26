<script setup>
import { ref } from "vue";
import Carousel from "primevue/carousel";
const blogs = ref([
  {
    image: "7.jpg",
    title: "TRƯỜNG CDYT TỔ CHỨC HỘI THẢO TƯ VẤN GIỚI THIỆU NGÀNH ĐIỀU DƯỠNG TẠI NHẬT BẢN",
    summary:
      "Hội thảo Du học, cơ hội làm việc tại Nhật là một hoạt động thường niên của Trường Cao đẳng Y tế Đắk Lắk, nhằm giúp sinh viên, đặc biệt là sinh viên ngành Điều Dưỡng, có cơ hội được tìm hiểu, được giải đáp thắc mắc, và được tạo điều kiện tốt nhất để có thể du học và làm việc tại Nhật Bản.",
  },
  {
    image: "6.jpg",
    title: "CƠ HỘI HỌC TẬP – LÀM VIỆC VÀ ĐỊNH CƯ TẠI ĐỨC, NHẬT BẢN",
    summary:
      "Trường Cao Đẳng Y Tế Đắk Lắk là cơ sở giáo dục nghề nghiệp, đào tạo nguồn nhân lực y tế của tỉnh và khu vực Tây Nguyên, đồng hành cùng các Bệnh viện, đào tạo lý thuyết  gắn liền thực tiễn, tạo dựng sự nghiệp cá nhân, nâng cao nguồn nhân lực y tế, đáp ứng nhu cầu của xã hội, hội nhập với khu vực và quốc tế.",
  },
  {
    image: "9.jpg",
    title: "ĐẠI HỌC KHÔNG PHẢI CON ĐƯỜNG DUY NHẤT",
    summary:
      "-🌟🌟 Với mức học phí thấp, các em vui mừng khi việc học của mình không phải là gánh nặng kinh tế cho gia đình. Thậm chí nhiều em hộ nghèo, hoặc cận nghèo với mức học lực khá còn nhận được học bổng 100 % học phí của trường trở thành niềm tự hào của gia đình và bố mẹ   ",
  },
  {
    image: "6.jpg",
    title: "CƠ HỘI HỌC TẬP – LÀM VIỆC VÀ ĐỊNH CƯ TẠI ĐỨC, NHẬT BẢN",
    summary:
      "Trường Cao Đẳng Y Tế Đắk Lắk là cơ sở giáo dục nghề nghiệp, đào tạo nguồn nhân lực y tế của tỉnh và khu vực Tây Nguyên, đồng hành cùng các Bệnh viện, đào tạo lý thuyết  gắn liền thực tiễn, tạo dựng sự nghiệp cá nhân, nâng cao nguồn nhân lực y tế, đáp ứng nhu cầu của xã hội, hội nhập với khu vực và quốc tế.",
  },
]);
</script>
<template>
  <div>
    <Carousel
      :value="blogs"
      :numVisible="1"
      :numScroll="1"
      :autoplayInterval="2000"
      :showNavigators="false"
      :showIndicators="false"
      class="border-1"
    >
      <template #item="slotProps">
        <a href="#">
          <img
            :src="`storage/activities/${slotProps.data.image}`"
            style="height: 350px; width: 100%; object-fit: cover"
          />
          <div class="w-full h-13rem p-3">
            <h3 class="text-xl font-bold">{{ slotProps.data.title }}</h3>
            <p class="font-bold mt-2">{{ slotProps.data.summary }}</p>
          </div>
        </a>
      </template>
    </Carousel>
  </div>
</template>
