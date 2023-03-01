<table class="table">
    <thead>
      <tr>
        @foreach ($heads as $head)
            <th>{{ $head }}</th>
        @endforeach

      </tr>
    </thead>
    <tbody>
        {{ $slot }}
    </tbody>
  </table>
