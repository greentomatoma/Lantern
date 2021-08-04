<template>
  <div class="stock-btn mt-2">
    <button
      type="button"
      class="shadow-none p-2"
      :class="buttonColor"
      @click="clickStock"
    >
    <i
      :class="buttonIcon"
    ></i>
    </button>
    {{ countStocks }}
  </div>
</template>

<script>
  export default {
    props: {
      initialIsStockedBy: {
          type: Boolean,
          default: false,
      },
      initialCountStocks: {
        type: Number,
        default: 0,
      },
      authorized: {
        type: Boolean,
        default: false,
      },
      endpoint: {
        type: String,
      },
    },
    data() {
      return {
        isStockedBy: this.initialIsStockedBy,
        countStocks: this.initialCountStocks,
      }
    },
    computed: {
      buttonColor() {
        return this.isStockedBy
        ? 'stocked'
        : 'no-stock'
      },
      buttonIcon() {
        return this.isStockedBy
        ? 'fas fa-bookmark fa-lg'
        : 'far fa-bookmark fa-lg'
      },
    },
    methods: {
      clickStock() {
        if(!this.authorized) {
          alert('レシピを保存するにはログインする必要があります')
          return
        }

        this.isStockedBy
          ? this.unstock()
          : this.stock()
      },
      async stock() {
        const response = await axios.put(this.endpoint)

        this.isStockedBy = true
        this.countStocks = response.data.countStocks
      },
      async unstock() {
        const response = await axios.delete(this.endpoint)

        this.isStockedBy = false
        this.countStocks = response.data.countStocks
      },
    },
  }
</script>
