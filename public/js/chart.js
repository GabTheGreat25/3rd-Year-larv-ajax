$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/api/operator-chart",
        dataType: "json",
        success: function (data) {
            console.log(data);
            var ctx = $("#operatorChart");
            var myBarChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: data.labels,
                    datasets: [
                        {
                            label: "Most Operator That Is Hired",
                            data: data.data,
                            backgroundColor: [
                                "rgba(75, 192, 192, 0.2)",
                                "rgba(255, 99, 132, 0.2)",
                                "rgb(255,0,0)",
                                "rgb(255,0,255)",
                            ],
                            borderColor: [
                                "rgba(75, 192, 192, 1)",
                                "rgba(255,99,132,1)",
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

    // $.ajax({
    //     type: "GET",
    //     url: "/api/dashboard/class-chart",
    //     dataType: "json",
    //     success: function (data) {
    //         console.log(data);
    //         var ctx = document.getElementById("salesChart");
    //         const chartAreaBorder = {
    //             id: "chartAreaBorder",
    //             beforeDraw(chart, args, options) {
    //                 const {
    //                     ctx,
    //                     chartArea: { left, top, width, height },
    //                 } = chart;
    //                 ctx.save();
    //                 ctx.strokeStyle = options.borderColor;
    //                 ctx.lineWidth = options.borderWidth;
    //                 ctx.setLineDash(options.borderDash || []);
    //                 ctx.lineDashOffset = options.borderDashOffset;
    //                 ctx.strokeRect(left, top, width, height);
    //                 ctx.restore();
    //             },
    //         };
    //         var myBarChart = new Chart(ctx, {
    //             type: "doughnut",
    //             data: {
    //                 labels: data.labels,
    //                 datasets: [
    //                     {
    //                         label: "Top Class Bought",
    //                         data: data.data,
    //                         backgroundColor: [
    //                             "rgba(75, 192, 192, 0.2)",
    //                             "rgba(255, 99, 132, 0.2)",
    //                         ],
    //                         borderColor: [
    //                             "rgba(75, 192, 192, 1)",
    //                             "rgba(255,99,132,1)",
    //                         ],
    //                         borderWidth: 1,
    //                     },
    //                 ],
    //             },
    //             options: {
    //                 scales: {
    //                     y: {
    //                         beginAtZero: true,
    //                     },
    //                 },
    //                 plugins: {
    //                     chartAreaBorder: {
    //                         borderColor: "blue",
    //                         borderWidth: 3,
    //                         borderDash: [0, 0],
    //                         borderDashOffset: 2,
    //                     },
    //                 },
    //             },
    //             plugins: [chartAreaBorder],
    //         });
    //     },
    //     error: function (error) {
    //         console.log(error);
    //     },
    // });
});
