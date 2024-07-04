<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approval Requests</title>
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
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
                    <td>Action</td>
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
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex space-x-2">
                                <form action="{{ route('approve-request', [$request->id, 'approve']) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Approve
                                    </button>
                                </form>
                                <form action="{{ route('approve-request', [$request->id, 'reject']) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        Reject
                                    </button>
                                </form>
                            </div>
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
