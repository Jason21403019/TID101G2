<template>
  <section>
    <div class="wrapper">
      <!-- banner -->
      <div class="banner mx-auto">
        <h1 class="title text-center text-white">F&Q</h1>
      </div>

      <div class="container">
        <div class="box col-xxl-12 fs-1 mt-5">
          <p class="mt-3 ms-2">購物流程說明</p>

          <div id="accordionFlushExample1" class="accordion accordion-flush">
            <div
              v-for="(item, index) in shoppingItems"
              :key="index"
              class="accordion-item bg-transparent"
              style="color: #fcf0d8"
            >
              <h2 :id="'flush-heading-shopping-' + index" class="accordion-header">
                <button
                  class="accordion-button collapsed fs-4 bg-transparent border-0"
                  style="color: #fcf0d8"
                  type="button"
                  data-bs-toggle="collapse"
                  :data-bs-target="'#flush-collapse-shopping-' + index"
                  aria-expanded="false"
                  :aria-controls="'flush-collapse-shopping-' + index"
                  @click="toggleIcon(index, 'shopping')"
                >
                  <i :class="item.isPlusIcon ? 'bi bi-plus fs-2' : 'bi bi-dash fs-2'"></i> {{ item.title }}
                </button>
              </h2>
              <div
                :id="'flush-collapse-shopping-' + index"
                class="accordion-collapse collapse"
                :aria-labelledby="'flush-heading-shopping-' + index"
                data-bs-parent="#accordionFlushExample1"
              >
                <div class="accordion-body fs-5">
                  {{ item.content }}
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="box col-xxl-12 fs-1 mt-5">
          <p class="mt-3 ms-2">付款問題</p>

          <div id="accordionFlushExample2" class="accordion accordion-flush">
            <div
              v-for="(item, index) in paymentItems"
              :key="index"
              class="accordion-item bg-transparent"
              style="color: #fcf0d8"
            >
              <h2 :id="'flush-heading-payment-' + index" class="accordion-header">
                <button
                  class="accordion-button collapsed fs-4 bg-transparent border-0"
                  style="color: #fcf0d8"
                  type="button"
                  data-bs-toggle="collapse"
                  :data-bs-target="'#flush-collapse-payment-' + index"
                  aria-expanded="false"
                  :aria-controls="'flush-collapse-payment-' + index"
                  @click="toggleIcon(index, 'payment')"
                >
                  <i :class="item.isPlusIcon ? 'bi bi-plus fs-2' : 'bi bi-dash fs-2'"></i> {{ item.title }}
                </button>
              </h2>
              <div
                :id="'flush-collapse-payment-' + index"
                class="accordion-collapse collapse"
                :aria-labelledby="'flush-heading-payment-' + index"
                data-bs-parent="#accordionFlushExample2"
              >
                <div class="accordion-body fs-5">
                  {{ item.content }}
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="box col-xxl-12 fs-1 mt-5">
          <p class="mt-3 ms-2">配送和運費問題</p>

          <div id="accordionFlushExample3" class="accordion accordion-flush">
            <div v-for="(item, index) in shipItems" :key="index" class="accordion-item bg-transparent" style="color: #fcf0d8">
              <h2 :id="'flush-heading-shipping-' + index" class="accordion-header">
                <button
                  class="accordion-button collapsed fs-4 bg-transparent border-0"
                  style="color: #fcf0d8"
                  type="button"
                  data-bs-toggle="collapse"
                  :data-bs-target="'#flush-collapse-shipping-' + index"
                  aria-expanded="false"
                  :aria-controls="'flush-collapse-shipping-' + index"
                  @click="toggleIcon(index, 'shipping')"
                >
                  <i :class="item.isPlusIcon ? 'bi bi-plus fs-2' : 'bi bi-dash fs-2'"></i> {{ item.title }}
                </button>
              </h2>
              <div
                :id="'flush-collapse-shipping-' + index"
                class="accordion-collapse collapse"
                :aria-labelledby="'flush-heading-shipping-' + index"
                data-bs-parent="#accordionFlushExample3"
              >
                <div class="accordion-body fs-5">
                  {{ item.content }}
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="box col-xxl-12 fs-1 mt-5">
          <p class="mt-3 ms-2">會員制度說明</p>

          <div id="accordionFlushExample4" class="accordion accordion-flush">
            <div v-for="(item, index) in memberItems" :key="index" class="accordion-item bg-transparent" style="color: #fcf0d8">
              <h2 :id="'flush-heading-member-' + index" class="accordion-header">
                <button
                  class="accordion-button collapsed fs-4 bg-transparent border-0"
                  style="color: #fcf0d8"
                  type="button"
                  data-bs-toggle="collapse"
                  :data-bs-target="'#flush-collapse-member-' + index"
                  aria-expanded="false"
                  :aria-controls="'flush-collapse-member-' + index"
                  @click="toggleIcon(index, 'member')"
                >
                  <i :class="item.isPlusIcon ? 'bi bi-plus fs-2' : 'bi bi-dash fs-2'"></i> {{ item.title }}
                </button>
              </h2>
              <div
                :id="'flush-collapse-member-' + index"
                class="accordion-collapse collapse"
                :aria-labelledby="'flush-heading-member-' + index"
                data-bs-parent="#accordionFlushExample4"
              >
                <div class="accordion-body fs-5">
                  {{ item.content }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'Questions',
  data() {
    return {
      shoppingItems: [
        {
          title: '如何查看我的訂單狀態?',
          content: '您可以在我們的網站上登入您的帳戶，然後在「訂單歷史」部分查看您的訂單狀態。',
          isPlusIcon: true
        },
        {
          title: '我可以取消已下的訂單嗎？',
          content: '是的，您可以在訂單處理前取消訂單。請登入您的帳戶並聯絡我們，我們將協助您取消訂單。',
          isPlusIcon: true
        },
        {
          title: '為什麼我的訂單被取消了？',
          content: '訂單可能因為庫存不足、付款問題或其他原因被取消。如有任何疑問，請聯絡我們。',
          isPlusIcon: true
        }
      ],
      paymentItems: [
        {
          title: '有哪些付款方式可供選擇?',
          content: '我們目前只接受信用卡支付，',
          isPlusIcon: true
        },
        {
          title: '是否提供分期付款?',
          content: '目前我們不提供分期付款服務。',
          isPlusIcon: true
        },
        {
          title: '付款失敗怎麼辦?',
          content: '請檢查您的支付信息是否正確，或者聯繫您的銀行。',
          isPlusIcon: true
        }
      ],
      shipItems: [
        {
          title: '我們提供免費運送嗎?',
          content: '本店和黑貓宅急便合作，運費固定為$250，店內不定時推出活動，有機會可以領取免運券喔!',
          isPlusIcon: true
        },
        {
          title: '是否提供國際運送的選項?',
          content: '是的，我們提供國際運送服務，費用和交貨時間會根據目的地不同而有所不同。',
          isPlusIcon: true
        },
        {
          title: '當天下單，大概多久可以到貨?',
          content: '雙北地區，當天14:00前下單，隔天到貨。其他地區，需三至七天。',
          isPlusIcon: true
        }
      ],
      memberItems: [
        {
          title: '如何加入會員?',
          content: '在本店消費達一次，即可加入會員!',
          isPlusIcon: true
        },
        {
          title: '忘記我的密碼，該怎麼辦?',
          content: '請在會員登入頁面點選 「忘記密碼」，提供您的電子信箱，我們將會寄送驗證信給您。',
          isPlusIcon: true
        },
        {
          title: '優惠券有使用期限嗎?需要多久時間內用完?',
          content: '自優惠券歸戶起一個月內，需使用完畢，一張優惠券可以使用一次。',
          isPlusIcon: true
        }
      ]
    }
  },
  methods: {
    toggleIcon(index, type) {
      if (type === 'shopping') {
        this.shoppingItems[index].isPlusIcon = !this.shoppingItems[index].isPlusIcon
      } else if (type === 'payment') {
        this.paymentItems[index].isPlusIcon = !this.paymentItems[index].isPlusIcon
      } else if (type === 'shipping') {
        this.shipItems[index].isPlusIcon = !this.shipItems[index].isPlusIcon
      } else if (type === 'member') {
        this.memberItems[index].isPlusIcon = !this.memberItems[index].isPlusIcon
      }
    }
  }
}
</script>

<style lang="scss" scoped>
// @import '.';
section {
  background: $negroni;
  .wrapper {
    border: 1px solid blue;
    width: 88.89%;
    margin: 0 auto;
    height: 100%;
    // margin: 0; /* 移除預設邊距 */
    .banner {
      width: 67.3%;
      width: 100%;
      height: 600px;
      // border: 1px solid yellow;
      overflow: hidden;
      margin-top: 100px;
      background: url('../imgs/QAImg/close-up-delicious-drinks.jpg');
      .title {
        // border: 1px solid blue;
        margin-top: 250px;
        // color: $irishcoffee !important;
        text-shadow: 5px 5px 5px #000000;
        font-size: 5rem;
        letter-spacing: 20px;
        font-weight: bold;
      }
    }
    .container {
      width: 100%;
      margin: 0 auto;
    }
  }
  .box {
    border: 1px solid $ramos-gin-fizz;
    border-radius: 8px;
    width: 100%;
    p {
      color: $ramos-gin-fizz;
    }

    .accordion {
      --bs-accordion-btn-focus-box-shadow: none !important;
    }
    .accordion-button::after {
      display: none;
    }

    button {
      background-color: transparent;
    }
  }
}
</style>
