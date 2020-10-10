<template>
    <div class="chat">
        hello
    </div>
</template>
<script>
import Pusher from 'pusher-js';

export default {
    created() {
        const vm = this;
        Pusher.logToConsole = true;

        var pusher = new Pusher('7507a52e135072b8b260', {
            cluster: 'ap2',
            forceTLS: true
        });

        
    }
}
</script>
<style>
</style>