<template>
  <div class="container">
    <main class="grid">
      <article>
        <div class="text">
          <p><strong>預約編號:</strong> {{ id }}</p>
          <p><strong>訂位姓名:</strong> {{ name }}</p>
          <p><strong>預約日期:</strong> {{ booking_date }}</p>
          <p><strong>預約時間:</strong> {{ booking_time }}</p>
          <p><strong>人數:</strong> {{ guest_count }}</p>
          <p><strong>備註:</strong> {{ bookingNote }}</p>

          <!-- 根據配送狀態 來判斷該出現的按鈕 delivery_status:已完成>完成訂單或是退換貨｜ status:未處理>取消訂單-->
        </div>
      </article>
    </main>
  </div>
</template>

<script>
export default {
  name: 'MemberOrderCard',

  props: {
    id: {
      required: true
    },
    name: {
      required: true
    },
    booking_date: {
      required: true
    },
    booking_time: {
      required: true
    },
    guest_count: {
      required: true
    },
    bookingNote: {
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>
// .grid {
//   display: grid;
//   grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
//   grid-template-rows: repeat(auto-fill, 250px);
//   grid-gap: 20px;
//   align-items: stretch;
//   padding-right: 20px;

// }

.grid > article {
  border: 1px solid $ramos-gin-fizz;
  box-shadow: 2px 2px 6px 0px rgba(0, 0, 0, 0.3);
  background-color: $ramos-gin-fizz;
  border-radius: 8px;
  transition: 0.3s;
}
.grid > article:hover {
  transform: scale(1.05, 1.05);
  box-shadow: 2px 2px 6px 0px rgba(84, 2, 2, 0.3);
}

.grid .text {
  padding: 20px;
  color: $blackvevet;
  font-family: $fontfamily;
  font-weight: bold;
  line-height: $lineheight;
  letter-spacing: $letterspacing - 0.175rem;
}
</style>
