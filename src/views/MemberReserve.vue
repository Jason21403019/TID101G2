<template>
  <section>
    <h1>我的預約</h1>
    <ul class="title">
      <li>成立時間</li>
      <li>定位姓名</li>
      <li>預約時間</li>
      <li>人數</li>
      <li>備註</li>
    </ul>
    <ul class="orderInfo">
      <li>{{ establishedTime }}</li>
      <li>{{ orderName }}</li>
      <li>{{ orderTime }}</li>
      <li>{{ NumberOfPeople }}</li>
      <li>{{ Remark }}</li>
    </ul>
    <ul class="orderInfo">
      <li>{{ establishedTime }}</li>
      <li>{{ orderName }}</li>
      <li>{{ orderTime }}</li>
      <li>{{ NumberOfPeople }}</li>
      <li>{{ Remark }}</li>
    </ul>
  </section>
</template>

<script>
export default {
  data() {
    return {
      establishedTime: '2024/05/09',
      orderName: '張哲菘',
      orderTime: '2024/05/20 17:00',
      NumberOfPeople: '6人',
      Remark: '希望靠角落'
    }
  }
}
</script>

<style>
body {
  background-color: #381b1d;
  section {
    font-family: 'Noto Serif TC';
    font-weight: bold;
    font-size: 20px;
    height: 1000px;
    width: 80%;

    margin-left: auto;
    margin-right: 5%;
    h1 {
      color: #fcf0d8;
      font-size: 45px;
      margin-top: 8%;
      margin-bottom: 3%;
    }
    .title {
      display: flex;
      color: #f6f6f6;
      background-color: #cead82;
      li {
        width: 20%;
        padding: 1% 0;
        padding-left: 1%;
      }
    }
    .orderInfo {
      display: flex;
      background-color: #fcf0d8;
      margin-top: 2%;
      li {
        width: 20%;
        /* margin-top: 2%; */
        padding: 2% 0;
        padding-left: 1%;
      }
    }
  }
}
</style>
