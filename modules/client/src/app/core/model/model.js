(function() {
  'use strict';

  angular.module('Model').factory('model', function($http, $q, _, $rootScope, dictionary) {

    var method_map = {
      get: 'get',
      post: 'create',
      put: 'update',
      delete: 'remove'
    };

    var handle_errors = function(method, element) {
      return function(response) {
        if (_(response.data.errors).isEmpty()) {
          return response.data.response;
        }

        $rootScope.$broadcast('error', {
          action: dictionary(method_map[method]),
          element: element,
          problems: response.data.errors
        });
        return $q.reject(response.data.errors);
      };
    };

    function request_load_data(method, resource, action, params) {

      var path = full_path(resource, action, params);

      var options = {
        transformRequest: angular.identity,
        headers: {
          'Content-Type': undefined
        }
      };

      var request_params = new FormData();

      request_params.append('file', params.data.file);

      return $http[method](path, request_params, options)
        .then(handle_errors(method, resource));
    }

    function request(method, resource, action, params) {

      var path = full_path(resource, action, params);

      var request_params = {};

      if (params !== undefined && params.data) {
        request_params = {
          data: params.data
        };
      }
      return $http[method](path, request_params)
        .then(handle_errors(method, resource));
    }

    function full_path(resource, action, params) {

      var path = globalApp.base_url + resource + '/api/' + action;

      if (params !== undefined && params.url_params) {
        _(_.values(params.url_params)).each(function(param) {
          path += '/' + param;
        })
      }

      path += document.location.search;

      if (params !== undefined && params.fideicomiso) {
        path += '&fideicomiso=' + params.fideicomiso;
      }

      return path;
    }

    return function(resource) {

      return {

        request: {
          get: function(resource, action, params) {
            return request('get', resource, action, params);
          },

          create: function(resource, action, params) {
            return request('post', resource, action, params);
          },

          update: function(resource, action, params) {
            return request('put', resource, action, params);
          },

          remove: function(resource, action, params) {
            return request('delete', resource, action, params);
          },

          load_data: function(resource, action, params) {
            return request_load_data('post', resource, action, params);
          }
        },

        get: function(action, params) {
          return this.request.get(resource, action, params);
        },

        create: function(action, params) {
          return this.request.create(resource, action, params);
        },

        update: function(action, params) {
          return this.request.update(resource, action, params);
        },

        remove: function(action, params) {
          return this.request.remove(resource, action, params);
        },

        load_data: function(action, params) {
          return this.request.load_data(resource, action, params);
        }
      };

    };
  });
})();