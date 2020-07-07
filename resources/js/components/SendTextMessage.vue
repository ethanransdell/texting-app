<template>
    <div>
        <div class="form-group">
            <label for="to">To</label>
            <input v-model="to" type="tel" class="form-control" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" maxlength="13" placeholder="000-000-0000">
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea v-model="body" class="form-control" placeholder="Enter the body here" maxlength="255"></textarea>
        </div>
        <button type="button" class="btn btn-primary" :disabled="!valid || sending" @click="send">{{ sending ? 'Sending' : 'Send' }}</button>
    </div>
</template>

<script>
    import TextMessageModel from '../models/TextMessageModel'

    export default {
        data: () => ({
            to: '',
            body: '',
            sending: false
        }),

        computed: {
            valid: function () {
                return this.to
                    && this.to.length <= 13
                    && this.to.match(/[0-9]{3}-[0-9]{3}-[0-9]{4}/)
                    && this.body
                    && this.body.length <= 255
            }
        },

        methods: {
            send() {
                this.sending = true

                axios
                    .post('/api/text-messaging/send', {
                        to: this.to,
                        body: this.body
                    })
                    .then(response => {
                        this.$emit('sent', new TextMessageModel(response.data))

                        alert('The text message has been sent')

                        this.reset()
                    })
                    .catch(err => alert(err.response.data.message))
                    .finally(() => this.sending = false)
            },

            reset() {
                this.to = ''
                this.body = ''
            }
        }
    }
</script>
