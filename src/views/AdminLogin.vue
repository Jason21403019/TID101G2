<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mt-5">
          <div class="card-header">
            <h3 class="text-center">後台登入</h3>
          </div>
          <div class="card-body">
            <form @submit.prevent="handleSubmit">
              <div class="form-group">
                <label for="email">電子郵件</label>
                <input type="email" class="form-control" v-model="email" id="email" placeholder="請輸入電子郵件">
              </div>
              <div class="form-group">
                <label for="password">密碼</label>
                <input type="password" class="form-control" v-model="password" id="password" placeholder="請輸入密碼">
              </div>
              <button type="submit" class="btn btn-primary btn-block">登入</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AdminLogin',
  data() {
    return {
      email: '',
      password: ''
    }
  },
  methods: {
    handleSubmit() {
      // 處理登入邏輯
      console.log('Email:', this.email);
      console.log('Password:', this.password);
    }
  }
}
</script>

<style lang="scss" scoped>


  div[data-v-f2aac0b3]{
    padding: 10px;
    body {
      background-color: $babypowder;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .card {
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card-header {
      background-color: $irishcoffee;
      color: #fff;
      border-bottom: none;
      border-radius: 10px 10px 0 0;
      padding: 10px;
    }
    .btn-primary {
      background-color: $campari;
      border-color: $campari;
    }
  }
</style>
