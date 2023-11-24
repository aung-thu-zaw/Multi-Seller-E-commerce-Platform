import { createStore } from 'vuex'

export default createStore({
  state: {
    selectedItems: []
  },
  mutations: {
    setSelectedItems(state, items) {
      state.selectedItems = items
    }
  },
  actions: {
    setSelectedItems({ commit }, items) {
      commit('setSelectedItems', items)
    }
  },
  getters: {
    getSelectedItems: (state) => state.selectedItems
  }
})
