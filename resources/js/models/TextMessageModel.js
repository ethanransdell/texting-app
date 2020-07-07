class TextMessageModel {
    constructor(data = {
        id: null,
        from: null,
        to: null,
        body: null
    }) {
        this.id = data.id
        this.from = data.from
        this.to = data.to
        this.body = data.body
    }
}

export default TextMessageModel
