<template>
  <nav class="navbar">
    <div class="container-fluid">
      <div class="d-flex justify-content-start">
        <a class="navbar-brand" href="#">
          <img src="../../imgs/logo/logo.png" alt="" width="80" height="80" />
        </a>
        <a class="navbar-brand" @click="$emit('toggleSidebar')">
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
  emits: ['toggleSidebar']
}
</script>

<style lang="scss" scoped>
.navbar {
  background-color: $irishcoffee;
  .navbar-brand {
    display: flex;
    align-items: center;
    margin-left: 90px;
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
      outline: none;
      box-shadow: none;
    }
  }
}
</style>
