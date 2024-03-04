<div class="modal fade" id="educationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Education</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="educationForm">
                        @csrf
                        <div class="row form-controler">
                            <div class="col-md-12">
                                <label for="level">Level *</label>
                                <input type="text" name="level" class="form-control" required="">
                            </div>
                            <div class="col-md-6">
                                <label for="">Year *</label>
                                <input type="text" class="yearpicker" name="year" class="form-control" required="">
                            </div>
                            <div class="col-md-6">
                                <label for="degree">Degree *</label>
                                <input type="text" name="degree" class="form-control" required="">
                            </div>
                            <div class="col-md-12">
                                <label for="note">Note</label>
                                <textarea name="note" id="" class="form-control"></textarea>
                            </div>

                            <div class="text-right mt-10">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update Education</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
