<script>
    var url = '<?= site_url(); ?>';
    function login() {
        var person = {
            username: $("#username").val(),
            password: $.md5($("#password").val()),
        }
        $.ajax({
            url: url + 'submit_login',
            method: 'post',
            data: JSON.stringify(person),
            dataType: 'json',
            success: function (response) {
                if (response.response == 'OK') {
                    if (response.data == 'A') {
                        $.notify({
                            message: '<i class="mdi mdi-check-all"></i> ' + response.message,
                        }, {type: 'success'})
                        setTimeout(function ()
                        {
                            window.location.href = "<?= site_url(); ?>admin";
                        }, 1000);
                    }
                } else {
                    $.notify({
                        message: '<i class="mdi mdi-close"></i> ' + response.message,
                    }, {type: 'warning'})
                }
            }
        });
    }
    //logout
    function logoutProcess() {
        $.ajax({
            url: url + 'logout',
            method: 'GET',
            success: function (response) {

                setTimeout(function ()
                {
                    window.location.href = "<?= site_url(); ?>login";
                }, 1000);
            }
        });
    }

    function addguide() {
        var name = $('#name').val();
        var gender = $('#gender').val();
        var contact = $('#contact').val();
        var email = $('#email').val();
        var address = $('#address').val();
        var input = {
            "name": name, "gender": gender,
            "contact": contact, "email": email, "address": address
        };

        $.ajax({
            url: url + 'guide/add',
            method: 'POST',
            headers: {
                'access_from': 'web',
            },
            data: JSON.stringify(input),
            dataType: 'json',
            contentType: 'application/json',
            success: function (response) {
                if (response.response == 'OK') {
                    toastr.success(response.message);
                    location.reload();
                } else {
                    toastr.warning(response.message)
                }
            }
        });
    }

    function saveguidestatus(seq) {
        var status = $("#status_option option:selected").val();
        var seq = seq;
        var input = {seq: seq, status: status};

        $.ajax({
            url: url + 'admin/guide/change_status',
            method: 'POST',
            data: JSON.stringify(input),
            dataType: 'json',
            contentType: 'application/json',
            success: function (response) {
                $('#changestatusguide').modal('hide');
                if (response.response == 'OK') {
                    toastr.success(response.message);
                    setTimeout(function ()
                    {
                        location.reload();
                    }, 1000);

                } else {
                    toastr.warning(response.message)
                }
            }
        });
    }
</script>

