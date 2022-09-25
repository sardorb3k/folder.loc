@if (session('success') || session('error'))
    <div class="example-alert" style="margin-bottom: 10px">
        <div
            class="alert alert-pro @if (session('error')) alert-danger @endif @if (session('success')) alert-primary @endif">
            <div class="alert-text">
                {{-- <h6>Message</h6> --}}
                <h6>{{ session('success') }} {{ session('error') }}</h6>
            </div>
        </div>
    </div>
@endif
