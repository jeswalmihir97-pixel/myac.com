@extends('Layout.cmaster') 
@section('title', 'Contact Us')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h2 class="fw-bold text-primary">Contact Us</h2>
            <hr>
            <p>If you have any questions, feel free to contact us by filling out the form below.</p>

            <form action="#" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Your Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Your Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea name="message" rows="4" class="form-control" placeholder="Write your message..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>

            <hr>
            <p class="mt-3">
                <strong>Email:</strong> support@myac.com <br>
                <strong>Phone:</strong> +91-9512823483 <br>
                <strong>Address:</strong> Gujarat, India
            </p>
        </div>
    </div>
</div>
@endsection
