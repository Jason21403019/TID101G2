<template>
  <div class="result-wrapper">
    <img src="../imgs/logo/logo-w.png" class="logo" alt="Logo" />
    <h1>最適合您的調酒</h1>
    <div class="result" v-if="result">
      <img :src="resultImage" alt="Result Image" />
      <div class="result-text">
        <h2>{{ resultTitle }}</h2>
        <p>{{ resultText }}</p>
        <button @click="login">領取優惠卷</button>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.result-wrapper {
  text-align: center;
  width: 100%;
  height: auto;
  display: flex;
  align-items: center;
  justify-content: center;
  background-image: url('../imgs/quizGameImg/productsImg_bg.jpg');
  background-size: cover;
  background-position: center;
  flex-direction: column;
  padding: 100px 0;
}


.logo {
  position: absolute;
  top: 20px;
  left: 20px;
  width: 100px; /* 稍微調整Logo大小 */
  height: auto;
}

.result {
  display: flex;
  width: 76%;
  flex-direction: column;
  align-items: center;
}

img {
  width: 50vw;
  max-width: 400px;
}

.result-text {
  text-align: center;
}

h1 {
  font-size: $fontSize_h3;
  color: $whitelady;
  margin: 10px;
  line-height: $lineheight-en;
  letter-spacing: $letterspacing;
}

h2 {
  font-size: $fontSize_h3;
  color: $whitelady;
  font-family: $fontfamily-en2;
  margin-bottom: 10px;
  line-height: $lineheight-en;
  letter-spacing: $letterspacing;
}

p {
  font-size: 1.2em;
  color: #eeeeee;
  margin-bottom: 50px;
  line-height: 1.5;
}

button {
  background: $blackvevet;
  padding: 10px 2rem;
  outline: 2.5px solid #12110e;
  outline-offset: 3px;
  border: 0;
  color: rgb(249, 248, 248);
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  font-size: 1rem;
  border-radius: 100rem;
  transition: 0.4s;
  font-weight: 600;
}

button:hover {
  outline-offset: 4.5px;
  background: $irishcoffee;
  font-size: 1.1rem;
}
</style>

<script>
export default {
  data() {
    return {
      userAnswers: [],
      result: null,
      resultTitle: '',
      resultImage: '',
      resultText: ''
    }
  },
  async created() {
    this.userAnswers = this.parseQuery(this.$route.query.answers);
    this.result = this.$route.query.result || null;

    if (this.result) {
      await this.setResultContent();
    }
  },
  methods: {
    parseQuery(query) {
      if (query) {
        return query.split(',');
      }
      return [];
    },

    async setResultContent() {
      const contentMap = {
        '歡樂與愉悅': {
          title: 'Whiskey Sour',
          image: new URL('../imgs/quizGameImg/Whiskey Sour.png', import.meta.url).href,
          text: 'Whiskey Sour這款的口感是層次豐富的。你可以在一口喝下之後感受到各種風味的變化，從威士忌的強烈到檸檬的清新酸感，再到糖的甜感，最後是蛋白帶來的獨特口感。這是一種相當享受口感變化的調酒，對於許多喜歡烈酒和酸味飲品的人來說，會是一個很好的選擇。'
        },
        '放鬆與舒適': {
          title: 'Mojito',
          image: new URL('../imgs/quizGameImg/mojito.png', import.meta.url).href,
          text: '這款雞尾酒不僅帶有清爽的口感，還散發著迷人的薄荷芳香，非常適合那些喜愛探索各種調酒風格並對飲品品質有高要求的人。他們可能特別熱愛夏天的清涼感，因此這款雞尾酒是在炎熱的夏季，無論是在海邊度假，還是繁忙的一天後放鬆身心，都能帶來極大的愉悅。'
        },
        '浪漫與優雅': {
          title: 'Negroni',
          image: new URL('../imgs/quizGameImg/Negroni.png', import.meta.url).href,
          text: '這款雞尾酒以其強烈且獨特的風味著稱，特別適合那些已有品嚐酒精飲料經驗的成熟人士。Negroni的苦味與獨特風采，為其愛好者帶來不可多得的品飲享受。對於初次接觸雞尾酒的人來說，Negroni則可能是一段截然不同的味蕾之旅。每一口都充滿複雜且深邃的層次，讓人不禁想細細品味，回味無窮。'
        },
        '溫暖與舒心': {
          title: 'Sazerac',
          image: new URL('../imgs/quizGameImg/Sazerac.png', import.meta.url).href,
          text: '這款雞尾酒的風味層次豐富，讓人一口接一口地品味。初入口時，你會首先感受到黑麥威士忌或白蘭地那深厚醇美的味道，隨後苦艾酒的苦澀與甜味悄然交織，既平衡又引人入勝。最終，一絲檸檬的酸甜恰到好處地閃現，為整體風味帶來一點細膩的變化。'
        }
      };

      const content = contentMap[this.result];
      if (content) {
        this.resultTitle = content.title;
        this.resultImage = content.image;
        this.resultText = content.text;
      } else {
        console.error('Invalid result value:', this.result);
      }
    },
    login() {
      this.$router.push({ path: '/register' });
    }
  }
};
</script>