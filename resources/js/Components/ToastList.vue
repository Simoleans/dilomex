<script setup>
import ToastListItem from "@/Components/ToastListItem.vue";
import {onUnmounted, ref} from "vue";
import toast from "@/Stores/toast"



/* et removeFinshEventListener = Inertia.on("finish", () => {
  if (page.props.value.toast) {
    toast.add({
      message: page.props.value.toast,
    });
  }
});

onUnmounted(() => removeFinshEventListener()); */

function remove(index) {
  toast.remove(index);
}

</script>
<template>
  <TransitionGroup
    tag="div"
    enter-from-class="translate-x-full opacity-0"
    enter-active-class="duration-500"
    leave-active-class="duration-500"
    leave-to-class="translate-x-full opacity-0"
    class="fixed top-4 right-4 z-50 w-full max-w-xs space-y-4">
    <ToastListItem
      v-for="(item, index) in toast.items"
      :key="item.key"
      :message="item.message"
      :duration="2000"
      @remove="remove(index)"
        :type="item.type"
    />
  </TransitionGroup>
</template>
