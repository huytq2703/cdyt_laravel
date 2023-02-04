<script setup>
import { ref } from "vue";
import Sidebar from "primevue/sidebar";
import Button from "primevue/button";
import { Link } from "@inertiajs/inertia-vue3";

const menu = [
  {
    label: "Trang chủ",
    name: "home",
  },
  {
    label: "Giới thiệu",
    child: [
      {
        label: "Thông tin chung",
        name: "general_info",
      },
      {
        label: "Chức năng nhiệm vụ",
        name: "task_function",
      },
      {
        label: "Cơ cấu tổ chức",
        name: "organizational_structure",
      },
      {
        label: "Công khai chất lượng",
        name: "public_quality",
      },
    ],
  },
  {
    label: "Phòng khoa",
    child: [
      {
        label: "Phòng tổ chức hành chính",
        name: "administrative_affairs_room",
      },
      {
        label: "Phòng đào tạo",
        name: "training_room",
      },
      {
        label: "Phòng tài chính kế toán",
        name: "finance_accounting_room",
      },
      {
        label: "Phòng công tác HSSV",
        name: "student_affairs_room",
      },
      {
        label: "Phòng khảo thí và KĐCL",
        name: "examination_room",
      },
      {
        label: "Khoa cơ bản",
        name: "basic_department",
      },
      {
        label: "Khoa Y",
        name: "medical_department",
      },
      {
        label: "Khoa điều dưỡng",
        name: "nursing_department",
      },
      {
        label: "Khoa dược",
        name: "pharmacy_department",
      },
    ],
  },
  {
    label: "Hoạt động nội bộ",
    child: [
      {
        label: "Hoạt động đảng",
        name: "party_activities",
      },
      {
        label: "Hoạt động chuyên môn",
        name: "professional_activities",
      },
      {
        label: "Đoàn thanh niên",
        name: "youth_union",
      },
      {
        label: "Hoạt động công đoàn",
        name: "trade_union_activities",
      },
      {
        label: "Thi và tuyển sinh",
        name: "examinations_and_admissions",
      },
    ],
  },
];

const menuFullVisible = ref(false);
</script>

<template>
  <!-- Web menu -->
  <div class="md:flex container mx-auto hidden overflow-scroll hide-scroll">
    <div v-for="item in menu" class="" :key="item.label">
      <div v-if="item?.child" class="dropdown2">
        <button class="dropbtn flex align-items-center gap-2 nav-link white-space-nowrap">
          {{ item.label }}<i class="pi pi-caret-down"></i>
        </button>
        <div class="dropdown2-content">
          <Link
            v-for="subMenu in item.child"
            class="white-space-nowrap"
            :key="subMenu.label"
            :href="route(subMenu.name)"
          >
            {{ subMenu.label }}
          </Link>
        </div>
      </div>

      <Link
        v-else
        :href="route(item.name)"
        class="flex nav-link flex-nowrap white-space-nowrap"
        >{{ item.label }}</Link
      >
    </div>
  </div>

  <!-- Mobile menu -->
  <div class="md:hidden flex justify-content-end container mx-auto py-1">
    <Button
      class="p-button-text text-white p-0"
      @click="
        () => {
          menuFullVisible = true;
        }
      "
      ><i class="pi pi-align-justify" style="font-size: 1.5rem"></i
    ></Button>
  </div>

  <Sidebar v-model:visible="menuFullVisible" :baseZIndex="1000" position="full">
    <div v-for="item in menu" class="" :key="item.label">
      <div v-if="item?.child" class="mobile-dropdown">
        <button class="mobile-dropbtn flex align-items-center gap-2 font-bold">
          {{ item.label }}<i class="pi pi-caret-down"></i>
        </button>
        <div class="mobile-dropdown-content">
          <a
            v-for="subMenu in item.child"
            class="white-space-nowrap"
            :key="subMenu.label"
            :href="route(subMenu.name)"
          >
            {{ subMenu.label }}
          </a>
        </div>
      </div>

      <a href="" class="flex flex-nowrap white-space-nowrap font-bold mb-1">{{
        item.label
      }}</a>
    </div>
  </Sidebar>
</template>

<style lang="scss" scoped>
.nav-link {
  color: white;
  font-weight: bold;
  padding: 7px;
  &:hover {
    background-color: #b83234;
  }
}

/* Hide scrollbar for Chrome, Safari and Opera */
.hide-scroll::-webkit-scrollbar {
  display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.hide-scroll {
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none; /* Firefox */
}

.dropbtn,
.nav-link {
  color: white;
  font-size: 1rem;
  padding: 0.5rem;
  font-weight: bold;
  border: none;
  cursor: pointer;
  transition: all 0.2s ease;
}

.dropdown2 {
  //   position: relative;
  display: inline-block;
  transition: all 0.2s ease;

  &-content {
    display: none;
    position: absolute;
    background-color: #2a8b6c;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 99999;
    transition: all 0.2s ease;

    a {
      color: white;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }
    a:hover {
      background-color: #b83234;
    }
  }

  &:hover .dropdown2-content {
    display: block;
  }
}

.mobile {
  &-dropdown {
    //   position: relative;
    display: inline-block;
    transition: all 0.3s ease;
    width: 100%;

    &-content {
      display: block;
      width: 100%;
      max-height: 0px;
      overflow: hidden;
      z-index: 99999;
      transition: all 0.3s ease;

      a {
        // color: white;
        padding: 7px 16px;
        text-decoration: none;
        display: block;
        font-weight: bold;
      }
    }

    &:hover &-content {
      max-height: max-content;
    }
  }
}
</style>
