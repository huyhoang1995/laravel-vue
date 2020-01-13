const matrixService = {
    data: {
        loginMatrix: (user, password) => {
            return {
                user: user || "",
                password: password || ""
            }
        },
        createChatRoom: (roomName) => {
            return {
                roomName: roomName || ""
            }
        },
        sendMessage: (message, roomId) => {
            return {
                message: message || "",
                roomId: roomId || "",
            }
        },
        chatRoomHistory: (roomId) => {
            return {
                roomId: roomId || "",
            }
        },
        inviteMember: (roomId, userId) => {
            return {
                roomId: roomId || "",
                userId: userId || "",

            }
        },
        uploadImages: (roomId, nameImages, url) => {
            return {
                roomId: roomId || "",
                nameImages: nameImages || "",
                url: url || "",

            }
        },
        uploadFileCommon: (images) => {
            const params = new FormData();
            params.append("images", images || "");
            return params;
        },

        sendMess: (phoneNumber, content) => {
            return {
                phoneNumber: phoneNumber || "",
                content: content || "",
            }
        }

    },

    action: {
        getClient: () => {
            let url = siteUrl + "/rest/getCLientServer";
            return axios.get(url);
        },
        getEvent: () => {
            let url = siteUrl + "/rest/getEvent";
            return axios.get(url);
        },

        loginMatrix: (data) => {
            let url = siteUrl + "/rest/loginMatrix";
            return axios.post(url, data);
        },
        logoutMatrix: () => {
            let url = siteUrl + "/rest/logoutMatrix";
            return axios.post(url);
        },

        createChatRoom: (data) => {
            let url = siteUrl + "/rest/createChatRoom";
            return axios.post(url, data);
        },

        getListRoom: () => {
            let url = siteUrl + '/rest/getListRoom';
            return axios.get(url);
        },
        sendMessage: (data) => {
            let url = siteUrl + "/rest/sendMessage";
            return axios.post(url, data);
        },
        chatRoomHistory: (data) => {
            let url = siteUrl + "/rest/chatRoomHistory?" + $.param(data, true);
            return axios.get(url);
        },
        getNameRoom: (data) => {
            let url = siteUrl + "/rest/getNameRoom?" + $.param(data, true);
            return axios.get(url);
        },
        listMemberRoom: (data) => {
            let url = siteUrl + "/rest/listMemberRoom?" + $.param(data, true);
            return axios.get(url);
        },
        registerAccount: (data) => {
            let url = siteUrl + "/rest/registerAccount";
            return axios.post(url, data);
        },
        inviteMember: (data) => {
            let url = siteUrl + "/rest/inviteMember";
            return axios.post(url, data);
        },
        joinRoom: (data) => {
            let url = siteUrl + "/rest/joinRoom";
            return axios.post(url, data);
        },
        leaveRoom: (data) => {
            let url = siteUrl + "/rest/leaveRoom";
            return axios.post(url, data);
        },
        tokenRefresh: () => {
            let url = siteUrl + "/rest/tokenRefresh";
            return axios.post(url);
        },
        uploadImages: (data) => {
            let url = siteUrl + "/rest/uploadImages";
            return axios.post(url, data);
        }
        ,
        uploadFileCommon: (data) => {
            var config = {
                headers: {
                    'Content-Type': undefined,
                    'processData': false,
                    'contentType': false
                }
            };
            let url = siteUrl + "/rest/uploadFileCommon";
            return axios.post(url, data, config);

        },
        sendMess: (data) => {
            let url = siteUrl + "/rest/sendMess";
            return axios.post(url, data);

        }
    }

};
export default matrixService;
