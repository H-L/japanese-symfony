$(document).ready(function() {
    formEditAction();
    editAction();
});
//formEditAction
function formEditAction() {
    $(".edit-form-create").on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            url: $this.data('path'),
            type: 'POST',
            data: $this.serialize(),
            success: function(data) {
                $('#edit-form').html(data);
                editAction();
            }
        });
    });
}
//editAction
function editAction() {
    $(".timeslot-edit-form").on('submit', function (e) {
        console.log('hey');
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            url: $this.attr('action'),
            type: $this.attr('method'),
            data: $this.serialize(),
            success: function(data) {
                $('#schedule').html(data);
                formEditAction();
                resetSearchBar();
            }
        });

    });
}