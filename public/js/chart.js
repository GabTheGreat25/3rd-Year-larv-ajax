$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/api/operator-chart",
        beforeSend: function (header) {
            header.setRequestHeader(
                "Authorization",
                "Bearer " + localStorage.getItem("token")
            );
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            var ctx = $("#operatorChart");
            var myBarChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: data.labels,
                    datasets: [
                        {
                            label: "Most Operator That Is Hired",
                            data: data.data,
                            backgroundColor: [
                                "rgba(58, 227, 116,1.0)",
                                "rgba(103, 230, 220,1.0)",
                                "rgb(125, 95, 255)",
                                "rgb(255, 250, 101)",
                            ],
                            borderColor: [
                                "rgba(255, 56, 56,1.0)",
                                "rgba(205, 132, 241,1.0)",
                            ],
                            borderWidth: 2,
                            borderRadius: Number.MAX_VALUE,
                            borderSkipped: false,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: "top",
                        },
                    },
                },
            });
        },
        error: function (error) {
            console.log(error);
        },
    });

    $.ajax({
        type: "GET",
        url: "/api/sales-chart",
        beforeSend: function (header) {
            header.setRequestHeader(
                "Authorization",
                "Bearer " + localStorage.getItem("token")
            );
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            var ctx = document.getElementById("salesChart");
            const chartAreaBorder = {
                id: "chartAreaBorder",
                beforeDraw(chart, args, options) {
                    const {
                        ctx,
                        chartArea: { left, top, width, height },
                    } = chart;
                    ctx.save();
                    ctx.strokeStyle = options.borderColor;
                    ctx.lineWidth = options.borderWidth;
                    ctx.setLineDash(options.borderDash || []);
                    ctx.lineDashOffset = options.borderDashOffset;
                    ctx.strokeRect(left, top, width, height);
                    ctx.restore();
                },
            };
            var myBarChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: data.labels,
                    datasets: [
                        {
                            label: "Monthly sales",
                            data: data.data,
                            backgroundColor: [
                                "rgba(41, 128, 185,0.4)",
                                "rgba(192, 57, 43,0.4)",
                            ],
                            borderColor: [
                                "rgba(75, 192, 192, 1)",
                                "rgba(255,99,132,1)",
                            ],
                            borderWidth: 1,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                    plugins: {
                        chartAreaBorder: {
                            borderColor: "blue",
                            borderWidth: 3,
                            borderDash: [0, 0],
                            borderDashOffset: 2,
                        },
                    },
                },
                plugins: [chartAreaBorder],
            });
        },
        error: function (error) {
            console.log(error);
        },
    });

    $.ajax({
        type: "GET",
        url: "/api/acc-chart",
        beforeSend: function (header) {
            header.setRequestHeader(
                "Authorization",
                "Bearer " + localStorage.getItem("token")
            );
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            var ctx = document.getElementById("accChart");
            var myBarChart = new Chart(ctx, {
                type: "doughnut",
                data: {
                    labels: data.labels,
                    datasets: [
                        {
                            label: "number of accessories sold",
                            data: data.data,
                            backgroundColor: () => {
                                var colors = [];
                                for (var i = 0; i < data.data.length; i++) {
                                    var letters = "0123456789ABCDEF".split("");
                                    var color = "#";
                                    for (var x = 0; x < 6; x++) {
                                        color +=
                                            letters[
                                                Math.floor(Math.random() * 16)
                                            ];
                                    }
                                    colors.push(color);
                                }
                                return colors;
                            },
                            borderColor: [
                                "rgba(27, 156, 252,1.0)",
                                "rgba(252, 66, 123,1.0)",
                            ],
                            borderWidth: 1,
                            responsive: true,
                        },
                    ],
                },
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
});
