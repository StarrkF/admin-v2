<form action="{{ $action }}" method="POST">
    @csrf
    <input type="hidden" name="hidden_id" id="hidden_id">
    <!-- Modal -->
  <div class="modal fade" id="{{ $id }}"  aria-hidden="true">
    <div class="modal-dialog {{ $size ?? '' }}">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ $title }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{ $slot }}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

</form>


