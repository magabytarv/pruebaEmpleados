(function() {
	'use strict';

	angular.module('Directives').directive('validation', function(_) {

		var directive = {
			restrict: 'A',
			priority: 1,
			scope: true,
			link: function(scope, elem, attrs) {
				var errors_messages = {
					required: 'Campo requerido!',
					number: ' El valor debe ser númerico!',
					email: ' Debe ser un email válido!',
					minlength: get_ming_lenght_error(),
					maxlength: get_max_lenght_error(),
					min: get_ming_error(),
					max: get_max_error(),
					onlyletters: 'Solo puede contener letras!',
					invalid_id_card: 'Cédula inválida!',
					invalid_legal_ruc: 'Ruc inválido!'
				};

				var element = $(elem);
				element.on('remove', function() {
					var control = scope.$eval(form_name + '["' + element.attr('id') + '"]');
					control.removed = true;
				});

				var attribute_name = attrs.name;
				var form = $(element).parents('form');
				var form_name = form.attr('name');
				var help_block = $('<p id=' + attrs.id + '_error class="text-danger form-element-error" style="font-size:10px;"></p>');
				var to_validate = element.parents('.to-validate');

				scope.$watch(form_name + '.' + attribute_name + '.$valid', function() {
					validate_input();
				});

				element.on('blur', validate_input);

				form.on('submit', function() {
					set_dirty();
					validate_input();
				});

				element.on('focus', set_dirty);

				scope.$watch(attrs.ngModel, function(new_value, old_value) {
					if (new_value !== old_value) {
						set_dirty();
						validate_input();
					}
				});

				function set_dirty() {
					scope.$eval(form_name + '.' + attribute_name + '.$dirty = true');
					scope.$eval(form_name + '.' + attribute_name + '.$pristine = false');
				}

				function validate_input() {
					var is_invalid = scope.$eval(form_name + '.' + attribute_name + '.$invalid');
					var is_dirty = scope.$eval(form_name + '.' + attribute_name + '.$dirty');

					if (is_invalid && is_dirty) {

						to_validate.addClass('has-error');

						if (element.parent().hasClass('input-group')) {
							element.parent().parent().append(help_block);
						} else {
							element.parent().append(help_block);
						}

						//help_block.text($filter('translate')(get_validation_message()));
						help_block.text(get_validation_message());
						help_block.show();

						return;
					}

					$(to_validate).removeClass('has-error');
					help_block.text('');
					help_block.hide();
				}

				function get_validation_message() {

					if (attrs.validation !== '') {
						return attrs.validation;
					}

					var error_message = '';
					var errors = scope.$eval(form_name + '.' + attribute_name + '.$error');

					_(errors).each(function(invalid, error) {
						if (invalid && errors_messages[error]) {
							if (error_message !== '') {
								error_message += ', ';
							}
							error_message += errors_messages[error];
						}
					});

					return error_message;
				}

				function get_ming_lenght_error() {
					var ming_length = attrs.ngMinlength;
					return 'Debe tener al menos ' + ming_length + ' caracteres!';
				}

				function get_max_lenght_error() {
					var ming_length = attrs.ngMaxlength;
					return 'Debe tener máximo ' + ming_length + ' caracteres!';
				}

				function get_max_error() {
					var max_length = attrs.max;
					return 'El valor ingresado debe ser menor o igual a ' + max_length;
				}

				function get_ming_error() {
					var ming_length = attrs.min;
					return 'El valor ingresado debe ser mayor a ' + ming_length;
				}
			}
		};

		return directive;
	});
})();