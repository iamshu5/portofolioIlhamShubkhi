@php $user = Auth::user() @endphp
@include('_partials.header', ['title' => 'Home'])

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-3">Welcome Brader! <strong>{{ $user->nama }}</strong></h1>
        </div>
    </div>
</div>

@include('_partials.footer')