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
    3
  </div>
</template>

<script>
  export default {
    props: {
      initialIsStockedBy: {
          type: Boolean,
          default: false,
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
        // const response = await axios.put(this.endpoint)

        this.isStockedBy = true
      },
      async unstock() {
        // const response = await axios.put(this.endpoint)

        this.isStockedBy = false
      },

    }
  }
</script>
