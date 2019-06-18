'use strict';

angular.module('Dictionary').factory('dictionary', function($locale, _){
  var locale = $locale.id;
  var default_locale = 'es-es';

  var dictionary = {
    'es-es' : {
      create: 'crear'
    }
  };

  return function(key, specified_locale) {

    if(specified_locale !== undefined) {
      locale = locale;
    }

    if(!_(dictionary).has(locale)) {
      locale = default_locale;
    }

    if(!_(dictionary[locale]).has(key)) {
      return key;
    }

    return dictionary[locale][key];
  };

});
