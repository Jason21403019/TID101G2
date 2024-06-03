<template>
  <div>
    <footer class="footer">
      <div class="footer__bg">
        <div class="footer__logo">
          <img src="/src/imgs/logo/logo.png" alt="Logo" />
        </div>
        <div class="footer__text">
          <h1 class="footer__contact">客服專線：0970638715</h1>
          <h1 class="footer__hours">週一-週日：17:00～03:00</h1>
          <h1 class="footer__holiday">(國定例假日公休)</h1>
        </div>
        <div class="footer__disclaimer">
          <p>
            本網站為緯育TibaMe前端工程師班第91期學員專題作品<br />
            本平台僅供學習、展示之用，無販售、商業行為等等。<br />
            參考資源: 賣酒網、獵酒人、樂和諧 | 圖片影片來源: freepik、pexels、Midjourney、istockphoto
          </p>
        </div>
      </div>
    </footer>
  </div>
</template>
<script>
export default { name: 'DefaultFooter' }
</script>
<style lang="scss" scoped="scoped">
.footer {
  background-color: #fcf0d8;
  padding: 20px;
  color: black;
  text-align: center;

  &__bg {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  &__logo img {
    max-width: 100px;
    margin-bottom: 15px;
  }

  &__text {
    h1 {
      font-size: 14px;
      margin: 5px 0;
    }
  }

  &__disclaimer {
    margin-top: 20px;
    font-size: 12px;
    line-height: 1.5;
  }
}
</style>
