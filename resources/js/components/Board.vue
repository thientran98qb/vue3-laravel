<template>
  <div class="container mx-auto">
    <div class="grid grid-cols-3">
      <square
        v-for="(item, index) in currentState"
        v-bind:key="index"
        v-bind:value-square="item"
        @click="clickOnSquare(index)"
      />
    </div>
  </div>
</template>
<script lang="ts">
import { defineComponent, ref, watch } from "vue";
import Square from "./Square.vue";
export default defineComponent({
  components: {
    Square,
  },
  props: {
    xIsNext: {},
    currentState: Array
  },
  setup(props, context) {
    const clickOnSquare = (i: number) => {
      context.emit('click-square', i)
    }
    // const calcWinner = (squares: any) => {
    //   const lines = [
    //     [0, 1, 2],
    //     [3, 4, 5],
    //     [6, 7, 8],
    //     [0, 3, 6],
    //     [1, 4, 7],
    //     [2, 5, 8],
    //     [0, 4, 8],
    //     [2, 4, 6]
    //   ];
    //   for (let i = 0; i < lines.length; i++) {
    //     const [a, b, c] = lines[i];
    //     if (squares[a] && squares[a] === squares[b] && squares[a] === squares[c]) {
    //       return squares[a];
    //     }
    //   }
    //   return null;
    // }
    return {
      clickOnSquare
    };
  }
});
</script>
