<template>
  <button class="box"
    @click="selectSquare"
  >
    {{valueSquare}}
  </button>
</template>
<script lang="ts">
import { defineComponent, ref } from "vue";
export default defineComponent({
  name: "square",
  props: {
    valueSquare: {

    },
    selectSquare: {

    }
  },
  setup() {
    const valueButton = ref<string>("");
    const isSelectX = ref<Boolean>(false)
    const selectBox = () => {
      if (isSelectX) {
        isSelectX.value = true
      }
      valueButton.value = "X"
    }
    return {
      valueButton,
      isSelectX,
      selectBox
    };
  },
});
</script>
<style>
.box {
  width: 89px;
  height: 89px;
  border: 1px solid rgb(12, 11, 11);
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: xxx-large;
  text-transform: capitalize;
  cursor: pointer;
  font-weight: 900;
}
</style>
