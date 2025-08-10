/*
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 5
Version: 5.4.1
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin/
*/

var handleDataTableDefault = function () {
	"use strict";

	if ($('#data-table-default').length !== 0) {
		$('#data-table-default').DataTable({
			responsive: true
		});
	}

	if ($('#data-table-side').length !== 0) {
		$('#data-table-side').DataTable({
			responsive: true,
			paging: false,    // walang pagination
			info: false,      // walang "Showing 1 to X of Y entries"
			searching: true   // naka-enable ang search box
		});
	}


	if ($('#data-table-course').length !== 0) {
		$('#data-table-course').DataTable({
			responsive: true
		});
	}

	if ($('#data-table-block').length !== 0) {
		$('#data-table-block').DataTable({
			responsive: true
		});
	}
};

var TableManageDefault = function () {
	"use strict";
	return {
		//main function
		init: function () {
			handleDataTableDefault();
		}
	};
}();

$(document).ready(function () {
	TableManageDefault.init();
});