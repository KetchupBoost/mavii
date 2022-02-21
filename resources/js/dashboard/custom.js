$(function () {
    "use strict";

    // Feather Icon Init Js
    feather.replace();

    $(".preloader").fadeOut();

    // this is for close icon when navigation open in mobile view
    $(".nav-toggler").on('click', function () {
        $("#main-wrapper").toggleClass("show-sidebar");
        $(".nav-toggler i").toggleClass("ti-menu");
    });

    // ==============================================================
    // Right sidebar options
    // ==============================================================
    $(function () {
        $(".service-panel-toggle").on('click', function () {
            $(".customizer").toggleClass('show-service-panel');

        });
        $('.page-wrapper').on('click', function () {
            $(".customizer").removeClass('show-service-panel');
        });
    });

    // ==============================================================
    //tooltip
    // ==============================================================
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    // ==============================================================
    //Popover
    // ==============================================================
    $(function () {
        $('[data-toggle="popover"]').popover()
    })

    // ==============================================================
    // Perfact scrollbar
    // ==============================================================
    $('.message-center, .customizer-body, .scrollable, .scroll-sidebar').perfectScrollbar({
        wheelPropagation: !0
    });

    // ==============================================================
    // Resize all elements
    // ==============================================================
    $("body, .page-wrapper").trigger("resize");
    $(".page-wrapper").delay(20).show();
    // ==============================================================
    // To do list
    // ==============================================================
    $(".list-task li label").click(function () {
        $(this).toggleClass("task-done");
    });

    // ==============================================================
    // This is for the innerleft sidebar
    // ==============================================================
    $(".show-left-part").on('click', function () {
        $('.left-part').toggleClass('show-panel');
        $('.show-left-part').toggleClass('ti-menu');
    });

    // For Custom File Input
    $('.custom-file-input').on('change', function () {
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });

    // Masks
    $('.phone').mask('(00) 0000-0000', { clearIfNotMatch: true });
    $('.cellphone').mask('(00) 00000-0000', { clearIfNotMatch: true });
    $('.cpf').mask('000.000.000-00', { clearIfNotMatch: true });
    $('.cnpj').mask('00.000.000/0000-00', { clearIfNotMatch: true });
    $('.postal_code').mask('00000-000', { clearIfNotMatch: true });
    $('.date').mask('00/00/0000', { clearIfNotMatch: true });
    $('.date_without_year').mask('00/00', { clearIfNotMatch: true });
    $('.hour').mask('00:00', { clearIfNotMatch: true });
    $('.money').mask('000.000.000.000.000,00', { reverse: true });

    // Icon Picker
    $('.icp-auto').iconpicker();

    $('.icp-auto').on('iconpickerSelected', function(e) {
        var input = $(e.currentTarget),
            icon = e.iconpickerValue;

        input.parent().find('.input-group-text').html('<i class="' + icon + ' fa-fw"></i>');
    });

    // Summernote
    $('.summernote').summernote({
        height: 200,
        lang: 'pt-BR',
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['picture', 'link', 'video']],
            ['misc', ['fullscreen', 'codeview', 'help']]
        ],
        callbacks: {
            onImageUpload: function(files) {
                sendFile(files[0]);
            }
        }
    });
});

// Show register
$(document).on('click', '.show-item', function(e) {
  e.preventDefault();

  var url = $(this).data('url'),
      large = $(this).data('large'),
      title = $(this).data('title');

  if(large == true) {
    $('#modal-show').find('.modal-dialog').addClass('modal-lg');
  }

  $('#modal-show').find('.modal-title').html(title);
  $('#modal-show').find('.modal-body').html('<div class="p-4 text-center"><i class="fas fa-spinner fa-spin"></i></div>');

  $('#modal-show').find('.modal-body').load(url, function(responseTxt, statusTxt, xhr) {
        
  }).on('show.bs.modal', function (event) {
      
  });
});

// Delete register
$(document).on('click', '.delete', function(e) {
    var url = $(this).data('url');

  $('#modal-delete').on('shown.bs.modal', function (event) {
    $(this).find('.modal-title').text('Apagar');
    $(this).find('.modal-body').html('<p class="text-center">Deseja realmente apagar este item?</p>');
    $(this).find('form').attr('action', url);
  });
});

// Update status
window.updateStatus = function(that, e) {
  var token = $(that).data('token'),
      controller = $(that).data('controller'),
      id = $(that).data('id'),
      value = $(that).find('input[type="checkbox"]').val();

  if (value == 0) {
    $(that).find('input').val(1);
  } else {
    $(that).find('input').val(0);
  }

  $.ajax({
    url: APP_URL + '/admin/' + controller + '/update_status/' + id,
    type: 'POST',
    data: { _token: token, status: value },
    success: function(result) {
      notify('<i class="fas fa-check fa-fw"></i> ' + result.message, 'success');
    },
    error: function(xhr) {
      notify('<i class="fas fa-times fa-fw"></i> ' + xhr.responseText, 'error');
    }
  });
}

// Update featured
window.updateFeatured = function(that, e) {
  var token = $(that).data('token'),
      controller = $(that).data('controller'),
      id = $(that).data('id'),
      value = $(that).data('value');

  if (value === 0) {
    $(that).data('value', 1);
    value = 1;
  } else {
    $(that).data('value', 0);
    value = 0;
  }

  $.ajax({
    url: APP_URL + '/admin/' + controller + '/update_featured/' + id,
    type: 'POST',
    data: { _token: token, featured: value },
    success: function(result) {
      if ($(that).find('.fas').length > 0) {
        $(that).html('<i class="far fa-star" aria-hidden="true"></i>');
      } else {
        $(that).html('<i class="fas fa-star" aria-hidden="true"></i>');
      }

      notify('<i class="fas fa-check fa-fw"></i> ' + result.message, 'success');
    },
    error: function(xhr) {
      notify('<i class="fas fa-times fa-fw"></i> ' + xhr.responseText, 'error');
    }
  });
}

// Notify
function notify(msg, type) {
  new Noty({
    text: msg,
    layout: 'bottomRight',
    type: type,
    theme: 'mint',
    timeout: 3000
  }).show();
}
