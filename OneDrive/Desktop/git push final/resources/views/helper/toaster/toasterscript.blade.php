<script>
    //Success Toast
    window.addEventListener('successtoast', event => {
        $('#feather').show();
        $('#errorfeather').hide();
        $('#warning').hide();
        $('#updatemessages').html(event.detail.message);
        $('#basic-non-sticky-notification-toggle').click();
    });
    //Update Toast
    window.addEventListener('updatetoast', event => {
        $('#feather').show();
        $('#errorfeather').hide();
        $('#warning').hide();
        $('#updatemessages').html(event.detail.message);
        $('#basic-non-sticky-notification-toggle').click();
    });
    // Delete Confirmation Toast
    window.addEventListener('deletetoast', event => {
        var id = (event.detail.{{ $deleteid }}) + 'id';
        document.getElementById(id).click();
    });
    //Delete Toaster
    window.addEventListener('deletemsg', event => {
        $('#feather').show();
        $('#errorfeather').hide();
        $('#warning').hide();
        $('#updatemessages').html(event.detail.message);
        $('#basic-non-sticky-notification-toggle').click();
    });
    //Error Toaster
    window.addEventListener('errortoast', event => {
        $('#feather').hide();
        $('#errorfeather').show();
        $('#warning').hide();
        $('#updatemessages').html(event.detail.message);
        $('#basic-non-sticky-notification-toggle').click();
    });
    // Warning Toaster
    window.addEventListener('warningtoast', event => {
        $('#feather').hide();
        $('#errorfeather').hide();
        $('#warning').show();
        $('#updatemessages').html(event.detail.message);
        $('#basic-non-sticky-notification-toggle').click();
    });

</script>
