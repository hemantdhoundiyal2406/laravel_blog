<footer class="footer mt-5 pt-5">
    <div class="container">
        <div class="row g-4 pb-4">
            <div class="col-lg-3 col-md-6">
                <a class="d-flex align-items-center gap-2 mb-3" href="{{ route('home') }}">
                    <span class="navbar-brand-mark"><i class="bi bi-flower1"></i></span>
                    <span>
                        <span class="brand-title">Purely</span>
                        <span class="brand-subtitle">Balanced mindful living</span>
                    </span>
                </a>
                <p class="text-muted-soft">Inspiring you to live a more mindful, balanced, and meaningful life.</p>
                <div class="d-flex gap-3 fs-5">
                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" aria-label="Pinterest"><i class="bi bi-pinterest"></i></a>
                    <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                    <a href="#" aria-label="Email"><i class="bi bi-envelope"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6 class="section-label mb-3">Quick Links</h6>
                <ul class="list-unstyled d-grid gap-2">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('blog.index') }}">Blog</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    <li><a href="{{ route('login') }}">Admin Login</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="section-label mb-3">Categories</h6>
                <ul class="list-unstyled d-grid gap-2">
                    @foreach($navCategories as $category)
                        <li><a href="{{ route('blog.index', ['category' => $category->slug]) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-4 col-md-6">
                <h6 class="section-label mb-3">Contact</h6>
                <ul class="list-unstyled d-grid gap-3 text-muted-soft">
                    <li><i class="bi bi-envelope me-2"></i> hello@purelyblog.com</li>
                    <li><i class="bi bi-geo-alt me-2"></i> Pune, India</li>
                    <li><i class="bi bi-clock me-2"></i> Monday - Friday: 9AM - 5PM</li>
                </ul>
            </div>
        </div>

        <div class="border-top py-3 d-flex flex-column flex-md-row justify-content-between gap-2 text-muted-soft small">
            <span>&copy; {{ date('Y') }} Purely Blog. All rights reserved.</span>
            <span>Made with care for mindful living.</span>
        </div>
    </div>
</footer>
