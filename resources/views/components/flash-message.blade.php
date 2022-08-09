@props(['status' => 'info'])

@php
if(session('status') === 'info'){$bgColor = 'bg-blue-500';}
if(session('status') === 'alert'){$bgColor = 'bg-red-500';}
@endphp

@if(session('message'))
  <div class="{{ $bgColor }} w-1/2 mx-auto font-bold text-center p-2 my-4 text-white message">
    {{ session('message' )}}
  </div>
@endif
