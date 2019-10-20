<div class="modal fade right" id="department-update-modal" tabindex="-1" role="dialog" aria-labelledby="department-update-modal-label"
     aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-info" role="document">
        <!--Content-->
        <form action=""  method="post" id="department-update-form" accept-charset="utf-8">
            {{ csrf_field() }}

            <div class="modal-content">
                <!--Header-->
                <div class="modal-header" style="background-color: #17A2B8;">
                    <p class="heading">Update Department
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
                                        <label for="name" class="col-sm-4 col-form-label text-md-right">Department Name</label>
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

                                    <div class="form-group row" id="md-name">
                                        <label for="department_code" class="col-sm-4 col-form-label text-md-right">Department Code</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <input type="text" name="department_code" id="department_code-for-update" class="form-control" autocomplete="off">
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
                                        <label for="top_rank" class="col-sm-4 col-form-label text-md-right">Top Rank</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <input type="text" name="top_rank" id="top_rank-for-update" class="form-control">
                                            </div>
                                        </div>
                                    </div>




                                    <div class="form-group row">
                                        <label for="overtime" class="col-sm-7 col-form-label">Leave Alternate Acknowledge Needed</label>
                                        <div class="col-sm-5">

                                            <div class="pretty p-default">
                                                <input type="checkbox" name="apply" id="apply" readonly />
                                                <div class="state p-primary">
                                                    <label>Apply</label>
                                                </div>
                                            </div>

                                            <!-- success -->
                                            <div class="pretty p-default">
                                                <input type="checkbox" name="acknowledge" id="acknowledge" />
                                                <div class="state p-success">
                                                    <label>Acknowledge</label>
                                                </div>
                                            </div>

                                            <!-- info -->
                                            <div class="pretty p-default">
                                                <input type="checkbox" name="recommend" id="recommend"/>
                                                <div class="state p-info">
                                                    <label>Recommend</label>
                                                </div>
                                            </div>

                                            <!-- warning -->
                                            <div class="pretty p-default">
                                                <input type="checkbox" name="approve" id="approve" />
                                                <div class="state p-warning">
                                                    <label>Approve</label>
                                                </div>
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

<script>
    $('#department-update-form').on("submit", function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        var url = 'department/update';
        // confirm then

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),

            error: function (request, status, error) {
                alert(request.responseText);
            },

            success: function (data) {

                $('#departments-table').DataTable().draw(false);
                $('#department-update-modal').modal('hide');
            },

        }).always(function (data) {
            $('#departments-table').DataTable().draw(false);
        });

    });
</script>