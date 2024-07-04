<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Activity Logs</title>
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-5">
        <h1 class="custom-h1 text-3xl font-bold text-center py-6">User Activity Logs</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-5">
                @if($logs->isEmpty())
                    <p class="text-gray-700">No activity logs found.</p>
                @else
                    <table class="custom-table">
                        <thead class="custom-thead">
                            <tr class="bg-gray-200">
                                <th class="custom-th py-2 px-4">User</th>
                                <th class="custom-th py-2 px-4">Activity</th>
                                <th class="custom-th py-2 px-4">Description</th>
                                <th class="custom-th py-2 px-4">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody class="custom-tbody">
                            @foreach($logs as $log)
                                <tr class="custom-tr custom-bg-gray-50 hover:bg-gray-100">
                                    <td class="custom-td py-2 px-4 border-b border-gray-200">{{ $log->user->first_name }} {{ $log->user->last_name }}</td>
                                    <td class="custom-td py-2 px-4 border-b border-gray-200">{{ $log->activity }}</td>
                                    <td class="custom-td py-2 px-4 border-b border-gray-200">
                                        @php
                                            $description = explode(', ', $log->description);
                                            $caption = $description[0] ?? '';
                                            $mediaUrl = null;
                                            foreach ($description as $part) {
                                                if (strpos($part, 'Media URL:') !== false) {
                                                    $mediaUrl = trim(str_replace('Media URL:', '', $part));
                                                    break;
                                                }
                                            }
                                        @endphp
                                        <div>{{ $caption }}</div>
                                        @if($mediaUrl)
                                            <div>
                                                <img src="{{ $mediaUrl }}" alt="User Uploaded Image" class="w-10 h-10 mt-2 object-cover rounded-lg">
                                            </div>
                                        @endif
                                    </td>
                                    <td class="custom-td py-2 px-4 border-b border-gray-200">{{ \Carbon\Carbon::parse($log->created_at)->format('F j, Y, g:i a') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-5">
                        {{ $logs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>

<style>
    body {
        background-color: #f3f4f6; 
        font-family: Arial, sans-serif; 
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        overflow: hidden;
    }

    .custom-h1 {
        background-color: #162F65;
        color: white;
        font-size: 1.5rem;
        font-weight: bold;
        padding: 1rem;
        top: 0;
    }

    .custom-table {
        width: 100%;
        background-color: #fff;
        border-collapse: collapse;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        table-layout: fixed;
        height: 500px;
    }

    .custom-th,
    .custom-td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        width: 25%; 
    }

    .custom-th {
        background-color: #f2f2f2;
        position: sticky;
        top: 80px; 
        z-index: 998;
    }

    .custom-thead {
        display: table;
        width: 100%;
        table-layout: fixed;
    }

    .custom-tbody {
        display: block;
        max-height: 400px; 
        overflow: auto;
        width: 100%;
    }

    .custom-tr {
        display: table;
        width: 100%;
        table-layout: fixed;
    }

    .custom-tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>
