@extends('layouts.main')

@section('content')
<section class="lg:mt-20 h-[50vh] flex flex-col items-center justify-center">
    @foreach($listing_quiz as $quiz)
        <div class="h-[50vh]">
            <h2 class="text-xl text-center">{{ $quiz['question'] }}</h2>
        </div>
    @endforeach
</section>
@endsection