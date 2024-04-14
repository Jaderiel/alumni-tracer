<!-- resources/views/livewire/user-list.blade.php -->

<div>
    <input wire:model="search" type="text" placeholder="Search...">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Course</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($verifiedAlumni as $user)
            <tr>
                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->course }}</td>
                <td><a href="#">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
