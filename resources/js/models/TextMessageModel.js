class TextMessageModel {
    constructor(data = {
        id: null,
        message_id: null,
        from: null,
        to: null,
        body: null
    }) {
        this.id = data.id
        this.message_id = data.message_id
        this.from = data.from
        this.to = data.to
        this.body = data.body
    }
}

export default TextMessageModel
