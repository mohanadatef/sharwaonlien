@extends('includes.frontend.master_frontend')
@section('title')
   job
@endsection
@section('content')
    @include('includes.admin.error')
    <div class="page" dir="ltr">
        <div class="container">
            <h1 class="section-title text-center" style="color: #024bd0">join to team</h1>
        </div>
        <nav>
            <div class="page-header bg-green text-center">
                <div class="container">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist" >

                        @if(count($job) > 0 )
                            <a class="nav-item nav-link active"  onclick="selectItemtab('nav-current-tab'),selectItemsection('nav-current')" id="nav-current-tab" data-toggle="tab" href="#nav-current" role="tab" aria-controls="nav-current"
                               aria-selected="true"
                            >
                               availbal job
                            </a>
                            <a class="nav-item nav-link" onclick="selectItemtab('nav-join-tab'),selectItemsection('nav-join')" id="nav-join-tab" data-toggle="tab" href="#nav-join" role="tab" aria-controls="nav-join"
                               aria-selected="false"
                            ></a>
                        @else
                            <p>good luck</p>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
        <div class="tab-content"  id="nav-tabContent">
            <div  class="tab-pane fade show active"  id="nav-current" role="tabpanel" aria-labelledby="nav-current-tab" >
                <!-- tab 1 -->
                <div class="container" >
                    {{--start show all vacanies--}}
                    @foreach($job as $jobs)
                        <article  class="vacances">
                            <h4 class="title">
                                <span class="green">job: </span>
                                <span>{{$jobs->tittel}}</span>
                            </h4>
                            <p>
                                {!! $jobs->description !!}
                            </p>
                            <center>
                                <a href="#" onclick="selectItemtab('nav-join-tab'),selectItemsection('nav-join')" id="changetabbutton" class="btn changetabbutton">تقديم</a>
                            </center>
                        </article>
                    @endforeach
                    {{--end show all vacanies--}}

                </div>
            </div>
            <!-- tab 2 -->

            <div class="tab-pane fade @if(count($job) == 0 )
                    show active
@endif" id="nav-join"  role="tabpanel" aria-labelledby="nav-join-tab" >
                <div class="container" style="padding-right: 50px; !important;">
                    <form action='{{ url("/job") }}' method="post"  enctype="multipart/form-data" class="form-green" file="true">
                        <h3 class="section-title">Personal Information</h3>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="form-group row">
                                <div class="col-md-6 d-flex pull-right">
                                    <label for="select" class="col-4 col-form-label">Apply For
                                        <span style="color: red;font-size: x-large;"> *</span>
                                    </label>
                                    <div class="col-8">
                                        <select id="select"  name="job_id" class="custom-select form-control">
                                            <option value="">Apply For</option>
                                            @foreach($job as $jobs)
                                                <option value="{{$jobs->id}}">{{$jobs->tittel}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 d-flex pull-right">
                                    <label for="fName" class="col-4 col-form-label">First name</label>
                                    <div class="col-8">
                                        <input id="first_name" name="first_name" value="{{old('first_name')}}" type="text" class="form-control here">
                                        <small class="text-danger">{{ $errors->first('first_name') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex pull-right">
                                    <label for="lName" class="col-4 col-form-label">Last name</label>
                                    <div class="col-8">
                                        <input id="last_name" name="last_name" value="{{old('last_name')}}" type="text" class="form-control here">
                                        <small class="text-danger">{{ $errors->first('last_name') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 d-flex pull-right">
                                    <label for="mobile" class="col-4 col-form-label">Mobile
                                        <span style="color: red;font-size: x-large;"> *</span>
                                    </label>
                                    <div class="col-8">
                                        <input id="mobile" name="mobile" type="text" value="{{old('mobile')}}" class="form-control here">
                                        <small class="text-danger">{{ $errors->first('mobile') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex pull-right">
                                    <label for="email" class="col-4 col-form-label">Email
                                        <span style="color: red;font-size: x-large;"> *</span>
                                    </label>
                                    <div class="col-8">
                                        <input id="email" name="email" value="{{old('email')}}" type="email" class="form-control here">
                                        <small class="text-danger">{{ $errors->first('email') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 d-flex pull-right">
                                    <label class="col-4 col-form-label pull-right">Gender</label>
                                    <br>
                                    <div class="col-8 d-flex pull-right">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="male" name="gender" class="custom-control-input" value="male">
                                            <label class="custom-control-label" for="male">Male</label>
                                        </div>
                                        <div class="custom-control custom-radio ml-5">
                                            <input type="radio" id="female" name="gender" class="custom-control-input" value="female">
                                            <label class="custom-control-label" for="female"> Female
                                                  </label>
                                        </div>
                                        <small class="text-danger float-left "> &ensp;{{ $errors->first('gender') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 d-flex pull-right">
                                    <label class="col-4 col-form-label pull-right">Date of birth</label>
                                    <div class="col-8 d-flex pull-right">
                                        <select name="day" id="day" class="custom-select" value="{{old('day')}}">
                                            <option value="">day</option>
                                            @for($i=1;$i<32;$i++)
                                                @if($i < 10)
                                                    <option value="0{{$i}}">0{{$i}}</option>
                                                @else
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endif
                                            @endfor

                                        </select>
                                        <select name="month" id="month" class="custom-select" value="{{old('month')}}">
                                            <option value="">Month</option>
                                            <option value="01">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                        <select name="year" id="year" class="custom-select" value="{{old('year')}}">
                                            <option value="">year</option>

                                            @for($i=2019;$i>=1900;$i--)

                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <br>
                                @if( $errors->first('year')  || $errors->first('day') || $errors->first('month') )

                                    <small class="text-danger"</small>
                                    {{--<small class="text-danger">{{ $errors->first('year') }}</small><br>
                                    {{--<small class="text-danger">{{ $errors->first('day') }}</small><br>
                                    <small class="text-danger">{{ $errors->first('month') }}</small><br>--}}

                                @endif

                            </div>
                        </div>
                        <h3 class="section-title">Educationl Information</h3>
                        <div class="row">
                            <div class="form-group row">
                                <div class="col-md-6 d-flex pull-right">
                                    <label for="university" class="col-4 col-form-label">University</label>
                                    <div class="col-8">
                                        <select name="university"  id="university" class="custom-select form-control">
                                            <option value="">Select...</option>
                                            <option value="Cairo university">Cairo university</option>
                                            <option value="Assuit university">Assuit university</option>
                                            <option value="Alexandria university">Alexandria university</option>
                                            <option value="Helwan university">Helwan university</option>
                                            <option value="Ain Shams university">Ain Shams university</option>
                                            <option value="Aswan university">Aswan university</option>
                                            <option value="Minya university">Minya university</option>
                                            <option value="Sohag university">Sohag university</option>
                                        </select>
                                        <small class="text-danger">{{ $errors->first('university') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex pull-right">
                                    <label for="faculty" class="col-4 col-form-label">
                                        <span style="color: white;font-size: x-large;"></span>
                                    </label>
                                    <div class="col-8">
                                        <input id="uOhter" name="uOhter" type="text" value="{{old('uOhter')}}" class="form-control here" placeholder="Other">
                                        <small class="text-danger">{{ $errors->first('uOhter') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 d-flex pull-right">
                                    <label for="faculty" class="col-4 col-form-label">Faculty
                                        <span style="color: red;font-size: x-large;"> *</span>
                                    </label>
                                    <div class="col-8">
                                        <select name="faculty" id="faculty" class="custom-select form-control" value="{{old('faculty')}}">
                                            <option value="">Select...</option>
                                            <option value="Computer Science">Computer Science</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Commerce">Commerce</option>
                                            <option value="Law">Law</option>
                                            <option value="Applied Arts">Applied Arts</option>
                                            <option value="Economics and Political Science">Economics and Political Science</option>
                                            <option value="Fine Arts">Fine Arts</option>
                                            <option value="Science">Science</option>
                                        </select>
                                        <small class="text-danger">{{ $errors->first('faculty') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex pull-right">
                                    <label for="faculty" class="col-4 col-form-label">
                                        <span style="color: white;font-size: x-large;">*</span>
                                    </label>
                                    <div class="col-8">
                                        <input id="fOhter" name="fOhter" value="{{old('fOhter')}}" type="text" class="form-control here" placeholder="Other">
                                        <small class="text-danger">{{ $errors->first('fOhter') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 d-flex pull-right">
                                    <label for="year" class="col-4 col-form-label">year</label>
                                    <div class="col-8">
                                        <input id="year" name="year" type="text" value="{{old('grad_year')}}" class="form-control here">
                                        <small class="text-danger">{{ $errors->first('grad_year') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex pull-right">
                                    <label for="grade" class="col-4 col-form-label">Grade</label>
                                    <div class="col-8">
                                        <select name="grade" id="grade" class="custom-select form-control">
                                            <option value="">Select....</option>
                                            <option value="A+">A+</option>
                                            <option value="A">A</option>
                                            <option value="B+">B</option>
                                            <option value="B">B</option>
                                            <option value="C+">C+</option>
                                            <option value="C">C</option>
                                            <option value="D+">D+</option>
                                            <option value="D">D</option>
                                        </select>
                                        <small class="text-danger">{{ $errors->first('grade') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12  ">
                                    <div class="row m-0">
                                        <label for="message" class="col-sm-2 col-form-label pull-right">notes</label>
                                        <div class="col-sm-10">
                                            <textarea name="message" class="form-control" id="message" rows="3" value="{{old('message')}}"></textarea>
                                            <small class="text-danger">{{ $errors->first('message') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 ">
                                    <div class="row m-0">
                                        <label for="resume" class="col-sm-2 col-form-label  pull-right">cv
                                            <span style="color: red;font-size: x-large;"> *</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control-file" name="resume" id="resume" value="{{old('resume')}}">
                                            <small class="text-danger">{{ $errors->first('resume') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="row m-0">
                                        <div class="col-sm-10 ml-auto">
                                            <button class="btn f-btn">send</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script-1')
    <script>
        selectItem("job");
    </script>
    <script>
        selectItem("jobsId");
        function selectItem(Id)
        {
            var arr = document.getElementsByClassName("selected-item");
            for (let index = 0; index < arr.length; index++) {
                if(arr[index].id != Id)
                {
                    arr[index].className = arr[index].className.replace("selected-item","unselected-item");
                }

            }
            document.getElementById(Id).className = document.getElementById(Id).className.replace("unselected-item","selected-item");
        }
        function selectItemtab(Id)
        {
            var arr = document.getElementsByClassName("nav-item nav-link");
            for (let index = 0; index < arr.length; index++) {
                if(arr[index].id != Id)
                {
                    arr[index].className = arr[index].className.replace("nav-item nav-link active","nav-item nav-link");
                }

            }
            document.getElementById(Id).className = document.getElementById(Id).className.replace("nav-item nav-link","nav-item nav-link active");
        }
        function selectItemsection(Id)
        {
            var arr = document.getElementsByClassName("tab-pane fade show active");
            for (let index = 0; index < arr.length; index++) {
                if(arr[index].id != Id)
                {
                    arr[index].className = arr[index].className.replace("tab-pane fade show active","tab-pane fade");
                }

            }
            document.getElementById(Id).className = document.getElementById(Id).className.replace("tab-pane fade","tab-pane fade show active");
        }
    </script>
    <script>
        //redirect to specific tab
        $('.changetabbutton').click(function(e){
            function selectItemtab(Id)
            {
                var arr = document.getElementsByClassName("nav-item nav-link");
                for (let index = 0; index < arr.length; index++) {
                    if(arr[index].id != Id)
                    {
                        arr[index].className = arr[index].className.replace("nav-item nav-link active","nav-item nav-link");
                    }

                }
                document.getElementById(Id).className = document.getElementById(Id).className.replace("nav-item nav-link","nav-item nav-link active");
            }
            function selectItemsection(Id)
            {
                var arr = document.getElementsByClassName("tab-pane fade show active");
                for (let index = 0; index < arr.length; index++) {
                    if(arr[index].id != Id)
                    {
                        arr[index].className = arr[index].className.replace("tab-pane fade show active","tab-pane fade");
                    }

                }
                document.getElementById(Id).className = document.getElementById(Id).className.replace("tab-pane fade","tab-pane fade show active");
            }
        })
    </script>
@endsection


