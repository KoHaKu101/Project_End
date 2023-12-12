const toggler = document.querySelector(".btn-sidebar-toggle");
toggler.addEventListener("click",function(){
    document.querySelector("#sidebar").classList.toggle("collapse");
});

function loadingButton(btn) {
    btn.attr('disabled', 'disabled');
    btn.html('<i class="fas fa-arrows-rotate fa-spin me-2"></i>กำลังบันทึก');
}
function SubmitForm(form) {
    const formElement = $('#' + form);
    const btn = formElement.find('button#submitBTN');
    loadingButton(btn);
    formElement.submit();
}
