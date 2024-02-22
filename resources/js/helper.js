export default {
    getPrice(value, symbol = true) {
        let string = value.toLocaleString('ru')
        if (symbol) string += ' ₽'
        return string
    },

    isNumber: function(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
          evt.preventDefault();
        } else {
          return true;
        }
      }
}