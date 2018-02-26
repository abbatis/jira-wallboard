<template>
    <div id="dashboard">
        <h1>{{ msg }}</h1>
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
      return [
        {
          'ticketName': 'Ticket Main one',
          'subTasks': [
            {
              'name': 'subtask one',
              'status': 'Done',
              'assignee': 'martijn'
            },
            {
              'name': 'subtask two',
              'status': 'UAT',
              'assignee': 'martijn'
            },
            {
              'name': 'subtask three',
              'status': 'Code Review',
              'assignee': 'martijn'
            }
          ]
        },
        {
          'ticketName': 'Ticket Main two',
          'subTasks': [
            {
              'name': 'story2 sub1',
              'status': 'In Progress',
              'assignee': 'martijn'
            },
            {
              'name': 'story2 sub2',
              'status': 'Done',
              'assignee': 'martijn'
            },
            {
              'name': 'story2 sub3',
              'status': 'In Progress',
              'assignee': 'martijn'
            }
          ]
        },
        {
          'ticketName': 'Ticket Main three',
          'subTasks': [
            {
              'name': 'story3 sub1',
              'status': 'Test',
              'assignee': 'martijn'
            },
            {
              'name': 'story3 sub2',
              'status': 'UAT',
              'assignee': 'martijn'
            },
            {
              'name': 'story3 sub3',
              'status': 'UAT',
              'assignee': 'martijn'
            },
            {
              'name': 'story3 sub3',
              'status': 'UAT',
              'assignee': 'martijn'
            },
            {
              'name': 'story3 sub3',
              'status': 'UAT',
              'assignee': 'martijn'
            },
            {
              'name': 'story3 sub3',
              'status': 'UAT',
              'assignee': 'martijn'
            },
            {
              'name': 'story3 sub3',
              'status': 'UAT',
              'assignee': 'martijn'
            },
            {
              'name': 'story3 sub3',
              'status': 'UAT',
              'assignee': 'martijn'
            }
          ]
        }
      ];
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

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
