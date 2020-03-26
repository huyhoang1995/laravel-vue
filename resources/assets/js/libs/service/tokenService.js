let notifyServer = "http://172.16.20.192:3000/api/v1/";
let tokenJWT = localStorage.getItem('token');
let headers = {
    "Content-Type": "application/json",
    "Accept-Type": "application/json",
    "Authorization": "Bearer " + tokenJWT
}
const jitsiService = {
    data: {
    },
    action: {
        insertToken: () => {
            let url = notifyServer + "token";
            let tokenFirebase = localStorage.getItem('FirebaseToken'); 
            let _data = {
                token: tokenFirebase,
                type: "fcm"
            }
            return axios.post(url, _data, { headers: headers });
        },
        deleteToken: () => {
            let url = notifyServer + "token";
            let tokenFirebase = localStorage.getItem('FirebaseToken');
            let _data = {
                token: tokenFirebase
            }
            return axios.delete(url, { headers: headers, _data });
        }

    }

};
export default jitsiService;
