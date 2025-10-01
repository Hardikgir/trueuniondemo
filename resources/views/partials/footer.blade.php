<footer class="site-footer">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 text-center text-gray-500 text-sm">
        &copy; {{ date('Y') }} TrueUnion. All Rights Reserved.
    </div>
</footer>

<!-- Loader JavaScript -->
<script>
    // Get a reference to the loader wrapper by its ID
    const loader = document.getElementById('loader');
    // Get all the anchor links on the page
    const links = document.querySelectorAll('a');

    // Function to make the loader visible
    const showLoader = () => {
        loader.classList.add('show');
    };

    // Function to hide the loader
    const hideLoader = () => {
        loader.classList.remove('show');
    };

    // Hide the loader once the page is fully loaded initially
    window.addEventListener('load', hideLoader);

    // FIX: Listen for the pageshow event, which fires on back/forward navigation
    window.addEventListener('pageshow', function (event) {
        // The event.persisted property is true if the page is from the bfcache
        if (event.persisted) {
            hideLoader();
        }
    });

    // Loop through every link on the page
    links.forEach(link => {
        // Add a click event listener to each link
        link.addEventListener('click', (e) => {
            const href = link.getAttribute('href');
            
            // If the link is valid, not an anchor (#), and not pointing to the current page,
            // show the loader. This prevents the loader from showing unnecessarily.
            if (href && !href.startsWith('#') && href !== window.location.href) {
                showLoader();
            }
        });
    });
</script>
