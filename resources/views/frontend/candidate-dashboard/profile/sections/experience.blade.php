<div class="tab-pane fade" id="pills-experience" role="tabpanel" aria-labelledby="pills-experience-tab" tabindex="0">
    <div class="d-flex justify-content-between">
        <h3>Experience</h3>
        <div class="btn btn-primary" data-bs-toggle="modal" onclick="$('#experienceForm').trigger('reset'); eiditId=''; eidtMode = false;" data-bs-target="#staticBackdrop">Add experience</div>
    </div>
    <br>
    <table class="table table-striped" id="experienceTable">
        <thead>
            <tr>
                <th scope="col">Company</th>
                <th scope="col">Department</th>
                <th scope="col">Designation</th>
                <th scope="col">Period</th>
                <th scope="col" style="width:15%;">Actions</th>
            </tr>
        </thead>
        <tbody class="experience-tbody">
            @foreach ($experienceCandidate as $exp)
                <tr>
                    <td>{{ $exp->company }}</td>
                    <td>{{ $exp->department }}</td>
                    <td>{{ $exp->designation }}</td>
                    <td>{{ date('d-m-Y', strtotime($exp->start)) }} -
                        {{ $exp->current_working === 1 ? 'Current' : date('d-m-Y', strtotime($exp->end)) }}</td>
                    <td>
                        <a href="{{ route('candidate.experience.edit', $exp->id) }}" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop" class="btn editExperience btn-sm btn-primary"><i
                                class="fa-solid fa-pen-to-square"></i></a>
                        <a href="{{ route('candidate.experience.destroy', $exp->id) }}"
                            class="btn btn-sm btn-danger delete-experience"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
