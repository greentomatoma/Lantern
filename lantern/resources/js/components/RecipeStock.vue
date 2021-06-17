<template>
  <div>
    <button
      type="button"
      class="btn btn-warning p-2 shadow-none"
      :class="buttonColor"
    >
    <i
      :class="buttonIcon"
      @click="clickStock"
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
          return view('login')
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
