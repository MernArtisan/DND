<section class="vs-newsletter-wrapper bg-dark z-index-step1">
    <div class="container">
        <div class="position-relative">
            <div class="inner-wrapper bg-black position-absolute top-50 start-50 translate-middle w-100 px-60 py-40">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-6 text-center text-xl-start mb-3 mb-xl-0">
                        <span class="sub-title2 mt-2">{{ $cms_content[5]->name }}</span>
                        <h2 class="mb-0 text-white">{!! $cms_content[5]->description !!}</h2>
                    </div>
                    <div class="col-md-10 col-lg-8 col-xl-6">
                        <form id="newsletterForm" action="{{ route('admin.newsletter.submit') }}" method="POST"
                            class="newsletter-style1 d-md-flex">
                            @csrf
                            <input type="email" name="email" class="form-control me-md-2 mb-2 mb-md-0"
                                placeholder="Enter email address" required style="margin-top: 20px">
                            <button type="submit" class="vs-btn gradient-btn">Subscribe Now</button>
                        </form>
                        <div id="newsletterMessage" class="mt-2 fw-semibold"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
