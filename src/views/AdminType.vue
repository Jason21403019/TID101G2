<template>
  <AdminBreadcrumb :items="breadcrumbItems" />
  <!-- 標題 -->
  <div class="productblock">
    <h1 class="productblock-h1">{{ mainTitle }}</h1>
    <span class="productblock-pipe"> | </span>
    <h1 class="productblock-h1">{{ subTitle }}</h1>
  </div>

  <!-- 按鈕 -->
  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <admin-btn @click="openModal('add')">
      <template #icon>
        <img src="../imgs/icon/icon_expand-w-67.svg" alt="addIcon" height="20" width="20" />
      </template>
      <template #text>新增</template>
    </admin-btn>
  </div>

  <!-- 列表 -->
  <section>
    <table class="table">
      <thead class="table-thead">
        <tr>
          <th scope="col">名稱</th>
          <th scope="col">備註</th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col">編輯</th>
        </tr>
      </thead>
      <tbody class="table-tbody">
        <tr v-for="type in types" :key="type.id">
          <td>{{ type.name }}</td>
          <td>{{ type.memo }}</td>
          <td></td>
          <td></td>
          <td></td>
          <td>
            <button @click="openModal('edit', type)">
              <img src="../imgs/icon/icon_admin-edit.svg" alt="editIcon" width="20px" height="20px" />
            </button>
          </td>
        </tr>
      </tbody>
      <caption>
        每頁列表顯示<span class="main__list-number">6</span
        >筆
      </caption>
    </table>
  </section>

  <ModalType ref="modal" :action-type="currentActionType" :type="currentType" :on-save="handleSave"></ModalType>
</template>

<script>
import AdminBreadcrumb from '../components/AdminBreadcrumb.vue'
import AdminBtn from '../components/AdminBtn.vue'
import ModalType from '../components/AdminModalType.vue'
import { variables } from '../js/AdminVariables.js'

export default {
  name: 'AdminType',
  components: {
    AdminBreadcrumb,
    AdminBtn,
    ModalType
  },
  data() {
    return {
      mainTitle: variables.productblock.product,
      subTitle: variables.productblock.typeList,
      breadcrumbItems: [
        { text: '首頁', link: '/admin', active: false },
        { text: variables.productblock.product, link: '', active: true },
        { text: variables.productblock.typeList, link: '/admin_type', active: false }
      ],

      currentActionType: 'add',
      currentType: {
        name: '',
        memo: ''
      },
      types: [
        {
          id: 1,
          name: 'Type 1',
          memo: '備註 1'
        }
      ]
    }
  },
  methods: {
    openModal(action, type = null) {
      this.currentActionType = action
      this.currentType = type ? { ...type } : { name: '', memo: '' }
      this.$refs.modal.show()
    },
    handleSave(formData) {
      if (this.currentActionType === 'add') {
        // 新增邏輯
        const newType = { ...formData, id: this.types.length + 1 }

        this.types.push(newType)
      } else {
        // 編輯邏輯
        const index = this.types.findIndex((type) => type.id === formData.id)

        if (index !== -1) {
          this.types.splice(index, 1, { ...formData })
        }
      }
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss';

.productblock {
  margin-top: 40px;
  margin-left: 160px;
  color: $campari;

  &-h1 {
    display: inline;
    font-size: $fontSize_h3;
  }

  &-pipe {
    font-size: $fontSize_h3;
    margin: 0 20px;
  }
}

.d-grid {
  margin-right: 55px;
  margin-top: 190px;
  @include breakpoint(1280px) {
    margin-right: 35px;
  }
  img {
    margin-right: 5px;
  }
}

.table {
  width: 85%;
  margin-top: 10px;
  margin-left: 160px;

  .table-thead {
    font-size: $fontSize_h4;

    th {
      background-color: $campari;
      color: $ramos-gin-fizz;
    }
  }

  #flexSwitchCheckChecked:checked {
    background-color: $toggle-on;
    border: solid $toggle-on;
  }
  button {
    border: none;
    background: none;
  }
}
</style>
