<!-- resources/views/logs/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Activity Logs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>User Activity Logs</h1>
        <div class="card">
            <div class="card-body">
                @if($logs->isEmpty())
                    <p>No activity logs found.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Activity</th>
                                <th>Description</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                                <tr>
                                    <td>{{ $log->user->first_name }} {{ $log->user->last_name }}</td>
                                    <td>{{ $log->activity }}</td>
                                    <td>
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
                                                <img src="{{ asset($mediaUrl) }}" alt="User Uploaded Image" style="max-width: 150px; height: auto;">
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($log->created_at)->format('F j, Y, g:i a') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $logs->links() }}
                @endif
            </div>
        </div>
    </div>
</body>
</html>
