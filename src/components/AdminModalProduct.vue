<template>
  <div id="exampleModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 id="exampleModalLabel" class="modal-title fs-5">{{ modalTitle }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div v-if="actionType === 'add'" class="mb-3">
              <label for="productId" class="col-form-label">商品ID:</label>
              <input id="productId" v-model="productData.id" type="text" class="form-control" />
            </div>
            <div class="mb-3">
              <label for="productBrand" class="col-form-label">商品品牌:</label>
              <input id="productBrand" v-model="productData.brand" type="text" class="form-control" />
            </div>
            <div class="mb-3">
              <label for="productName" class="col-form-label">商品名稱:</label>
              <input id="productName" v-model="productData.name" type="text" class="form-control" />
            </div>
            <div class="mb-3">
              <label for="productCategory" class="col-form-label">商品類別:</label>
              <select id="productCategory" v-model="productData.product_class_id" class="form-select">
                <option value="無酒精白酒">無酒精白酒</option>
                <option value="無酒精粉紅酒">無酒精粉紅酒</option>
                <option value="無酒精氣泡酒">無酒精氣泡酒</option>
                <option value="無酒精果汁">無酒精果汁</option>
                <option value="無酒精紅酒">無酒精紅酒</option>
              </select>
            </div>
            <!-- 商品資訊 -->
            <section class="productInfo">
              <div class="mb-3 d-flex align-items-center">
                <div class="col-md-4 d-flex align-items-center">
                  <label for="productSpec" class="col-form-label me-2">規格:</label>
                  <input id="productSpec" v-model="productData.details" type="text" class="form-control" />
                </div>
                <div class="col-md-4 d-flex align-items-center">
                  <label for="productPrice" class="col-form-label me-2">售價:</label>
                  <input id="productPrice" v-model="productData.price" type="number" class="form-control" min="0" />
                </div>
                <div class="col-md-4 d-flex align-items-center">
                  <label for="productStock" class="col-form-label me-2">庫存:</label>
                  <input id="productStock" v-model="productData.stock" type="number" class="form-control" min="0" />
                </div>
              </div>
            </section>
            <!-- 商品敘述 -->
            <div class="mb-3">
              <label for="message-text" class="col-form-label">商品簡述:</label>
              <textarea id="message-text" v-model="productData.content" class="form-control"></textarea>
            </div>
            <!-- 上傳商品圖的input -->
            <div class="mb-3">
              <label for="productImage" class="col-form-label">上傳主要商品圖:</label>
              <input id="productImage" type="file" class="form-control" @change="handleFileUpload($event, 'main')" />
            </div>
            <div class="mb-3">
              <label for="productImage" class="col-form-label">上傳次要商品圖:</label>
              <input id="productImage" type="file" class="form-control" @change="handleFileUpload($event, 'sub')" />
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" @click="onSave">儲存</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    actionType: String,
    product: Object
  },
  data() {
    return {
      productData: {
        id: '',
        name: '',
        price: null,
        brand: '',
        product_class_id: '',
        details: '',
        stock: null,
        content: '',
      },
      modal: null
    }
  },
  computed: {
    modalTitle() {
      return this.actionType === 'add' ? '新增商品' : '編輯商品'
    }
  },
  watch: {
    product: {
      immediate: true,
      handler(newVal) {
        if (newVal) {
          this.productData = { ...newVal }
        } else {
          this.productData = {
            id: '',
            name: '',
            price: null,
            brand: '',
            product_class_id: '',
            details: '',
            stock: null,
            content: '',
          }
        }
      }
    }
  },
  mounted() {
    this.modal = new bootstrap.Modal(document.getElementById('exampleModal'))
  },
  methods: {
    show() {
      this.modal.show()
    },
    hide() {
      this.modal.hide()
    },
    async onSave() {
      try {
        if (this.actionType === 'add') {
          // 新增商品
          const response = await axios.post(`${import.meta.env.VITE_PHP_PATH}adminproduct.php`, this.productData);
          console.log('新增商品成功:', response.data);
          console.log(this.productData);
        } else {
          // 修改商品
          const response = await axios.put(`${import.meta.env.VITE_PHP_PATH}adminproduct.php`, this.productData);
          console.log('修改商品成功:', response.data);
          console.log(this.productData);
        }
        this.$emit('save', this.productData);
        this.hide();
      } catch (error) {
        console.error('儲存商品失敗:', error);
      }
    },
    handleFileUpload(event, type) {
  const file = event.target.files[0];
  const propertyName = type === 'main' ? 'picture' : 'subpage_photo';

  // 存储文件对象
  this.productData[`${propertyName}File`] = file;

  // 将文件转换为base64格式
  const reader = new FileReader();
  reader.onload = () => {
    // 存储base64字符串
    this.productData[propertyName] = reader.result;
    console.log(`上传的文件Base64 (${propertyName}):`, reader.result);
  };
  reader.readAsDataURL(file);
},


  }
}
</script>

<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss'; // 確保這一行在最上面

.modal-header {
  font-size: $fontSize_h4;
  background-color: $babypowder;
  color: $campari;
}

.modal-body {
  font-size: $fontSize_h4;
  background-color: $babypowder;
  color: $campari;
  .productInfo {
    input {
      width: 60%;
    }
  }
  .form-check-input[data-v-c3e3b637]:checked {
    background-color: $toggle-on;
    border: solid $toggle-on;
  }
}

.modal-footer {
  background-color: $babypowder;
  color: $campari;
  .btn-primary {
    background-color: $campari;
    color: $ramos-gin-fizz;
  }
}
</style>
