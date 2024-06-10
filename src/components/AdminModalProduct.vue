<template>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">{{ modalTitle }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="productBrand" class="col-form-label">商品品牌:</label>
              <input type="text" class="form-control" id="productBrand" v-model="productData.brand" />
            </div>

            <div class="mb-3">
              <label for="productName" class="col-form-label">商品名稱:</label>
              <input type="text" class="form-control" id="productName" v-model="productData.name" />
            </div>

            <div class="mb-3">
              <label for="productCategory" class="col-form-label">商品類別:</label>
              <select class="form-select" id="productCategory" v-model="productData.category">
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
                  <input type="text" class="form-control" id="productSpec" v-model="productData.spec" />
                </div>

                <div class="col-md-4 d-flex align-items-center">
                  <label for="productPrice" class="col-form-label me-2">售價:</label>
                  <input type="number" class="form-control" id="productPrice" v-model="productData.price" min="0" />
                </div>
                <div class="col-md-4 d-flex align-items-center">
                  <label for="productStock" class="col-form-label me-2">庫存:</label>
                  <input type="number" class="form-control" id="productStock" v-model="productData.stock" min="0" />
                </div>
              </div>
            </section>

            <!-- 商品敘述 -->
            <div class="mb-3">
              <label for="message-text" class="col-form-label">商品簡述:</label>
              <textarea class="form-control" id="message-text"></textarea>
            </div>

            <!-- 上傳商品圖的input -->
            <div class="mb-3">
              <label for="productImage" class="col-form-label">上傳商品圖:</label>
              <input type="file" class="form-control" id="productImage" @change="handleFileUpload" />
            </div>

            <!-- 熱銷商品 -->

            <div class="mb-3">
              <label for="message-text" class="col-form-label">熱銷商品:</label>
              <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="..." />
            </div>

            <!-- 上下架 -->
            <div class="mb-3">
              <label for="message-text" class="col-form-label">下架/上架:</label>
              <div class="form-check form-switch">
                <input id="flexSwitchCheckChecked" class="form-check-input" type="checkbox" checked />
              </div>
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
export default {
  props: {
    actionType: String,
    product: Object
  },
  data() {
    return {
      productData: {
        id: null,
        name: '',
        price: null
      },
      modal: null
    }
  },
  computed: {
    modalTitle() {
      return this.actionType === 'add' ? '新增商品' : '編輯商品'
    }
  },
  methods: {
    show() {
      this.modal.show()
    },
    hide() {
      this.modal.hide()
    },
    onSave() {
      this.$emit('save', this.productData)
      this.hide()
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
            id: null,
            name: '',
            price: null
          }
        }
      }
    }
  },
  mounted() {
    this.modal = new bootstrap.Modal(document.getElementById('exampleModal'))
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
