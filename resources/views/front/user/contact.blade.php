@extends('front.layouts.master')

@push('styles')

@endpush

@section('content')
    <div class="main_content">
        <section class="contact_page">
            <div class="contact_page_title">Contact Us</div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 offset-md-1">
                        <div class="contact_content">
                            <div class="contact_content_title">Contact Information</div>
                            <div class="contact_content_subtitle">
                                Fill up the form to get in touch with the candidate and fill
                                up the form.
                            </div>
                            <ul class="contact_list">
                                <li>
                                    <i class="fa fa-map-marker-alt"></i>
                                    <span class="contact_list_item">{{$siteSettings['address'] ?? ''}}</span>
                                </li>
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <span class="contact_list_item">{{$siteSettings['phone'] ?? ''}}</span>
                                </li>
                                <li>
                                    <i class="fa fa-envelope"></i>
                                    <span class="contact_list_item">{{$siteSettings['email'] ?? ''}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form method="post" action="{{route('front.userContact.submit',[$currentUser->username])}}" class="contact_form">
                            @csrf
                            <div class="form-group">
                                <label for="">Full Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your name" required/>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter your email" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Phone Number</label>
                                        <input type="text" name="phone" class="form-control" placeholder="Enter your phone number" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Message</label>
                                <textarea name="message" class="form-control" id="" cols="30" rows="4" required></textarea>
                            </div>
                            <div class="btn_container">
                                <button type="submit" class="btn-md">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')

@endpush
