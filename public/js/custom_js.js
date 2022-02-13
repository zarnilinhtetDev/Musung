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

$("#myInput").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
});

function toggle_div_fun(id) {
    var divelement = document.getElementById(id);
    if (divelement.style.display == "none") divelement.style.display = "block";
    else divelement.style.display = "none";
}
function toggleMe() {
    var text = document.getElementById("password2");
    var password_div = document.getElementById("password-div");
    password_div.style.display =
        window.getComputedStyle(password_div, null).display === "none"
            ? "block"
            : "none";
}
$(document).ready(function () {
    ////Tabs Change////
    $("#tab-content .div_1").hide();
    $("#tab-content .div_1:first").show();

    $("#nav li.span2").click(function () {
        $("#nav li a").removeClass("active");
        $(this).find("a").addClass("active");
        $("#tab-content .div_1").hide();

        var indexer = $(this).index(); //gets the current index of (this) which is #nav li
        $("#tab-content .div_1:eq(" + indexer + ")").fadeIn(); //uses whatever index the link has to open the corresponding box
    });
});
$(document).ready(function () {
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

var i = 1;
$("#add_product_detail").click(function () {
    i++;
    $("#dynamic_field").append(
        '<tr id="row' +
            i +
            '"><td><label>Category</label> <select class="form-control" name="category[]" required><option></option><option value="0">Coat</option><option value="1">Shirt</option><option value="2">Trousers</option></select></td><td><label>Product Name</label><input type="text" class="form-control" name="p_name[]" placeholder="Musung Shirt" required /></td><td><label>Target</label><input type="text" class="form-control" name="category_target[]" id="setting_target" placeholder="Target" required /></td><td><br/><button type="button" name="remove" id="' +
            i +
            '" class="btn btn-danger btn_remove">X</button></td></tr>'
    );
});
$(document).on("click", ".btn_remove", function () {
    var button_id = $(this).attr("id");
    $("#row" + button_id + "").remove();
});
///insert data into LineModal of Line Setting
var LineModal = document.getElementById("LineModal");
LineModal.addEventListener("show.bs.modal", function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget;
    // Extract info from data-bs-* attributes
    var l_id = button.getAttribute("data-bs-l-id");
    var l_name = button.getAttribute("data-bs-l-name");
    var l_status = button.getAttribute("data-bs-l-status");

    var l_id_input = document.getElementById("l_id_2");
    var l_setting_name_2 = document.getElementById("l_setting_name_2");

    l_id_input.value = l_id;
    l_setting_name_2.innerHTML = l_name;
});

$(document).ready(function () {
    var target_setting = $("#setting_target");
    target_setting.on("keyup", function () {
        target_setting.each(function (index) {
            console.log($(this).val());
        });
    });
    var dynamic_field = $("#dynamic_field #setting_target");
    dynamic_field.on("keyup", function () {
        dynamic_field.each(function (index) {
            console.log($(this).val());
        });
    });
});

///// Time Diff in Line Setting /////
$(document).ready(function () {
    $("#LineModal").on("show.bs.modal", function () {
        $("#start_time").on("change", function () {
            var start_time = $("#start_time").val();
            $("#s_time").val(start_time);
            $("#end_time").on("change", function () {
                var end_time = $("#end_time").val();
                $("#e_time").val(end_time);

                var start = $("#s_time").val();
                var end = $("#e_time").val();

                s = start.split(":");
                e = end.split(":");

                min = e[1] - s[1];
                hour_carry = 0;
                if (min < 0) {
                    min += 60;
                    hour_carry += 1;
                }
                hour = e[0] - s[0] - hour_carry;
                diff = hour + ":" + min;

                $("#work_hour").val(diff);
            });
        });
    });
});
$(document).ready(function () {
    $("#exampleModal2").on("show.bs.modal", function () {
        //// TextArea Count /////
        var maxChars = 150;
        var textLength = 0;
        var comment = "";
        var outOfChars = textLength + " character left";

        /* initalize for when no data is in localStorage */
        var count = maxChars;
        $("#characterLeft").text(count + " characters left");

        /* fix val so it counts carriage returns */
        $.valHooks.textarea = {
            get: function (e) {
                return e.value.replace(/\r?\n/g, "\r\n");
            },
        };

        function checkCount() {
            textLength = $("#comment").val().length;
            if (textLength >= maxChars) {
                $("#characterLeft").text(outOfChars);
            } else {
                count = maxChars - textLength;
                $("#characterLeft").text(count + " characters left");
            }
        }

        /* on keyUp: update #characterLeft as well as count & comment in localStorage */
        $("#comment").keyup(function () {
            checkCount();
            comment = $(this).val();
            localStorage.setItem("comment", comment);
        });

        /* on pageload: get check for comment text in localStorage, if found update comment & count */
        // if (localStorage.getItem("comment") != null) {
        //     $("#comment").text(localStorage.getItem("comment"));
        //     checkCount();
        // }

        //TextArea Count End///
    });
});
$(document).ready(function () {
    $(".sidebar-link").on("click", function () {
        $(".collapse").collapse("hide");
    });

    let min = 60;

    let time = $("input[id=last-input]").last().val();

    $("input[id=add-time]").val(addtime(time, min));
    function addtime(time, hour) {
        let times = time.split(":");
        //clear here more than 24 hours
        min = min % (24 * 60);
        times[0] = parseInt(times[0]) + parseInt(min / 60);
        times[1] = parseInt(times[1]) + (min % 60);
        //here control if hour and minutes reach max
        if (times[1] >= 60) {
            times[1] = 0;
            times[0]++;
        }
        times[0] >= 24 ? (times[0] -= 24) : null;

        //here control if less than 10 then put 0 frond them
        times[0] < 10 ? (times[0] = "0" + times[0]) : null;
        times[1] < 10 ? (times[1] = "0" + times[1]) : null;

        return times.join(":");
    }

    $(".input-numeric-one").focus(function () {
        $("#numeric").hide();
        $("#numeric_one").show();
        $(document).on("change", ".input-numeric-one", function () {
            var input = $(".input-numeric-one");
            var nonKeys = $(".key-del-one, .key-clear-one");
            var inputValue = input.val();

            if (inputValue == "") {
                nonKeys.prop("disabled", true);
            } else {
                nonKeys.prop("disabled", false);
            }
        });

        //key numeric
        $(document).on("click", ".key-one", function () {
            var number = $(this).attr("data-key");
            var input = $(".input-numeric-one");
            var inputValue = input.val();

            input.val(inputValue + number).change();
        });

        //delete
        $(document).on("click", ".key-del-one", function () {
            var input = $(".input-numeric-one");
            var inputValue = input.val();

            input.val(inputValue.slice(0, -1)).change();
        });

        //clear
        $(document).on("click", ".key-clear-one", function () {
            var input = $(".input-numeric-one");

            input.val("").change();
        });
    });
    $(".input-numeric").focus(function () {
        $("#numeric_one").hide();
        $("#numeric").show();
        $(document).on("change", ".input-numeric", function () {
            var input = $(".input-numeric");
            var nonKeys = $(".key-del, .key-clear");
            var inputValue = input.val();

            if (inputValue == "") {
                nonKeys.prop("disabled", true);
            } else {
                nonKeys.prop("disabled", false);
            }
        });

        $(document).on("click focus", ".input-numeric", function () {
            var parents = $(this).parents(".input-numeric-container");
            var data = parents.attr("data-numeric");

            if (data) {
                if (data == "hidden") {
                    parents.find(".table-numeric").show();
                }
            }
        });

        //key numeric
        $(document).on("click", ".key", function () {
            var number = $(this).attr("data-key");
            var input = $(".input-numeric");
            var inputValue = input.val();

            input.val(inputValue + number).change();
        });

        //delete
        $(document).on("click", ".key-del", function () {
            var input = $(".input-numeric");
            var inputValue = input.val();

            input.val(inputValue.slice(0, -1)).change();
        });

        //clear
        $(document).on("click", ".key-clear", function () {
            var input = $(".input-numeric");

            input.val("").change();
        });
    });
});

$(document).on("click", ".remove-field", function (e) {
    $(this).parent(".remove").remove();
    e.preventDefault();
});

$(document).ready(function () {
    //// TextArea Count /////
    var maxChars = 150;
    var textLength = 0;
    var comment = "";
    var outOfChars = textLength + " character left";

    /* initalize for when no data is in localStorage */
    var count = maxChars;
    $("#characterLeft").text(count + " characters left");

    /* fix val so it counts carriage returns */
    $.valHooks.textarea = {
        get: function (e) {
            return e.value.replace(/\r?\n/g, "\r\n");
        },
    };

    function checkCount() {
        textLength = $("#comment").val().length;
        if (textLength >= maxChars) {
            $("#characterLeft").text(outOfChars);
        } else {
            count = maxChars - textLength;
            $("#characterLeft").text(count + " characters left");
        }
    }

    /* on keyUp: update #characterLeft as well as count & comment in localStorage */
    $("#comment").keyup(function () {
        checkCount();
        comment = $(this).val();
        localStorage.setItem("comment", comment);
    });

    /* on pageload: get check for comment text in localStorage, if found update comment & count */
    // if (localStorage.getItem("comment") != null) {
    //     $("#comment").text(localStorage.getItem("comment"));
    //     checkCount();
    // }

    //TextArea Count End///

    //// New Dynamic Line for p_detail in LineSetting /////
});
