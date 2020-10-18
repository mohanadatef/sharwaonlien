@extends('includes.frontend.master_frontend')
@section('title')
    About us
@endsection
@section('content')
    <section id="about-body-section">
        <section id="about-header-section">
                <img src="{{url('public/images/about_us/'. $about_us->image)}}" class="about-head-img"/>
        </section>
        <section id="about-content-section">
            <div class="about-content">
                {!!  $about_us->description !!}
            </div>
        </section>
    </section>
@endsection
@section('script-1')
    <script>
        selectItem("about_us");
    </script>
@endsection