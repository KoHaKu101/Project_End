const toggler = document.querySelector(".btn-sidebar-toggle");
toggler.addEventListener("click", function () {
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
function alertConfirmDelete(url, _token) {
    Swal.fire({
        icon: 'warning',
        title: 'ต้องการลบรายการไหม ?',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        confirmButtonColor: '#157347',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "DELETE",
                url: url,
                dataType: "JSON",
                data:{
                    _token:_token
                },
                success: function (response) {
                    Swal.fire('Success', response.message, 'success').then((result) => {location.reload()});
                },
                error: function (xhr) {
                    // Display error message using SweetAlert for specific error cases
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        Swal.fire('Error', xhr.responseJSON.error, 'error');
                    } else {
                        // Handle other error cases
                        Swal.fire('Error', 'เกิดข้อผิดพลาดบางอย่าง กรุณาติดต่อเจ้าหน้าที่', 'error');
                    }
                }
            });
        }
    })
}
