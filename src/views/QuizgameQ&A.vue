<template>
  <div class="wrapper">
    <img src="../imgs/quizGameImg/gamequiz_bg2-1.png" alt="" class="corner corner-tl">
    <img src="../imgs/quizGameImg/gamequiz_bg2-2.png" alt="" class="corner corner-tr">
    <img src="../imgs/quizGameImg/gamequiz_bg2-3.png" alt="" class="corner corner-bl">
    <img src="../imgs/quizGameImg/gamequiz_bg2-4.png" alt="" class="corner corner-br">
    <div class="container">
      <img src="../imgs/logo/logo-w.png" alt="logo">
      <div class="question">
        <h1>{{ questions[currentQuestionIndex].question }}</h1>
        <div class="botones">
          <button
            v-for="option in questions[currentQuestionIndex].options"
            :key="option"
            class="btn"
            @click="handleOptionClick(option)"
          >
            {{ option }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import gsap from "gsap";

export default {
  data() {
    return {
      currentQuestionIndex: 0,
      userAnswers: [],
      result: '',
      questions: [
        {
          question: '酸 甜 苦 辣 你比較喜歡哪種口感?',
          options: ['SOUR酸', 'SWEET甜', 'BITTER苦', 'SPICY辣']
        },
        {
          question: '偏愛濃烈還是淡雅的味道？',
          options: ['濃烈', '淡雅']
        },
        {
          question: '希望調酒帶來什麼樣的感受或氛圍？',
          options: ['放鬆與舒適', '歡樂與愉悅', '浪漫與優雅', '溫暖與舒心']
        },
        {
          question: '恭喜你!來揭曉你的第一杯酒吧！',
          options: ['公布答案']
        }
      ],
      images: [
        '../imgs/quizGameImg/gamequiz_bg2-1.png',
        '../imgs/quizGameImg/gamequiz_bg2-2.png',
        '../imgs/quizGameImg/gamequiz_bg2-3.png',
        '../imgs/quizGameImg/gamequiz_bg2-4.png'
      ]
    };
  },
  mounted() {
    this.animateImages();
  },
  methods: {
    handleOptionClick(option) {
      this.userAnswers.push(option);

      if (this.currentQuestionIndex === 2) {
        this.result = option;
      }

      if (this.currentQuestionIndex < this.questions.length - 1) {
        this.currentQuestionIndex++;
      } else {
        this.$router.push({
          path: '/resultpage',
          query: { answers: this.userAnswers.join(','), result: this.result }
        });
      }
    },
    animateImages() {
      gsap.fromTo(".corner-tl", {opacity: 0}, {opacity: 1, duration: 2, repeat: -1, yoyo: true});
      gsap.fromTo(".corner-tr", {opacity: 0}, {opacity: 1, duration: 2, repeat: -1, yoyo: true, delay: 0.5});
      gsap.fromTo(".corner-bl", {opacity: 0}, {opacity: 1, duration: 2, repeat: -1, yoyo: true, delay: 1});
      gsap.fromTo(".corner-br", {opacity: 0}, {opacity: 1, duration: 2, repeat: -1, yoyo: true, delay: 1.5});
    }
  }
}
</script>

<style lang="scss">
.wrapper {
  font-family: $fontfamily;
  line-height: $lineheight;
  letter-spacing: $letterspacing;
  width: 100%;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background-image: url('../imgs/quizGameImg/productsImg_bg.jpg');
  background-size: cover;
  background-position: center;

  .container {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;

    img {
      width: 150px;
      height: 150px;
    }
  }

  .corner {
    position: absolute;
    width: 10%;
    height: auto;
    opacity: 0;
    img {
      width: 100%;
      height: auto;
    }
  }

  .corner-tl { 
    top: 0; 
    left: 0; 
  }
  .corner-tr { 
    top: 0; 
    right: 0; 
  }
  .corner-bl { 
    bottom: 0; 
    left: 0; 
  }
  .corner-br { 
    bottom: 0; 
    right: 0; 
  }
}

.question {
  height: auto;
  text-align: center;
  color: white;
  padding: 20px;
  border-radius: 10%;
  box-shadow: 0 0 20px 0 rgba(220, 135, 228, 0.5);

  h1 {
    margin-bottom: 20px;
    padding: 40px;
    font-size: $fontSize_h3;
  }

  .botones {
    display: flex; 
    flex-wrap: wrap; 
    justify-content: center; 
    gap: 10px;
  }

  button {
    margin-top: 20px;
    padding: 10px 20px;
    font-size: 1rem;

    &.btn {
      padding: 0.9em 1.6em;
      border: none;
      outline: none;
      color: #fff;
      font-family: inherit;
      font-weight: 500;
      font-size: 17px;
      cursor: pointer;
      position: relative;
      z-index: 0;
      border-radius: 12px;
      width: 40%;

      &::after {
        content: '';
        z-index: -1;
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: rgb(46, 46, 46);
        left: 0;
        top: 0;
        border-radius: 12px;
      }

      /* glow */
      &::before {
        content: '';
        background: linear-gradient(45deg, #ff0000, #002bff, #ff00c8, #002bff, #ff0000, #002bff, #ff00c8, #002bff);
        position: absolute;
        top: -2px;
        left: -2px;
        background-size: 600%;
        z-index: -1;
        width: calc(100% + 4px);
        height: calc(100% + 4px);
        filter: blur(8px);
        animation: glowing 20s linear infinite;
        transition: opacity 0.3s ease-in-out;
        border-radius: 12px;
        opacity: 0;
      }

      @keyframes glowing {
        0% { background-position: 0 0; }
        50% { background-position: 400% 0; }
        100% { background-position: 0 0; }
      }

      /* hover */
      &:hover::before { opacity: 1; }
      &:active::after { background: transparent; }
      &:active { color: #000; font-weight: bold; }
    }
  }
}

@media (max-width: 768px) {
  .question {
    width: 80%;
    padding: 10px;

    h1 {
      margin-bottom: 10px;
      padding: 20px;
      font-size: 1.6rem;
    }
  }

  .botones button {
    flex: 1 1 calc(50% - 20px);
    font-size: 0.9rem;
  }
}
</style>