<template>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Message ID</th>
            <th scope="col">From</th>
            <th scope="col">To</th>
            <th scope="col">Body</th>
            <th scope="col">Service Name</th>
        </tr>
        </thead>
        <tbody>
        <tr v-if="!textMessages.length">
            <td colspan="4" class="text-center">None Found</td>
        </tr>
        <text-message-row
            v-for="(textMessage, index) in textMessages"
            :key="index"
            :text-message="textMessage"/>
        </tbody>
    </table>
</template>

<script>
    import TextMessageRow from './TextMessageRow'

    export default {
        components: {
            TextMessageRow
        },

        props: {
            textMessages: {
                type: Array,
                default: []
            }
        }
    }
</script>
