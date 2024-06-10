<template>
  <h1>我的優惠券</h1>
  <section>
    <article>
      <img src="../imgs/voucherImg/free.png" alt="" />
      <ul class="couponInfo">
        <li class="title">{{ coupon1.conponName }}</li>
        <li>有效日期:{{ coupon1.Time }}</li>
        <li>代碼:{{ coupon1.code }}</li>
      </ul>
    </article>
    <article>
      <img src="../imgs/voucherImg/sale.png" alt="" />
      <ul class="couponInfo">
        <li class="title">{{ coupon2.conponName }}</li>
        <li>{{ coupon2.info }}</li>
        <li>有效日期:{{ coupon2.Time }}</li>
        <li>代碼:{{ coupon2.code }}</li>
      </ul>
    </article>
    <article>
      <img src="../imgs/voucherImg/sale.png" alt="" />
      <ul class="couponInfo">
        <li class="title">{{ coupon2.conponName }}</li>
        <li>{{ coupon2.info }}</li>
        <li>有效日期:{{ coupon2.Time }}</li>
        <li>代碼:{{ coupon2.code }}</li>
        <li class="invalid">{{ Invalid }}</li>
      </ul>
    </article>
    <article>
      <img src="../imgs/voucherImg/sale.png" alt="" />
      <ul class="couponInfo">
        <li class="title">{{ coupon2.conponName }}</li>
        <li>{{ coupon2.info }}</li>
        <li>有效日期:{{ coupon2.Time }}</li>
        <li>代碼:{{ coupon2.code }}</li>
        <li class="Use">{{ use }}</li>
      </ul>
    </article>
  </section>
</template>

<script>
export default {
  data() {
    return {
      use: '已使用',
      Invalid: '已失效',
      coupon1: {
        conponName: '貼心免運券',
        Time: '2024.06.09',
        code: 'WS24T00',
        img: 'src/imgs/voucherImg/free.png'
      },
      coupon2: {
        conponName: '註冊折扣券',
        info: '折抵$4000，消費滿$60000可使用',
        Time: '2024.06.09',
        code: 'WS24T03',
        img: 'src/imgs/voucherImg/free.png'
      }
    }
  }
}
</script>

<style>
body {
  background-color: #381b1d;
  h1 {
    color: #fcf0d8;
    font-size: 45px;
    margin-top: 8%;
    margin-bottom: 3%;
    margin-left: auto;
    width: 80%;
  }
  section {
    font-family: 'Noto Serif TC';
    font-weight: bold;
    font-size: 20px;
    margin-bottom: 30%;
    width: 75%;
    background-color: #fcf0d8;
    padding: 3% 2%;
    margin-left: auto;
    margin-right: 8%;
    display: flex;
    flex-wrap: wrap;
    article {
      border: 1px solid black;
      border-radius: 5px;
      background-color: #f6f6f6;
      display: flex;
      width: 38%;
      margin: 1% 1%;
      img {
        display: block;
        padding: 1% 1%;
      }
      .couponInfo {
        display: flex;
        flex-direction: column;
        width: 100%;
        li {
          /* margin-top: 2%; */
          padding: 2% 0;
          font-size: 11px;
        }
        .title {
          font-size: 32px;
        }
        .invalid {
          font-size: 30px;
          color: red;
          margin-left: auto;
          margin-top: -13%;
        }
        .Use {
          font-size: 30px;
          color: red;
          margin-left: auto;
          margin-top: -13%;
        }
      }
    }
  }
}
</style>
