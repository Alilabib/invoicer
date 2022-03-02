@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Company</div>
                <form method="POST" action="{{route('company.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if($errors->any())
                            {{ implode('', $errors->all('<div class="alert alert-success" role="alert">:message</div>')) }}
                        @endif
                        <div class="logo">
                            <label for="upload" style="display:block;text-align: center;">
                                <img id="blah" src="{{asset('placeholder.png')}}" alt="your image" width="100px" height="100px"  aria-hidden="true" style="width:30%;height: 34%;" class="image-preview" />
                                <input accept="image/*" type='file'  name="logo" id="imgInp" class="image-upload" />
                            </label>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                Name*: <input type="text" name='company[name]' class="form-control" />
                                Phone: <input type="text" name='company[phone]' class="form-control" />
                                Email: <input type="email" name='company[email]' class="form-control" />
                                Address: <input type="text" name='company[address]' class="form-control"  />
                                Address: <input type="text" name='company[vat]' class="form-control"  />

                            </div>
                            <div class="col-6">
                                Country: <input type="text" name='company[country]' class="form-control" />
                                City: <input type="text" name='company[city]' class="form-control"  />
                                State: <input type="text" name='company[state]' class="form-control" />
                                Postcode/ZIP: <input type="text" name='company[postcode]' class="form-control" />
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <br/>
                        <input type="submit" class="btn btn-primary" value="Save Invoice" />
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>

    const imgInp = document.getElementById('imgInp');

    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
        blah.src = URL.createObjectURL(file)
        }
    }
</script>
@stop
