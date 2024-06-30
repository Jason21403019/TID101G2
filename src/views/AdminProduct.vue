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
        <select v-model="selectedOption" class="form-select" aria-label="Default select example" @change="handleSelectChange">
          <option selected value="">全部商品</option>
          <option value="1">商品類別</option>
        </select>
      </template>
      <!-- 如果切換到商品類別時，變更input視窗為下拉式 -->
      <template #input>
        <input v-if="selectedOption !== '1'" :id="inputId" v-model="inputValue" type="text" class="form-control" />
        <select v-else v-model="selectedCategory" class="form-select">
          <option value="">選擇商品類別</option>
          <option value="無酒精白酒">無酒精白酒</option>
          <option value="無酒精粉紅酒">無酒精粉紅酒</option>
          <option value="無酒精氣泡酒">無酒精氣泡酒</option>
          <option value="無酒精果汁">無酒精果汁</option>
          <option value="無酒精紅酒">無酒精紅酒</option>
        </select>
      </template>
    </admin-select-input>
    <admin-btn @click="search" class="searchBtn">
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
        <img src="../imgs/icon/icon_delete.svg" alt="delIcon" height="20" width="20" />
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
    <!-- 列表 -->
    <table class="table">
      <thead class="table-thead">
        <tr>
          <th scope="col">
            <input v-model="selectAll" class="form-check-input" type="checkbox" @change="toggleAllCheckboxes" />
          </th>
          <th scope="col">商品編號</th>
          <th scope="col">商品名稱</th>
          <th scope="col">商品類別</th>
          <th scope="col">商品售價</th>
          <th scope="col">銷售數量</th>
          <th scope="col">庫存數</th>
          <th scope="col">編輯</th>
          <th scope="col">刪除</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(product, index) in products" :key="product.id">
          <th scope="row">
            <input v-model="product.selected" class="form-check-input" type="checkbox" />
          </th>
          <td>{{ product.id }}</td>
          <td>{{ product.name }}</td>
          <td>{{ product.product_class_id }}</td>
          <td>NT$ {{ product.price }}</td>
          <td>{{ product.sales }}</td>
          <td>{{ product.stock }}</td>
          <td>
            <button @click="openModal('edit', product)">
              <img src="../imgs/icon/icon_admin-edit.svg" alt="editIcon" width="20px" height="20px" />
            </button>
          </td>
          <td>
            <button @click="deleteProduct(index, product.id)">
              <img src="../imgs/icon/icon_delete.svg" alt="deleteIcon" width="20px" height="20px" />
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </section>
  <ModalProduct ref="modal" :action-type="currentActionType" :product="currentProduct" @save="handleSave" />
</template>

<script>
import AdminBreadcrumb from '../components/AdminBreadcrumb.vue'
import AdminBtn from '../components/AdminBtn.vue'
import AdminBulkBtn from '../components/AdminBulkBtn.vue'
import AdminSelectInput from '../components/AdminSelectInput.vue'
import ModalProduct from '../components/AdminModalProduct.vue'
import Swal from 'sweetalert2'
import { variables } from '../js/AdminVariables.js'
import axios from 'axios'

export default {
  name: 'AdminProduct',
  components: {
    AdminBreadcrumb,
    AdminSelectInput,
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
      selectAll: false,
      products: [],
      inputValue: '',
      inputId: 'formGroupExampleInput1',
      selectedOption: '',
      selectedCategory: ''
    }
  },
  created() {
    this.fetchProducts();
  },
  watch: {
    products: {
      handler() {
        this.selectAll = this.products.every(product => product.selected);
      },
      deep: true
    }
  },
  methods: {
    fetchProducts(name = '', product_class_id = '') {
      let url = `${import.meta.env.VITE_PHP_PATH}adminproduct.php?name=${encodeURIComponent(name)}`;
      if (product_class_id) {
        url += `&product_class_id=${encodeURIComponent(product_class_id)}`;
      }
      console.log('Fetching products with URL:', url);
      axios.get(url)
        .then(response => {
          const data = response.data;
          console.log('API response data:', data);
          if (Array.isArray(data)) {
            this.products = data;
          } else {
            console.error('返回的數據不是一個陣列:', data);
            this.products = [];
            if (data.message) {
              Swal.fire('提示', data.message, 'info');
            }
          }
        })
        .catch(error => {
          console.error('Error fetching products:', error);
          this.products = [];
          Swal.fire('錯誤', '無法獲取產品數據。', 'error');
        });
    },
    search() {
  let searchTerm = ''; // 預設搜尋字串為空

  if (this.selectedOption === '1') {
    searchTerm = this.selectedCategory; // 如果選擇了選項 '1'，就用 selectedCategory 來搜尋
  } else {
    searchTerm = this.inputValue; // 否則就用 inputValue 來搜尋
  }

  console.log('搜尋字串：', searchTerm); 

  this.fetchProducts(searchTerm); // 使用搜尋字串來抓取產品資料
},
  openModal(actionType, product = {}) {
      this.currentActionType = actionType;
      this.currentProduct = product;
      this.$refs.modal.show();
    },
    handleSave(updatedProduct) {
      if (this.currentActionType === 'add') {
        this.products.push(updatedProduct);
      } else {
        const index = this.products.findIndex(p => p.id === updatedProduct.id);
        if (index !== -1) {
          this.products.splice(index, 1, updatedProduct);
        }
      }
    },
    deleteProduct(index, productId) {
      Swal.fire({
        title: '確認刪除',
        text: '您確定要刪除此項目嗎？',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '確定',
        cancelButtonText: '取消'
      }).then(result => {
        if (result.isConfirmed) {
          console.log(productId); 
          axios.delete(`${import.meta.env.VITE_PHP_PATH}adminproduct.php`, {
            params: { id: productId } 
          })
          .then(response => {
            const data = response.data;
            if (data.message === "Product deleted successfully.") {
              this.products.splice(index, 1);
              Swal.fire('已刪除', '產品已成功刪除。', 'success');
            } else {
              Swal.fire('錯誤', data.error || '刪除失敗。', 'error');
            }
          })
          .catch(error => {
            console.error('Error deleting product:', error);
            Swal.fire('錯誤', '刪除失敗。', 'error');
          });
        }
      });
    },
    bulkCancel() {
      const selectedProducts = this.products.filter(product => product.selected);
      if (selectedProducts.length === 0) {
        Swal.fire('錯誤', '請選擇至少一個產品進行刪除。', 'error');
        return;
      }
      Swal.fire({
        title: '確認刪除',
        text: '您確定要刪除選中的 ' + selectedProducts.length + ' 個項目嗎？',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '確定',
        cancelButtonText: '取消'
      }).then(result => {
        if (result.isConfirmed) {
          const deletePromises = selectedProducts.map(product => {
            return axios.delete(`${import.meta.env.VITE_PHP_PATH}adminproduct.php`, { 
              params: { id: product.id } 
            });
          });

          Promise.all(deletePromises)
            .then(responses => {
              const allSuccess = responses.every(response => {
                return response.status === 200 && response.data.message === "Product deleted successfully.";
              });

              if (allSuccess) {
                this.products = this.products.filter(product => !product.selected);
                Swal.fire('已刪除', '選中的產品已成功刪除。', 'success');
              } else {
                Swal.fire('錯誤', '部分產品刪除失敗，請稍後再試。', 'error');
              }
            })
            .catch(error => {
              console.error('Error deleting products:', error);
              Swal.fire('錯誤', '刪除失敗，請稍後再試。', 'error');
            });
        }
      });
    },
    toggleAllCheckboxes() {
      this.products.forEach(product => {
        product.selected = this.selectAll;
      });
    },
    handleSelectChange() {
      if (this.selectedOption !== '1') {
        this.selectedCategory = '';
      }
    }
  }
};
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

  .admin_btn {
    margin-right: 55px;
    @include breakpoint(1280px) {
      margin-right: 35px;
    }
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