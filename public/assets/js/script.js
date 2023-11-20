const toggler = document.querySelector(".btn-sidebar-toggle");
toggler.addEventListener("click",function(){
    document.querySelector("#sidebar").classList.toggle("collapse");
});

function loadingSubmit() {
    var button = $('#submitBTN');
    var icon = $('#icon');
    button.attr('disabled', 'disabled');
    button.html('<i class="fas fa-arrows-rotate fa-spin me-2"></i>กำลังบันทึก');
    $('#FormSubmit').submit();
}

