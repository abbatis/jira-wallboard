<template>
    <div id="dashboard">
        <!--<h1>{{ msg }}</h1>-->
        <div class="status">
            <div class="status-column status-column--header"
                 v-for="(column, index) in columns"
                 :key="index">
                {{ column }}
            </div>
        </div>
        <MainTicket v-for="(ticket, index) in tickets"
                    :key="index"
                    :main_ticket="ticket"
                    :columns="columns">
        </MainTicket>
    </div>
</template>

<script>
import MainTicket from './MainTicket';

export default {
  name: 'Dashboard',
  components: { MainTicket },
  data () {
    return {
      msg: 'Gazelle B2C Dashboard'
    };
  },
  computed: {
    tickets () {
        console.log(window.jiraCollection);
        return window.jiraCollection.issueCollection;
    },
    columns () {
      return [
        'Story',
        'ToDo',
        'In Progress',
        'Code Review',
        'Test',
        'UAT',
        'Done'
      ];
    }
  }
};
</script>
