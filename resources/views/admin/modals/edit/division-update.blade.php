<div class="modal fade right" id="division-update-modal" tabindex="-1" role="dialog" aria-labelledby="division-update-modal-label"
     aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-info" role="document">
        <!--Content-->
        <form action="{{ url('admin/division/update') }}"  method="post" accept-charset="utf-8">
            {{ csrf_field() }}

            <div class="modal-content">
                <!--Header-->
                <div class="modal-header" style="background-color: #17A2B8;">
                    <p class="heading">New Division
                    </p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>

                <!--Body-->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card text-primary bg-gray border-primary">

                                <div class="card-body">


                                    <div class="form-group row" id="md-name">
                                        <label for="name" class="col-sm-4 col-form-label text-md-right">Division Name</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <input type="text" name="name" id="name-for-update" class="form-control" autocomplete="off">
                                                <input type="hidden" name="id" id="id-for-update" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="md-name">
                                        <label for="short_name" class="col-sm-4 col-form-label text-md-right">Short Name</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <input type="text" name="short_name" id="short_name-for-update" class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="started_from" class="col-sm-4 col-form-label text-md-right">Started From</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <input type="text" value="{!! \Carbon\Carbon::now()->format('d-m-Y') !!}" name="started_from" id="started_from-for-update" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-sm-4 col-form-label text-md-right">Email ID</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <input type="text" name="email" id="email-for-update" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description" class="col-sm-4 col-form-label text-md-right">Description</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <textarea class="form-control" name="description" cols="50" rows="4" id="description-for-update"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Footer-->
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</a>
                </div>

            </div>
            <!--/.Content-->
        </form>
    </div>
</div>
<!-- Modal: modalAbandonedCart-->