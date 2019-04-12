/* global $ */
/* this is an example for validation and change events */
var valueArray = [];

if (document.getElementById('orderId') !== null)
	var orderId = document.getElementById("orderId").value;

$.fn.numericInputExample = function (dataId) {
	'use strict';
	var element = $(this),
		footer = element.find('tfoot tr'),
		dataRows = element.find('tbody tr'),
		initialTotal = function () {
			var column, total;
			for (column = dataId; column < dataId + 1; column++) {
				total = 0;
				dataRows.each(function () {
					var row = $(this);
					total += parseFloat(row.children().eq(column).text());
				});
				if (isNaN(total)) {
					total = 0;
					footer.children().eq(column).text(total.toFixed(2));
				} else {
					footer.children().eq(column).text(total.toFixed(2));
				}
			}
			;
		};
	element.find('td').on('change', function (evt) {
		var cell = $(this),
			column = cell.index(),
			total = 0;
		if (column === 0) {
			return;
		}
		valueArray = [];
		element.find('tbody tr').each(function () {
			var row = $(this);
			var value = parseFloat(row.children().eq(column).text());
			var detailId = row.children().eq(0).text()
			if (!isNaN(value)) {
				valueArray.push({
					ode_id: detailId,
					ode_price: value,
					ode_discount: 0,
					ode_total: value,
					orderId: orderId,
				})
				total += parseFloat(value);
			}
		});
		// console.log(valueArray);
		if (column === 1 && total > 50000000) {
			$('.alert').show();
			return false; // changes can be rejected
		} else {
			$('.alert').hide();
			footer.children().eq(column).text(total.toFixed(2));
		}
	}).on('validate', function (evt, value) {
		var cell = $(this),
			column = cell.index();
		if (column === 0) {
			return !!value && value.trim().length > 0;
		} else {
			return !isNaN(parseFloat(value)) && isFinite(value);
		}
	});
	initialTotal();
	return this;
};
