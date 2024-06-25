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
import { ref } from 'vue';
import Swal from 'sweetalert2';
import { useRouter } from 'vue-router';

export default {
  name: 'CardForm',
  setup() {
    const cardNumber1 = ref('');
    const cardNumber2 = ref('');
    const cardNumber3 = ref('');
    const cardNumber4 = ref('');
    const cardName = ref('');
    const cardMonth = ref('');
    const cardYear = ref('');
    const cardCvv = ref('');
    const router = useRouter();

    const focusNext = (event, index) => {
      if (event.target.value.length === event.target.maxLength) {
        const nextInput = document.querySelectorAll('.card-number')[index];
        if (nextInput) {
          nextInput.focus();
        }
      }
    };

    const validateCardNumber = (cardNumber) => {
      const newCardNum = cardNumber.replace(/-/g, '');
      const sum = evenNum(newCardNum) + oddNum(newCardNum);
      let resultNum = sum % 10;
      if (resultNum !== 0) {
        resultNum = 10 - resultNum;
      }
      return resultNum === Number(newCardNum[15]);
    };

    const evenNum = (newCardNum) => {
      let sum = 0;
      for (let i = 1; i <= 13; i += 2) {
        let resultNum = Number(newCardNum[i]);
        sum += resultNum;
      }
      return sum;
    };

    const oddNum = (newCardNum) => {
      let sum = 0;
      for (let i = 0; i <= 15; i += 2) {
        let resultNum = Number(newCardNum[i]) * 2;
        if (resultNum >= 10) {
          resultNum -= 9;
        }
        sum += resultNum;
      }
      return sum;
    };

    const handleSubmit = () => {
      const cardNumber = `${cardNumber1.value}-${cardNumber2.value}-${cardNumber3.value}-${cardNumber4.value}`;
      if (
        cardNumber1.value &&
        cardNumber2.value &&
        cardNumber3.value &&
        cardNumber4.value &&
        cardName.value &&
        cardMonth.value &&
        cardYear.value &&
        cardCvv.value
      ) {
        if (!validateCardNumber(cardNumber)) {
          Swal.fire({
            title: '信用卡號碼無效',
            icon: 'error',
            confirmButtonText: '確定',
          });
        } else {
          submitOrder();
        }
      } else {
        Swal.fire({
          title: '請填寫所有欄位',
          icon: 'error',
          confirmButtonText: '確定',
        })
      }
    };

    const submitOrder = () => {
      Swal.fire({
        title: '付款處理中',
        html: '請稍候...',
        timer: 3000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
        }
      }).then(result => {
        if (result.dismiss === Swal.DismissReason.timer) {
          Swal.fire({
            title: '付款成功！',
            icon: 'success',
            confirmButtonText: '確定',
          }).then(() => {
            router.push('/ordercomplete');
          });
        }
      });
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
      handleSubmit,
    };
  },
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