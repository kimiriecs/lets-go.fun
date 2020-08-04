{{--  @php /**@var \Illuminate\Support\ViewErrorBag $errors*/ @endphp  --}}
        @if ($errors->any())
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        {{--  {!! dd($errors->all(':message')) !!}  --}}
                        {{ $errors->first() }}
                      </div>
                </div>
            </div>
        @endif
        @if (session('success'))
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                       {{ session()->get('success') }}
                      </div>
                </div>
            </div>
        @endif