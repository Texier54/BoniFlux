import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
	state: {
		member: false,
		token: false,
		uuidStream: '',
		idStream: ''
	},
	mutations: {
		setMember(state, member) {
			state.member = member;
		},
		setListeMember(state, liste) {
			state.listemember = liste;
		},
		setUuidStream(state, uuid) {
			state.uuidStream = uuid
		},
		setidStream(state, id) {
			state.idStream = id
		},
		setToken(state, token) {
			state.token = token;
		},
		initialiseStore(state) {
			if (localStorage.getItem('store')) {
				this.replaceState(
					Object.assign(state, JSON.parse(localStorage.getItem('store')))
				);
			}
		},
		getToken() {
			return state.token;
		},
	},
})
