<div class="modal fade right" id="modal-edit-training-schedule" tabindex="-1" role="dialog" aria-labelledby="modal-edit-training-schedule-label"
     aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-info" role="document">
        <!--Content-->
        <form action="" id="training-schedule-edit-form"  method="post" accept-charset="utf-8">
            {{ csrf_field() }}

            <div class="modal-content">
                <!--Header-->
                <div class="modal-header" style="background-color: #17A2B8;">
                    <p class="heading">Edit Training Schedule
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

                                    <input type="hidden" name="id-for-update" id="id-for-update" class="form-control">

                                    <div class="form-group row">
                                        <label for="title" class="col-sm-4 col-form-label text-md-right">Title</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <input type="text" name="title" id="u_title" class="form-control" required autocomplete="off" autofocus>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description" class="col-sm-4 col-form-label text-md-right">Description</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <textarea class="form-control" name="description" cols="50" rows="4" id="u_description"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="trainer" class="col-sm-4 col-form-label text-md-right">Trainer</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <input type="text" name="trainer" id="u_trainer" class="form-control" required autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="start_from" class="col-sm-4 col-form-label text-md-right">Start From</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <input type="text" name="start_from" id="u_start_from" value="" class="form-control" required readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="end_on" class="col-sm-4 col-form-label text-md-right">Ends On</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <input type="text" name="end_on" id="u_end_on" value="" class="form-control" required readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="participants" class="col-sm-4 col-form-label text-md-right">Participants</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <input type="number" name="participants" id="u_participants" value="{!! 0 !!}" class="form-control" required autocomplete="off">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="attended" class="col-sm-4 col-form-label text-md-right">Attended</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <input type="number" name="attended" id="u_attended" class="form-control" required autocomplete="off">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="closing_notes" class="col-sm-4 col-form-label text-md-right">Closing Note</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <textarea class="form-control" name="closing_notes" cols="50" rows="4" id="u_closing_notes"></textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="status" class="col-sm-4 col-form-label text-md-right">Status</label>
                                        <div class="col-sm-8">

                                            <div class="form-group">
                                                <div class="maxl">
                                                    <label class="radio inline">
                                                        <input type="radio" id="status-open" name="status" value="{!! 1 !!}">
                                                        <span style="color: #0a0a0a">Open</span>
                                                    </label>
                                                    <label class="radio inline">
                                                        <input type="radio" id="status-close" name="status" value="{!! 0 !!}">
                                                        <span style="color: #0a0a0a">Close</span>
                                                    </label>
                                                </div>
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
    $( function() {


        $('#training-edit-form').on("submit", function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            var url = 'training/update';
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

                    $('#trainings-table').DataTable().draw(false);
                    $('#modal-edit-training').modal('hide');
                },

            }).always(function (data) {
                $('#trainings-table').DataTable().draw(false);
            });
        });


        $( "#start_from" ).datetimepicker({
            format:'d-m-Y H:i',
            inline:false,
            step:30,
        });

        $( "#end_on" ).datetimepicker({
            format:'d-m-Y H:i',
            inline:false,
            step:30,
        });


    } );


</script>