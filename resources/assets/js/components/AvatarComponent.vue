<template>
    <div>
        <div class="profile-wrap text-center">
            <div class="pad-btm">
                <img class="img-circle img-md" src="img/avt.png" alt="Profile Picture" />
            </div>
            <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                <span class="pull-right dropdown-toggle">
                    <i class="dropdown-caret"></i>
                </span>
                <p class="mnp-name">{{dataInfo.name}}</p>
                <span class="mnp-desc">aaron.cha@themeon.net</span>
            </a>
        </div>
        <div id="profile-nav" class="collapse list-group bg-trans">
            <a href="#" class="list-group-item">
                <i class="demo-pli-male icon-lg icon-fw"></i> View Profile
            </a>
            <a href="#" class="list-group-item">
                <i class="demo-pli-gear icon-lg icon-fw"></i> Settings
            </a>
            <a href="#" class="list-group-item">
                <i class="demo-pli-information icon-lg icon-fw"></i> Help
            </a>
            <a @click="logout()" href="#" class="list-group-item">
                <i class="demo-pli-unlock icon-lg icon-fw"></i> Logout
            </a>
        </div>
    </div>
</template>
<script>
    // import openSocket from 'socket.io-client';
    // const socket = openSocket('http://localhost:3003');

    import config from '../config';


    export default {
        created() {

        },
        mounted() {
            this.getUserInfo();
        },
        data: function () {
            return {
                dataInfo: {}
            };
        },
        methods: {
            getUserInfo: function () {
                service.jitsiService.action.userInfo().then(resp => {
                    // console.log(resp.data);
                    this.dataInfo = resp.data;

                    // userInfo to storage
                    localStorage.setItem("dataUserInfo", JSON.stringify(resp.data));


                }).then(() => {
                    this.$socketServer.socket.emit(config.socket.login, { id: this.dataInfo.id, name: this.dataInfo.name }, this.callBackUserOnline());
                }).catch(err => {
                    console.log(err)
                })
            },

            callBackUserOnline: function () {
                // this.$socketServer.socket.emit(config.socket.usersOnline);

            },

            logout: function () {
                const token = localStorage.getItem('FirebaseToken');
                    // xoa token
                service.tokenService.action.deleteToken().then(res => {
                    localStorage.removeItem('FirebaseToken');
                    localStorage.removeItem('token');
                })
                
                service.jitsiService.action.logout().then(resp => {
                    this.$socketServer.socket.disconnect();

                    console.log(resp);
                    window.location.href = siteUrl + "/login";
                }).catch(err => {
                    console.log(err)
                })
            }

            // logout: function () {
            //     service.matrixService.action
            //         .logoutMatrix()
            //         .then(result => {
            //             console.log(result);
            //             var url = siteUrl + "/login";
            //             window.location.href = url;
            //         })
            //         .catch(err => {
            //             console.log(err);
            //         });
            //     localStorage.removeItem("dataLogin");
            // }
        }
    };

</script>