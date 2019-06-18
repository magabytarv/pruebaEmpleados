'use strict';

angular.module('Directives').directive('chosenselect', function ($parse, _) {

    function value_is_object(options_value) {
        return (options_value.split('.').length === 1);
    }

    function value_property(options_value) {
        return options_value.split('.')[1];
    }

    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            var model_get = $parse(attrs.ngModel);
            var model_set = model_get.assign;

            var options = attrs.ngOptions.split(' ');
            var collection_string = options[_.indexOf(options, 'in') + 1];

            var disabled_options_collection_string = '';
            if (attrs.disabledOptions) {
                var disabled_options = attrs.disabledOptions.split(' ');
                disabled_options_collection_string = disabled_options[_.indexOf(disabled_options, 'in') + 1];
            }


            scope.$watch(collection_string, function () {
                if (_(attrs).has('useHtml')) {
                    _($(element).find('option')).each(function (option) {
                        $(option).html($(option).text());
                    });
                }
                $(element).trigger('chosen:updated');
            }, true);

            scope.$watch(attrs.ngModel, function () {
                $(element).trigger('chosen:updated');
            }, true);

            scope.$watch(disabled_options_collection_string, function () {
                $(element).trigger('chosen:updated');
            }, true);

            $(element).chosen({width: '100%'});
            $(element).change(function () {
                scope.$apply(function () {
                    var collection = $parse(collection_string)(scope);

                    var value = collection[element.val()];

                    if (!value_is_object(options[0])) {
                        var property = value_property(options[0]);
                        value = collection[element.val()][property];
                    }

                    model_set(scope, value);
                });
                scope.$apply(attrs.ngChange);

                var selected_element = $(element).data('chosen').container.find('a.chosen-single span');
                selected_element.text(selected_element.text().trim());
            });
        }
    };
});