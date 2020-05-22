(function ($) {

    $(document).ready(function sidebar() {
        $('#sidebarCollapse').on('click', function sidebar() {
            $('#sidebar, #content').toggleClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
    });

    $(document).ready(function () {
        $(window).on("scroll", function () {
            if ($(window).scrollTop() >= 20) {
                $(".navbar").addClass("compressed");
            } else {
                $(".navbar").removeClass("compressed");
            }
        });
    });



    $('.paring_carousel').owlCarousel({
        loop: false,
        margin: 10,
        dots: false,
        autoplay: true,
        nav: true,
        navText: [$('.owl-navigation .owl-nav-prev'), $('.owl-navigation .owl-nav-next')],
        autoplayTimeout: 6000,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    $('.week_carousel').owlCarousel({
        loop: false,
        margin: 10,
        dots: false,
        autoplay: true,
        autoplayTimeout: 6000,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            },
            1600: {
                items: 5
            }
        }
    });


    $(".toggle-password").click(function () {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });


})(jQuery);

function goBack() {
    window.history.back();
}


var yb = { id: function (str) { return document.getElementById(str) } };


function showSliderValue() { yb.id('slidervalue').innerHTML = yb.id('slider').value + '%'; }


showSliderValue();
setProgress();

yb.id('slider').oninput = function () { showSliderValue(); setProgress() };
yb.id('slider').onchange = function () { showSliderValue(); setProgress() };


function setProgress() {
    var radius = yb.id('progress').getAttribute('r');
    var circumference = 2 * Math.PI * radius;

    var progress_in_percent = yb.id('slider').value;
    var progress_in_pixels = circumference * (100 - progress_in_percent) / 100;
    yb.id('progress').style.strokeDashoffset = progress_in_pixels + 'px';

    if (yb.id('slider').value < 25) {
        yb.id('progress').style.stroke = 'red';
        yb.id('slidervalue').style.color = 'red';
    }
    else if (yb.id('slider').value >= 75) {
        yb.id('progress').style.stroke = '#4586ff';
        yb.id('slidervalue').style.color = '#4586ff';
    }
    else {
        yb.id('progress').style.stroke = '#30e3ca';
        yb.id('slidervalue').style.color = '#30e3ca';
    }
}



function CheckFunction() {
    if (document.getElementById('Checks').checked) {
        document.getElementById('nick').style.display = "inline";
        document.getElementById('customFile').setAttribute('required', true);
    }
    else {
        document.getElementById('customFile').removeAttribute('required');
        document.getElementById('nick').style.display = "none";
    }
}




/*
const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
const currentTheme = localStorage.getItem('theme');

if (currentTheme) {
    document.documentElement.setAttribute('data-theme', currentTheme);

    if (currentTheme === 'dark') {
        toggleSwitch.checked = true;
    }
}

function switchTheme(e) {
    if (e.target.checked) {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
    }
    else {
        document.documentElement.setAttribute('data-theme', 'light');
        localStorage.setItem('theme', 'light');
    }
}

toggleSwitch.addEventListener('change', switchTheme, false);
*/
