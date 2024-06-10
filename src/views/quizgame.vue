<template>
  <div id="heart" class="heart">
    <div id="backgrounds" class="background-images">
      <img src="../imgs/quizGameImg/gamequiz_bg2-1.png" alt="" class="bg-img bg-img1" />
      <img src="../imgs/quizGameImg/gamequiz_bg2-2.png" alt="" class="bg-img bg-img2" />
      <img src="../imgs/quizGameImg/gamequiz_bg2-3.png" alt="" class="bg-img bg-img3" />
      <img src="../imgs/quizGameImg/gamequiz_bg2-4.png" alt="" class="bg-img bg-img4" />
    </div>
    <div id="logo" class="logo">
      <img src="../imgs/logo/logo-w.png" alt="" />
    </div>
    <div id="title" class="title">
      <h1>發掘你的調酒名單</h1>
    </div>
    <div id="text" class="text">
      <h2>
        你今天首次來到酒吧 我們特地為你準備了這場不平凡的聲光饗宴。
        可是，你知道你最適合的調酒是哪一款嗎？讓我們來幫助你解答這個問題吧！
        一場發掘酒味與個人品味結合之旅 不再彷徨，也不再迷茫.... 品嚐屬於你的專屬饗宴
      </h2>
    </div>
    <div id="btn" class="btn">
      <button class="button" @click="startQuiz" data-text="Awesome">
        <span class="actual-text">&nbsp;開始饗宴&nbsp;</span>
        <span aria-hidden="true" class="hover-text">&nbsp;開始&nbsp;</span>
      </button>
    </div>
    <audio src="../imgs/quizGameImg/gamequiz_clouds-08.svg"></audio>
  </div>
</template>

<script>
import gsap from "gsap";
import imagesLoaded from "imagesloaded";

export default {
  mounted() {
    imagesLoaded(".bg-img", () => {
      const images = document.querySelectorAll(".bg-img");
      const tl = gsap.timeline({ repeat: -1, repeatDelay: 0 });

      images.forEach((img, index) => {
        tl.to(img, {
          autoAlpha: 1,
          duration: 2.5,
          ease: "power2.inOut",
          onComplete: () => {
            if (index === images.length - 1) {
              gsap.to(images[0], {
                autoAlpha: 1,
                duration: 1.5,
                ease: "power2.inOut",
                delay: 1,
              });
              gsap.to(images[index], {
                autoAlpha: 0,
                duration: 1.5,
                delay: 4,
              });
            }
          },
        }).to(
          img,
          {
            autoAlpha: 0,
            duration: 1.5,
            ease: "power2.inOut",
          },
          "+=1.5"
        );
      });
    });
  },
  methods: {
    startQuiz() {
      this.$router.push("/quizgameQ&A");
    },
  },
};
</script>

<style lang="scss" scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family:$fontfamily;
  line-height: $lineheight-en;
  letter-spacing: $letterspacing;
} 

.heart {
  background: url(../imgs/quizGameImg/gamequiz_mbg-10.jpg) center center no-repeat;
  background-size: cover;
  width: 100%;
  height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  position: relative;
  color: white;
}

.logo {
  width: 15rem;
  margin-bottom: 30px;
  z-index: 2;
}

.logo img {
  width: 100%;
  height: auto;
}

.title h1 {
  font-size: 3em;
  font-weight: bold;
  text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
  margin-bottom: 20px;
  z-index: 2;
}

.text {
  width: 80%;
  margin: 0 auto 30px;
  z-index: 2;
}

.text h2 {
  font-size: 1.2em;
  line-height: 1.8;
  text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
}

.btn {
  z-index: 2;
}

.button {
  margin: 0;
  height: auto;
  background: transparent;
  padding: 0;
  border: none;
  cursor: pointer;
  --border-right: 6px;
  --text-stroke-color: #cead82;
  --animation-color: #f6f6f6;
  --fs-size: 2em;
  letter-spacing: 3px;
  text-decoration: none;
  font-size: var(--fs-size);
  font-family: 'Arial';
  position: relative;
  text-transform: uppercase;
  color: transparent;
  -webkit-text-stroke: 1px var(--text-stroke-color);
}

.hover-text {
  position: absolute;
  box-sizing: border-box;
  content: attr(data-text);
  color: var(--animation-color);
  width: 0%;
  inset: 0;
  border-right: var(--border-right) solid var(--animation-color);
  overflow: hidden;
  transition: 0.5s;
  -webkit-text-stroke: 1px var(--animation-color);
}

.button:hover .hover-text {
  width: 100%;
  filter: drop-shadow(0 0 23px var(--animation-color));
}

.background-images {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1;
  overflow: hidden;
}

.bg-img {
  position: relative;
  top: 0;
  left: 150px;
  filter: blur(5px);
  height: 100%;
  object-fit: fill;
  opacity: 0;
  transition: opacity 1s ease-in-out;
}
.bg-img1 {
  position: relative;
  left: 11vw;
  bottom: 6vw;
  width: 25vw;
}
.bg-img2 {
  position: relative;
  left: 25vw;
}
.bg-img3 {
  position: relative;
  right: 10vw;
}
.bg-img4 {
  position: relative;
  right: 20vw;
  bottom: 6vw;
}
</style>