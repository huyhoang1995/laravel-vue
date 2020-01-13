const itemService = {
  data: {
    list: (name, page, perPage) => {
      return {
        name: name || "",
        page: page || "",
        perPage: perPage || ""
      };
    },
    insertUpdateData: function(name, price, avatar) {
      const params = new FormData();
      params.append("name", name || "");
      params.append("price", price || "");
      params.append("avatar", avatar || "");
      return params;
    }
  },
  action: {
    list: data => {
      let url = siteUrl + "/rest/item?" + $.param(data, true);
      return axios.get(url);
    },
    singleItem: id => {
      let url = siteUrl + "/rest/item/" + id;
      return axios.get(url);
    },
    insert: data => {
      let url = siteUrl + "/rest/item";
      return axios.post(url, data);
    },
    update: (id, data) => {
      let url = siteUrl + "/rest/item/" + id;
      return axios.post(url, data);
    },
    delete: id => {
      let url = siteUrl + "/rest/item/" + id;
      return axios.delete(url);
    }
  }
};
export default itemService;
