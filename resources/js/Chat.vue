
<template>
    <div class = "">
        <div class = "">
        <textarea v-model="messages"></textarea>
        <input class = "form-control" type="text" v-model = "textMessage" @keyup.enter = "sendMessage">
        </div>
    </div>
</template>

<script>
export default {

    data() {
        return {
            messages: [],
            textMessage: ''
        }
    },
    mounted() {
        window.Echo.channel('chat')
            .listen('Message', ({message}) => {
                this.messages.push(message.body)
            });
    },
    methods: {
        sendMessage() {
            axios.post('/messages', {body: this.textMessage});

            this.messages.push(this.textMessage);

            this.textMessage = '';
        }
    }



}
</script>
