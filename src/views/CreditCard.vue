<template>
  <div class="wrapper">
    <div class="form">
      <div class="card-input">
        <label>卡號</label>
        <div class="card-number-wrapper">
          <input
            type="text"
            v-model="cardNumber1"
            maxlength="4"
            class="card-number"
            @input="focusNext($event, 1)"
          />
          <span>-</span>
          <input
            type="text"
            v-model="cardNumber2"
            maxlength="4"
            class="card-number"
            @input="focusNext($event, 2)"
          />
          <span>-</span>
          <input
            type="text"
            v-model="cardNumber3"
            maxlength="4"
            class="card-number"
            @input="focusNext($event, 3)"
          />
          <span>-</span>
          <input
            type="text"
            v-model="cardNumber4"
            maxlength="4"
            class="card-number"
            @input="focusNext($event, 4)"
          />
        </div>
      </div>
      <div class="card-input">
        <label>持卡人姓名</label>
        <input type="text" v-model="cardName" id="cardName" />
      </div>
      <div class="card-input">
        <label for="cardMonth">到期月份</label>
        <select v-model="cardMonth" id="cardMonth">
          <option value="" disabled selected>月份</option>
          <option value="01">01</option>
          <option value="02">02</option>
          <option value="03">03</option>
          <option value="04">04</option>
          <option value="05">05</option>
          <option value="06">06</option>
          <option value="07">07</option>
          <option value="08">08</option>
          <option value="09">09</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
        </select>
      </div>
      <div class="card-input">
        <label for="cardYear">到期年份</label>
        <select v-model="cardYear" class="card-input__select" id="cardYear">
          <option value="" disabled selected>年份</option>
          <option value="2024">2024</option>
          <option value="2025">2025</option>
          <option value="2026">2026</option>
          <option value="2027">2027</option>
          <option value="2028">2028</option>
          <option value="2029">2029</option>
          <option value="2030">2030</option>
          <option value="2031">2031</option>
        </select>
      </div>
      <div class="card-input">
        <label for="cardCvv">CVV</label>
        <input type="text" v-model="cardCvv" id="cardCvv" maxlength="4" />
      </div>
      <button @click="handleSubmit">提交</button>
    </div>
  </div>
</template>

<script>
import { ref, onBeforeUnmount } from 'vue';
import Swal from 'sweetalert2';
import axios from 'axios';
import { useRouter } from 'vue-router';

export default {
name: 'CreditCard',
setup() {
  const router = useRouter();
  const cardNumber1 = ref('');
  const cardNumber2 = ref('');
  const cardNumber3 = ref('');
  const cardNumber4 = ref('');
  const cardName = ref('');
  const cardMonth = ref('');
  const cardYear = ref('');
  const cardCvv = ref('');

  const validateCardNumber = (cardNumber) => {
  const newCardNum = cardNumber.replace(/-/g, '');  // 移除卡號中的分隔符
  let sum = 0;
  const nDigits = newCardNum.length;
  const parity = nDigits % 2;  // 根據卡號長度計算奇偶性

  for (let i = 0; i < nDigits; i++) {
    let digit = parseInt(newCardNum[i]);
    if (i % 2 == parity) {  // 奇數位置或偶數位置的判定需要根據卡號長度的奇偶性決定
      digit = digit * 2;
      if (digit > 9) {
        digit -= 9;
      }
    }
    sum += digit;
  }

  return sum % 10 == 0;
  };


  // 创建一个 Axios Cancel Token
  const axiosCancelSource = axios.CancelToken.source();

  const focusNext = (event, index) => {
    if (event.target.value.length === event.target.maxLength) {
      const nextInput = document.querySelectorAll('.card-number')[index];
      if (nextInput) {
        nextInput.focus();
      }
    }
  };

  // 确保在组件卸载前取消所有正在进行的请求
  onBeforeUnmount(() => {
    axiosCancelSource.cancel('Component unmounting: Request canceled.');
  });

  const handleSubmit = async () => {
    const cardNumber = `${cardNumber1.value}-${cardNumber2.value}-${cardNumber3.value}-${cardNumber4.value}`;
    if (cardName.value && cardMonth.value && cardYear.value && cardCvv.value && cardNumber) {
      if (validateCardNumber(cardNumber)) {
        const shippingInfo = JSON.parse(localStorage.getItem('shippingInfo'));
        const cartSummary = JSON.parse(localStorage.getItem('cartSummary'));
        const memberId = localStorage.getItem('isLoggedIn');
        const orderData = {
        receiver: shippingInfo?.shipName,
        receiver_phone: shippingInfo?.shipPhone,
        receiver_address: shippingInfo?. shipAddress,
        receiver_email: shippingInfo?.shipEmail,
        note: shippingInfo?.note,
        subtotal: cartSummary?.subtotal,
        shipping_fee: cartSummary?.shipping_fee,
        discount: cartSummary?.discount,
        total_amount: cartSummary?.total,
        payment_status: "已付款", 
        payment_method: "信用卡",
        status: "未處理",
        id:"",
        order_date:"",
        
        member_id: localStorage.getItem('isLoggedIn'),
        delivery_method:"宅配",
        delivery_status:"未取貨",
        };
        


        try {
          // const response = await axios.post(`http://localhost/TID101G2/public/api/submitOrder.php`, orderData, {

          const response = await axios.post(`${import.meta.env.VITE_PHP_PATH}SubmitOrder.php`, orderData, {
          // const response = await axios.post('http://localhost:8087/TID101G2/public/api/submitOrder.php', orderData, {
            cancelToken: axiosCancelSource.token // 使用 cancel token
          });
          if (response.data.success) {
            Swal.fire('付款成功！', '', 'success').then(() => {
              router.push('/ordercomplete');
              localStorage.removeItem('shippingInfo'); // 僅清除特定資料
              localStorage.removeItem('cartSummary'); // 清除 localStorage 中的数据
            });
          } else {
            throw new Error(response.data.message);
          }
        } catch (error) {
          if (axios.isCancel(error)) {
            console.log('Request canceled:', error.message);
          } else {
            Swal.fire('支付錯誤', error.message, 'error');
          }
        }
      } else {
        Swal.fire('無效的信用卡號碼', '', 'error');
      }
    } else {
      Swal.fire('欄位不可為空', '', 'error');
    }
  };

  return {
    cardNumber1,
    cardNumber2,
    cardNumber3,
    cardNumber4,
    cardName,
    cardMonth,
    cardYear,
    cardCvv,
    focusNext,
    handleSubmit
  };
}
};
</script>


<style lang="scss" scoped>

.wrapper {
  padding: 50px;

  .form {
      max-width: 400px;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      margin: 30px 0 30px 0;

      margin: 0 auto;

      input{
      
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;

      }

      .card-number-wrapper{
          display: flex;
          align-items: baseline;
          // justify-content: center;

          input{
              width: 25%;
          }
      }

      label{

          display: block;
          margin-bottom: 5px;
          font-weight: bold;

      }

      select{
          width: 100%;
          padding: 10px;
          margin-bottom: 20px;
          border: 1px solid #ccc;
          border-radius: 5px;
          box-sizing: border-box;
      }

      button{

          width: 100%;
          padding: 10px;
          background-color: #007bff;
          color: white;
          border: none;
          border-radius: 5px;
          cursor: pointer;
          font-size: 16px;

      }

      }
  }   





</style>