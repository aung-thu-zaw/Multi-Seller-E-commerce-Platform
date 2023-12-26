import { createStore } from 'vuex'

export default createStore({
  state: {
    selectedItems: [],
    isWidgetOpened: false,
    storeId: null
  },
  mutations: {
    setSelectedItems(state, items) {
      state.selectedItems = items
    },
    toggleWidget(state, storeId) {
      state.isWidgetOpened = !state.isWidgetOpened
      state.storeId = storeId
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
