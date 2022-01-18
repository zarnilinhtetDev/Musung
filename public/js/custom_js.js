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
        type: "bar",
        stackType: "100%",
    },
    series: [
        {
            name: "sales",
            data: [30, 40, 45, 50, 49, 60, 70, 91, 100],
        },
    ],
    xaxis: {
        categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999],
    },
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
