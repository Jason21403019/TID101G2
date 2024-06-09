<template>
  <AdminBreadcrumb :items="breadcrumbItems" />
  <!-- 標題 -->
  <div class="productblock">
    <h1 class="productblock-h1">{{ mainTitle }}</h1>
    <span class="productblock-pipe"> | </span>
    <h1 class="productblock-h1">{{ subTitle }}</h1>
  </div>

  <!-- 搜尋 -->
  <section class="d-flex align-items-center">
    <admin-select-input input-id="formGroupExampleInput1" :selected-option="selectedOption">
      <template #label>查詢條件</template>
      <template #select>
        <select class="form-select" v-model="selectedOption" @change="handleSelectChange" aria-label="Default select example">
          <option selected value="">全部商品</option>
          <option value="1">商品類別</option>
        </select>
      </template>

      <!-- 如果切換到商品類別時，變更input視窗為下拉式 -->
      <template #input>
        <input v-if="selectedOption !== '1'" :id="inputId" type="text" class="form-control" v-model="inputValue" />
        <select v-else class="form-select" v-model="selectedCategory">
          <option value="">選擇商品類別</option>
          <option value="category1">無酒精白酒</option>
          <option value="category2">無酒精粉紅酒</option>
          <option value="category3">無酒精氣泡酒</option>
          <option value="category4">無酒精果汁</option>
          <option value="category5">無酒精白酒</option>
        </select>
      </template>
    </admin-select-input>

    <admin-btn :handle-click="search" class="searchBtn">
      <template #icon>
        <img src="../imgs/icon/icon_admin-search-w.svg" alt="addIcon" height="20" width="20" />
      </template>
      <template #text>查詢</template>
    </admin-btn>
  </section>

  <!-- 按鈕 -->
  <div class="d-grid gap-2 d-md-flex justify-content-md-between">
    <admin-bulk-btn :handle-click="bulkCancel">
      <template #bulkicon>
        <img src="../imgs/icon/icon_delete.svg" alt="cancelIcon" height="20" width="20" />
      </template>
      <template #bulktext>多筆刪除</template>
    </admin-bulk-btn>

    <admin-btn @click="openModal('add')">
      <template #icon>
        <img src="../imgs/icon/icon_expand-w-67.svg" alt="addIcon" height="20" width="20" />
      </template>
      <template #text>新增</template>
    </admin-btn>
  </div>

  <section>
    <table class="table">
      <thead class="table-thead">
        <tr>
          <th scope="col"></th>
          <th scope="col">商品編號</th>
          <th scope="col">商品名稱</th>
          <th scope="col">商品類別</th>
          <th scope="col">商品售價</th>
          <th scope="col">銷售數量</th>
          <th scope="col">庫存數</th>
          <th scope="col">熱銷商品</th>
          <th scope="col">下架/上架</th>
          <th scope="col">編輯</th>
          <th scope="col">刪除</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(product, index) in products" :key="product.id">
          <th scope="row">
            <input class="form-check-input" type="checkbox" />
          </th>
          <td>{{ product.id }}</td>
          <td>{{ product.name }}</td>
          <td>{{ product.category }}</td>
          <td>NT$ {{ product.price }}</td>
          <td>{{ product.sales }}</td>
          <td>{{ product.stock }}</td>
          <td>
            <div>
              <input class="form-check-input" type="checkbox" />
            </div>
          </td>
          <td>
            <div class="form-check form-switch">
              <input id="flexSwitchCheckChecked" class="form-check-input" type="checkbox" checked />
            </div>
          </td>
          <td>
            <button @click="openModal('edit', product)">
              <img src="../imgs/icon/icon_admin-edit.svg" alt="" width="20px" height="20px" />
            </button>
          </td>
          <td>
            <button @click="deleteProduct(index)">
              <img src="../imgs/icon/icon_delete.svg" alt="" width="20px" height="20px" />
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

  <ModalProduct ref="modal" :actionType="currentActionType" :product="currentProduct" @save="handleSave" />
</template>

<script>
import AdminBreadcrumb from '../components/AdminBreadcrumb.vue'
import AdminSelectInput from '../components/AdminSelectInput.vue'
import AdminDateInput from '../components/AdminDateInput.vue'
import AdminBtn from '../components/AdminBtn.vue'
import AdminBulkBtn from '../components/AdminBulkBtn.vue'
import ModalProduct from '../components/AdminModalProduct.vue'
import { variables } from '../js/AdminVariables.js'

export default {
  name: 'AdminOrder',
  components: {
    AdminBreadcrumb,
    AdminSelectInput,
    AdminDateInput,
    AdminBtn,
    AdminBulkBtn,
    ModalProduct
  },
  data() {
    return {
      mainTitle: variables.productblock.product,
      subTitle: variables.productblock.productList,
      breadcrumbItems: [
        { text: '首頁', link: '/admin', active: false },
        { text: variables.productblock.product, link: '', active: true },
        { text: variables.productblock.productList, link: '/admin_product', active: false }
      ],
      currentActionType: '',
      currentProduct: {},
      products: [
        {
          id: 'P001',
          name: 'VINADA 無酒精氣泡酒',
          category: '無酒精紅酒',
          price: 800,
          sales: 10,
          stock: 50,
          isHot: false,
          isAvailable: true
        },
        {
          id: 'P002',
          name: 'Another Product',
          category: 'Category',
          price: 500,
          sales: 5,
          stock: 20,
          isHot: true,
          isAvailable: false
        }
      ],
      // 回傳input
      selectedOption: '',
      inputValue: '',
      selectedCategory: ''
    }
  },
  methods: {
    openModal(actionType, product = {}) {
      this.currentActionType = actionType
      this.currentProduct = product
      this.$refs.modal.show()
    },
    handleSave(updatedProduct) {
      if (this.currentActionType === 'add') {
        this.products.push(updatedProduct)
      } else {
        const index = this.products.findIndex((p) => p.id === updatedProduct.id)
        if (index !== -1) {
          this.products.splice(index, 1, updatedProduct)
        }
      }
    },
    deleteProduct(index) {
      this.products.splice(index, 1)
    },
    handleSelectChange() {
      if (this.selectedOption !== '1') {
        this.inputValue = '' // 清除普通輸入框的值
        this.selectedCategory = '' // 清除選擇類別的值
      }
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss'; // 確保這一行在最上面

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
.d-flex {
  .searchBtn {
    margin-top: 40px;
    margin-left: 5px;
  }
}
.d-grid {
  margin-top: 100px;
  margin-left: 160px;
  .admin_btn{
    margin-right: 130px;
  }

}
.table td,
.table th {
  vertical-align: middle;
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
  button {
    border: none;
    background: none;
  }
 
  #flexSwitchCheckChecked:checked {
    background-color: $toggle-on;
    border: solid $toggle-on;
  }
}
</style>
