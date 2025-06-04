@if(Session::has('message'))
    @php 
        $message = Session::get('message') 
    @endphp

    <div class="alert {{ $message['flag'] }}" style="width: 100%;">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        {{ $message['message'] }}
    </div>
@endif

@if($errors->any())
    @foreach ($errors->all() as $error)
        <p style="margin: 0px; color: red;"><strong>{{ $error }}</strong></p>
    @endforeach
@endif 