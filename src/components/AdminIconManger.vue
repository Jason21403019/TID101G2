<template>
  <img :src="iconSrc" class="nav-icon"/>
</template>

<script>
  import memberIcon from '@/imgs/icon/icon_admin-users-alt-w.svg';
  import productIcon from '@/imgs/icon/icon_admin-apps-add-w.svg';
  import discountIcon from '@/imgs/icon/icon_admin-fee-receipt-w.svg';
  import orderIcon from '@/imgs/icon/icon_admin-rectangle-w.svg';
  import wineIcon from '@/imgs/icon/icon_admin-answer-w.svg';
  import reservationIcon from '@/imgs/icon/icon_admin-calendar-check-w.svg';
  import adminIcon from '@/imgs/icon/icon_admin-user-gear-w.svg';
  // 咖啡色
  import memberIconB from '@/imgs/icon/icon_admin-users-alt.svg';
  import productIconB from '@/imgs/icon/icon_admin-apps-add.svg';
  import discountIconB from '@/imgs/icon/icon_admin-fee-receipt.svg';
  import orderIconB from '@/imgs/icon/icon_admin-rectangle.svg';
  import wineIconB from '@/imgs/icon/icon_admin-answer.svg';
  import reservationIconB from '@/imgs/icon/icon_admin-calendar-check.svg';
  import adminIconB from '@/imgs/icon/icon_admin-user-gear.svg';

  export default {
    props: {
      icon: {
        type: String,
        required: true
      },
      expanded: {
        type: Boolean,
        default: false
      }
    },
    computed: {
      iconSrc() {
        const icons = {
          member: this.expanded ? memberIconB : memberIcon,
          product: this.expanded ? productIconB : productIcon,
          discount: this.expanded ? discountIconB : discountIcon,
          order: this.expanded ? orderIconB : orderIcon,
          wine: this.expanded ? wineIconB : wineIcon,
          reservation: this.expanded ? reservationIconB : reservationIcon,
          admin: this.expanded ? adminIconB : adminIcon,
        };
        return icons[this.icon];
      },
    }
  };
</script>

<style lang="scss" scoped>
  .nav-icon {
    width: 24px;
    height: 24px;
  }

  
</style>
