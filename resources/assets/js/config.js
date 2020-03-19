const config = {};

config.server = {
    port: '3003'
}

config.redis = {
    port: 6379,
    host: '127.0.0.1',
    usersOnline: 'usersOnline',
    timeOutOfCall: 'timeOutOfCall'
}

config.socket = {
     login: 'login',
    disconnect: 'disconnect',
    usersOnline: 'usersOnline',
    connecting: "_connecting",
    connected: "_connected",
    timeOutCalling: 'timeoutCalling',
    statusAnswer: 'statusAnswer',
    cancelCall: 'cancelCall',
    hideModalReceiveCall: 'hideModalReceiveCall',
    outOfRoom: 'outOfRoom',
    endMyCall: 'endMyCall',
    endCall: 'endCall'
}
export default config;

