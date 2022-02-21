$(function () {
	// Bootstrap 
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover();

	// Selectize
	$('.selectize').selectize();

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

	// Swiper
	var swiper = new Swiper('.swiper-container', {
		effect: 'coverflow',
		grabCursor: false,
		centeredSlides: true,
		slidesPerView: 'auto',
		autoplay: {
			delay: 5000,
		},
		loop: true,
		coverflowEffect: {
			rotate: 50,
			stretch: 0,
			depth: 100,
			modifier: 1,
			slideShadows : true
		},
		pagination: {
			el: '.swiper-pagination',
		},
	});

	// Toggle document fields
	var typeSelect = $('[name="type"]');

	$(typeSelect).change(function(e) {
		if ($(this).val() == '0') {
			$('#companyName').slideUp('slow');
			$('#companyName').find('input').removeAttr('required');

			$('#cpf').show();
			$('#cpf').find('input').attr('required', true);

			$('#cnpj').hide();
			$('#cnpj').find('input').removeAttr('required');
		} else if($(this).val() == '1') {
			$('#companyName').slideDown('slow');
			$('#companyName').find('input').attr('required', true);

			$('#cpf').hide();
			$('#cpf').find('input').removeAttr('required');

			$('#cnpj').show();
			$('#cnpj').find('input').attr('required', true);
		}
	});

	if (typeSelect.length > 0) {
		typeSelect.trigger('change');
	}

	var activeItems = $('.list-group-root .list-group').find('.active');

	if (activeItems.length > 0) {
		activeItems.parents('.collapse').addClass('show');
		activeItems.parents('.list-group').prev().find('.fas').removeClass('fa-chevron-right').addClass('fa-chevron-down');
	}

	$('.list-group-item').on('click', function() {
		$('.fas', this)
			.toggleClass('fa-chevron-right')
			.toggleClass('fa-chevron-down');
  });
});

$(document).ajaxComplete(function() {
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover();

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
});

window.enableSubmit = function() {
	$('[type="submit"]').removeAttr('disabled');
	$('[type="submit"]').css('pointer-events', 'auto');
}

window.disableSubmit = function() {
	$('[type="submit"]').attr('disabled', true).css('pointer-events', 'none');
}

// Form step
$(document).on('click', '.form-step fieldset .btn-next', function(e) {
	e.preventDefault();

	var parent_step = $(this).parents('fieldset'),
			next_step = true;
	
	parent_step.find('[required]').not('[type="hidden"], [disabled="disabled"]').each(function() {
		if($(this).val() == '' || $(this).val() == null || $(this).val() == undefined) {
			$(this).addClass('is-invalid');
			next_step = false;
		} else if($(this).is(':radio') || $(this).is(':checkbox')) {
			var inputName = $(this).attr('name');

			if (!$('[name="' + inputName + '"]').is(':checked')) {
				next_step = false;
				$(this).parents('.radio-group').addClass('border-danger');
			} else {
				$(this).parents('.radio-group').removeClass('border-danger');
			}
		} else {
			$(this).removeClass('is-invalid');
		}
	});


	if(!next_step) {
		notify('<i class="fas fa-exclamation-triangle fa-fw"></i> Preencha todos os campos', 'error');
	} else {
		parent_step.fadeOut(400, function() {
			$(this).next().fadeIn();
		});
	}
});

$(document).on('click', '.form-step fieldset .btn-previous', function(e) {
	e.preventDefault();
	
	var parent_step = $(this).parents('fieldset');

	parent_step.fadeOut(400, function() {
		$(this).prev().fadeIn();
	});
});

// Show register
$(document).on('click', '.create-item', function(e) {
	e.preventDefault();

	var url = $(this).data('url'),
			large = $(this).data('large'),
			title = $(this).data('title');

	if(large == true) {
		$('#modal-create').find('.modal-dialog').addClass('modal-lg');
	}

	$('#modal-create').find('.modal-title').html(title);
	$('#modal-create').find('.modal-body').html('<div class="p-4 text-center"><i class="fas fa-spinner fa-spin"></i></div>');

	$('#modal-create').find('.modal-body').load(url, function(responseTxt, statusTxt, xhr) {
		initMap();
	}).on('show.bs.modal', function (event) {
			
	});
});

// Edit register
$(document).on('click', '.edit-item', function(e) {
	e.preventDefault();

	var url = $(this).data('url'),
			large = $(this).data('large'),
			title = $(this).data('title');

	if(large == true) {
		$('#modal-edit').find('.modal-dialog').addClass('modal-lg');
	}

	$('#modal-edit').find('.modal-title').html(title);
	$('#modal-edit').find('.modal-body').html('<div class="p-4 text-center"><i class="fas fa-spinner fa-spin"></i></div>');

	$('#modal-edit').find('.modal-body').load(url, function(responseTxt, statusTxt, xhr) {
		
	}).on('show.bs.modal', function (event) {
			
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

// Show register
$(document).on('click', '.list-items', function(e) {
	e.preventDefault();

	var url = $(this).data('url'),
			large = $(this).data('large'),
			title = $(this).data('title');

	if(large == true) {
		$('#modal-list').find('.modal-dialog').addClass('modal-lg');
	}

	$('#modal-list').find('.modal-title').html(title);
	$('#modal-list').find('.modal-body').html('<div class="p-4 text-center"><i class="fas fa-spinner fa-spin"></i></div>');

	$('#modal-list').find('.modal-body').load(url, function(responseTxt, statusTxt, xhr) {
				
	}).on('show.bs.modal', function (event) {
			
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
    url: APP_URL + '/' + controller + '/update_status/' + id,
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

// Get location by postal code
window.filterUsers = function(that, e) {
	e.preventDefault();

	var data = $(that).serialize();

	$('#users').html('<object data="' + APP_URL + '/public/img/loading.svg" type="image/svg+xml" class="d-block m-auto"></object>');

	$.ajax({
		url: APP_URL + '/users/filter',
		type: 'POST',
		data: data,
		success: function(result) {
			$('#users').html(result.html);
		},
		error: function(xhr) {
			notify('<i class="fas fa-times fa-fw"></i> ' + xhr.responseText, 'error');
		}
	});
}

function getPosition() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	} else {
		alert('Geolocation is not supported by this browser.');
	}
}

function showPosition(position) {
	$('[name="lat"]').val(position.coords.latitude);
	$('[name="lng"]').val(position.coords.longitude);
}

// Get location by postal code
window.getLocation = function(that, e) {
	var postalCode = $(that).val();

	if (postalCode.length < 9) {
		return false;
	}

	$('.postal_code').after('<i class="fas fa-redo fa-spin"></i>');

	$.get('https://viacep.com.br/ws/' + postalCode + '/json/', function(data) {
		if (data.erro) {
			notify('<div class="alert alert-warning">Cep inválido, digite novamente.</div>', 'warning');
		} else {
			$('[name="public_place"]').val(data.logradouro);
			$('[name="neighborhood"]').val(data.bairro);
			$('[name="complement"]').val(data.complemento);
			$('[name="state_id"] option').filter(function () { return $(this).data('uf') == data.uf; }).attr('selected', true);
			$('[name="state_id"]').trigger('change');
			setTimeout(function() {
				$('[name="city_id"] option').filter(function () { return $(this).text() == data.localidade; }).attr('selected', true);
			}, 2000);
		}

		$('form .fa-redo').remove();
	});
}

// Init map 
window.initMap = function(that, e) {
	// Vars
	var map,
			myLatLng,
			marker,
			infowindow,
			autocomplete,
			geocoder = new google.maps.Geocoder();

	// Set map location
	myLatLng = (function (myLatLng) {
		var lat = $('#lat').val(),
				lng = $('#lng').val();

		if (lat == '' && lng == '') {
			myLatLng = new google.maps.LatLng(-15.6014109, -56.09789169999999);
		} else {
			myLatLng = new google.maps.LatLng(lat, lng);
		}

		return myLatLng;
	}());
	
	// Init
	map = new google.maps.Map(document.getElementById('map'), {
		center: myLatLng,
		zoom: 14
	});

	// Marker
	marker = new google.maps.Marker({
		position: myLatLng,
		map: map,
		draggable: true
	});

	// Autocomplete
	autocomplete = new google.maps.places.Autocomplete((document.getElementById('location')), {types: ['geocode', 'establishment']});
	autocomplete.bindTo('bounds', map);

	// Update map and marker to new location
	autocomplete.addListener('place_changed', function() {
		marker.setVisible(false);
		var place = autocomplete.getPlace();

		// Update lat and lng values
		$('#lat').val(place.geometry.location.lat());
		$('#lng').val(place.geometry.location.lng());

		if (!place.geometry) {
			window.alert("O endereço digitado não contém nenhuma geometria");
			return;
		}

		if (infowindow != undefined) {
			infowindow.close();
		}

		infowindow = new google.maps.InfoWindow({
			content: '<div><h4>' + place.name + '</h4><p style="margin-bottom: 0;">' + place.formatted_address + '</p></div>'
		});

		marker.addListener('click', function() {
			infowindow.open(map, this);
		});

		// If the place has a geometry, then present it on a map.
		// if (place.geometry.viewport) {
		// 	map.fitBounds(place.geometry.viewport);
		// } else {
		// 	map.setCenter(place.geometry.location);
		// 	map.setZoom(14);
		// }
		map.setCenter(place.geometry.location);
		map.setZoom(14);
		marker.setPosition(place.geometry.location);
		marker.setVisible(true);
	});

	// Update field's values
	google.maps.event.addListener(marker, 'dragend', function() {
		geocoder.geocode({ 'latLng': marker.getPosition() }, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				if (results[0]) {
					$('#location').val(results[0].formatted_address);
					$('#lat').val(marker.getPosition().lat());
					$('#lng').val(marker.getPosition().lng());
				}
			}
		});
	});

	// Enter to select
	google.maps.event.addDomListener(document.getElementById('location'), 'keydown', function(e) {
		if (e.keyCode == 13) { 
			 e.preventDefault(); 
		}
	});
}

// Create event
window.saveEvent = function(that, e) {
	e.preventDefault();
	var url = $(that).attr('action'),
			data = $(that).serializeArray();

	$(that).find('.btn-submit').html('<i class="fas fa-spinner fa-spin"></i>');

	$.ajax({
		url: url,
		type: 'POST',
		data: data,
		success: function(result) {
			window.location.replace(APP_URL + '/eventos');
		},
		error: function(xhr) {
			$(that).find('.btn-submit').text('Finalizar');
			notify('<i class="fas fa-times fa-fw" aria-hidden="true"></i> ' + xhr.responseText, 'error');
		}
	});
}

// Edit event
window.saveEventApplication = function(that, e) {
	e.preventDefault();
	var url = $(that).attr('action'),
			token = $(that).attr('meta[name="csrf-token"]'),
			data = $(that).serializeArray();

	data.push({ name: 'token', value: token });

	$(that).find('.btn-submit').html('<i class="fas fa-spinner fa-spin"></i>');

	$.ajax({
		url: url,
		type: 'POST',
		data: data,
		success: function(result) {
			$('#modal-edit').modal('toggle');
		},
		error: function(xhr) {
			$(that).find('.btn-submit').replaceWith('<button type="submit" class="btn btn-dark px-5">Salvar</button>');
			notify('<i class="fas fa-times fa-fw" aria-hidden="true"></i> ' + xhr.responseText, 'error');
		}
	});
}

// Notify
window.notify = function(msg, type) {
	new Noty({
		text: msg,
		layout: 'bottomRight',
		type: type,
		theme: 'mint',
		timeout: 3000
	}).show();
}
