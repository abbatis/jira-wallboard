<template>
    <div class="subtask">
        <span class="subtask-name">{{ subtask.name }}</span>
    </div>
</template>

<script>
export default {
  name: 'Ticket',
  props: ['subtask']
};
</script>
