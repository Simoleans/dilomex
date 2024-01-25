<script setup>
import {onMounted} from "vue";

const props = defineProps({
    message: String,
    type: {
        type: String,
        default: "success"
    },
    duration: {
        type: Number,
        default: 2000
    }
});


onMounted(() => {
  setTimeout(() => emit("remove"), props.duration);
});

const emit = defineEmits(["remove"]);
</script>
<template>
  <div
    class="flex items-center rounded-lg p-5  shadow-lg"
    role="alert"
    :class="{
      'bg-green-500 text-green-100 dark:bg-green-800 dark:text-green-200': props.type === 'success',
      'bg-red-500 text-red-100 dark:bg-red-800 dark:text-red-200': props.type === 'error',
      'bg-yellow-500 text-yellow-100 dark:bg-yellow-800 dark:text-yellow-200': props.type === 'warning',
      'bg-blue-500 text-blue-100 dark:bg-blue-800 dark:text-blue-200': props.type === 'info',
    }"
  >
    <div
      class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg  dark:text-blue-200"
      :class="{
        'bg-green-100 text-green-500 dark:bg-green-800 dark:text-green-200': props.type === 'success',
        'bg-red-100 text-red-500 dark:bg-red-800 dark:text-red-200': props.type === 'error',
        'bg-yellow-100 text-yellow-500 dark:bg-yellow-800 dark:text-yellow-200': props.type === 'warning',
        'bg-blue-100 text-blue-500 dark:bg-blue-800 dark:text-blue-200': props.type === 'info',
      }"
    >
      <svg
        aria-hidden="true"
        class="h-5 w-5"
        fill="currentColor"
        viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          fill-rule="evenodd"
          d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
          clip-rule="evenodd"
        ></path>
      </svg>
      <span class="sr-only">Fire icon</span>
    </div>
    <div class="ml-3 text-sm font-normal">{{ props.message }}</div>
    <button
      @click="emit('remove')"
      type="button"
      class="-mx-1.5 -my-1.5 ml-auto inline-flex h-8 w-8 rounded-lg bg-white p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-800 dark:text-gray-500 dark:hover:bg-gray-700 dark:hover:text-white"
      data-dismiss-target="#toast-default"
      aria-label="Close"
    >
      <span class="sr-only">Close</span>
      <svg
        aria-hidden="true"
        class="h-5 w-5"
        fill="currentColor"
        viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          fill-rule="evenodd"
          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
          clip-rule="evenodd"
        ></path>
      </svg>
    </button>
  </div>
</template>
