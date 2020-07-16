class TextMessageModel {
    constructor(data = {
        id: null,
        message_id: null,
        from: null,
        to: null,
        body: null,
        service_name: null,
        status: null
    }) {
        this.id = data.id
        this.message_id = data.message_id
        this.from = data.from
        this.to = data.to
        this.body = data.body
        this.service_name = data.service_name
        this.status = data.status
    }
}

export default TextMessageModel
