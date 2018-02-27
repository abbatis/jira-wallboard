<template>
    <div class="subtask">
        <span class="subtask-name"><span style="text-decoration: underline;">{{ subtask.key }}</span> {{ subtask.name }}</span>
        <span class="subtask-image" v-if="subtask.assignee && subtask.assignee.avatarUrls">
            <img :src="subtask.assignee.avatarUrls['48x48']" />
        </span>
        <span class="subtask-image" v-if="!subtask.assignee || !subtask.assignee.avatarUrls">
            <img :src="subtask.reporter.avatarUrls['48x48']" />
        </span>
        <hr />
        <span class="subtask-assignee"><strong>Assignee</strong>
            {{ subtask.assignee ? subtask.assignee.displayName : "None" }}</span><br />
        <span class="subtask-reporter"><strong>Reporter</strong>
            {{ subtask.reporter ? subtask.reporter.displayName : "None" }}</span>
    </div>
</template>

<script>
export default {
  name: 'Ticket',
  props: ['subtask']
};
</script>
