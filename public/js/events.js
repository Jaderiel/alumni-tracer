$('#menu-btn').click(function() {
    $('#menu').toggleClass("active");
})

var registerButtons = document.querySelectorAll(".register-btn");

registerButtons.forEach(function(button) {
    button.addEventListener("click", function() {
        this.innerHTML = '<i class="fas fa-check"></i>';
    });
});