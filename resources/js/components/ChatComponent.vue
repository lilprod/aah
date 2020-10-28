<template>
    <div class="chat-window">
						
        <!-- Chat Left -->
        <div class="chat-cont-left">
            <div class="chat-header">
                <span>Chats</span>
                <a href="javascript:void(0)" class="chat-compose">
                    <i class="material-icons">control_point</i>
                </a>
            </div>
            <form class="chat-search">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <i class="fas fa-search"></i>
                    </div>
                    <input type="text" class="form-control" placeholder="Search">
                </div>
            </form>
                <div class="chat-users-list">
                    <div class="chat-scroll">
                        <a href="javascript:void(0);" class="media"  v-for="(user, index) in users" :key="index">
                            <div class="media-img-wrap">
                                <div class="avatar avatar-away">
                                    <img src="assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" class="avatar-img rounded-circle">
                                </div>
                            </div>
                            <div class="media-body">
                                <div>
                                    <div class="user-name">{{ user.name }}</div>
                                    <!--<div class="user-last-chat">Hey, How are you?</div>-->
                                </div>
                                <!--<div>
                                    <div class="last-chat-time block">2 min</div>
                                    <div class="badge badge-success badge-pill">15</div>
                                </div>-->
                            </div>
                        </a>
                </div>
            </div>
        </div>
        <!-- /Chat Left -->
    
        <!-- Chat Right -->
        <div class="chat-cont-right">
            <div class="chat-header">
                <a id="back_user_list" href="javascript:void(0)" class="back-user-list">
                    <i class="material-icons">chevron_left</i>
                </a>
                <div class="media">
                    <div class="media-img-wrap">
                        <div class="avatar avatar-online">
                            <img src="assets/img/doctors/doctor-thumb-02.jpg" alt="User Image" class="avatar-img rounded-circle">
                        </div>
                    </div>
                    <div class="media-body">
                        <div class="user-name">Dr. {{ user.name }}</div>
                        <div class="user-status">online</div>
                    </div>
                </div>
                <div class="chat-options">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#voice_call">
                        <i class="material-icons">local_phone</i>
                    </a>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#video_call">
                        <i class="material-icons">videocam</i>
                    </a>
                    <a href="javascript:void(0)">
                        <i class="material-icons">more_vert</i>
                    </a>
                </div>
            </div>
            <div class="chat-body">
                <div class="chat-scroll">
                    <ul class="list-unstyled" style="height:300px; overflow-y:scroll" v-chat-scroll>
                        
                        <li class="media received" v-for="(message, index) in messages" :key="index">
                            <div class="avatar">
                                <img :src="message.user.profile_picture" alt="User Image" class="avatar-img rounded-circle">
                            </div>
                            <div class="media-body">
                                <div class="msg-box">
                                    <div>
                                        <p>{{ message.message }}</p>
                                        <ul class="chat-msg-info">
                                            <li>
                                                <div class="chat-time">
                                                    <span>8:35 AM</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                    </ul>
                </div>
            </div>
            <div class="chat-footer">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="btn-file btn">
                            <i class="fa fa-paperclip"></i>
                            <input type="file">
                        </div>
                    </div>
                    <!--<input type="text" class="input-msg-send form-control" placeholder="Type something">-->
                    <input
                    @keydown="sendTypingEvent"
                    @keyup.enter="sendMessage"
                    v-model="newMessage"
                    type="text"
                    name="message"
                    placeholder="Enter your message..."
                    class="input-msg-send form-control">
                    <div class="input-group-append">
                        <button type="button" class="btn msg-send-btn"><i class="fab fa-telegram-plane"></i></button>
                    </div>
                </div>
                <span class="text-muted" v-if="activeUser" >{{ activeUser.name }} is typing...</span>
            </div>
        </div>
        <!-- /Chat Right -->
        
    </div>
</template>

<script>
    export default {
        props:['user'],
        data() {
            return {
                messages: [],
                newMessage: '',
                users:[],
                activeUser: false,
                typingTimer: false,
            }
        },
        created() {
            this.fetchMessages();
            Echo.join('chat')
                .here(user => {
                    this.users = user;
                })
                .joining(user => {
                    this.users.push(user);
                })
                .leaving(user => {
                    this.users = this.users.filter(u => u.id != user.id);
                })
                .listen('ChatEvent',(event) => {
                    this.messages.push(event.chat);
                })
                .listenForWhisper('typing', user => {
                   this.activeUser = user;
                    if(this.typingTimer) {
                        clearTimeout(this.typingTimer);
                    }
                   this.typingTimer = setTimeout(() => {
                       this.activeUser = false;
                   }, 1000);
                })
        },
        methods: {
            fetchMessages() {
                axios.get('messages').then(response => {
                    this.messages = response.data;
                })
            },
            sendMessage() {
                this.messages.push({
                    user: this.user,
                    message: this.newMessage
                });
                axios.post('messages', {message: this.newMessage});
                this.newMessage = '';
            },
            sendTypingEvent() {
                Echo.join('chat')
                    .whisper('typing', this.user);
                console.log(this.user.name + ' is typing now')
            }
        }
    }
</script> 