<template>
  <main>
    <MemberMenu />

    <section>
      <h1>我的預約</h1>
      <ul class="title">
        <li>成立時間</li>
        <li>訂位姓名</li>
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
      <section class="mobile">
        <ul class="orderInfoMobile">
          <li>成立時間:{{ establishedTime }}</li>
          <li>訂位姓名:{{ orderName }}</li>
          <li>預約時間:{{ orderTime }}</li>
          <li>人數:{{ NumberOfPeople }}</li>
          <li>備註:{{ Remark }}</li>
        </ul>
        <ul class="orderInfoMobile">
          <li>成立時間:{{ establishedTime }}</li>
          <li>訂位姓名:{{ orderName }}</li>
          <li>預約時間:{{ orderTime }}</li>
          <li>人數:{{ NumberOfPeople }}</li>
          <li>備註:{{ Remark }}</li>
        </ul>
      </section>
    </section>
  </main>
</template>

<script>
import MemberMenu from '../components/MemberMenu.vue'
export default {
  components: {
    MemberMenu
  },
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

<style lang="scss" scoped>
@mixin breakpoint($point) {
  @if $point == pc {
    @media (max-width: 1280px) {
      @content;
    }
  } @else if $point == mobile {
    @media (max-width: 768px) {
      @content;
    }
  }
}
body {
  main {
    padding-top: 100px;
    display: flex;
    background-color: $campari;
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
        margin-bottom: 3%;
      }

      .title {
        display: flex;
        color: #f6f6f6;
        background-color: #cead82;
        list-style-type: none;
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
        list-style-type: none;

        li {
          width: 20%;
          /* margin-top: 2%; */
          padding: 2% 0;
          padding-left: 1%;
          @include breakpoint(pc) {
            font-size: 11px;
          }
          @include breakpoint(mobile) {
            display: none;
          }
        }
      }
      // 手機板
      .mobile {
        height: 250px;
        display: flex;
        width: 100%;
        justify-content: space-around;
        .orderInfoMobile {
          display: none;
          width: 40%;
          @include breakpoint(mobile) {
            display: block;
          }
          background-color: #fcf0d8;
          margin-top: 2%;
          list-style-type: none;
          li {
            font-size: 17px;
          }
        }
      }
    }
  }
}
</style>
