<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sent Text Messages</div>

                    <div class="card-body">
                        <sent-text-messages :text-messages="sentTextMessages"/>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Send Text Message</div>

                    <div class="card-body">
                        <send-text-message @sent="addSentTextMessage"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SendTextMessage from './SendTextMessage'
    import SentTextMessages from './SentTextMessages'

    export default {
        components: {
            SendTextMessage,
            SentTextMessages
        },

        data: () => ({
            sentTextMessages: []
        }),

        methods: {
            addSentTextMessage(message) {
                this.sentTextMessages.push(message)
                console.log(this.sentTextMessages)
            }
        }
    }
</script>
