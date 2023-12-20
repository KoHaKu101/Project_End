const toggler = document.querySelector("#btnSideBarToggle");
const sidebar = document.querySelector(".sidebar");
const sidebar_link_collapsed = $('a.sidebar-link.dropdown-list');
const sidebar_dropdown = $('.sidebar-dropdown.list-unstyled');
toggler.addEventListener("click", function () {
    sidebar.classList.toggle("collapseCustom");
    sidebar_dropdown.removeClass('show');
});

$(document).ready(function () {
    if($('#manage_data_list').hasClass('active')){
        $('#manage_data').addClass('show');
    }

    if($('#copy_media_list').hasClass('active')){
        $('#copy_media').addClass('show');
    }

});
sidebar_link_collapsed.click(function () {
    if (sidebar.classList.contains('collapseCustom')) {
        toggler.click();
    }
});
// sidebar_link_collapsed.addEventListener("click", function () {

// });
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
                data: {
                    _token: _token
                },
                success: function (response) {
                    Swal.fire('Success', response.message, 'success').then((result) => { location.reload() });
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
function InputOnlyNumber(input) {
    input.value = input.value.replace(/[^0-9]/g, '');
  }
// $('#dropdownUser').on('click',function(){
//     $(this).dropdown('toggle');
// });



