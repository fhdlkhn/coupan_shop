@extends('front.layout.layout')


@section('content')
    <section class="ly-page-top-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Contact Us</h1>
                    <p>Join top UK hosts who make an average of £6,492 every year for each car they list on Turo*</p>
                </div>
            </div>
        </div>
    </section>
    <section class="ly-contact-us-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="main-img-box">
                        <img class="main-img" src="{{asset('front/images/banners/contact-img.png')}}" alt="contact-img">
                        <div class="hired-box">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0zM12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036c-.01-.003-.019 0-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M20 3.5A1.5 1.5 0 0 1 21.5 5v14a1.5 1.5 0 0 1-3 0V5A1.5 1.5 0 0 1 20 3.5m-4 3A1.5 1.5 0 0 1 17.5 8v11a1.5 1.5 0 0 1-3 0V8A1.5 1.5 0 0 1 16 6.5m-4 3a1.5 1.5 0 0 1 1.5 1.5v8a1.5 1.5 0 0 1-3 0v-8A1.5 1.5 0 0 1 12 9.5m-4 3A1.5 1.5 0 0 1 9.5 14v5a1.5 1.5 0 0 1-3 0v-5A1.5 1.5 0 0 1 8 12.5m-4 3A1.5 1.5 0 0 1 5.5 17v2a1.5 1.5 0 0 1-3 0v-2A1.5 1.5 0 0 1 4 15.5"/></g></svg>
                            <span>100K+</span>
                            <small>People got hired</small>
                        </div>
                        <div class="message-box">
                            <img src="{{asset('front/images/banners/client-1.png')}}" alt="client-img">
                            <small>Adam Sandler</small>
                            <span>Lead Engineer at Canva</span>
                            <p>“Great platform for the job seeker that searching for new career heights.”</p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621c.537-.278 1.24-.375 1.929-.311c1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5a3.871 3.871 0 0 1-2.748-1.179m10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621c.537-.278 1.24-.375 1.929-.311c1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5a3.871 3.871 0 0 1-2.748-1.179"/></svg>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="ly-contact-area">
                        <form action="{{route('contact.submit')}}" method="POST" class="ly-contact-form">
                            @csrf
                            <h3>Contact us</h3>
                            <div class="fields-group">
                                <div class="input-box">
                                    <input type="text" name="first_name" class="form-control" id="firstName" placeholder="First Name">
                                </div>
                                <div class="input-box">
                                    <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="fields-group">
                                <div class="input-box single-field">
                                    <input type="email" name="email" class="form-control" id="inputAddress" placeholder="Email">
                                </div>
                            </div> 
                            <div class="fields-group">
                                <div class="input-box single-field">
                                    <input type="text" name="subject" class="form-control" id="inputAddress" placeholder="Email Subject">
                                </div>
                            </div> 
                            <div class="fields-group textarea">
                                <div class="input-box">
                                    <p>Message</p>
                                    <textarea name="message" id="" placeholder="Write your message here..."></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="button-box">
                                    <button class="ly-button-1">Get Started <span class="iconify" data-icon="tabler:chevron-right"></span></button>
                                </div>  
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection