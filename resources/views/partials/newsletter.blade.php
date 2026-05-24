<section id="newsletter" class="container my-5">
    <div class="newsletter-panel p-4 p-lg-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-5 d-flex gap-3 align-items-center">
                <div class="category-icon bg-white text-danger shadow-sm"><i class="bi bi-envelope-heart"></i></div>
                <div>
                    <h2 class="font-display fw-bold mb-1">Join 20,000+ Readers</h2>
                    <p class="mb-0 text-muted-soft">Get weekly mindful living tips and new articles in your inbox.</p>
                </div>
            </div>
            <div class="col-lg-7">
                <form action="{{ route('subscribe.store') }}" method="POST" class="row g-2">
                    @csrf
                    <div class="col-md">
                        <input type="email" name="email" class="form-control" placeholder="Enter your email address" required>
                    </div>
                    <div class="col-md-auto">
                        <button class="btn btn-brand w-100 px-4" type="submit">Subscribe Now</button>
                    </div>
                    <div class="col-12 small text-muted-soft">No spam. Unsubscribe anytime.</div>
                </form>
            </div>
        </div>
    </div>
</section>
