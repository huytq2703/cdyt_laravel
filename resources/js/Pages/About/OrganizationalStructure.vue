<script setup>
import App from "@/Layouts/App.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Listbox from 'primevue/listbox';
import { Link } from "@inertiajs/inertia-vue3";
import MenuSideBar from "./Components/MenuSideBar.vue";

</script>

<template>
  <Head title="Cơ cấu tổ chức" />
  <App>
      <div class="container mx-auto">
          <div class="grid py-4">
                <div class="col-12 xl:col-9 pr-3">
                    <h3
                        class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
                    >
                        CƠ CẤU TỔ CHỨC
                    </h3>
                    <!-- Here content -->
                    <div>
                        <p style="text-align: justify;">Tổ chức bộ máy của Nhà trường cơ cấu theo thông tư số 46/2016/TT-BLĐTBXH, ngày 28/12/2016 của Bộ Lao động - Thương binh và Xã hội ban hành Điều lệ trường cao đẳng.</p>
                        <p style="text-align: justify;"><strong>1. Hiệu trưởng, Phó hiệu trưởng</strong></p>
                        <p style="text-align: justify;">Hiệu trưởng: 01</p>
                        <p style="text-align: justify;">Phó hiệu trưởng: 01</p>
                        <p style="text-align: justify;"><strong>2. Hội đồng Khoa học và Đào tạo&nbsp;</strong></p>
                        <p style="text-align: justify;">Chủ tịch: Hiệu trưởng;</p>
                        <p style="text-align: justify;">Phó chủ tịch: Phó Hiệu trưởng phụ trách đào tạo;</p>
                        <p style="text-align: justify;">Thư ký: Trưởng Phòng Đào tạo - Nghiên cứu khoa học và Hợp tác quốc tế;</p>
                        <p style="text-align: justify;">- Thành viên: Phòng Công tác học sinh, sinh viên; Phòng Tài chính - Kế toán; Phòng Khảo thí và Kiểm định chất lượng; Khoa Điều dưỡng - Kỹ thuật y học; Khoa Y Khoa Khoa học cơ bản, Khoa Dược.</p>
                        <p style="text-align: justify;">- Hội đồng Khoa học - Đào tạo và các Hội đồng tư vấn khác sẽ được thành lập theo quy định và yêu cầu.</p>
                        <p style="text-align: justify;"><strong>3. Các phòng chức năng: 5 phòng</strong></p>
                        <p style="text-align: justify;">Phòng Tổ chức - Hành chính;</p>
                        <p style="text-align: justify;">Phòng Đào tạo - Nghiên cứu khoa học và Hợp tác quốc tế;</p>
                        <p style="text-align: justify;">Phòng Tài chính - Kế toán;</p>
                        <p style="text-align: justify;">Phòng Công tác học sinh, sinh viên;</p>
                        <p style="text-align: justify;">Phòng Khảo thí và Kiểm định chất lượng.</p>
                        <p style="text-align: justify;"><strong>4. Các Khoa trực thuộc trường: 4 khoa</strong></p>
                        <p style="text-align: justify;">Khoa Khoa học cơ bản;</p>
                        <p style="text-align: justify;">Khoa Y;</p>
                        <p style="text-align: justify;">Khoa Điều dưỡng - Kỹ thuật y học;</p>
                        <p style="text-align: justify;">Khoa Dược;</p>
                        <p style="text-align: justify;"><strong>5. Các cơ sở phục vụ đào tạo và nghiên cứu khoa học</strong></p>
                        <p style="text-align: justify;">Thư viện;</p>
                        <p style="text-align: justify;">Nhà thuốc thực hành;</p>
                        <p style="text-align: justify;">Ký túc xá;</p>
                        <p style="text-align: justify;">Nhà ăn sinh viên;</p>
                        <p style="text-align: justify;">Y tế trường học.</p>
                        <p style="text-align: justify;"><strong>6. Tổ chức ĐCSViệt Nam</strong></p>
                        <p style="text-align: justify;">Chi bộ Đảng gồm 22 đảng viên.</p>
                        <p style="text-align: justify;"><strong>7. Các đoàn thể và tổ chức xã hội</strong></p>
                        <p style="text-align: justify;">Công đoàn cơ sở;</p>
                        <p style="text-align: justify;">Đoàn Thanh niên Cộng sản Hồ Chí Minh;</p>
                        <p style="text-align: justify;">Ban nữ công;</p>
                        <p style="text-align: justify;">Tổ Cựu chiến binh.</p>
                        <p style="text-align: justify;"><a name="_Toc416072259"></a><strong>8&nbsp;</strong><strong>Về đội ngũ CBVC và giảng viên&nbsp;</strong></p>
                        <p style="text-align: justify;">
                            - Tổng số cán bộ nhân viên: 70 người <em>(Biên chế: 44 người; Hợp đồng theo&nbsp;</em><em>Nghị định 68/2000/NĐ-CP</em><em>: 05 người; Hợp đồng trong ngân sách 15 người; Hợp đồng từ nguồn thu của nhà trường: 06 người).</em>
                        </p>
                        <p style="text-align: justify;">- Cán bộ hành chính, phục vụ: 19/70, chiếm 27%.</p>
                        <p style="text-align: justify;"><a name="_Toc416072261">- Giảng viên:</a> 51/70, chiếm 73%.</p>
                        <p style="text-align: justify;">
                            <u>Trong đó</u>: Sau Đại học: 20 người, chiếm 29%; Đại học: 37 người, chiếm 53%; Cao đẳng: 06 người, chiếm 9%; Khác: 07 người, chiếm 10%; nam 21 người, chiếm 30%; nữ 49 người, chiếm 70%; dân tộc 03 người, chiếm 4%;
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
