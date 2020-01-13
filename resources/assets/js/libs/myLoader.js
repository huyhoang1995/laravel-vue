const myLoader = {
	show: function () {
		$('#modalLoader').modal({
			show: true,
			backdrop: 'static'
		});
	},
	hide: function () {
		$('#modalLoader').modal('hide');
	}
};

export default myLoader;