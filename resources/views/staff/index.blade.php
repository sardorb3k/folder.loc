@section('title', 'Staff list')
@extends('layouts.app')
@section('content')
    @livewire('staff')


    <script type="text/javascript">
        window.livewire.on('userStore', () => {
            $('#exampleModal').modal('hide');
        });
    </script>
@endsection
