<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Activity Logs</title>
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-5">
        <h1 class="text-3xl font-bold mb-5">User Activity Logs</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-5">
                @if($logs->isEmpty())
                    <p class="text-gray-700">No activity logs found.</p>
                @else
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="w-1/4 py-2">User</th>
                                <th class="w-1/4 py-2">Activity</th>
                                <th class="w-1/4 py-2">Description</th>
                                <th class="w-1/4 py-2">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach($logs as $log)
                                <tr class="bg-gray-50">
                                    <td class="py-2 px-4 border-b border-gray-200">{{ $log->user->first_name }} {{ $log->user->last_name }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200">{{ $log->activity }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200">
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
                                    <td class="py-2 px-4 border-b border-gray-200">{{ \Carbon\Carbon::parse($log->created_at)->format('F j, Y, g:i a') }}</td>
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
