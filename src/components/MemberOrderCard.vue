<template>
  <div class="container">
    <main class="grid">
      <article>
        <div class="text">
          <p><strong>訂單編號:</strong> {{ orderId }}</p>
          <p><strong>成立時間:</strong> {{ orderTime }}</p>
          <p><strong>訂單狀態:</strong> {{ orderStatus }}</p>
          <p><strong>總價:</strong> {{ totalPrice }}</p>
          <p><strong>配送狀態:</strong> {{ shippingStatus }}</p>
          <p><strong>付款狀態:</strong> {{ paymentStatus }}</p>
          <p><strong>出貨狀態:</strong> {{ fulfillmentStatus }}</p>
          <a href="https://codepen.io/collection/XdWJOQ/" class="btn btn-primary btn-block">Here's why</a>
        </div>
      </article>
      <article>
        <div class="text">
          <h3>Completely Synergize</h3>
          <p>
            Dramatically engage seamlessly visualize quality intellectual capital without superior collaboration and
            idea-sharing.
          </p>
          <a href="https://codepen.io/collection/XdWJOQ/" class="btn btn-primary btn-block">Here's how</a>
        </div>
      </article>
      <article>
        <div class="text">
          <h3>Dynamically Procrastinate</h3>
          <p>Completely synergize resource taxing relationships via premier niche markets.</p>
          <a href="https://codepen.io/collection/XdWJOQ/" class="btn btn-primary btn-block">Read more</a>
        </div>
      </article>
      <article>
        <div class="text">
          <h3>Best in class</h3>
          <p>Imagine jumping into that boat, and just letting it sail wherever the wind takes you...</p>
          <a href="https://codepen.io/collection/XdWJOQ/" class="btn btn-primary btn-block">Just do it...</a>
        </div>
      </article>
      <article>
        <div class="text">
          <h3>Dynamically innovate supply chains</h3>
          <p>Holisticly predominate extensible testing procedures for reliable supply chains.</p>
          <a href="https://codepen.io/collection/XdWJOQ/" class="btn btn-primary btn-block">Here's why</a>
        </div>
      </article>
      <article>
        <div class="text">
          <h3>Sanity check</h3>
          <p>Objectively innovate empowered manufactured products whereas parallel platforms.</p>

        </div>
      </article>
    </main>
  </div>
</template>

<script>
export default {
  name: 'MemberOrderCard',

  props: {
    orderId: {
      type: String,
      required: true
    },
    orderTime: {
      type: String,
      required: true
    },
    orderStatus: {
      type: String,
      required: true
    },
    totalPrice: {
      type: Number,
      required: true
    },
    shippingStatus: {
      type: String,
      required: true
    },
    paymentStatus: {
      type: String,
      required: true
    },
    fulfillmentStatus: {
      type: String,
      required: true
    }
  },
}
</script>

<style lang="scss" scoped>
body {
//   padding: 40px 0;
}

.grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  grid-template-rows: repeat(auto-fill, 250px);
  grid-gap: 20px;
  align-items: stretch;
  padding-right: 20px;
  
}

.grid > article {
  border: 1px solid $ramos-gin-fizz;
  box-shadow: 2px 2px 6px 0px rgba(0, 0, 0, 0.3);
  background-color: $ramos-gin-fizz;
  border-radius: 4px;
}

.grid .text {
  padding: 20px;
  color: $blackvevet;
  font-family: $fontfamily;
  font-weight: bold;
  line-height:$lineheight;
  letter-spacing: $letterspacing - 0.175rem;
}
</style>
