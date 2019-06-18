'use strict';

angular.module('Utils').factory('date_utils', function() {
	
	function format_date(date, format) {
		format = format || 'YYYY/MM/DD';
		return date.format(format);
	}
	
	function initial_report_date(format) {
		
		var start_date = moment().add('months', -1);
		var end_date = moment();
		
		return {start_date: format_date(start_date, format), end_date: format_date(end_date, format)};
	}
	
	function date_diff_days(date1, date2) {
	  return moment(date1).diff(moment(date2), 'days');
	}

	return {
		current_date: function(format) {
			return format_date(moment(), format);
		},
		format_date: function(date, format) {
			return format_date(moment(date), format);
		},
		initial_report_date: function(format) {
			return initial_report_date(format);
		},
		date_diff_days: function (date1, date2) {
			return date_diff_days(date1, date2);
		}
	}
});
