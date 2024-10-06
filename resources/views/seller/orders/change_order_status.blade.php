                          {{-- change status  --}}
                          <div class="modal fade" id="change_order_status" tabindex="-1" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">change order status</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <form action="" method="post">
                                          @method('put')
                                          @csrf
                                          <input type="hidden" name="id" value="order_id">
                                          <div class="row">
                                              <div class="col">
                                                  <p class="h5 text-danger"> are sure you want to change this order status</p>
                                                  <select name="order_status" class="default-select form-control wide mb-3">
                                                      <option value="oredr_status">order status</option>
                                                   
                                                  </select>
                                              </div>
                                          </div>
                      
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary"
                                                  data-dismiss="modal">close</button>
                                              <button class="btn btn-success">save</button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                          {{--  end change status--}}