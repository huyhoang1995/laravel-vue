const myEnter = {
	bind: function (el, binding, vnode) {
		el.addEventListener('keypress', (e) => {
			if (e.which === 13){
				binding.value();
			}     
		});
	}
}

export default myEnter;