<template>
  <div class="popup" v-if="message">
    <p>{{ message }}</p>
    <button class="close-btn" @click="closePopup">x</button>
  </div>
</template>

<script>
export default {
  name: "Popup",
  props: {
    message: {
      type: String,
      required: true,
    },
  },
  methods: {
    closePopup() {
      this.$emit("close");
    },
  },
};
</script>

<style scoped>
.popup {
  position: fixed;
  
  top: 10px;
  
  background-color: #f44336;
  color: white;
  
 
  border-radius: 5px;
  box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.2);
  z-index: 1;
  
}

p{
    margin-right: 20px;
    padding: 10px;
}
.close-btn {
  background-color: transparent;
  border: none;
  color: white;
  margin-left: 10px;
  font-size: 18px;
  cursor: pointer;
  position: absolute;
  top: 1px;
  right: 10px;
}
</style>
