$(document).ready(function() {
    formEditAction();
    editAction();
    newAction();
});

//newAction
function newAction() {
    $("#timeslot-new-form").on('submit', function (e) {
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            url: $this.attr('action'),
            type: $this.attr('method'),
            data: $this.serialize(),
            error: function (data) {
                if(data.status == 400) {
                    $this.find('.form-errors').html(data.responseText);
                }
                formEditAction();
            },
            success: function(data) {
                $this.find('.form-errors').html('');
                $('#schedule').html(data);
                formEditAction();
                $this[0].reset();
            }
        });
    });
}

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
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            url: $this.attr('action'),
            type: $this.attr('method'),
            data: $this.serialize(),
            error: function (data) {
                if(data.status == 400) {
                    $this.find('.form-errors').html(data.responseText);
                }
                formEditAction();
            },
            success: function(data) {
                $this.find('.form-errors').html('');
                $('#schedule').html(data);
                formEditAction();
            }
        });

    });
}