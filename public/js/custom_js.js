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
var options = {
    chart: {
        width: "100%",
        height: 380,
        type: "bar",
    },
    colors: ["#ffd416", "#6495ed"],
    plotOptions: {
        bar: {
            horizontal: false,
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        width: 1,
        colors: ["#fff"],
    },
    series: [
        { name: "Target", data: [100, 100, 100, 100, 100, 100, 100] },
        { name: "Actual", data: [44, 55, 41, 64, 22, 43, 21] },
    ],
    xaxis: {
        categories: [
            "Line 1",
            "Line 2",
            "Line 3",
            "Line 4",
            "Line 5",
            "Line 6",
            "Line 7",
        ],
    },
    yaxis: {
        max: 100,
    },
    legend: {
        position: "bottom",
        verticalAlign: "top",
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
});
