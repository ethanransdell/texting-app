<template>
    <tr>
        <td :title="textMessage.message_id">{{ textMessage.message_id.substring(0, 5) }}...</td>
        <td>{{ textMessage.from }}</td>
        <td>{{ textMessage.to }}</td>
        <td>
            <p>{{ textMessage.body }}</p>
        </td>
        <td>{{ textMessage.service_name }}</td>
        <td>{{ textMessage.status }}</td>
        <td>
            <button class="btn btn-sm btn-primary" @click="$emit('refresh', textMessage)">Click...</button>
        </td>
    </tr>
</template>

<script>
    import TextMessageModel from '../models/TextMessageModel'

    export default {
        props: {
            textMessage: {
                type: TextMessageModel,
                default: null
            }
        }
    }
</script>
