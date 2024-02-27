const toggler = document.querySelector("#btnSideBarToggle");
const sidebar = document.querySelector(".sidebar");
const sidebar_link_collapsed = $('a.sidebar-link.dropdown-list');
const sidebar_dropdown = $('.sidebar-dropdown.list-unstyled');

toggler.addEventListener("click", function () {
    sidebar.classList.toggle("collapseCustom");
    sidebar_dropdown.removeClass('show');
});
$(document).on({
    ajaxStart: function(){
        $('#loading-overlay').show();
    },
    ajaxStop: function(){
        $('#loading-overlay').hide();
    }
});
$(document).ready(function () {
    $('.modal').modal({
        backdrop: 'static',
                keyboard: false
      });
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
    btn.attr('disabled', true);
    btn.html('<i class="fas fa-arrows-rotate fa-spin me-2"></i>กำลังบันทึก');
}
function SubmitForm(btn,form) {
    const formElement = $('#' + form);
    const form_btn = $('#'+btn);
    var isValid = true;
    formElement.find('input[required]:not([disabled]), select[required]:not([disabled]), textarea[required]:not([disabled])').each(function () {
        let id_input = $(this).attr('id');
        if ($.trim($(this).val()) == '') {
            isValid = false;
            $('#'+id_input).addClass('input-error');
            $('#'+id_input).removeClass('input-success');
            $('#error_'+id_input).attr('hidden',false);
        } else {
            $('#'+id_input).addClass('input-success');
            $('#'+id_input).removeClass('input-error');
            $('#error_'+id_input).attr('hidden',true);
        }
    });
    if (isValid) {
        loadingButton(form_btn);
        $('#loading-overlay').show(); // Show loading overlay if needed
        formElement.submit();
    }
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
  function formatDateThai(date) {
    var day = String(date.getDate()).padStart(2, '0');
    var month = String(date.getMonth() + 1).padStart(2, '0'); // January is 0!
    var year = date.getFullYear() + 543; // Convert to Buddhist calendar year

    return day + '-' + month + '-' + year;
  }

  // Function to handle the change event of the date input field
  function handleDateChange(event) {
    console.log(event);
    var inputDate = new Date(event.target.value);
    var formattedDate = formatDateThai(inputDate);
    event.target.value = formattedDate;
  }



