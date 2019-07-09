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
        $.ajax({
            url: '/basket/delete',
            type: 'POST',
            DataType: 'json',
            data: {id: id},
            context: $(this),
            error: function () {
                alert('error');
            },
            success: function (data) {
                if(data.result === 1){
                    $('#basketCount').text(data.count);
                    $('#basketTotal').text(data.total);
                    $(this).closest('.product-item').remove();
                } else {
                    console.log(data);
                }
            }
        })
    });
    $('.setStatus').on('click', function (event) {
        event.preventDefault();
        let id = $(this).data('order-id');
        console.log(id);
    })
});