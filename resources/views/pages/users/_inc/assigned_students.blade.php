<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">This teacher has following students:</h5>
    </div>
    <div class="card-body">
        <table id="teachers-table" class="table table-striped" style="width:100%">
            <thead>
            <tr>
                <th>{{ 'ID' }}</th>
                <th>{{ 'Name' }}</th>
                <th>{{ 'Email' }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $user)
                <tr>

                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}"> {{  $user->email }} </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


