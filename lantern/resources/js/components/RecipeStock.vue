<template>
  <div>
    <button
      type="button"
      class="btn btn-warning p-2 shadow-none"
      :class="buttonColor"
    >
    <i
      :class="buttonIcon"
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
    },
    data() {
      return {
        isStockedBy: this.initialIsStockedBy,
      }
    },
    computed: {
      buttonColor() {
        return this.isStockedBy
        ? 'btn btn-light'
        : 'btn btn-warning'
      },
      buttonIcon() {
        return this.isStockedBy
        ? 'fas fa-bookmark fa-lg'
        : 'far fa-bookmark fa-lg'
      },
    },
  }
</script>
