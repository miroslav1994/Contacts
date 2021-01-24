@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger" id="mess_danger">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif
<div class="alert alert-danger" id="mess_danger" style="display:none;">
</div>
<input type="hidden" name="is_error" id="is_error" value="0">
