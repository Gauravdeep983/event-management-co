<footer>
    <div id="banner">
        <div class="footer-caption">
            <div class="left">
                <h2>Contactate con<span> Nosotros</span></h2>
            </div>

            <form class="right">
                <div class="emailForm">
                    <input type="email" placeholder="Email" name="email" />
                    <button class="emailButton" type="submit">ENVIAR</button>
                </div>
            </form>
        </div>
    </div>
    <div class="social">
        <div class="social-container">
            <button><i class="fas fa-envelope"></i></button>
            <button><i class="fab fa-twitter"></i></button>
            <button><i class="fab fa-instagram"></i></button>
        </div>
    </div>
    <div class="copyright">
        <h5><span>DiazApps</span> &copy; 2020 All Right Reserved</h5>
        <button onclick="scrollToTop()"><i class="fas fa-lg fa-chevron-up"></i></button>
    </div>
</footer>
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the element that opens the modal
    var login = document.getElementById("popup");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    login.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    // Scroll to top function
    function scrollToTop() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }
    let mainNav = document.getElementById('js-menu');
    let navBarToggle = document.getElementById('js-navbar-toggle');

    navBarToggle.addEventListener('click', function() {
        mainNav.classList.toggle('active');
    });
</script>