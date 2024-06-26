<template>
  <AdminBreadcrumb :items="breadcrumbItems" />
  <div class="resblock">
    <h1 class="resblock-h1">{{ mainTitle }}</h1>
    <span class="resblock-pipe"> | </span>
    <h1 class="resblock-h1">{{ subTitle }}</h1>
  </div>
  <div>
    <admin-input input-id="formGroupExampleInput1">
      <template #label>查詢條件</template>
      <template #select>
        <select class="form-select" aria-label="Default select example">
          <option selected>會員編號</option>
        </select>
      </template>
    </admin-input>
    <div class="d-flex align-items-center">
      <admin-date-input start-date-id="dateInputField1" end-date-id="dateInputField2">
        <template #label>訂位日期</template>
        <template #info>(最多查詢100天)</template>
      </admin-date-input>
      <admin-btn :handle-click="search">
        <template #icon>
          <img src="../imgs/icon/icon_admin-search-w.svg" alt="searchIcon" height="20" width="20" />
        </template>
        <template #text>查詢</template>
      </admin-btn>
    </div>
  </div>

  <section v-if="reservations.length">
    <table class="table">
      <thead class="table-thead">
        <tr>
          <th scope="col">會員編號</th>
          <th scope="col">會員姓名</th>
          <th scope="col">會員電話</th>
          <th scope="col">Email</th>
          <th scope="col"></th>
          <th scope="col">用餐人數</th>
          <th scope="col">備註</th>
          <th scope="col">訂位時間</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="reservation in reservations" :key="reservation.id">
          <td>{{ reservation.member_id	 }}</td>
          <td>{{ reservation.full_name }}</td>
          <td>{{ reservation.phone }}</td>
          <td>{{ reservation.email }}</td>
          <td>{{ reservation.status }}</td>
          <td>{{ reservation.guest_count }}</td>
          <td>{{ reservation.booking_note }}</td>
          <td>{{ reservation.booking_time }}</td>
        </tr>
      </tbody>
      <caption>每頁列表顯示<span class="main__list-number">10</span>筆</caption>
    </table>
  </section>
  <div v-else>No reservations found.</div>
</template>

<script>
import axios from 'axios';
import AdminBreadcrumb from '../components/AdminBreadcrumb.vue';
import AdminBtn from '../components/AdminBtn.vue';
import AdminBulkBtn from '../components/AdminBulkBtn.vue';
import AdminDateInput from '../components/AdminDateInput.vue';
import AdminInput from '../components/AdminInput.vue';
import { variables } from '../js/AdminVariables.js';

export default {
  name: 'AdminRes',
  components: {
    AdminBreadcrumb,
    AdminInput,
    AdminDateInput,
    AdminBtn,
    AdminBulkBtn
  },
  data() {
    return {
      mainTitle: variables.resblock.reservation,
      subTitle: variables.resblock.bookingList,
      breadcrumbItems: [
        { text: '首頁', link: '/admin', active: false },
        { text: variables.resblock.reservation, link: '', active: true },
        { text: variables.resblock.bookingList, link: '/admin_res', active: false }
      ],
      reservations: []
    }
  },
  async mounted() {
    await this.fetchReservations();
  },
  methods: {
    async fetchReservations() {
      try {
        const response = await axios.get(`${import.meta.env.VITE_PHP_PATH}admin_res.php`);
        this.reservations = response.data;
      } catch (error) {
        console.error("獲取訂位資料時出錯：", error);
        this.reservations = []; // Ensure data consistency
      }
    }
  }
}
</script>
<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss'; // 確保這一行在最上面

.resblock {
  margin-top: 40px;
  margin-left: 160px;
  color: $campari;
  &-h1 {
    display: inline;
    font-size: $fontSize_h3;
  }
  &-pipe {
    font-size: $fontSize_h3;
    margin: 0 20px;
  }
}
.searchDay {
  font-size: $fontSize_p;
}
.d-grid {
  margin-top: 50px;
  margin-left: 160px;
}
.table {
  width: 85%;
  margin-top: 10px;
  margin-left: 160px;
  .table-thead {
    font-size: $fontSize_h4;
    th {
      background-color: $campari;
      color: $ramos-gin-fizz;
    }
  }
  #flexSwitchCheckChecked:checked {
    background-color: $toggle-on;
    border: solid $toggle-on;
  }
  .fa-solid.fa-pencil {
    color: $campari;
  }
}
.swal-form {
  // z-index: 3;
  .swal2-input {
    pointer-events: auto; /* 確保輸入框可以被點擊和輸入 */
    opacity: 1; /* 確保輸入框是可見的 */
  }
}
</style>
