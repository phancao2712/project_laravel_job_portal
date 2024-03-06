<div class="tab-pane fade" id="pills-experience" role="tabpanel" aria-labelledby="pills-experience-tab" tabindex="0">
    <div class="">
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
                @forelse ($experienceCandidate as $exp)
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
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Not Found Data!</td>
                        </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Education --}}
    <div class="mt-60">
        <div class="d-flex justify-content-between">
            <h3>Education</h3>
            <div class="btn btn-primary" data-bs-toggle="modal" onclick="$('#educationForm').trigger('reset'); eiditId=''; eidtMode = false;" data-bs-target="#educationModal">Add education</div>
        </div>
        <br>
        <table class="table table-striped" id="educationTable">
            <thead>
                <tr>
                    <th scope="col">Name School</th>
                    <th scope="col">Degree</th>
                    <th scope="col">Year End</th>
                    <th scope="col">Note</th>
                    <th scope="col" style="width:15%;">Actions</th>
                </tr>
            </thead>
            <tbody class="education-tbody">
                @forelse ($educationCandidate as $exp)
                    <tr>
                        <td>{{ $exp->level }}</td>
                        <td>{{ $exp->degree }}</td>
                        <td>{{ $exp->year }}</td>
                        <td>{{ $exp->note }}</td>
                        <td>
                            <a href="{{ route('candidate.education.edit', $exp->id) }}" data-bs-toggle="modal"
                                data-bs-target="#educationModal" class="btn edit-education btn-sm btn-primary"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{ route('candidate.education.destroy', $exp->id) }}"
                                class="btn btn-sm btn-danger delete-education"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Not Found Data!</td>
                        </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
