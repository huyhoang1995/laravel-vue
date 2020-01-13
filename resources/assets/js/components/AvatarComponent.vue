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
        <p class="mnp-name">Aaron Chavez</p>
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
      <a @click="logout" href="#" class="list-group-item">
        <i class="demo-pli-unlock icon-lg icon-fw"></i> Logout
      </a>
    </div>
  </div>
</template>
<script>
export default {
  created() {},
  mounted() {},
  data: function() {
    return {};
  },
  methods: {
    logout: function() {
      service.matrixService.action
        .logoutMatrix()
        .then(result => {
          console.log(result);
          var url = siteUrl + "/login";
          window.location.href = url;
        })
        .catch(err => {
          console.log(err);
        });
      localStorage.removeItem("dataLogin");
    }
  }
};
</script>