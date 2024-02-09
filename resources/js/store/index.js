import { createStore } from 'vuex'

export default createStore({
  state: {
    selectedItems: [],
    isWidgetOpened: false
  },
  mutations: {
    setSelectedItems(state, items) {
      state.selectedItems = items
    },
    toggleWidget(state) {
      state.isWidgetOpened = !state.isWidgetOpened
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
