<template>
    <div class="row col-sm-12">
        <div id="page-head">
        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

        <div id="page-title">
            <h1 class="page-header text-overflow">JitSi login</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->
        </div>
        <div class="welcome">
            <div class="box-enter">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form >
                            <legend class="col-md-12">Start a new meeting</legend>

                            <span class="col-md-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="" placeholder="Nhập tên" v-model="name">
                                </div>
                            </span>
                            <span class="col-md-2">
                                <router-link :to="{name: 'jitsiComponent', params: {name:name}}"class="btn btn-primary">GO</router-link>
                            </span>
                        </form>
                        <button @click="joinRoom()">JOIN ROOM</button>

                    </div>
                </div>
            </div>
        </div>   
    </div>
</template>

<script>
const options = {
    hosts: {
        // XMPP domain.
        domain: 'jitsi.newtel.com.vn',

        // When using authentication, domain for guest users.
        // anonymousdomain: 'guest.example.com',

        // Domain for authenticated users. Defaults to <domain>.
        // authdomain: 'jitsi.newtel.com.vn',

        // Jirecon recording component domain.
        // jirecon: 'jirecon.jitsi.newtel.com.vn',

        // Call control component (Jigasi).
        // call_control: 'callcontrol.jitsi.newtel.com.vn',

        // Focus component domain. Defaults to focus.<domain>.
        // focus: 'focus.jitsi.newtel.com.vn',

        // XMPP MUC domain. FIXME: use XEP-0030 to discover it.
        muc: 'conference.jitsi.newtel.com.vn'
    },
    // BOSH URL. FIXME: use XEP-0156 to discover it.
    bosh: '//jitsi.newtel.com.vn/http-bind',

    // The name of client node advertised in XEP-0115 'c' stanza
    clientNode: 'http://jitsi.org/jitsimeet',
};

const confOptions = {
    openBridgeChannel: true
};

let connection = null;
let isJoined = false;
let room = null;

let localTracks = [];
const remoteTracks = {};

const JitsiMeetJS = window.JitsiMeetJS;

export default {
    mounted() {
        // this.startCall();
    },
    data: function() {
        return {
            name: ""
        }
        
    },
    methods: {

        joinRoom:function(){
            let connection =  new JitsiMeetJS.JitsiConnection(null, null, options);
            connection.connect();

            console.log(connection,'joinRoom');

            let room = connection.initJitsiConference('hoang', confOptions);
            console.log(room);
        },

        loginJitsi:function(){
            console.log(123213);
            window.location.href= siteUrl + '/jitsiComponent';
        }

    },
    components: {
    }
};
</script>
