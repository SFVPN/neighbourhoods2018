
jQuery(document).ready(function() {
  //  jQuery('.accordion p:empty, .orbit p:empty').remove();

var marksCanvas = document.getElementById("marksChart");
var marksData = {
	labels: Object.keys(audit_vars),
	datasets: [{
		label: "Rating",
		backgroundColor: "rgba(0, 150, 136, .75)",
		data: Object.values(audit_vars)
	}]
};

var radarChart = new Chart(marksCanvas, {
  type: 'radar',
  data: marksData,
  options: {
        layout: {
            padding: {
                left: 0,
                right: 0,
                top: 0,
                bottom: 0
            }
        },
        legend: {
            display: false
        },
        tooltips: {
            titleFontSize: 16,
            bodyFontSize: 14,
            bodySpace: 5,
            displayColors: false,
        },

    }
});
});
