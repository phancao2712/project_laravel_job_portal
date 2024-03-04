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
