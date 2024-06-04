<template>
  <body class="ral__wrapper">
    <div class="ral__container">
      <div class="ral__btns">
        <button class="ral__btns-btn ral__container-registerbtn">註冊</button>
        <button class="ral__btns-btn ral__container-loginbtn">登入</button>
      </div>
      <div class="register__container">
        <div class="register__container-name">
          <label for="name">姓名</label>
          <input id="name" type="text" placeholder="請輸入姓名" />
        </div>
        <div class="register__container-phone">
          <label for="phone">電話</label>
          <input id="phone" type="text" placeholder="請輸入電話" />
        </div>
      </div>
    </div>
  </body>
</template>

<script>
export default {
  name: 'RegisterAndLogin'
}
</script>

<style lang="scss" scoped>
.ral__wrapper {
  padding-top: 100px;
  background: rgba($color: $ramos-gin-fizz, $alpha: 0.5);
  .ral__container {
    border: 1px solid red;
    width: 50%;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
    .ral__btns {
      display: flex;
      justify-content: space-evenly;

      &-btn {
        outline: none;
        border: none;
        width: 320px;
        margin: 0.25rem;
        line-height: 70px;
        background: $irishcoffee;
        color: $babypowder;
        font-size: $fontSize_h3;
        font-family: $fontfamily;
        @include border-radius(8px);
        cursor: pointer;
      }
    }
    &-registerbtn {
    }
    &-loginbtn {
      border: 1px solid red;
    }
    .register__container {
      border: 1px solid green;
      display: flex;
      flex-direction: column;
      &-name,
      &-phone {
        display: flex;
        flex-direction: column;
        label {
          font-size: $fontSize_h3;
          font-family: $fontfamily;
          padding-bottom: 0.5rem;
        }
        input {
          width: 300px;
          height: 30px;
          font-size: $fontSize_h3;
          font-family: $fontfamily;
        }
        border: 1px solid red;
      }
    }
  }
}
</style>
