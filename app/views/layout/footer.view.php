<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script>

    $(document).ready(function () {
        function getCookie(key) {
            var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
            return keyValue ? keyValue[2] : null;
        }

        function setView(val_s) {
            if (val_s.length > 0) {
                $("#tbody").html('');
                var total = 0;
                $.each(val_s, function (idx, topic) {
                    total++
                    var html = `<tr>
                            <th scope="row">#${total}</th>
                            <th scope="row">#${topic['id']}</th>
                            <th>${topic['amount']}</th>
                            <th>${topic['buyer']}</th>
                            <th>${topic['receipt_id']}</th>
                            <th>${topic['items']}</th>
                            <th>${topic['buyer_email']}</th>
                            <th>${topic['buyer_ip']}</th>
                            <th>${topic['note']}</th>
                            <th>${topic['city']}</th>
                            <th>${topic['phone']}</th>
                            <th class="hash_key">${topic['hash_key']}</th>
                            <th>${topic['entry_at']}</th>
                            <th>${topic['entry_by']}</th>
                        </tr>`;
                    $("#tbody").append(html);
                });
                $(".table").removeClass('invisible');
                $(".no-found").addClass('invisible');
                $(".total").html(`Total : ${total}`);
            } else {
                $(".table").addClass('invisible');
                $(".no-found").removeClass('invisible');
            }
        }

        function getall() {
            $.ajax({
                type: "GET",
                url: '/ajax/get/orders',
                success: function (res) {
                    var val_s = JSON.parse(JSON.stringify(res));
                    setView(val_s)
                }
            });
        }

        function getByDate() {
            var from_v = $("#from").val();
            var to_v = $("#to").val();
            if (!from_v || !to_v) {
                return
            }

            $.ajax({
                type: "GET",
                url: '/ajax/get/orders/by-date',
                data: {'from': from_v, 'to': to_v},
                success: function (res) {
                    var val_s = JSON.parse(JSON.stringify(res));
                    setView(val_s)
                }
            });
        }

        function getByReceiptId() {
            var recipi_id = $("#id").val()
            $.ajax({
                type: "GET",
                url: '/ajax/get/orders/by-receipt-id',
                data: {'id': recipi_id},
                success: function (res) {
                    var val_s = JSON.parse(JSON.stringify(res));
                    setView(val_s)
                }
            });
        }

        // Storing Data
        $("#order_add_form").submit(function (e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: '/ajax/store/orders',
                data: form.serialize(), // serializes the form's elements.
                success: function (res) {
                    var val_s = JSON.stringify(res.data);
                    $(".is-invalid").removeClass('is-invalid');
                    $(".invalid-feedback").remove();
                    if (val_s === '"ok"') {
                        document.getElementById("order_add_form").reset();
                        getall();
                        $('.bd-example-modal-lg').modal('hide');
                        alert("Order added successfully");
                    } else {
                        var val_s = JSON.parse(JSON.stringify(res.data));
                        $.each(val_s, function (i, v) {
                            $(`#${i}`).addClass('is-invalid')
                            $(`<div class="invalid-feedback">
                                    ${v}
                            </div>`).insertAfter(`#${i}`);

                        })
                    }
                }
            });

        });


        // Filter by date
        $("#from , #to").on('change', function (e) {
            getByDate()
        });

        //Filter by id

        $("#id").on('input', function (e) {
            getByReceiptId()
        })

        $("#reset").on('click', function (e) {
            getall()
        })

        $('#modelBtn').on('click', function () {
            if (getCookie('isSubmitted')) {
                alert('You already submit a order. Please try after 24 hours.')
            } else {
                $('.bd-example-modal-lg').modal('show');
            }
        });
    })
    ;
</script>

</body>
</html>