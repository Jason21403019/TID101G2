<template>
  <AdminBreadcrumb :items="breadcrumbItems" />
  <!-- 標題 -->
  <div class="adminpanel">
    <h1 class="adminpanel-h1">{{ mainTitle }}</h1>
    <span class="adminpanel-pipe"> | </span>
    <h1 class="adminpanel-h1">{{ subTitle }}</h1>
  </div>

  <!-- 管理者資料 -->
  <section class="panelblock">
    <div class="row mb-3">
      <label for="nameInput" class="col-sm-1 col-form-label">姓名</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="nameInput">
      </div>
    </div>
    <div class="row mb-3">
      <label for="phoneInput" class="col-sm-1 col-form-label">電話</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="phoneInput">
      </div>
    </div>
    <div class="row mb-3">
      <label for="emailInput" class="col-sm-1 col-form-label">Email</label>
      <div class="col-sm-3">
        <input type="email" class="form-control" id="emailInput">
      </div>
    </div>
    <div class="row mb-3">
      <label for="positionInput" class="col-sm-1 col-form-label">職位</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="positionInput" placeholder="員工" disabled>
      </div>
    </div>

    <!-- 按鈕 -->
    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
      <admin-btn :handle-click="save">
        <template #text>儲存</template>
      </admin-btn>
    </div>
  </section>

</template>

<script>
import AdminBreadcrumb from '../components/AdminBreadcrumb.vue'
import AdminBtn from '../components/AdminBtn.vue'
import { variables } from '../js/AdminVariables.js'
export default {
  name: 'AdminPanel',
  components: {
    AdminBreadcrumb,
    AdminBtn
  },
  data() {
    return {
      mainTitle: variables.adminpanel.panel,
      subTitle: variables.adminpanel.profile,
      breadcrumbItems: [
        { text: '首頁', link: '/admin', active: false },
        { text: variables.adminpanel.panel, link: '', active: true },
        { text: variables.adminpanel.profile, link: '/admin_panel', active: false }
      ]
    }
  },
}
</script>


<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss'; 

.adminpanel {
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
.panelblock{
  margin-top: 80px;
  font-size: $fontSize_h4;
  color: $campari;

  .col-form-label{
    margin-left: 160px;
  }

  .d-grid{
    margin-top: 40px;
    margin-left: 160px;
  }
}
</style>