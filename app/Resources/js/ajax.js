$(document).ready(function() {
    formEditAction();
    editAction();
    newAction();
});

if($('.time-slot').length == 0) {
    $('button.edit').addClass('hidden');
}

$('button.edit').on('click', function () {
    if($('#edit-form').hasClass('hidden')) {
        $('#edit-form').toggleClass('hidden');
        $('#new-form').toggleClass('hidden');
    }
});

$('button.new').on('click', function () {
    if($('#new-form').hasClass('hidden')) {
        $('#new-form').toggleClass('hidden');
        $('#edit-form').toggleClass('hidden');
    }
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
                    $this.find('.form-errors').show();
                    $this.find('.form-errors').html(data.responseText);
                }
                formEditAction();
            },
            success: function(data) {
                $this.find('.form-errors').html('');
                $this.find('.form-errors').hide();
                $('#schedule').html(data);
                formEditAction();
                $this[0].reset();
                if($('button.edit').hasClass('hidden')) {
                    $('button.edit').removeClass('hidden');
                }
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
                if($('#edit-form').hasClass('hidden')) {
                    $('#edit-form').toggleClass('hidden');
                    $('#new-form').toggleClass('hidden');
                }
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
                    $this.find('.form-errors').show();
                    $this.find('.form-errors').html(data.responseText);
                }
                formEditAction();
            },
            success: function(data) {
                $this.find('.form-errors').html('');
                $this.find('.form-errors').hide();
                $('#schedule').html(data);
                formEditAction();
            }
        });

    });
}