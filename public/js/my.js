$(document).ready(function () {
    $("#deleteAll").click(function () {
        let check = $("#deleteAll").is(":checked");
        $('.checkbox').not(this).prop('checked', check);
    })
    $(".checkbox").click(function () {
        let check = $(this).is(":checked");
        let checkAll = $("#deleteAll").is(":checked");

        if (check === false && checkAll === true) {
            $('#deleteAll').prop("checked", false)
        }
    })
    $("#deleteUser").click(function () {
        let checkbox = $(".checkbox")
        let deleteId = []
        for (let i = 0; i < checkbox.length; i++) {
            if (checkbox[i].checked) {
                deleteId.push(checkbox[i].value)
            }
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: origin + '/admin/users/delete',
            method: 'POST',
            data: {
                deleteId: deleteId
            },
            success: function (res) {
                if (res.status === 'success') {
                    for (let i = 0; i < deleteId.length; i++) {
                        $('#checkbox-' + deleteId[i]).remove();
                    }
                }
            },
            error: function (error) {
                alert('error')
            }
        })

    });
    $("#deleteProduct").click(function () {
        let checkbox = $(".checkbox")
        let deleteId = []
        for (let i = 0; i < checkbox.length; i++) {
            if (checkbox[i].checked) {
                deleteId.push(checkbox[i].value)
            }
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: origin + '/admin/products/delete',
            method: 'POST',
            data: {
                deleteId: deleteId
            },
            success: function (res) {
                if (res.status === 'success') {
                    for (let i = 0; i < deleteId.length; i++) {
                        $('#checkbox-' + deleteId[i]).remove();
                    }                }
            },
            error: function (error) {
                alert('error')
            }
        })

    });

})
