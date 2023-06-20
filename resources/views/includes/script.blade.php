<script>
    const menuContent = document.querySelector("#menuContent");

    const menuButtons = document.querySelectorAll(".menu-buttons button");

    const menuHeight = getComputedStyle(document.documentElement).getPropertyValue(
        "--menu-height"
    );

    const toggleMenuOpen = (value) => {
        document.body.classList.toggle("open", value);
    };

    const toggleMenuBlock = (event, index) => {
        menuButtons.forEach((button) => button.classList.remove("active"));
        event.classList.toggle("active");
        menuContent.style.translate = `0 calc(0px - ${menuHeight} * ${index})`;
    };
</script>

<!-- Bootstrap -->
<script type="text/javascript" src="{{ asset('/bootstrap-5.0.2/dist/js/bootstrap.min.js') }}"></script>

<!-- Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
    integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Jquery -->

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<!-- Vanila Tilt -->
<script src="{{ asset('/script/vanilla-tilt.js') }}"></script>
<!-- Vanila Tilt -->

<!-- Owl Carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Owl Carousel -->

<script defer src='{{ asset('carousel/static.cloudflareinsights.com/beacon.min.js') }}'
    data-cf-beacon='{"token": "07e9b2efafbd4b458690b79234a62148"}'></script>

<!-- Data Aos -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init()
</script>
<!-- Data Aos -->

<script>
    // <!-- Navbar Scroll -->
    const navbar = document.querySelector('.navbar')

    window.addEventListener('scroll', () => {
        if (window.scrollY === 0) {
            navbar.classList.add('navbar-transparent')
            navbar.classList.remove('bg-dark')
        } else {
            navbar.classList.remove('navbar-transparent')
            navbar.classList.add('bg-dark')
        }
    })

    // <!-- Navbar Toggler -->
    document
        .querySelector('.navbar-toggler')
        .addEventListener('click', () => {
            navbar.classList.add('bg-dark')
        })

    // Dropdown behavior for screens wider than 991px
    if (window.matchMedia('(min-width: 991px)').matches) {
        $('.dropdown').hover(
            () => {
                $('.dropdown-menu').addClass('show')
            },
            () => {
                $('.dropdown-menu').removeClass('show')
            },
        )
    }

    // Dropdown behavior for screens narrower than 991px
    if (window.matchMedia('(max-width: 991px)').matches) {
        $('.dropdown').on('click', () => {
            $('.dropdown-menu').toggleClass('show')
        })
    }
</script>
