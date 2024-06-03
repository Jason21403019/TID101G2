<template>
  <div
    class="sidebar"
    :class="{ 'sidebar-expanded': isExpanded }"
    @mouseenter="handleMouseEnter"
    @mouseleave="handleMouseLeave"
  >
    <div class="d-flex justify-content-start">
      <router-link to="/admin">
        <img src="../../imgs/logo/logo-w.png" alt="logo" width="60" height="60" />
        <span v-if="isExpanded" class="logo-text">紙醉金迷後台</span>
      </router-link>
    </div>
    <ul v-if="!isExpanded" class="nav">
      <li v-for="item in navItems" :key="item.text" class="nav-item">
        <admin-icon-manger :icon="item.icon" :expanded="false" />
      </li>
    </ul>

    <ul v-else id="accordionFlushExample" class="accordion accordion-flush">
      <li v-for="(item, index) in navItems" :key="item.text" class="accordion-item">
        <div :id="'flush-heading' + index" class="accordion-header">
          <button
            class="accordion-button collapsed"
            type="button"
            data-bs-toggle="collapse"
            :data-bs-target="'#flush-collapse' + index"
            aria-expanded="false"
            :aria-controls="'flush-collapse' + index"
            @click="toggleExpand(index)"
          >
            <admin-icon-manger :icon="item.icon" :expanded="expandedIndex === index" />
            <span class="nav-text">{{ item.text }}</span>
          </button>
        </div>
        <div
          :id="'flush-collapse' + index"
          class="accordion-collapse collapse"
          :aria-labelledby="'flush-heading' + index"
          data-bs-parent="#accordionFlushExample"
        >
          <ul class="accordion-body">
            <li v-for="subItem in item.subItems" :key="subItem.text">
              <a :href="subItem.link">{{ subItem.text }}</a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
import AdminIconManger from '../../components/AdminIconManger.vue'
import { variables } from '../../js/AdminVariables.js'

export default {
  components: {
    AdminIconManger
  },
  props: {
    isExpanded: {
      type: Boolean,
      // required: true,
      default: false
    }
  },
  data() {
    return {
      navItems: [
        {
          text: variables.memberblock.member,
          icon: 'member',
          subItems: [{ text: variables.memberblock.memberList, link: '/#/admin_member' }]
        },
        {
          text: variables.productblock.product,
          icon: 'product',
          subItems: [
            { text: variables.productblock.typeList, link: '/#/admin_type' },
            { text: variables.productblock.productList, link: '/#/admin_product' }
          ]
        },
        {
          text: variables.orderblock.order,
          icon: 'order',
          subItems: [{ text: variables.orderblock.orderList, link: '/#/admin_order' }]
        },
        {
          text: variables.articleblock.wine,
          icon: 'wine',
          subItems: [
            { text: variables.articleblock.categoryList, link: '/#/admin_category' },
            { text: variables.articleblock.articleList, link: '/#/admin_article' }
          ]
        },
        {
          text: variables.resblock.reservation,
          icon: 'reservation',
          subItems: [{ text: variables.resblock.bookingList, link: '/#/admin_res' }]
        },
        {
          text: variables.adminblock.admin,
          icon: 'admin',
          subItems: [{ text: variables.adminblock.account, link: '/#/admin_account' }]
        }
      ],
      expandedIndex: null,
      mouseOver: false
    }
  },
  methods: {
    // toggleSidebar() {
    //   this.isExpanded = !this.isExpanded;
    // },
    // icon的svg轉換
    handleMouseEnter() {
      if (!this.isExpanded) {
        this.mouseOver = true
        this.$emit('update:isExpanded', true)
      }
    },
    handleMouseLeave() {
      if (this.mouseOver) {
        this.mouseOver = false
        this.$emit('update:isExpanded', false)
      }
    },
    toggleExpand(index) {
      this.expandedIndex = this.expandedIndex === index ? null : index
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../../../node_modules/bootstrap/scss/bootstrap.scss';

.sidebar {
  font-family: $fontfamily,$fontfamily-en;
  position: fixed;
  top: 0;
  width: 80px;
  height: 100vh;
  background-color: $irishcoffee;
  color: $babypowder;
  transition: width 0.3s;
  display: flex;
  flex-direction: column;
  align-items: center;
  .nav-item svg {
    fill: $babypowder;
  }
  &-expanded {
    width: 250px;
  }

  .d-flex{
    img{
      padding: 5px;
    }
    .logo-text {
      margin-left: 10px;
      text-decoration: none;
      outline: none;
      border-bottom: none;
      color: $babypowder;
    }
    a{
      text-decoration: none;
    }
  }

  .nav,
  .accordion {
    list-style: none;
    padding: 0;
    width: 100%;

    .nav-item {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 10px;
      width: 100%;
      cursor: pointer;

      .nav-text {
        display: none;
        white-space: nowrap;
        margin-left: 10px;
      }
    }
  }
  .accordion-item {
    background-color: $irishcoffee;

    .accordion-button {
      display: flex;
      align-items: center;
      outline: none;
      background-color: $irishcoffee;
      color: $babypowder;
      font-size: $fontSize_h5;
      .nav-icon {
        flex-shrink: 0;
        margin-right: 20px;
      }
      &::after {
        background-image: url('../../imgs/icon/icon_option-w.svg');
      }
      &:not(.collapsed) {
        color: $campari;
        &::after {
          background-image: url('../../imgs/icon/icon_option.svg');
        }
      }
      &:focus {
        outline: none;
        box-shadow: none;
      }
    }
  }
  .accordion-body {
    list-style: none;

    li {
      padding-bottom: 15px;
      line-height: $lineheight;

      a {
        text-decoration: none;
        color: $babypowder;
        display: block;
        height: 100%;
        padding-left: 55px;
        &:hover {
          color: $campari;
        }
      }
    }
  }

  &.sidebar-expanded .nav-item .nav-text {
    display: inline;
  }
}
</style>
