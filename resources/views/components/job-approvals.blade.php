<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="card-holder">
        @foreach($jobs as $job)
        <div class="content-holder">
            <div class="left-content">
                <div class="detail-holder">
                    <h3>{{ $job->job_title}}</h3>
                    <p>{{ $job->job_location}}</p>
                    <p>{{ $job->salary}}</p>
                    <p>{{ $job->job_type}}</p>
                    <p>{{ $job->job_description}}</p>
                    <h5>Posted by: {{ $job->user->first_name}} {{ $job->user->last_name}}</h5>
                </div>
            </div>
            <div>
                <div class="button-holder">
                    <form action="{{ route('job.approve', $job->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="approve-button" onclick="return confirm('Are you sure you want to approve this job post?')">Approve</button>
                    </form>
                    <form id="delete-form" action="{{ route('job.delete', $job->id) }}" method="POST" onsubmit="return confirmDelete();" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to reject this job post?')">Reject</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</body>
</html>

<style>
    .content-holder {
        display: flex;
        justify-content: space-between;
        background-color: white;
        border-radius: 20px;
        height: 300px;
        width: 800px;
        padding: 20px;
        box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
        margin-bottom: 10px;
        transition: transform 0.3s ease;
    }

    .content-holder:hover {
        transform: scale(1.02);
    }
    .left-content {
        display: flex;
        gap: 10px
    }
    .image-holder {
        width: 250px;
    }

    .image-holder img {
        border-radius: 20px;
        object-fit: cover;
        width: 100%;
        height: 100%;
    }
    .detail-holder {
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 4px;
    }

    .card-holder {
        display: flex;
        align-items: center;
        flex-direction: column;
    }

    .approve-button {
        padding: 2px 10px 2px 10px;
        background-color: #00A36C;
        color: white;
        cursor: pointer;
        border: none;
        border-radius: 3px
    }

    .approve-button:hover {
        background-color: #016443;
    }

    .delete-btn {
        padding: 2px 10px 2px 10px;
        background-color: #BB0237;
        color: white;
        cursor: pointer;
        border: none;
        border-radius: 3px
    }

    .delete-btn:hover {
        background-color: #850227;
    }

    .button-holder {
        display: flex;
        flex-direction: row;
        gap: 10px
    }
</style>