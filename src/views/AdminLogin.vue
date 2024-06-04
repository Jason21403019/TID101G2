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
                <input type="email" class="form-control" v-model="email" id="email" placeholder="請輸入電子郵件" />
              </div>
              <div class="form-group">
                <label for="password">密碼</label>
                <input type="password" class="form-control" v-model="password" id="password" placeholder="請輸入密碼" />
              </div>
              <button type="submit" class="btn btn-primary">登入</button>
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
      console.log('Email:', this.email)
      console.log('Password:', this.password)
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss'; 
.container {
  padding: 5px;
  font-size: $fontSize_h4;

  .text-center{
    font-size: $fontSize_h3;
  }
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
    color: $babypowder;
    border-bottom: none;
    border-radius: 10px 10px 0 0;
    padding: 10px;
  }
  label, .form-control{
    margin-bottom: 10px;
  }

  .btn-primary {
    background-color: $campari;
    border-color: $campari;
  }
}
</style>
