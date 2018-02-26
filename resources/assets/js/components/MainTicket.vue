<template>
    <div class="mainticket">
        <div class="status">
            <div class="status-column"
                 v-for="(column, index) in columns"
                 :key="index">
                <div class="story"
                     v-if="index === 0">
                    <span class="story-name">{{ main_ticket.ticketName }}</span>
                </div>
                <Ticket v-for="(subtask, task_index) in main_ticket.subTasks"
                     v-if="subtask.status === column"
                     :key="task_index"
                    :subtask="subtask">
                </Ticket>
            </div>
        </div>
    </div>
</template>

<script>
import Ticket from './Ticket';

export default {
  name: 'MainTicket',
  props: ['main_ticket', 'columns'],
  components: { Ticket },
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
    };
  }
};
</script>
