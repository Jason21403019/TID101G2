<template>
  <nav class="navbar">
    <div class="container-fluid">
      <div :class="['d-flex', 'justify-content-start', { 'button-shifted': isExpanded }]">
        <a class="navbar-brand" @click="handleClick">
          <img src="../../imgs/icon/icon_hambur-w.svg" alt="固定導覽列" width="40" height="40" />
        </a>
      </div>

      <div class="btn-group d-flex justify-content-end">
        <button type="button" class="navbar-brand btn" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="../../imgs/icon/icon_admin-person-w.svg" alt="管理者面板" width="40" height="40" />
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><router-link class="dropdown-item" to="/admin_panel">個人資料</router-link></li>
          <li><a class="dropdown-item" href="#">登出</a></li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'AdminHeader',
  props: {
    isExpanded: {
      type: Boolean,
      required: true,
    },
  },
  methods: {
    handleClick(event) {
      this.$emit('toggleSidebar');
      event.target.blur(); // 移除焦點
    },
  },
};
</script>

<style lang="scss" scoped>
@import '../../../node_modules/bootstrap/scss/bootstrap.scss';
.navbar {
  background-color: $irishcoffee;
  position: fixed;
  top: 0;
  width: 100%;
  .button-shifted {
    transform: translateX(200px); /* 向右移動200px，根據需要調整位移量 */
    transition: transform 0.3s ease;
  }
  .d-flex.justify-content-start {
    transition: transform 0.3s ease;
  }

  .navbar-brand {
    display: flex;
    align-items: center;
    margin-left: 80px;
    img {
      font-size: $fontSize_h2;
      background-color: $irishcoffee;
      color: $babypowder;
      border: none;
      &:hover {
        cursor: pointer;
      }
    }
    &:focus {
      border: none;
      box-shadow: none;
      outline: none;
    }
  }
  .dropdown-menu{
    background-color: $ramos-gin-fizz;
    .dropdown-item {
      background-color: $ramos-gin-fizz;
      color: $campari;
      &:hover {
        background-color: $campari;
        color: $ramos-gin-fizz;
      }
    }
  }
  
  .btn-group > 
  .btn[data-v-b6c4c226]:not(:last-child):not(.dropdown-toggle), 
  .btn-group > .btn.dropdown-toggle-split[data-v-b6c4c226]:first-child, 
  .btn-group > .btn-group:not(:last-child) > .btn[data-v-b6c4c226] {
      border: none !important;
  }
}
</style>
