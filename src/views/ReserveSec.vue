<template>
  <div v-if="showPopup" class="popup" @click.self="showPopup = false">
    <div class="popup__content">
      <div class="order">
        <img src="../imgs/icon/icon_checkbox-w.svg" alt="" />
        <p>您已訂位成功</p>
      </div>

      <div class="place">
        <h3>紙醉金迷 台北總店</h3>
        <p>02-70638715</p>
        <p>地址：台北市中山區南京東路三段219號</p>
      </div>

      <div class="data">
        <p class="hello">{{ reservationData.name }} 先生/女士您好</p>
        <p class="hello">以下是您的訂位資訊</p>
        <p class="r_date">{{ formattedDate }}</p>
        <p class="r_time">{{ reservationData.time }}</p>
        <p class="r_guests">用餐人數 {{ reservationData.guests }} 位</p>

        <!-- <p>張哲菘先生您好</p>
            <p>以下是您的訂位資訊</p>
            <p>2024年6月11日 星期二</p>
            <p>12:00</p>
            <p>用餐人數12位</p> -->

        <button @click="cancelReservation">取消訂位</button>

        <div class="btn_text">
          <p>如需更改訂位資訊，或有其他訂位問題，請來電</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Swal from 'sweetalert2'
export default {
  data() {
    return {
      reservationData: {
        name: '',
        phone: '',
        guests: 1,
        date: '',
        time: '',
        note: ''
      },
      showPopup: true,
      memberId: ''
    }
  },
  computed: {
    formattedDate() {
      if (this.reservationData.date) {
        const options = { year: 'numeric', month: 'long', day: 'numeric', weekday: 'long' }

        return new Date(this.reservationData.date).toLocaleDateString('zh-TW', options)
      }

      return ''
    }
  },

  created() {
    // 從reservationData拿取資料

    const data = localStorage.getItem('reservationData')

    if (data) {
      // 將資料轉換為JSON(因為這是localstorage儲存的型態)
      this.reservationData = JSON.parse(data)
    }
  },
  methods: {
    cancelReservation() {
      this.showPopup = false
      // 这里可以添加取消逻辑，例如清空表单或发送取消请求

      // 调用 SweetAlert2 弹窗显示取消预约成功
      Swal.fire({
        icon: 'success',
        title: '取消預約成功',
        text: '您的預約已成功取消。',
        confirmButtonText: '確認'
      })

      // 新增跳轉回預約頁面
      this.$router.push('/reserve_first')
      this.fetchReserve()
    },
    // php
    fetchReserve() {
      // const memberId = 'm001' // 设置 memberId 变量为 'm001'

      // 构建带有查询字符串的 URL
      // const url = http://localhost/TID101G2sql/src/components/ProductCart.php?member_id=${encodeURIComponent(memberId)}
      fetch(`${import.meta.env.VITE_PHP_PATH}ReserveSecCancel.php`, {
        method: 'POST',

        body: JSON.stringify({
          booking_date: this.reservationData.date,
          booking_time: this.reservationData.date + ' ' + this.reservationData.time,
          guest_count: this.reservationData.guests,
          member_id: this.memberId
        })
      })
      // .then((response) => response.json())
      // .then((data) => {
      //   console.log('Insert successful:', data) // 輸出成功信息
      //   // 可以在這裡進行一些成功後的處理，如果有需要的話
      // })
      // .catch((error) => console.error('Error inserting data:', error))
    }
  },
  mounted() {
    // 获取存储在 localStorage 中的值，并赋给 memberId
    this.memberId = localStorage.getItem('isLoggedIn')
    console.log(this.memberId) // 输出 memberId，用于验证获取是否正确
  }
}
</script>

<style lang="scss" scoped>
.popup {
  padding: 50px;
  width: 50%;
  margin: 0 auto;
  margin-top: 100px;

  @include breakpoint(1280px) {
    width: 60%;
  }

  @include breakpoint(820px) {
    width: 80%;
  }

  @include breakpoint(540px) {
    width: 100%;
  }

  @include breakpoint(430px) {
    padding: 20px;
  }

  @include breakpoint(375px) {
    padding: 10px;
  }

  p {
    font-family: $fontfamily;
    color: $campari;
    //  text-align: center;
  }

  .popup__content {
    background-color: $ramos-gin-fizz;
    padding: 0 0 50px 0;

    @include breakpoint(430px) {
      padding: 0 0 30px 0;
    }

    .order {
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: $campari;
      border-bottom: 10px solid #fff;
      padding: 20px;

      @include breakpoint(430px) {
        padding: 10px;
      }

      img {
        width: 30px;
        height: 30px;
        margin-right: 5px;
      }

      p {
        line-height: 2;
        color: $ramos-gin-fizz;
        letter-spacing: $letterspacing;
        font-size: $fontSize_h4;
      }
    }
    .place {
      // outline: 1px solid palegreen;
      text-align: center;
      padding: 20px;

      @include breakpoint(430px) {
        padding: 10px;
      }

      h3 {
        font-size: $fontSize_h3;
        font-family: $fontfamily;
        color: $campari;
        margin-bottom: 10px;
      }

      p {
        font-size: $fontSize_h5;
        margin-bottom: 10px;

        @include breakpoint(430px) {
          margin-bottom: 0;
        }

        @include breakpoint(375px) {
          font-size: $fontSize_p;
        }
      }
    }

    .data {
      width: 80%;
      margin: 0 auto;
      border: 1px solid $irishcoffee;
      padding: 30px;
      text-align: center;

      @include breakpoint(430px) {
        padding: 10px;
      }

      @include breakpoint(375px) {
        width: 100%;
      }

      .hello {
        font-size: $fontSize_p;
        margin-bottom: 10px;

        @include breakpoint(430px) {
          font-size: $fontSize_p;
        }
      }

      .r_date {
        font-size: $fontSize_h3;
        margin-bottom: 30px;
        font-weight: bold;

        @include breakpoint(430px) {
          font-size: 1.5rem;
        }
      }

      .r_time {
        font-size: $fontSize_h1;
        color: rgb(248, 34, 34);
        margin-bottom: 30px;
        font-weight: bold;
      }

      .r_guests {
        font-size: $fontSize_p;
        margin-bottom: 30px;

        @include breakpoint(430px) {
          font-size: $fontSize_h4;
        }
      }

      button {
        width: 35%;
        color: $irishcoffee;
        font-size: $fontSize_h4;
        background-color: $ramos-gin-fizz;
        border: 1px solid $irishcoffee;
        border-radius: 5px;
        line-height: 2;
        margin-bottom: 30px;
        font-weight: bold;

        @include breakpoint(430px) {
          width: 40%;
        }
      }

      .btn_text {
        p {
          font-size: $fontSize_p;

          @include breakpoint(430px) {
            font-size: $fontSize_h5;
            line-height: 2;
          }
        }
      }
    }
  }
}
</style>
