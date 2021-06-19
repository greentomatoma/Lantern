<template>
  <div>
    <button
      type="button"
      class="btn btn-warning p-2 shadow-none"
      :class="buttonColor"
      @click="clickStock()"
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
        ? 'btn btn-warning'
        : 'btn btn-light'
        
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
          // return view('login')
          alert('レシピを保存するにはログインする必要があります')
          return
        }

        this.isStockedBy
          ? this.unstock()
          : this.stock()
      },
      stock() {
        const response = axios.put(this.endpoint)

        this.isStockedBy = true
        this.countStocks = response.data.countStocks
      },
      unstock() {
        const response = axios.delete(this.endpoint)

        this.isStockedBy = false
        this.countStocks = response.data.countStocks
        console.log(this.countStocks);
      },
    },
  }
</script>
