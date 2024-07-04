<div>
            @if (session('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; border-color: #c3e6cb; padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: .25rem;">
                {{ session('success') }}
            </div>
            @endif
            <ul>
                
                <div class="board-list">
                    <table width="100%">
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Course</td>
                                <td>Batch</td>
                                <td style="text-align: center;">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($unverifiedUsers as $user)
                            <tr>
                            <td>
                                <div>
                                    <h5>{{ $user->first_name }} {{ $user->last_name }}</h5>
                                    <p>{{ $user->email }}</p>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <p>{{ $user->course }}</p>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <p>{{ $user->batch }}</p>
                                </div>
                            </td>
                                @unless($user->is_email_verified)
                                    <td class="action" style="display: flex; justify-content: center;">
                                        <a href="#" class="button approve-btn" data-form-id="{{ 'form-'.$user->id }}">Approve</a>
                                        <form id="{{ 'form-'.$user->id }}" method="POST" action="{{ route('user.approve', ['userId' => $user->id]) }}">
                                            @method('PUT')
                                            @csrf
                                        </form>
                                        <form id="delete-form" action="{{ route('user.delete', ['userId' => $user->id]) }}" method="POST" onsubmit="return confirmDelete();">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class=" delete-btn">Reject</button>
                                        </form>
                                    </td>
                                @else
                                    <td>
                                        <button style="padding: 10px; border-radius: 10px; background-color: gray; color: white;" disabled>approved</button>
                                    </td>
                                    <td></td>
                                @endunless
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </ul>
        </div>

        <script>
            function confirmDelete() {
                return confirm('Are you sure you want to delete this post? This action cannot be undone.');
            }
        </script>

<style>
        .delete-btn {
            background-color: #BB0237;
            color: white;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .delete-btn:hover {
            background-color: #850227;
        }
</style>