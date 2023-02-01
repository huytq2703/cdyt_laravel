<script setup>
import App from "@/Layouts/App.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Listbox from 'primevue/listbox';
import { Link } from "@inertiajs/inertia-vue3";
import MenuSideBar from "./Components/MenuSideBar.vue";

</script>

<template>
  <Head title="Thông tin chung" />
  <App>
      <div class="container mx-auto">
          <div class="grid py-4">
                <div class="col-12 xl:col-9 pr-3">
                    <h3
                        class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
                    >
                        GIỚI THIỆU CHUNG
                    </h3>
                    <!-- Here content -->
                    <div>
                        <p><img src="/storage/images/abouts/gioi-thieu-chung.jpg" class="fr-fic fr-dii" style="width: 100%;" /></p>
                        <p><strong>1. Tên và trụ sở: &nbsp; &nbsp;&nbsp;</strong></p>
                        <p>-<strong>&nbsp;</strong>Tên tiếng Việt: <strong>TRƯỜNG CAO ĐẲNG Y TẾ ĐẮK LẮK</strong></p>
                        <p>-<strong>&nbsp;</strong>Tên giao dịch quốc tế: <strong>DAKLAK MEDICAL COLLEGE</strong></p>
                        <p>- Tên viết tắt: <strong>DMC</strong></p>
                        <p><a name="_Toc462213442">- Địa chỉ:</a> Số 32 Y Ngông, phường Tân Tiến, thành phố Buôn Ma Thuột, tỉnh Đắk Lắk.</p>
                        <p>- Điện thoại: (02623) 860 618; Fax: (02623) 860618;</p>
                        <p>- Website: <a href="http://www.dmc.edu.vn"></a><a href="//www.dmc.edu.vn">www.dmc.edu.vn</a>; Email: <a href="mailto:caodangytedaklak@gmail.com.">caodangytedaklak@gmail.com.</a></p>
                        <p><strong>2. Quá trình thành lập và phát triển:</strong></p>
                        <p style="text-align: justify;">
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Tiền thân trường Trung cấp Y tế Đắk Lắk được xây dựng vào những năm đầu của thập niên 70 của thế kỷ trước của chế độ cũ. Vào thời điểm đó, trường có tên là Trường Tá viên điều dưỡng, đào tạo
                            tá viên điều dưỡng với thời gian 1 năm; Sau năm 1975, miền Nam hoàn toàn giải phóng và thống nhất đất nước, trường được thu dung và đổi tên thành trường Cán bộ y tế Đắk Lắk và đào tạo cán bộ y tế trình độ sơ học (hộ sinh, y tá, dược
                            tá). Đến năm 1977, trường bắt đầu đào tạo y sỹ trung học nhằm đáp ứng nhu cầu phục vụ cho công tác chăm sóc và bảo vệ sức khỏe cho nhân dân.
                        </p>
                        <p style="text-align: justify;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Ngày 01/8/1978, Ủy ban nhân dân tỉnh Đắk Lắk ra quyết định đổi tên trường Cán bộ y tế Đắk Lắk thành trường Trung học Y tế Đắk Lắk.</p>
                        <p style="text-align: justify;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Năm 2007, Ủy ban nhân dân tỉnh Đắk Lắk quyết định đổi tên trường Trung học Y tế Đắk Lắk thành trường Trung cấp Y tế Đắk Lắk.</p>
                        <p style="text-align: justify;">
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Trong điều kiện của tỉnh Đắk Lắk là địa bàn vùng núi, có nhiều đồng bào dân tộc thiểu số sinh sống và là vùng biên giới còn rất nhiều khó khăn, tuy nhiên với sự đoàn kết, quyết tâm và nỗ lực
                            của Lãnh đạo Đảng, Chính quyền, Ban giám hiệu và toàn thể cán bộ, giáo viên, Trường đã đạt được những thành tích rất phấn khởi, dưới mái trường này đã có nhiều con em đồng bào các dân tộc trong tỉnh và khu vực Tây Nguyên được học
                            tập, đào tạo trở thành những cán bộ Y tế có trình độ và tay nghề từ sơ cấp, đến trung cấp đảm bảo cho đội ngũ nhân lực y tế tại các cơ sở Y tế từ tỉnh xuống huyện, xã, góp phần quan trọng vào sự nghiệp chăm sóc sức khỏe nhân dân
                            trên địa bàn tỉnh
                        </p>
                        <p style="text-align: justify;">
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Trải qua 41 năm xây dựng và trưởng thành, được sự quan tâm giúp đỡ của các Bộ, Ngành, Tỉnh Ủy, Hội đồng nhân dân, Ủy ban nhân dân tỉnh Đắk Lắk và các cơ quan ban ngành của tỉnh, Trường Cao
                            đẳng Y tế Đắk Lắk đã chính thức được thành lập trên cơ sở nâng cấp từ Trường Trung cấp Y tế Đắk Lắk, theo Quyết định số 4567/QĐ-BGDDT ngày 13 tháng 10 năm 2016, đánh đấu một bước ngoặc quan trọng trong sự nghiệp đào tạo cán bộ Y tế
                            tỉnh nhà.
                        </p>
                    </div>
                </div>
                <div class="col-12 xl:col-3">
                    <MenuSideBar />
                </div>
          </div>
      </div>
  </App>
</template>

<style lang="scss">
.nav-link {
  color: white;
  padding: 7px;
  &:hover {
    background-color: #b83234;
    font-weight: bold;
  }
}
.nav-link {
  color: white;
  font-size: 1rem;
  padding: 0.5rem;
  border: none;
  cursor: pointer;
  transition: all 0.2s ease;
}

.side-menu {
    height: calc(100vh - 130px);
}
.bg-category {
    background-color: #2a8b6c;
}
.text-category {
    color: white;
}
</style>
