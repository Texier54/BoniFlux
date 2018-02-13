import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
	state : {
		partie : false,
	},
	mutations : {
		setPartie(state,partie) {
			state.partie = partie;
		},
		initialiseStore(state) {
			if(localStorage.getItem('store')) {
				this.replaceState(
					Object.assign(state, JSON.parse(localStorage.getItem('store')))
				);
			}
		},
		getPartie() {
			return state.partie;
		},
	},
})
