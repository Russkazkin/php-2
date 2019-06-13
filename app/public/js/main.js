$(document).ready(function () {
    $('.buy').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            url: '/basket/add',
            type: 'POST',
            DataType: 'json',
            data: {id: id},
            error: function () {
                alert('error');
            },
            success: function (data) {
                $('#basketCount').text(data.count);
            }
        })
    });
    $('.delete').on('click', function () {
        let id = $(this).data('basket');
        console.log(id);
        $.ajax({
            url: '/basket/delete',
            type: 'POST',
            DataType: 'json',
            data: {id: id},
            error: function () {
                alert('error');
            },
            success: function (data) {
                $('#basketCount').text(data.count);
                location.reload();
            }
        })
    })
});