import {reactive} from "vue";

export default reactive({
  items: [],
  add(toast) {
    if (Object.keys(toast.message).length <= 0) return
    this.items.unshift({
      key: Symbol(),
      ...toast
    });
  },


  remove(index) {
    this.items.splice(index, 1);
  },
});
