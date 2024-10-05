<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="edit_order_status{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <form action="" method="post">
            @csrf
            @method('put')

            <div class="row">
                <div class="col">
                    <p class="h5 text-danger"> order name</p>
                    <input type="hidden" name="order_id" value="">
                    <input type="checkbox" name="order_status" id="">
                </div>
            </div>
  
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">close</button>
                <button class="btn btn-success">save</button>
            </div>
        </form>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>