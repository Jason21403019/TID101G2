<template>
  <nav class="navbar">
    <div class="container-fluid">
      <div :class="['d-flex', 'justify-content-start', { 'button-shifted': isExpanded }]">
        <a class="navbar-brand" @click="handleClick">
          <img src="../../imgs/icon/icon_hambur-w.svg" alt="" width="40" height="40" />
        </a>
      </div>

      <div class="btn-group d-flex justify-content-end">
        <button type="button" class="navbar-brand btn" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="../../imgs/icon/icon_admin-person-w.svg" alt="" width="40" height="40" />
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="#">個人資料</a></li>
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
    handleClick() {
      this.$emit('toggleSidebar');
    },
  },
};
</script>

<style lang="scss" scoped>
@import '../../../node_modules/bootstrap/scss/bootstrap.scss';
.navbar {
  background-color: $irishcoffee;
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
    }
  }
}
</style>
