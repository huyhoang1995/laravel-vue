var notifyServer = "http://172.16.20.180:4000";
const jitsiService = {
    data: {
        login: (account, password) => {
            return {
                account: account || "",
                password: password || ""
            }
        },
    },

    action: {
        login: (data) => {
            let url = siteUrl + "/rest/loginJitsi";
            return axios.post(url, data);
        },
        userInfo: () => {
            let url = siteUrl + "/rest/userInfo";
            return axios.get(url);
        },
        listUser: () => {
            let url = siteUrl + "/rest/listUser";
            return axios.get(url);
        },
        logout: () => {
            let url = siteUrl + "/rest/logout";
            return axios.get(url);
        },
        getNotify: (status) => {
            let url = notifyServer + "/send-notification/" + status ;
            return axios.get(url);
        }

    }

};
export default jitsiService;
