var barNew = {
    series: [
        {
            name: "Data",
            data: [44, 55, 67, 67]
        }
    ],
    chart: {
        type: "bar",
        height: 350,
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: "10%",
            endingShape: "rounded",
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
    },
    xaxis: {
        categories: ["Uploaded", "Installed", "Confirmed", "Cancelled"],
    },
    yaxis: {
        title: {
            text: "Number of Applications",
        },
    },
    fill: {
        opacity: 1,
    },
    //different color 
    colors: ["#0566a3", "#1ea271", "#0f3c91", "#0566a3"],
};


var barOpen = new ApexCharts(document.querySelector("#bar"), barNew);

barOpen.render();