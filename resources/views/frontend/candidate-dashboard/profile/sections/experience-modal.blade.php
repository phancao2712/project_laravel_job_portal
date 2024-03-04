<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Experience</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="experienceForm">
                        @csrf
                        <div class="row form-controler">
                            <div class="col-md-12">
                                <label for="company">Company *</label>
                                <input type="text" name="company" class="form-control" required="">
                            </div>
                            <div class="col-md-6">
                                <label for="level">Department *</label>
                                <input type="text" name="department" class="form-control" required="">
                            </div>
                            <div class="col-md-6">
                                <label for="designation">Designation *</label>
                                <input type="text" name="designation" class="form-control" required="">
                            </div>
                            <div class="col-md-6">
                                <label for="company">Date start *</label>
                                <input type="text" class="datepicker" name="start" class="form-control"
                                    required="">
                            </div>
                            <div class="col-md-6">
                                <label for="company">Date end *</label>
                                <input type="text" class="datepicker" name="end" class="form-control"
                                    required="">
                            </div>
                            <div class="col-md-12 mt-10 mb-10">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="current_working">
                                <label class="form-check-label" for="remember">I am currently working</label>
                            </div>
                            <div class="col-md-12">
                                <label for="company">Responsibility</label>
                                <textarea name="responsibilites" id="" maxlength="500" cols="100" class="form-control"></textarea>
                            </div>

                            <div class="text-right mt-20">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create Experience</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
