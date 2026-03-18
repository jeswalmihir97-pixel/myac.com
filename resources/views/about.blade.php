@extends('Layout.cmaster') 
@section('title', 'About Us')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <!-- Page Title -->
            <h2 class="fw-bold text-primary">About Us</h2>
            <hr>

            <!-- Company Introduction -->
            <p>
                Welcome to <strong>MYAC.COM</strong>, your trusted destination for quality products and services.  
                Since our beginning, we have been committed to offering the best shopping experience to our customers 
                by combining affordable prices, reliable products, and friendly support.
            </p>

            <!-- Mission & Vision -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <h4 class="fw-bold text-secondary">Our Mission</h4>
                    <p>
                        To deliver excellence through high-quality products, affordable pricing, 
                        and top-class customer service that ensures 100% satisfaction.
                    </p>
                </div>
                <div class="col-md-6">
                    <h4 class="fw-bold text-secondary">Our Vision</h4>
                    <p>
                        To become a leading e-commerce platform that empowers people to shop smarter, 
                        live better, and trust us as their go-to marketplace.
                    </p>
                </div>
            </div>

            <!-- Why Choose Us -->
            <div class="mt-4">
                <h4 class="fw-bold text-secondary">Why Choose Us?</h4>
                <ul>
                    <li>✅ Wide range of products</li>
                    <li>✅ Affordable pricing</li>
                    <li>✅ Fast and secure delivery</li>
                    <li>✅ 24/7 customer support</li>
                </ul>
            </div>

            <!-- Our Team -->
            <div class="mt-4">
                <h4 class="fw-bold text-secondary">Meet Our Team</h4>
                <div class="row text-center">
                    <div class="col-md-4 mb-3">
                        <h6 class="fw-bold">Mihir Jeswal</h6>
                        <p class="team-role">Founder & CEO</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h6 class="fw-bold">Rahul Bharada</h6>
                        <p class="team-role">Operations Manager</p>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="mt-4">
                <h4 class="fw-bold text-secondary">Get in Touch</h4>
                <p>
                    <strong>Email:</strong> support@myac.com <br>
                    <strong>Phone:</strong> +91-9512823483 <br>
                    <strong>Address:</strong> Gujarat, India
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
