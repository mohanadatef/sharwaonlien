<div class="col-md-6 find-us-form">
    <form action="{{url('/call_us')}}" method="POST">
        {{csrf_field()}}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : "" }}">
               <input type="text" value="{{Request::old('name')}}" class="form-control find-us-input"
                                    name="name" placeholder="Name">
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : "" }}">
                <input type="text" value="{{Request::old('email')}}" class="form-control find-us-input"
                       name="email" placeholder="Email">
            </div>
            <div class="form-group{{ $errors->has('message') ? ' has-error' : "" }}">
                <textarea  id="exampleFormControlTextarea1" value="{{Request::old('message')}}"
                          placeholder="Message" class="form-control  find-us-area" name="message" ></textarea>
            </div>
            <button type="submit" class="btn btn-primary contact-send-btn">  <i class="fas fa-paper-plane"></i>SEND</button>
    </form>
</div>
<section id="book-modal-message">
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <h2 class="book-modal-title "><span class="book-modal-title-span">Success!</span></h2>
                    <h2 class="book-modal-span"><i class="fas fa-check-circle"></i></h2>
                    <p class="book-modal-mes-detail">Thanks for filling the form, this will help us informing you
                        by all needed information for you.
                        Thanks!</p>
                </div>
                <div class="modal-footer" style="justify-content: center;border: none;">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> -->
                    <button type="button"  class="btn btn-primary"
                            style="min-width: 100px;background: #00adef;border:none;" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</section>
@section('script-1')
    @if($check > 0)
        <script>
            $(document).ready(function () {
                $('#exampleModalCenter').modal('show');
            });
        </script>
    @endif
@endsection
@yield('call_us')