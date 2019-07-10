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
        let order_id = $(this).data('order-id'),
            name = 'order-' + order_id,
            status = $('input[name=' + name + ']:checked').val();

        console.log(name);
        console.log('id: ' + order_id);
        console.log('status: ' + status);

        $.ajax({
            url: '/order/status',
            type: 'POST',
            DataType: 'json',
            data: {order_id: order_id, status: status},
            context: $(this),
            error: function () {
                alert('error');
            },
            success: function (data) {
                if(data.result === 1){
                    alert(data.message);
                } else {
                    console.log(data.message);
                }
            }
        })
    })
});