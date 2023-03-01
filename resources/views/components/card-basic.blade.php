@props(['title' => 'Review'])

<div class="card">
    <div class="card-header bg-primary">
        <h5 class="text-white">{{ $title }}</h5>
    </div>
    <div class="card-content">
        <div class="card-body">
            {{ $slot }}
        </div>
    </div>
</div>
