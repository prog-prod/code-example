<script src="{{ asset('js/aos.js') }}"></script>
<!-- google map -->
<script src="{{ asset('js/gmap.js') }}"></script>
<script>
    window.onload = function() {
        let preloader = document.querySelector('.preloader');
        preloader.style.transition = 'opacity 0.6s';
        preloader.style.opacity = '0';
        preloader.addEventListener('transitionend', function() {
            preloader.style.display = 'none';
        });
    };
</script>
