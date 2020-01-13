<template>
    <div class="row col-sm-12">
        <div id="page-head">
        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

        <div id="page-title">
            <h1 class="page-header text-overflow">JitSi</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->
        </div>
        
        <div class="center-video"></div>

        <div>
            <button @click="endCall()"> cancel call</button>
        </div>

    </div>
</template>

<script>
const options = {
    hosts: {
        // XMPP domain.
        domain: 'meet.jit.si',

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
        muc: 'conference.meet.jit.si'
    },
    // BOSH URL. FIXME: use XEP-0156 to discover it.
    bosh: 'https://meet.jit.si/http-bind',

    // The name of client node advertised in XEP-0115 'c' stanza
    clientNode: 'https://jitsi.org/jitsimeet',
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
        this.startCall();
    },
    data: function() {
        return {
        
        }
        
    },
    methods: {
        startCall: function(){
            console.log('start call');
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
                desktopSharingChromeSources: [ 'screen', 'window' ],

                // Required version of Chrome extension
                desktopSharingChromeMinExtVersion: '0.1',

                // Whether desktop sharing should be disabled on Firefox.
                desktopSharingFirefoxDisabled: true
            };

            JitsiMeetJS.init(initOptions);
            let connection =  new JitsiMeetJS.JitsiConnection(null, null, options);

            connection.addEventListener( JitsiMeetJS.events.connection.CONNECTION_ESTABLISHED,this.onConnectionSuccess);
            connection.addEventListener( JitsiMeetJS.events.connection.CONNECTION_FAILED,this.onConnectionFailed);
            connection.addEventListener( JitsiMeetJS.events.connection.CONNECTION_DISCONNECTED,this.disconnect);

            JitsiMeetJS.mediaDevices.addEventListener(
                JitsiMeetJS.events.mediaDevices.DEVICE_LIST_CHANGED,
                this.onDeviceListChanged);

            connection.connect();
            JitsiMeetJS.createLocalTracks({ devices: [ 'audio', 'video' ] })
            .then(this.onLocalTracks)
            .catch(error => {
                throw error;
            });


            if (JitsiMeetJS.mediaDevices.isDeviceChangeAvailable('output')) {
                JitsiMeetJS.mediaDevices.enumerateDevices(devices => {
                    const audioOutputDevices = devices.filter(d => d.kind === 'audiooutput');

                    if (audioOutputDevices.length > 1) {
                        $('#audioOutputSelect').html(audioOutputDevices.map(d =>`<option value="${d.deviceId}">${d.label}</option>`).join('\n'));

                        $('#audioOutputSelectWrapper').show();
                    }
                });
            }

        },
        onLocalTracks: function(tracks) {
            console.log('call start');
            let localTracks = tracks;
            console.log(localTracks);
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
                    deviceId => console.log(`track audio output device was changed to ${deviceId}`));
                if (localTracks[i].getType() === 'video') {
                    $('.center-video').append(`<video autoplay='1' id='localVideo${i}' style="width:100%; min-height:100vh" />`);
                    localTracks[i].attach($(`#localVideo${i}`)[0]);
                } else {
                    $('.center-video').append(`<audio autoplay='1' muted='true' id='localAudio${i}' />`);
                    localTracks[i].attach($(`#localAudio${i}`)[0]);
                }
                if (isJoined) {
                    room.addTrack(localTracks[i]);
                }
            }
        },
        unload:function() {
            for (let i = 0; i < localTracks.length; i++) {
                localTracks[i].dispose();
            }
            room.leave();
            connection.disconnect();
        },
        onConnectionSuccess:function() {
            console.log('connect room');
            let connection =  new JitsiMeetJS.JitsiConnection(null, null, options);
            room = connection.initJitsiConference('huyhoang', confOptions);
            console.log(room,'onConnectionSuccess');
            room.on(JitsiMeetJS.events.conference.TRACK_ADDED, this.onRemoteTrack);
            room.on(JitsiMeetJS.events.conference.TRACK_REMOVED, track => {
                console.log(`track removed!!!${track}`);
            });
            room.on(
                JitsiMeetJS.events.conference.CONFERENCE_JOINED,
                onConferenceJoined);
            room.on(JitsiMeetJS.events.conference.USER_JOINED, id => {
                console.log('user join');
                remoteTracks[id] = [];
            });
            room.on(JitsiMeetJS.events.conference.USER_LEFT, onUserLeft);
            room.on(JitsiMeetJS.events.conference.TRACK_MUTE_CHANGED, track => {
                console.log(`${track.getType()} - ${track.isMuted()}`);
            });
            room.on(
                JitsiMeetJS.events.conference.DISPLAY_NAME_CHANGED,
                (userID, displayName) => console.log(`${userID} - ${displayName}`));
            room.on(
                JitsiMeetJS.events.conference.TRACK_AUDIO_LEVEL_CHANGED,
                (userID, audioLevel) => console.log(`${userID} - ${audioLevel}`));
            room.on(
                JitsiMeetJS.events.conference.PHONE_NUMBER_CHANGED,
                () => console.log(`${room.getPhoneNumber()} - ${room.getPhonePin()}`));
            room.join();
        },

        /**
        * This function is called when the connection fail.
        */
        onConnectionFailed:function() {
            console.error('Connection Failed!');
        },

        /**
        * This function is called when the connection fail.
        */
        onDeviceListChanged:function(devices) {
            console.info('current devices', devices);
        },
        
        disconnect:function() {
            console.log('disconnect!');
            let connection =  new JitsiMeetJS.JitsiConnection(null, null, options);

            connection.removeEventListener(
                JitsiMeetJS.events.connection.CONNECTION_ESTABLISHED,
                this.onConnectionSuccess);
            connection.removeEventListener(
                JitsiMeetJS.events.connection.CONNECTION_FAILED,
                 this.onConnectionFailed);
            connection.removeEventListener(
                JitsiMeetJS.events.connection.CONNECTION_DISCONNECTED,
                 this.disconnect);
        },
        onRemoteTrack:function(track) {
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

            if (track.getType() === 'video') {
                $('body').append(
                    `<video autoplay='1' id='${participant}video${idx}' />`);
            } else {
                $('body').append(
                    `<audio autoplay='1' id='${participant}audio${idx}' />`);
            }
            track.attach($(`#${id}`)[0]);
        },
        endCall:function(){
            let connection =  new JitsiMeetJS.JitsiConnection(null, null, options);
            console.log(connection);
            connection.addEventListener( JitsiMeetJS.events.conference.USER_JOINED,this.disconnect());
        }

    },
    components: {
    }
};
</script>
