<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approval Requests</title>
    <style>
        .approve-btn {
            background-color: #00A36C;
            color: white;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .approve-btn:hover {
            background-color: #016443;
        }
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
</head>
<body class="bg-gray-100 p-8">
    @if (auth()->user()->user_type === 'Admin' || auth()->user()->user_type === 'Super Admin')
    <h6 class="text-xl font-bold mt-6 mb-6 text-center">Pending Name Approval Requests</h6>

    <div class="board-list">
        <table width="100%">
            <thead class="bg-gray-50">
                <tr>
                    <td>User</td>
                    <td>Field</td>
                    <td>Old Value</td>
                    <td>New Value</td>
                    <td style="text-align: center;">Action</td>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($approvalRequests as $request)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $request->user->first_name }} {{ $request->user->last_name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $request->field }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $request->old_value }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $request->new_value }}</div>
                        </td>
                        <td class="action" style="display: flex; justify-content: center;">
                                <form action="{{ route('approve-request', [$request->id, 'approve']) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="button approve-btn">Approve</button>
                                </form>
                                <form action="{{ route('approve-request', [$request->id, 'reject']) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="delete-btn">Reject</button>
                                </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="text-center text-red-500 mt-4">
        You are not authorized to view some approvals here.
    </div>
    @endif
</body>
</html>
