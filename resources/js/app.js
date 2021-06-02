window._ = require("lodash");
const bootstrap = require('bootstrap');

// bootstrap tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
tooltipTriggerList.map(function (tooltipTriggerEl) {
	return new bootstrap.Tooltip(tooltipTriggerEl);
})

// js-datepicker
import datepicker from 'js-datepicker';

document.querySelectorAll('.datepicker').forEach(element => {
	let options = {
		startDay: 1,
		formatter: (input, date, instance) => {
			let dd = date.getDate();
			let mm = date.getMonth() + 1; // January is 0!
			let yyyy = date.getFullYear();

			if (dd < 10)
				dd = '0' + dd;

			if (mm < 10)
				mm = '0' + mm;

			input.value = dd + '.' + mm + '.' + yyyy;
		}
	};

	let parts = element.value.split('.');
	let date = new Date(parts[2], parts[1] - 1, parts[0]);
	if (!isNaN(date))
		options.dateSelected = date;

	datepicker(element, options);
});

// dashboard chart
import Chart from 'chart.js/auto';

window.initDashboardChart = function(labels, data) {
	new Chart(document.getElementById('employees-age-chart').getContext('2d'), {
		type: 'bar',
		data: {
			labels: labels,
			datasets: [
				{
					label: 'Count',
					data: data,
					borderColor: 'rgba(0, 0, 0, 0.5)',
					backgroundColor: 'rgba(0, 0, 0, 0.5)',
				},
			],
		},
		options: {
			responsive: true,
			plugins: {
				legend: {
					display: false,
				},
				title: {
					display: true,
					text: 'Employees by age',
				},
			},
		}
	});
}