@foreach($candidateEducation as $exp)
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
@endforeach
