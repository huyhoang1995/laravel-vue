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
    statusLogin: 'statusLogin',
    usersOnline: 'usersOnline',
    callToPer: 'callToPer',
    statusAnswer: 'statusAnswer',
    cancelCall: 'cancelCall',
    endCall: 'endCall',
    hideModalReceiveCall: 'hideModalReceiveCall',
    outOfRoom: 'outOfRoom',
    endMyCall: 'endMyCall'
}
export default config;

