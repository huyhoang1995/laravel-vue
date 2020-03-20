<template>
    <div>
        <div class="center-video">

        </div>
        <div class="button-box">
            <i @click="handleHand()"  class="btn btn-default btn-icon btn-circle fa fa-hand-paper-o" :class="{ boxShadow: getShowHand }" aria-hidden="true"></i>
            <i @click="handleSound()" v-if="showHideAudio" class="btn btn-default btn-icon btn-circle fa fa-microphone" aria-hidden="true"></i>
            <i @click="handleSound()" v-if="!showHideAudio" class="btn btn-default btn-icon btn-circle fa fa-microphone-slash" aria-hidden="true"></i>
            <i @click="finishedCall()" class="btn btn-danger btn-icon btn-circle fa fa-phone" aria-hidden="true"></i>
            <i @click="handleVideo()" v-if="showHideVideo" class="btn btn-default btn-icon btn-circle fa fa-video-camera" aria-hidden="true"></i>
            <i @click="handleVideo()" v-if="!showHideVideo" class="btn btn-danger btn-icon btn-circle fa fa-video-camera" aria-hidden="true"></i>
        </div>
    </div>
</template>

<script>

// console.log(nameRoom,'room name');
import config from '../config';


function changeViewCurrentUser(id){
}
const options = {
    hosts: {
        // XMPP domain.
        domain: 'meet.jit.si',
        muc: 'conference.meet.jit.si'
    },
    // BOSH URL. FIXME: use XEP-0156 to discover it.
    bosh: 'https://meet.jit.si/http-bind',

    // The name of client node advertised in XEP-0115 'c' stanza
    clientNode: 'https:///meet.jit.si',
};


// const options = {
//     hosts: {
//         domain: 'jitsi.newtel.com.vn',
//         muc: 'conference.jitsi-meet.example.com' // FIXME: use XEP-0030
//     },
//     bosh: 'https://jitsi.newtel.com.vn/http-bind', // FIXME: use xep-0156 for that

//     // The name of client node advertised in XEP-0115 'c' stanza
//     clientNode: 'https://jitsi.newtel.com.vn/jitsimeet'
// };

const confOptions = {
    openBridgeChannel: true,
};

let connection = null;
let isJoined = false;
let room = null;

let localTracks = [];
const remoteTracks = {};

let nameRoom = "";
let myUserId = "";
let partnerId = "";

let isVideo = true;

let isHand = true;

window.changeViewParticipant = function(id){
    const tracks = remoteTracks[id];

    console.log(tracks, 'track participant')
    for ( var i = 0; i < tracks.length; i++) {
        console.log(tracks[i]);
        if(tracks[i].type == 'video'){
            var dataTrack = tracks[i];     
        }
    }
    $('.bigVideo').remove();

    // change CSS
    $('.view-call-main').children().removeClass('background-black');
    $('.view-call-main').children().children().removeClass('overlay-background');

    $('.video-call-small').children().removeClass('background-black');
    $('.video-call-small').children().children().removeClass('overlay-background');
    
    $(`.${id}`).children().addClass('background-black');
    $(`.${id}`).children().children().addClass('overlay-background');

    // render video main
    window.renderVideoMain(dataTrack);
    
}

window.renderVideoMain = function(track) {
    console.log(track);
    $('.center-video').append(
        `<video autoplay='1' class="view-call-main-big bigVideo" id='' />`
    );
    track.attach($(`.bigVideo`)[0]);
}

window.changeViewCurrentUser = function () {
    $('.bigVideo').remove();

    for (let i = 0; i < localTracks.length; i++) {

        if (localTracks[i].getType() === 'video') {
            $('.center-video').append(`<video autoplay='1' class='view-call-main-big bigVideo' id='' />`);

            localTracks[i].attach($(`.bigVideo`)[0]);
        } else {
            // $('.center-video').append(
            //     `<audio autoplay='1' muted='true' id='localAudio${i}' />`);
            // localTracks[i].attach($(`#localAudio${i}`)[0]);
        }
        if (isJoined) {
            room.addTrack(localTracks[i]);
        }
    }
    
    $('.view-call-main').children().addClass('background-black');
    $('.view-call-main').children().children().addClass('overlay-background');
    $('.video-call-small').children().removeClass('background-black');
    $('.video-call-small').children().children().removeClass('overlay-background');

}
    import openSocket from 'socket.io-client';

export default {
    created() {
        this.$socketServer.socket = openSocket('http://localhost:3003');
    },
    mounted() {
        nameRoom = this.getName('nameRoom');
        myUserId =  parseInt(this.getName('myUserId'));
        partnerId =  parseInt(this.getName('partnerId'));
   
        this.startCall();
        
        this.$socketServer.socket.on(config.socket.endCall, () => {
           console.log('data endCall');
            room.leave();
            connection.disconnect();
            window.close();
        });

    },
    data: function() {
        return {
            getShowHand: false,
            showHideAudio: true,
            showHideVideo: true,
            showChatBox: true,
            listConversation : [],
            message: "",
            timer:0
        }

    },
    methods: {
      
        sendMessage:function(){
            room.sendTextMessage(this.message);
            this.message = "";
            return false;

        },
        getName: function(name) {
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            return results[1] || 0;
        },
        
        startCall: function() {
            $(window).bind('beforeunload', this.unload);
            $(window).bind('unload', this.unload);

            // JitsiMeetJS.setLogLevel(JitsiMeetJS.logLevels.ERROR);
            const initOptions = {
                disableAudioLevels: true,

                // The ID of the jidesha extension for Chrome.
                desktopSharingChromeExtId: 'mbocklcggfhnbahlnepmldehdhpjfcjp',

                // Whether desktop sharing should be disabled on Chrome.
                desktopSharingChromeDisabled: false,

                // The media sources to use when using screen sharing with the Chrome
                // extension.
                desktopSharingChromeSources: ['screen', 'window'],

                // Required version of Chrome extension
                desktopSharingChromeMinExtVersion: '0.1',

                // Whether desktop sharing should be disabled on Firefox.
                desktopSharingFirefoxDisabled: true
            };

            JitsiMeetJS.init(initOptions);

            connection = new JitsiMeetJS.JitsiConnection(null, null, options);

            connection.addEventListener(
                JitsiMeetJS.events.connection.CONNECTION_ESTABLISHED,
                this.onConnectionSuccess);
            connection.addEventListener(
                JitsiMeetJS.events.connection.CONNECTION_FAILED,
                this.onConnectionFailed);
            connection.addEventListener(
                JitsiMeetJS.events.connection.CONNECTION_DISCONNECTED,
                this.disconnect);
            connection.addEventListener(
                JitsiMeetJS.events.connection.CONNECTION_DISCONNECTED,
                this.disconnect);

            JitsiMeetJS.mediaDevices.addEventListener(
                JitsiMeetJS.events.mediaDevices.DEVICE_LIST_CHANGED,
                this.onDeviceListChanged);

            connection.connect();

            JitsiMeetJS.createLocalTracks({ devices: ['audio', 'video'] })
                .then(this.onLocalTracks)
                .catch(error => {
                    throw error;
                });

            if (JitsiMeetJS.mediaDevices.isDeviceChangeAvailable('output')) {
                JitsiMeetJS.mediaDevices.enumerateDevices(devices => {
                    const audioOutputDevices
                        = devices.filter(d => d.kind === 'audiooutput');

                    if (audioOutputDevices.length > 1) {
                        $('#audioOutputSelect').html(
                            audioOutputDevices
                                .map(
                                d =>
                                    `<option value="${d.deviceId}">${d.label}</option>`)
                                .join('\n'));

                        $('#audioOutputSelectWrapper').show();
                    }
                });
            }
        },

     
        onConnectionSuccess: function() {
            console.log('success connection')
            room = connection.initJitsiConference(nameRoom, confOptions);
            room.on(JitsiMeetJS.events.conference.TRACK_ADDED, this.onRemoteTrack);
            room.on(JitsiMeetJS.events.conference.TRACK_REMOVED, track => {
                console.log(`track removed!!!${track}`);
            });
            room.on(
                JitsiMeetJS.events.conference.CONFERENCE_JOINED,
                this.onConferenceJoined);
            room.on(JitsiMeetJS.events.conference.USER_JOINED, id => {
                console.log('user join');
                remoteTracks[id] = [];
            });
            room.on(JitsiMeetJS.events.conference.USER_LEFT, this.onUserLeft);
            room.on(JitsiMeetJS.events.conference.TRACK_MUTE_CHANGED, track => {
                console.log(`${track.getType()} - ${track.isMuted()}`,'checkWhenMuted');
            });
            room.on(
                JitsiMeetJS.events.conference.DISPLAY_NAME_CHANGED,
                (userID, displayName) => console.log(`${userID} - ${displayName}`, 'displayName'));
            room.on(
                JitsiMeetJS.events.conference.TRACK_AUDIO_LEVEL_CHANGED,
                (userID, audioLevel) => console.log(`${userID} - ${audioLevel} showMeVoice`));
            room.on(
                JitsiMeetJS.events.conference.PHONE_NUMBER_CHANGED,
                () => console.log(`${room.getPhoneNumber()} - ${room.getPhonePin()}`));

            // room.on(JitsiMeetJS.events.conference.TALK_WHILE_MUTED , this.talkWhileMuted);
            // room.on(JitsiMeetJS.events.conference.MESSAGE_RECEIVED  , this.messageReceived);
            // room.on(JitsiMeetJS.events.conference.NOISY_MIC   , this.noisyMic);
            
            // check khi nào đối tác tắt bật
            room.on(JitsiMeetJS.events.conference.TRACK_MUTE_CHANGED  , this.muteChange);

            // check đối tác nói 
            // room.on(JitsiMeetJS.events.conference.TRACK_AUDIO_LEVEL_CHANGED, this.handleAudioLevelChanged);
            
            // room.on(JitsiMeetJS.events.conference.PARTICIPANT_PROPERTY_CHANGED, this.handleParticipantPropertyChanged(data, event));

            // bắt sự thay đổi gửi đi từ thành viên khác
            room.on(JitsiMeetJS.events.conference.PARTICIPANT_PROPERTY_CHANGED,  this.handleParticipantPropertyChanged);

            room.join();
            
            // get event participant change 

        },

        // set event show hand
        handleHand:function(){
            room.setLocalParticipantProperty('raisedHand', JSON.stringify(isHand) );
            isHand = !isHand;
            this.getShowHand = !this.getShowHand;
        },


    

        
        // get event showhand 
        handleParticipantPropertyChanged:function(data, event){
            if(data._properties.raisedHand == 'true') {
                $(`.${data._id}hand`).removeClass('hide-class');
            }else{
                $(`.${data._id}hand`).addClass('hide-class');
            }   
   
        },
        handleAudioLevelChanged:function(participantId,audioLevel){
            console.log('active sound',participantId, audioLevel )
        },

        muteChange:function(tracks){
            console.log(tracks, 'checkMuteChange')
            if(tracks.muted == true){
                $(`.${tracks.ownerEndpointId}`).children().first().removeClass('hide-class');
            }else{
                $(`.${tracks.ownerEndpointId}`).children().first().addClass('hide-class');
            }
            
        },

        noisyMic:function(){
            console.log('micNoisy')
        },
        
        messageReceived:function(id, text, ts){
            console.log(id, text, ts,'track message')
            this.listConversation.push({
                'id': id,
                'text':text
            })
        },
        talkWhileMuted:function(track){
            console.log(track)
            console.log('muted voice')
        },

        onConnectionFailed: function() {
            console.error('Connection Failed!');
        },


        disconnect: function() {
            console.log('disconnect!');
            connection.removeEventListener(
                JitsiMeetJS.events.connection.CONNECTION_ESTABLISHED,
                onConnectionSuccess);
            connection.removeEventListener(
                JitsiMeetJS.events.connection.CONNECTION_FAILED,
                onConnectionFailed);
            connection.removeEventListener(
                JitsiMeetJS.events.connection.CONNECTION_DISCONNECTED,
                dWisconnect);
        },
        unload: function() {
            for (let i = 0; i < localTracks.length; i++) {
                localTracks[i].dispose();
            }
            room.leave();
            connection.disconnect();
        },
        onLocalTracks: function(tracks) {
            localTracks = tracks ;  
            for (let i = 0; i < localTracks.length; i++) {
                localTracks[i].addEventListener(
                    JitsiMeetJS.events.track.TRACK_AUDIO_LEVEL_CHANGED,
                    audioLevel => console.log(`Audio Level local: ${audioLevel}`));
                localTracks[i].addEventListener(
                    JitsiMeetJS.events.track.TRACK_MUTE_CHANGED,
                    () => console.log('local track muted'));
                localTracks[i].addEventListener(
                    JitsiMeetJS.events.track.LOCAL_TRACK_STOPPED,
                    () => console.log('local track stoped'));
                localTracks[i].addEventListener(
                    JitsiMeetJS.events.track.TRACK_AUDIO_OUTPUT_CHANGED,
                    deviceId =>
                        console.log(
                            `track audio output device was changed to ${deviceId}`));
                
                if (localTracks[i].getType() === 'video') {
                    $('body').append(`
                        <div class='view-call-main' onclick="changeViewCurrentUser()">
                            <div class="video-box" >
                                <div class="video-over-layout">
                                    <video autoplay='1' style="width:100%;" id='localVideo${i}' />
                                </div>
                            </div>
                        </div>
                    `);
                    localTracks[i].attach($(`#localVideo${i}`)[0]);
                    window.changeViewCurrentUser();

                } else {
                    $('.center-video').append(
                        `<audio autoplay='1' muted='true' id='localAudio${i}' />`);
                    localTracks[i].attach($(`#localAudio${i}`)[0]);
                }
                if (isJoined) {
                    room.addTrack(localTracks[i]);
                }
            }
        },
        onRemoteTrack: function(track) {

            // handleVideoTrack(track);

            if (track.isLocal()) {
                return;
            }
            const participant = track.getParticipantId();

            if (!remoteTracks[participant]) {
                remoteTracks[participant] = [];
            }

            const idx = remoteTracks[participant].push(track);
            track.addEventListener(
                JitsiMeetJS.events.track.TRACK_AUDIO_LEVEL_CHANGED,
                audioLevel => console.log(`Audio Level remote: ${audioLevel}`));
            track.addEventListener(
                JitsiMeetJS.events.track.TRACK_MUTE_CHANGED,
                () => console.log('remote track muted'));
            track.addEventListener(
                JitsiMeetJS.events.track.LOCAL_TRACK_STOPPED,
                () => console.log('remote track stoped'));
            track.addEventListener(JitsiMeetJS.events.track.TRACK_AUDIO_OUTPUT_CHANGED,
                deviceId =>
                    console.log(
                        `track audio output device was changed to ${deviceId}`));
            const id = participant + track.getType() + idx;
            
            console.log(track, 'track remote',participant);


            if (track.getType() === 'video') {

                $('.participant-overview').append(
                        `<div class="video-call-small ${participant} hello">
                            <i class="fa fa-microphone-slash icon-slash-micro hide-class" aria-hidden="true"></i>
                            <i class="fa fa-hand-paper-o icon-hand ${participant}hand hide-class" aria-hidden="true"></i>
                            <div class="video-box-participant background-black"  onclick="changeViewParticipant('${participant}')">
                                <div class="video-over-layout overlay-background">
                                    <video autoplay='1' style="width:100%; " id='${participant}video${idx}'/>
                                </div>
                            </div>
                        </div>`
                );
               
            } else {
                $('body').append(
                    `<audio autoplay='1' id='${participant}audio${idx}' />`);
            }
         
 
            
            track.attach($(`#${id}`)[0]);

            this.renderVideoMain(track,participant);
            
           
        },
        removeClassMicro:function(track,participant){
            $( document ).ready(function() {

                if(track.isMuted()){
                    $(`.${participant}`).children().removeClass('hide-class');
                }
            });

        },
        renderVideoMain: function(track,participant) {
            $('.center-video').append(
                `<video autoplay='1' class="view-call-main-big bigVideo" id='' />`
            );
            track.attach($(`.bigVideo`)[0]);
            window.changeViewParticipant(participant);
            this.removeClassMicro(track,participant);
        },
        handleSound: function() {
            for (var index = 0; index < localTracks.length; index++) {
                if (localTracks[index].type == 'audio') {
                    // localTracks[index].track.muted = true;
                    // localTracks[index].track.enabled = !localTracks[index].track.enabled;

                    if(localTracks[index].track.enabled == true){
                        localTracks[index].mute();
                    }else{
                        localTracks[index].unmute();
                    }
                    this.showHideAudio = !this.showHideAudio;

                };

            }

        },

        finishedCall: function() {
            this.$socketServer.socket.emit(config.socket.endCall, {
                myUserId: myUserId,
                partnerId: partnerId
            });
            
            room.leave();
            connection.disconnect();
            window.close();
        },
        // function mute
        handleVideo: function() {
            console.log(localTracks);
            for (var index = 0; index < localTracks.length; index++) {
                if (localTracks[index].type == 'video') {
                    // localTracks[index].track.muted = true;
                    localTracks[index].track.enabled = !localTracks[index].track.enabled;
                    this.showHideVideo = !this.showHideVideo;
                };
            }
        },

        onDeviceListChanged: function(devices) {
            console.info('current devices', devices);
        },

        // khi người dùng tham gia phòng họp
        onConferenceJoined: function() {
            console.log('conference joined!');
            isJoined = true;
            for (let i = 0; i < localTracks.length; i++) {
                room.addTrack(localTracks[i]);
            }
        },

        // khi người dùng rời phòng họp
        onUserLeft: function(id) {
            if (!remoteTracks[id]) {
                return;
            }
            $(`.${id}`).remove();
            window.changeViewCurrentUser();
            const tracks = remoteTracks[id];
            console.log(tracks , 'userLeftTrack');
            for (let i = 0; i < tracks.length; i++) {
                tracks[i].detach($(`#${id}${tracks[i].getType()}`));
                console.log(`#${id}${tracks[i].getType()}`,'userLeftID');
            }
        },

        changeViewOtherUser: function(id) {
            console.log('12312312321');
            $("#biglocalVideo").remove();

            $('.view-call-main').children().removeClass('background-black');
            $('.view-call-main').children().children().removeClass('overlay-background');
            $('.video-call-small').children().addClass('background-black');
            $('.video-call-small').children().children().addClass('overlay-background');
        },

        changeViewCurrentUser: function() {

            console.log('remove class ');
            for (let i = 0; i < localTracks.length; i++) {

                if (localTracks[i].getType() === 'video') {
                    $('.center-video').append(`<video autoplay='1' class='view-call-main-big bigVideo' id='' />`);

                    localTracks[i].attach($(`.bigVideo`)[0]);
                } else {
                    // $('.center-video').append(
                    //     `<audio autoplay='1' muted='true' id='localAudio${i}' />`);
                    // localTracks[i].attach($(`#localAudio${i}`)[0]);
                }
                if (isJoined) {
                    room.addTrack(localTracks[i]);
                }
            }

            $('.view-call-main').children().addClass('background-black');
            $('.view-call-main').children().children().addClass('overlay-background');
            $('.video-call-small').children().removeClass('background-black');
            $('.video-call-small').children().children().removeClass('overlay-background');
        }

    },
    components: {
    }
};


</script>
