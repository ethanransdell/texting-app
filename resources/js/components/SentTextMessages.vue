<template>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Message ID</th>
            <th scope="col">From</th>
            <th scope="col">To</th>
            <th scope="col">Body</th>
            <th scope="col">Service Name</th>
            <th scope="col">Status</th>
            <th scope="col">Refresh</th>
        </tr>
        </thead>
        <tbody>
        <tr v-if="!textMessages.length">
            <td colspan="7" class="text-center">None Found</td>
        </tr>
        <text-message-row
            v-for="(textMessage, index) in textMessages"
            :key="index"
            :text-message="textMessage"
            @refresh="refresh"/>
        </tbody>
    </table>
</template>

<script>
    import TextMessageRow from './TextMessageRow'
    import TextMessageModel from '../models/TextMessageModel'

    export default {
        components: {
            TextMessageRow
        },

        props: {
            textMessages: {
                type: Array,
                default: []
            }
        },

        methods: {
            refresh(textMessage) {
                axios
                    .post('/api/text-messaging/' + textMessage.id + '/refresh')
                    .then(response => Vue.set(this.textMessages, this.textMessages.indexOf(textMessage), new TextMessageModel(response.data)))
                    .catch(err => alert(err.response.data.message))
            }
        }
    }
</script>
