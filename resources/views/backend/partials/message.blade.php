{{-- 
    @if ($errors->any())
        <div class="alert alert-danger text-center">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
        </div>
    @endif

    @if (Session::has('success'))
    <div id="toastr-2">
            <p>{{ Session::get('success') }}</p>
    </div>
    @endif

    @if (Session::has('error'))
    <div class="alert alert-danger text-center">
            <p>{{ Session::get('error') }}</p>
    </div>
    @endif --}}