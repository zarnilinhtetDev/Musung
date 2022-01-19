/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function (event) {
    if (!event.target.matches(".dropbtn")) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains("show")) {
                openDropdown.classList.remove("show");
            }
        }
    }
};
var colors = ["#1dc1dd", "#0074c8"];
var options = {
    chart: {
        height: 400,
        type: "bar",
        parentHeightOffset: 0,
        fontFamily: "Poppins, sans-serif",
        toolbar: {
            show: true,
        },
    },
    grid: {
        borderColor: "#c7d2dd",
        strokeDashArray: 5,
    },
    colors: colors,
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: "70%",
            endingShape: "flat",
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
    series: [
        {
            name: "Actual",
            data: [40, 28, 47, 22, 34, 25, 30, 50],
        },
        {
            name: "Target",
            data: [100, 100, 100, 100, 100, 100, 100, 100],
        },
    ],
    xaxis: {
        categories: [
            "data 1",
            "data 2",
            "data 3",
            "data 4",
            "data 5",
            "data 6",
            "data 7",
            "data 8",
        ],
        labels: {
            style: {
                colors: ["#353535"],
                fontSize: "16px",
                fontFamily: "Poppins, sans-serif",
            },
        },
        axisBorder: {
            color: "#8fa6bc",
        },
    },
    yaxis: {
        title: {
            text: "",
        },
        labels: {
            style: {
                colors: "#353535",
                fontSize: "16px",
                fontFamily: "Poppins, sans-serif",
            },
        },
        axisBorder: {
            color: "#f00",
        },
        max: 100,
    },
    legend: {
        horizontalAlign: "right",
        position: "top",
        fontSize: "16px",
        fontFamily: "Poppins, sans-serif",
        labels: {
            colors: "#353535",
        },
        markers: {
            width: 15,
            height: 15,
            radius: 0,
        },
        itemMargin: {
            vertical: 20,
        },
    },
    fill: {
        opacity: 1,
    },
    tooltip: {
        style: {
            fontSize: "15px",
            fontFamily: "Poppins, sans-serif",
        },
        y: {
            formatter: function (val) {
                return val;
            },
        },
    },
    responsive: [
        {
            breakpoint: 1000,
            options: {
                plotOptions: {
                    bar: {
                        horizontal: true,
                    },
                },
                legend: {
                    position: "bottom",
                },
            },
        },
    ],
};

var chart = new ApexCharts(document.querySelector("#target_chart"), options);

chart.render();

var options_2 = {
    series: [
        {
            name: "Actual",
            data: [40, 72, 47, 60, 34, 25, 30, 55, 80],
        },
        {
            name: "Target",
            data: [100, 100, 100, 100, 100, 100, 100, 100, 100],
        },
    ],
    chart: {
        type: "bar",
        height: "100%",
    },
    colors: colors,
    plotOptions: {
        bar: {
            borderRadius: 4,
            horizontal: true,
        },
    },
    dataLabels: {
        enabled: false,
    },
    xaxis: {
        categories: [
            "Line 1",
            "Line 3",
            "Line 4",
            "Line 4S",
            "Line 5A",
            "Line 5S",
            "Line 8",
            "Mini",
            "Total",
        ],
        max: 100,
    },
};

var chart_2 = new ApexCharts(
    document.querySelector("#live_bar_chart"),
    options_2
);
chart_2.render();

$(document).ready(function () {
    $(".sidebar-link").on("click", function () {
        $(".collapse").collapse("hide");
    });
    $("#myInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    $("#tab-content .div_1").hide();
    $("#tab-content .div_1:first").show();

    $("#nav li").click(function () {
        $("#nav li a").removeClass("active");
        $(this).find("a").addClass("active");
        $("#tab-content .div_1").hide();

        var indexer = $(this).index(); //gets the current index of (this) which is #nav li
        $("#tab-content .div_1:eq(" + indexer + ")").fadeIn(); //uses whatever index the link has to open the corresponding box
    });

    //// Show Hide Navbar
    $("#btn_navbar_close").click(function () {
        //get collapse content selector
        var collapse_content_selector = $(this).attr("href");
        console.log(collapse_content_selector);

        //make the collapse content to be shown or hide
        var toggle_switch = $(this);
        $(collapse_content_selector).toggle(function () {
            if ($(this).css("display") == "none") {
                //change the button label to be 'Show'
                toggle_switch.html(
                    "<span class='text-white'>Show Navigation Bar</span>"
                );
            } else {
                //change the button label to be 'Hide'
                toggle_switch.html(
                    "<span class='text-white'>Hide Navigation Bar</span>"
                );
            }
        });
    });
});
