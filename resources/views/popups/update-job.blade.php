<form method="POST" action="{{ route('jobs.update', $job->id) }}">
    @csrf
    @method('PUT')

    <input type="text" name="job_title" value="{{ $job->job_title }}" placeholder="Job Title">
    <input type="text" name="job_location" value="{{ $job->job_location }}" placeholder="Job Location">
    <input type="text" name="salary" value="{{ $job->salary }}" placeholder="Salary">

    <button type="submit">Update</button>
</form>
