<footer class="main-footer bg-dark text-light py-5">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <img src="<?= Yii::getAlias('@web') ?>/assets/images/logo-white.png" alt="Assignment Connect" class="footer-logo mb-4">
                <p>Connecting educational institutions with expert tutors worldwide.</p>
                <div class="social-links">
                    <a href="#" class="social-icon-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon-link linkedin"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-icon-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon-link"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <h4>TOP 4 CATEGORY</h4>
                <ul class="list-unstyled">
                    <li><a href="#">Development</a></li>
                    <li><a href="#">Finance & Accounting</a></li>
                    <li><a href="#">Design</a></li>
                    <li><a href="#">Business</a></li>
                </ul>
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <h4>Quick Links</h4>
                <ul class="list-unstyled">
                    <li><a href="#">About</a></li>
                    <li><a href="#" class="become-instructor">Become Instructor →</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Career</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <h4>Support</h4>
                <ul class="list-unstyled">
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Terms & Condition</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            
            <div class="col-lg-2 col-md-6">
                <h4>Download Our App</h4>
                <div class="app-buttons">
                    <a href="#" class="d-block mb-2">
                        <img src="<?= Yii::getAlias('@web') ?>/assets/images/app-store.png" alt="App Store" class="img-fluid">
                    </a>
                    <a href="#" class="d-block">
                        <img src="<?= Yii::getAlias('@web') ?>/assets/images/google-play.png" alt="Google Play" class="img-fluid">
                    </a>
                </div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-12">
                <div class="footer-bottom d-flex justify-content-between">
                    <p class="mb-0">&copy; <?php echo date('Y'); ?> Assignment Connect. All rights reserved.</p>
                    <div class="language-selector">
                        <select class="form-select bg-dark text-light border-0">
                            <option selected>English</option>
                            <option>Spanish</option>
                            <option>French</option>
                            <option>German</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
    // Social icon hover functionality
    document.addEventListener('DOMContentLoaded', function() {
        const socialIcons = document.querySelectorAll('.social-icon-link');
        
        // Set default active state to LinkedIn (middle icon)
        const linkedInIcon = document.querySelector('.social-icon-link.linkedin');
        
        socialIcons.forEach(icon => {
            icon.addEventListener('mouseenter', function() {
                // Remove active class from all icons
                socialIcons.forEach(i => i.classList.remove('linkedin'));
                // Add active class to hovered icon
                this.classList.add('linkedin');
            });
            
            icon.addEventListener('mouseleave', function() {
                // Remove active class from all icons
                socialIcons.forEach(i => i.classList.remove('linkedin'));
                // Reset default active state
                linkedInIcon.classList.add('linkedin');
            });
        });
    });
</script> 