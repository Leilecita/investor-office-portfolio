@extends('layouts.admin')

@section('content')
<div class="p-4">
    @if (\Session::has('success'))
    <div>
        <p>{{ \Session::get('success') }}</p>
    </div>
    @endif

    @foreach($forms as $form)
        @include('forms.single', ['form' => $form])
    @endforeach 

</div>
@endsection