@extends('front.layouts.master')
@section('title','İletişim Sayfası')
@section('content')
    @section('image','https://media.istockphoto.com/id/1458164457/tr/foto%C4%9Fraf/businessman-using-laptop-and-smartphone-with-contact-icons-on-virtual-screen-searching-web.jpg?s=2048x2048&w=is&k=20&c=pWGDF1hEpIGV_XYUqv3gdEmxbDHWk32W8DAnrnk6WY4=')


                    <main class="mb-4">

                        <div class="container px-4 px-lg-5">

                            <div class="row gx-4 gx-lg-5 justify-content-center">

                                <div class="col-md-10 col-lg-8 col-xl-7">

                                        @if(session('success'))
                                        <div class="alert alert-success">
                                            {{session('success')}}
                                        </div>
                                        @endif


                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="my-5">
                                        <form id="contactForm" method="post" action="{{route('contactpost')}}">
                                            @csrf
                                            <div class="form-floating">
                                                <input class="form-control" id="name" type="text" name="name" data-sb-validations="required" />
                                                <label for="name">İsim</label>
                                            </div>
                                            <div class="form-floating">
                                                <input class="form-control" id="email" type="email" name="email" data-sb-validations="required,email" />
                                                <label for="email">E-mail</label>
                                            </div>
                                            <div class="form-floating">
                                                <input class="form-control" id="phone" type="tel" name="phone" ata-sb-validations="required" />
                                                <label for="phone">Telefon</label>
                                            </div>
                                            <div class="form-floating">
                                                <textarea class="form-control" id="message" style="height: 12rem" name="message"  data-sb-validations="required"></textarea>
                                                <label for="message">Mesajınız</label>
                                            </div>
                                            <br />
                                            <button class="btn btn-primary" id="submitButton" type="submit">Gönder</button>
                                        </form>
                                    </div>
                                </div>
                                @include('front.Widgets.categoryWidget')
                            </div>

                        </div>
                    </main>



@endsection
