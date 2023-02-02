<template>
  <h1 class="text-center text-3xl font-bold underline text-red-500">
    Game caro
  </h1>
  <div class="flex justify-center items-start gap-10 mt-10">
    <div>
      <h3>{{status}}</h3>
      <Board :x-is-next="xIsNext" :current-state="currentState" @click-square="handleClick"/>
    </div>
    <div>
      <ol>
        <li @click="jumpTo(item.move)" class="cursor-pointer hover:underline" v-for="(item, index) in moves" v-bind:key="index">{{item.desc}}</li>
      </ol>
    </div>
  </div>
</template>
<script lang="ts">
import { computed, defineComponent, reactive, ref, toRefs, watch } from "vue";
import Board from "./Board.vue";
export default defineComponent({
  components: { Board },
  name: "game",
  setup() {
    const state = reactive({
      xIsNext: true,
      history: [Array(9).fill(null)],
      currentStep: 0
    })
    const currentState = computed(() => state.history[state.currentStep])
    const status = computed(() => {
      const squares = currentState.value,
      winner = calculateWinner(squares);
      if (!squares.includes(null)) {
          return 'No one wins';
      }
      if (winner) {
          return 'Winner: ' + winner.value;
      } else {
          return 'Next player: ' + (state.xIsNext ? 'X' : 'O');
      }
    });
    const moves = computed(() => {
      return state.history.map((step, move) => {
        const desc = move ? 'Go to move #' + move : 'Go to game start';
        return {
          step,
          move,
          desc
        };
      });
    });
    const handleClick = (i: number) => {
      const history = state.history.slice(0, state.currentStep + 1)
      const current = history[history.length - 1]
      const squares = current.slice()
      if (squares[i] || calculateWinner(squares)) {
        return
      }
      if (state.xIsNext) {
        squares[i] = 'X'
      } else {
        squares[i] = 'O'
      }

      state.history = history.concat([squares])

      state.xIsNext = !state.xIsNext
      state.currentStep = history.length
    }

    const jumpTo = (step: number) => {
      state.currentStep = step;
      state.xIsNext = step % 2 === 0;
    };

    const calculateWinner = (squares: Array<string | null>) => {
      const lines = [
        [0, 1, 2],
        [3, 4, 5],
        [6, 7, 8],
        [0, 3, 6],
        [1, 4, 7],
        [2, 5, 8],
        [0, 4, 8],
        [2, 4, 6],
      ];
      for (let i = 0; i < lines.length; i++) {
        const [a, b, c] = lines[i];
        if (
          squares[a] &&
          squares[a] === squares[b] &&
          squares[a] === squares[c]
        ) {
          return {
            loc: lines[i],
            value: squares[a],
          };
        }
      }
      return null;
  }
    return {
      ...toRefs(state),
      currentState,
      handleClick,
      moves,
      jumpTo,
      status
    };
  },
});
</script>
