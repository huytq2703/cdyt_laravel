<script setup>
import App from "@/Layouts/App.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Listbox from 'primevue/listbox';
import { Link } from "@inertiajs/inertia-vue3";
import MenuSideBar from "./Components/MenuSideBar.vue";

</script>

<template>
  <Head title="Khoa Y" />
  <App>
      <div class="container mx-auto">
          <div class="grid py-4">
                <div class="col-12 xl:col-9 pr-3">
                    <h3
                        class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
                    >
                        KHOA Y
                    </h3>
                    <!-- Here content -->
                    <div>
                        <ul>
                            <li>
                                <strong>I/</strong><strong>&nbsp;</strong><strong>VỊ TRÍ - CHỨC NĂNG</strong><strong>:</strong>
                                <p>
                                    Các Khoa, Bộ môn chịu sự lãnh đạo trực tiếp của Hiệu trưởng, chịu trách nhiệm trước Hiệu trưởng về tổ chức, điều hành và giám sát công tác giảng dạy. Tổ chức thực hiện nhiệm vụ đào tạo theo chương trình chi tiết đã được phê
                                    duyệt, tổ chức các hoạt động nghiên cứu khoa học phù hợp với chuyên môn;
                                </p>
                                <p>Tham gia các hoạt động tư vấn trong ngành về các vấn đề có liên quan đến lĩnh vực chuyên môn của bộ môn; quản lý viên chức bộ môn, đào tạo bồi dưỡng cán bộ và tham gia quản lý học sinh thực tập tại các cơ sở y tế.</p>
                                <p><strong>II/</strong><strong>&nbsp;NHIỆM VỤ:</strong></p>
                                <p>
                                    - Tham gia xây dựng chương trình chi tiết môn học phù hợp cho từng đối tượng đào tạo. Tổ chức thực hiện quá trình đào tạo, kế hoạch giảng dạy, học tập và các hoạt động giáo dục khác theo Chương trình, kế hoạch giảng dạy
                                    chung của nhà trường;
                                </p>
                                <p>&nbsp; - Tổ chức biên soạn chương trình, giáo trình môn học, tài liệu giảng dạy lý thuyết, bảng kiểm thực hành và lượng giá học sinh - sinh viên. Đánh giá kết quả học tập của học sinh, sinh viên khách quan, chính xác</p>
                                <p>- Tổ chức tốt công tác giảng dạy đảm bảo thời lượng và chất lượng.</p>
                                <p>- Tổ chức nghiên cứu cải tiến phương pháp giảng dạy, học tập; đề xuất xây dựng kế hoạch bổ sung, bảo trì thiết bị dạy học, thực hành, thực tập và thực nghiệm khoa học.</p>
                                <p>-&nbsp;Xây dựng kế hoạch và tổ chức thực hiện việc đào tạo, bồi dưỡng nâng cao trình độ chuyên môn, nghiệp vụ cho giảng viên và cán bộ, nhân viên thuộc khoa quản lý.</p>
                                <p>- Các cán bộ trong khoa tích cực tham gia thực hiện đề tài Nghiên cứu khoa học, sáng kiến cải tiến;</p>
                                <p>- Quản lý giáo viên, cán bộ học sinh thuộc khoa theo phân cấp của Hiệu trưởng;</p>
                                <p>- Thực hiện các nhiệm vụ khác theo sự phân công của Hiệu trưởng</p>
                            </li>
                        </ul>
                        <p><br /></p>
                        <p>
                            <strong><span lang="VI">III/</span></strong><strong><span lang="VI">&nbsp;</span></strong><strong>CƠ CẤU TỔ CHỨC:</strong>
                        </p>
                        <p><strong>a/ Tổ bộ môn, Các môn học giảng dạy:</strong></p>
                        <p>- &nbsp; &nbsp; &nbsp; &nbsp; Bộ môn Nội</p>
                        <p>- &nbsp; &nbsp; &nbsp; &nbsp; Bộ môn Ngoại</p>
                        <p>- &nbsp; &nbsp; &nbsp; &nbsp; Bộ môn Sản</p>
                        <p>- &nbsp; &nbsp; &nbsp; &nbsp; Bộ môn Nhi</p>
                        <p>- &nbsp; &nbsp; &nbsp; &nbsp; Bộ môn chuyên khoa</p>
                        <p><strong>b/ Lãnh đạo:&nbsp;</strong>01 trưởng khoa và 1-2 phó khoa</p>
                        <p>
                            <strong><span lang="VI">IV/</span></strong><strong>&nbsp;QUYỀN HẠN TRƯỞNG</strong><strong><span lang="VI">&nbsp;KHOA:</span></strong>
                        </p>
                        <p>- &nbsp; &nbsp; &nbsp; &nbsp; Chủ trì giao ban hàng ngày và dự giao ban trường;</p>
                        <p>- &nbsp; &nbsp; &nbsp; &nbsp; Bố trí nhân lực cho phù hợp với công việc. Bố trí điều động giáo viên thực hiện công tác theo yêu cầu của Nhà trường;</p>
                        <p>- &nbsp; &nbsp; &nbsp; &nbsp; Ký duyệt đề kiểm tra, đề thi của các bộ môn, giáo viên trực thuộc;</p>
                        <p>- &nbsp; &nbsp; &nbsp; &nbsp; Ký các giấy tờ cho giáo viên, học sinh theo quy định, quy chế trường;</p>
                        <p>- &nbsp; &nbsp; &nbsp; &nbsp; Nhận xét các thành viên về tinh thần trách nhiệm, thái độ phục vụ, khả năng chuyên môn, báo cáo Hiệu trưởng xét đề bạt, đào tạo, nâng lương, khen thưởng, kỉ luật.</p>
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
